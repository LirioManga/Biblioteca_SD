<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Resource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{

    public function store(Request $request)
    {
        Log::info('Available value: ' . $request->input('available'));
        Log::info('Boolean conversion: ' . ($request->boolean('available') ? 'true' : 'false'));
        try {

            $file = $request->file('file_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('recursos/arquivos', $fileName, 'public');

            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_img_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('recursos/imagens', $imageName, 'public');
            }

            $recurso = Resource::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'type' => $request->input('type'),
                'file_path' => $filePath,
                'available' => $request->boolean('available'),
                'owner_id' => auth()->id(),
            ]);

            // Log::info('Recurso adicionado: ' . json_encode($recurso));

            return response()->json([
                'success' => true,
                'message' => 'Recurso adicionado com sucesso!',
                'recurso' => $recurso,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao adicionar recurso: ' . $e->getMessage(),
            ]);
        }
    }

    public function edit($resourceId)
    {
        try {
            $resource = Resource::findOrFail($resourceId);

            // Verifica se o usuário autenticado é o proprietário do recurso
            if (Auth::check() && Auth::id() !== $resource->owner_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Você não tem permissão para editar este recurso.'
                ], 403);
            }

            return response()->json([
                'success' => true,
                'data' => $resource
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar o recurso: ' . $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $resourceId)
    {
        try {
            $resource = Resource::findOrFail($resourceId);
            
            if (Auth::id() !== $resource->owner_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Você não tem permissão para atualizar este recurso.'
                ], 403);
            }
    
            $request->validate([
                'title' => 'sometimes|required|string|max:255',
                'description' => 'sometimes|required|string',
                'type' => 'sometimes|required|string',
                'file_path' => 'sometimes|file',
                'image' => 'sometimes|image',
                'available' => 'sometimes|boolean',
            ]);
    
            $data = $request->only(['title', 'description', 'type', 'available']);
    
            if ($request->hasFile('file_path')) {
                // Remove o arquivo antigo se existir
                if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
                    Storage::disk('public')->delete($resource->file_path);
                }
                
                $file = $request->file('file_path');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $data['file_path'] = $file->storeAs('recursos/arquivos', $fileName, 'public');
            }
    
            if ($request->hasFile('image')) {
                // Remove a imagem antiga se existir
                if ($resource->image_path && Storage::disk('public')->exists($resource->image_path)) {
                    Storage::disk('public')->delete($resource->image_path);
                }
                
                $image = $request->file('image');
                $imageName = time() . '_img_' . $image->getClientOriginalName();
                $data['image_path'] = $image->storeAs('recursos/imagens', $imageName, 'public');
            }
    
            $resource->update($data);
    
            return response()->json([
                'success' => true,
                'message' => 'Recurso atualizado com sucesso!',
                'data' => $resource,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar recurso: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $recurso = Resource::findOrFail($id);
            
            // Verifica se o usuário é o dono do recurso
            if ($recurso->owner_id !== auth()->id()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Você não tem permissão para excluir este recurso.',
                ], 403);
            }
    
            // Remove os arquivos associados
            Storage::disk('public')->delete($recurso->file_path);
            if ($recurso->image_path) {
                Storage::disk('public')->delete($recurso->image_path);
            }
    
            $recurso->delete();
    
            return response()->json([
                'success' => true,
                'message' => 'Recurso excluído com sucesso!',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao excluir recurso: ' . $e->getMessage(),
            ]);
        }
    }

    public function download($id)
    {
        try {
            $resource = Resource::findOrFail($id);

            if (!$resource->file_path || !Storage::exists($resource->file_path)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Arquivo não encontrado!'
                ], 404);
            }

            return Storage::download($resource->file_path);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erro ao baixar o arquivo: ' . $e->getMessage()
            ]);
        }
    }

    public function myResources()
    {
        try {
            $userId = Auth::id(); 
            $recursos = Resource::where('owner_id', $userId)->get();

            return response()->json([
                'success' => true,
                'data' => $recursos
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar os recursos: ' . $e->getMessage()
            ]);
        }
    }
    public function search(Request $request)
    {
        try {
            $searchTerm = $request->input('q');
            $userId = auth()->id();
    
            $query = Resource::where('owner_id', $userId)
                        ->orderBy('created_at', 'desc');
    
            if ($searchTerm) {
                $query->where('title', 'LIKE', "%$searchTerm%")
                      ->orWhere('description', 'LIKE', "%$searchTerm%");
            }
    
            return response()->json([
                'success' => true,
                'data' => $query->get()
            ]);
    
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar recursos: ' . $e->getMessage()
            ], 500);
        }
    }
}
