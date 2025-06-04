<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetMail;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    public function reset(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json(['message' => 'E-mail não encontrado.'], 404);
            }

            // Gera uma nova senha com um padrão
            $novaSenha = 'Util@' . date('Y') . rand(1000, 9999);

            // Atualiza a senha na base de dados (criptografada)
            $user->password = Hash::make($novaSenha);
            $user->save();
            Mail::to($user->email)->send(new PasswordResetMail($user->name, $novaSenha));

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Uma nova senha foi enviada para o seu e-mail.'
                ],
                200
            );
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao processar a solicitação: ' . $e->getMessage()
            ], 500);
        }
    }
}
