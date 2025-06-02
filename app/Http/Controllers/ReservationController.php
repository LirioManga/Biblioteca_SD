<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Resource;
use Exception;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function requestResource(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'resource_id' => 'required|exists:resources,id',
            ]);

            $resource = Resource::findOrFail($request->resource_id);

            if (!$resource->available) {
                return response()->json([
                    'status' => false,
                    'message' => 'Recurso indisponível para requisição.'
                ]);
            }

            $reservation = Reservation::create([
                'user_id' => $request->user_id,
                'resource_id' => $request->resource_id,
                'requested_at' => now(),
                'status' => 'requested',
            ]);

            $resource->available = 0;
            $resource->save();

            return response()->json([
                'status' => true,
                'message' => 'Recurso requisitado com sucesso!',
                'data' => $reservation
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao requisitar o recurso: ' . $e->getMessage()
            ]);
        }
    }

    public function cancelReservation(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
        ]);

        $reservation = Reservation::findOrFail($request->reservation_id);

        if ($reservation->status !== 'requested') {
            return response()->json([
                'status' => false,
                'message' => 'Só é possível cancelar uma requisição que ainda não foi devolvida.'
            ]);
        }

        $reservation->status = 'cancelled';
        $reservation->returned_at = now();
        $reservation->save();

        $resource = $reservation->resource;
        $resource->available = 1;
        $resource->save();

        return response()->json([
            'status' => true,
            'message' => 'Requisição cancelada com sucesso!',
            'data' => $reservation
        ]);
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
                'status' => false,
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
