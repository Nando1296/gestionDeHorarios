<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreLogin;
use App\Http\Requests\StorePerfil;
class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     */
   
    public function authenticate(StoreLogin $request): RedirectResponse
    {
        $credentials = $request->validate([
            'usuario' => ['required'],
            'contrasenia' => ['required']
        ]);

        $usuario = Usuario::query()
            ->where('usuario', $credentials['usuario'])
            ->where('contrasenia', $credentials['contrasenia'])
            ->where('estado',1)
            ->first();
        
            if ($usuario) {
                Auth::login($usuario);
                $request->session()->regenerate();
                return redirect()->intended('/menu')->with('id',$usuario->id);
            }  
          
            throw \Illuminate\Validation\ValidationException::withMessages([
    
                'contrasenia' => __('auth.failed'),
                
            ]);
             
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('/');
    }
    public function showEditPassword()
    {
        $usuario = Usuario::all();
        return view('Perfil-Usuario.Cambiar_Contrasenia', ['usuarios' => $usuario]);

     }

    public function updatePassword(StorePerfil $request)
    {
        # Validacion
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'new_password_confirmation' =>'required',
        ]);
        #Coincidir con la contraseña anterior
        if(Hash::check($request->old_password, auth()->user()->contrasenia)){
         return back()->with("error", "La contraseña es incorrecta!");
        }
        #actualizar la nueva contraseña
        Usuario::whereId(auth()->user()->id)->update([
            'contrasenia' => $request->new_password
        ]);
       return redirect()->route('CambiarContraseña')->with('actualizar', 'ok');
    }
}
