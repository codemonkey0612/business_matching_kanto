<?php

namespace App\Http\Middleware;

use App\Models\AdminUser;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->session()->get('admin_id');
        if (!$id) {
            return redirect()->route('admin.login.show');
        }
        $admin = AdminUser::find($id);
        if (!$admin) {
            $request->session()->forget('admin_id');
            return redirect()->route('admin.login.show');
        }
        $request->attributes->set('admin', $admin);
        return $next($request);
    }
}
