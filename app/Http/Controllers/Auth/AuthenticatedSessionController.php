<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        Log::info('Login attempt', ['email' => $request->email, 'password' => $request->password]);
        session()->regenerate();
        try{
           
            // dd($data);

            if (Auth::attempt(['name' => $request->name, 'password' => $request->password]) || 
            Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
               Log::info('User authenticated');
                // dd(Auth::user());
                switch ($user->user_type) {
                    case 'admin':
                        // $admin = $user;
                       Log::info('Admin user authenticated');
                        return redirect()->to('/admin')->with(['user' => $user]);

                    case 'student':
                        Log::info('Student user authenticated');
                            // $student = $user->direcao;
                            return redirect()->to('/student')->with(['user' => $user]);
                    default:
                        return back()->withInput()
                            ->withErrors(['name' => 'As credenciais fornecidas não correspondem aos nossos registros.']);
                }
            } else {
                return back()->withInput()
                    ->withErrors(['name' => 'Utilizador ou senha inválidos.']);
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
