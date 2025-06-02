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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
            'image' => 'nullable|image|max:2048',
        ]);

        $resource = new Resource($validated);
        if (Auth::check()) {
            $resource->owner_id = Auth::user()->id;
        } else {
            // $resource->owner_id = $request->input('owner_id');
            $resource->owner_id = '1b341d40-1c04-40cc-8aae-29d3dc7dadf0'; // so para testes
        }

        if ($request->hasFile('file_path')) {
            $resource->file_path = $request->file('file_path')->store('resources/files');
        }

        if ($request->hasFile('image_path')) {
            $resource->image_path = $request->file('image_path')->store('resources/images');
        }

        $resource->save();

        return response()->json([
            'status' => true,
            'message' => 'Recurso registado com sucesso!',
            'data' => $resource
        ]);
    }

    public function update(Request $request)
    {
        // Log::info('Dados recebidos: ' . json_encode($request->all()));
        // Log::info('ID do recurso: ' . $id);
        try {
            // Validação dos dados recebidos
            $validated = $request->validate([
                'id' => 'required|integer|exists:resources,id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'type' => 'required|string',
                'file' => 'nullable|file|mimes:pdf,doc,docx',
                'image' => 'nullable|image|max:2048',
            ]);

            $resource = Resource::findOrFail($validated['id']);

            // if (Auth::check() && Auth::id() !== $resource->owner_id) {
            //     return response()->json([
            //         'status' => false,
            //         'message' => 'Você não tem permissão para actualizar este recurso.'
            //     ]);
            // }

            if ($request->hasFile('file')) {
                if ($resource->file_path && Storage::exists($resource->file_path)) {
                    Storage::delete($resource->file_path);
                }
                $resource->file_path = $request->file('file')->store('resources/files');
            }

            if ($request->hasFile('image')) {
                if ($resource->image_path && Storage::exists($resource->image_path)) {
                    Storage::delete($resource->image_path);
                }
                $resource->image_path = $request->file('image')->store('resources/images');
            }

            $resource->title = $validated['title'];
            $resource->description = $validated['description'] ?? $resource->description;
            $resource->type = $validated['type'];

            $resource->save();

            return response()->json([
                'status' => true,
                'message' => 'Recurso atualizado com sucesso!',
                'data' => $resource
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao atualizar o recurso: ' . $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $resource = Resource::findOrFail($id);
            if ($resource->file_path && Storage::exists($resource->file_path)) {
                Storage::delete($resource->file_path);
            }

            if ($resource->image_path && Storage::exists($resource->image_path)) {
                Storage::delete($resource->image_path);
            }

            $resource->delete();

            return response()->json([
                'status' => true,
                'message' => 'Recurso excluído com sucesso!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao excluir o recurso: ' . $e->getMessage()
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

    public function show()
    {
        $resources = Resource::all();
        $resourcesWithOwnerName = $resources->map(function ($resource) {
            $owner = User::where('id', $resource->owner_id)->first();
            $resource->owner_name = $owner ? $owner->name : null;
            return $resource;
        });
    
        return response()->json([
            'message' => 'Lista de recursos',
            'data' => $resources
        ]);
    }

    public function search($id)
    {
        try {
            $resource = Resource::findOrFail($id);

            return response()->json([
                'message' => 'Recurso encontrado',
                'data' => $resource
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Recurso não encontrado'
            ]);
        }
    }

}
