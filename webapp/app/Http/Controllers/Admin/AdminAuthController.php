<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function showLogin(): View
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'login_id' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $admin = AdminUser::where('login_id', $data['login_id'])->first();
        if (!$admin || !Hash::check($data['password'], $admin->password_hash)) {
            return back()->withErrors(['login_id' => 'IDまたはパスワードが正しくありません'])
                ->withInput($request->only('login_id'));
        }

        $request->session()->regenerate();
        $request->session()->put('admin_id', $admin->id);
        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login.show');
    }
}
