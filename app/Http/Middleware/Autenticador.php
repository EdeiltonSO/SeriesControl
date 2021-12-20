<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Autenticador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $req, Closure $next)
    {
        // caso esse middleware esteja no grupo web do
        // arquivo Kernel.php, dá pra adicionar exceções
        // e evitar loop de redirecionamento com:
        // if(!$req-is('entrar', 'registrar') && !Auth::check())

        if(!Auth::check()) {
            return redirect('/entrar');
        }
        return $next($req);
    }
}
