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

    public function viewRequestsToMyResources()
    {
        try {
            $userId = auth()->id();

            $reservations = Reservation::with(['user', 'resource'])
                ->whereHas('resource', function ($query) use ($userId) {
                    $query->where('owner_id', $userId);
                })
                ->where('status', '!=', 'cancelled')
                ->latest()
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Requisições para meus recursos.',
                'data' => $reservations
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar requisições: ' . $e->getMessage()
            ]);
        }
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

    public function verificarRecursoAprovado($id)
    {
        try {
            $userId = auth()->id();

            $reservation = Reservation::where('resource_id', $id)
                ->where('user_id', $userId)
                ->where('status', 'approved')
                ->first();

            if (!$reservation) {
                return response()->json([
                    'success' => false,
                    'message' => 'Este recurso ainda não foi aprovado para visualização.'
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Recurso aprovado.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao verificar recurso: ' . $e->getMessage()
            ]);
        }
    }

    public function aprovarRequisicao(Request $request)
    {
        try {
            $reservation = Reservation::where('id', $request->id)
                ->whereHas('resource', function ($query) {
                    $query->where('owner_id', auth()->id());
                })
                ->firstOrFail();

            if ($reservation->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'A requisição já foi processada.'
                ]);
            }

            $reservation->status = 'approved';
            $reservation->save();

            return response()->json([
                'success' => true,
                'message' => 'Requisição aprovada com sucesso!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao aprovar requisição: ' . $e->getMessage()
            ]);
        }
    }

    public function rejeitarRequisicao(Request $request)
    {
        try {
            $reservation = Reservation::where('id', $request->id)
                ->whereHas('resource', function ($query) {
                    $query->where('owner_id', auth()->id());
                })
                ->firstOrFail();

            if ($reservation->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'A requisição já foi processada.'
                ]);
            }

            $reservation->status = 'rejected';
            $reservation->save();

            return response()->json([
                'success' => true,
                'message' => 'Requisição rejeitada com sucesso!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao rejeitar requisição: ' . $e->getMessage()
            ]);
        }
    }

    public function abrirRecurso($id)
    {
        try {
            $userId = auth()->id();

            $reservation = Reservation::where('resource_id', $id)
                ->where('user_id', $userId)
                ->where('status', 'approved')
                ->first();

            if (!$reservation) {
                return response()->json([
                    'success' => false,
                    'message' => 'Você não tem permissão para acessar este recurso ou ele ainda não foi aprovado.'
                ]);
            }

            $resource = $reservation->resource;

            return response()->json([
                'success' => true,
                'title' => $resource->title,
                'pdf_url' => asset('storage/' . $resource->file_path),
                'data' => $resource,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao abrir recurso: ' . $e->getMessage()
            ]);
        }
    }
}
