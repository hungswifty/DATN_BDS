<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Session;

class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //dung session de bat loi, ko dang nhap k vao dc dashboard
        //
        $id = $this->getIdSesionAdmin();
        $user = $this->getUserSessionAdmin();
        if ($id <= 0 || empty($user)) {
            return redirect()->route('admin.login');
        }
        return $next($request);
    }

    private function getIdSesionAdmin(){
        $idAdmin = Session::get('id');
        $idAdmin = is_numeric($idAdmin) ? $idAdmin : 0;
        return $idAdmin;
    }

    private function getUserSessionAdmin(){
        $userAdmin = Session::get('username');
        return $userAdmin;
    }
}
