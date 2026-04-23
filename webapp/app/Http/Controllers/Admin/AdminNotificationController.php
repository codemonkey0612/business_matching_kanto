<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminNotificationController extends Controller
{
    public function index(Request $request): View
    {
        $query = NotificationLog::with(['contactRequest.fromParticipant', 'target'])
            ->orderByDesc('created_at');

        if ($status = $request->query('status')) {
            $query->where('send_status', $status);
        }

        $logs = $query->paginate(30)->withQueryString();

        return view('admin.notifications.index', compact('logs'));
    }
}
