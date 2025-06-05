<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Resource;
use Exception;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function requestResource(Request $request)
    {
        try {
            $resource = Resource::findOrFail($request->id);

            if (!$resource->available) {
                return response()->json([
                    'status' => false,
                    'message' => 'Recurso indisponível para requisição.'
                ]);
            }

            $reservation = Reservation::create([
                'user_id' => $request->user_id,
                'resource_id' => $request->id,
                'requested_at' => now(),
                'user_id' => auth()->id(),
                'status' => 'pending',
            ]);

            $resource->available = 0;
            $resource->save();

            return response()->json([
                'success' => true,
                'message' => 'Recurso requisitado com sucesso!',
                'data' => $reservation
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao requisitar o recurso: ' . $e->getMessage()
            ]);
        }
    }

    public function cancelReservation(Request $request)
    {
        try {
            $reservation = Reservation::where('resource_id', $request->id)
                ->where('user_id', auth()->id())
                ->whereIn('status', ['approved', 'pending'])
                ->latest()
                ->firstOrFail();

            $reservation->status = 'cancelled';
            $reservation->returned_at = now();
            $reservation->save();

            // Libera o recurso
            $reservation->resource->update(['available' => 1]);

            return response()->json([
                'success' => true,
                'message' => 'Requisição cancelada com sucesso!',
                'data' => $reservation
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cancelar a requisição: ' . $e->getMessage()
            ]);
        }
    }


    public function returnResource(Request $request)
    {
        try {
            $request->validate([
                'reservation_id' => 'required|exists:reservations,id',
            ]);

            $reservation = Reservation::findOrFail($request->reservation_id);

            if ($reservation->status === 'returned') {
                return response()->json([
                    'status' => false,
                    'message' => 'Este recurso já foi devolvido.'
                ]);
            }

            $reservation->returned_at = now();
            $reservation->status = 'returned';
            $reservation->save();

            $resource = $reservation->resource;
            $resource->available = 1;
            $resource->save();

            return response()->json([
                'status' => true,
                'message' => 'Recurso devolvido com sucesso!',
                'data' => $reservation
            ]);
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Erro ao devolver o recurso: ' . $e->getMessage()
            ]);
        }
    }

    public function viewRequestsToMyResources(Request $request)
    {
        $userId = $request->input('owner_id') ?? auth()->id();

        $resourceIds = Resource::where('owner_id', $userId)->pluck('id');

        $reservations = Reservation::whereIn('resource_id', $resourceIds)
            ->with(['user', 'resource'])
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Requisições para meus recursos.',
            'data' => $reservations
        ]);
    }

    public function viewMyRequests(Request $request)
    {
        $userId = $request->input('user_id') ?? auth()->id();

        $reservations = Reservation::where('user_id', $userId)
            ->with('resource')
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'minhas requisicoes.',
            'data' => $reservations
        ]);
    }
}
