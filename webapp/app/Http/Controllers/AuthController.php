<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $participant = Participant::where('email', $data['email'])->first();
        if (!$participant || !Hash::check($data['password'], $participant->password_hash)) {
            return back()->withErrors(['email' => 'メールアドレスまたはパスワードが正しくありません'])
                ->withInput($request->only('email'));
        }

        $request->session()->regenerate();
        $request->session()->put('participant_id', $participant->id);

        if ($participant->isCompleted()) {
            return redirect()->route('matching.index');
        }
        return redirect()->route('profile.edit');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('participant_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.show');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:254', 'unique:participants,email'],
            'password' => ['required', 'string', 'min:8', 'max:100', 'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/'],
            'password_confirmation' => ['required', 'same:password'],
            'agree' => ['accepted'],
        ], [
            'password.regex' => 'パスワードは英数混在で入力してください',
            'agree.accepted' => '利用規約・個人情報同意にチェックしてください',
            'email.unique' => 'このメールアドレスは既に登録されています',
        ]);

        $participant = Participant::create([
            'company_id' => null,
            'name' => null,
            'name_kana' => null,
            'role_title' => null,
            'phone_number' => null,
            'email' => $data['email'],
            'password_hash' => Hash::make($data['password']),
            'registration_status' => 'draft',
            'agreed_at' => true,
            'agreed_timestamp' => now(),
        ]);

        $request->session()->regenerate();
        $request->session()->put('participant_id', $participant->id);

        return redirect()->route('profile.edit');
    }
}
