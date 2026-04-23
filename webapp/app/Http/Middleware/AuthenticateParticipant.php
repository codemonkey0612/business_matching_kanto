<?php

namespace App\Http\Middleware;

use App\Models\Participant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateParticipant
{
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->session()->get('participant_id');
        if (!$id) {
            return redirect()->route('login.show');
        }
        $participant = Participant::find($id);
        if (!$participant) {
            $request->session()->forget('participant_id');
            return redirect()->route('login.show');
        }
        $request->attributes->set('participant', $participant);
        return $next($request);
    }
}
