<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function admin(){
        return view('admin.index');
    }

    public function student(){
        return view('student.index');
    }

    public function showRecoverForm(){
        return view('auth.forgot-password');
    }

    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('email')),
            ]);

           
            return response()->json([
                'status' => true,
                'message' => 'Utilizador registado com sucesso',
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Erro ao registar o utilizador',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function search($id)
    {
        try {
            $user = User::with('profile')->findOrFail($id);

            return response()->json([
                'status' => true,
                'data' => $user
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Utilizador não encontrado',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function show()
    {
        try {
            $users = User::with('profile')->get();

            return response()->json([
                'status' => true,
                'data' => $users
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao buscar utilizadores',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'required|exists:users,id',
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:users,email,',
                'user_type' => 'sometimes|in:admin,student',
                'gender' => 'nullable|string',
                'birthdate' => 'nullable|date',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:255',
            ]);

            $user = User::findOrFail($validated['id']);
            $user->update($request->only(['name', 'email', 'user_type']));

            if ($user->profile) {
                $user->profile->update($request->only(['gender', 'birthdate', 'phone', 'address']));
            }

            return response()->json([
                'status' => true,
                'message' => 'Utilizador actualizado com sucesso'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao actualizar o utilizador',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
