@extends('layouts.admin')
@section('title', 'ダッシュボード')

@section('content')

@php
  $completionRate = $stats['total'] > 0 ? round($stats['completed'] / $stats['total'] * 100) : 0;
  $contactRate    = $stats['display_count'] > 0 ? round($stats['contacts'] / $stats['display_count'] * 100, 1) : 0;
  $avgViews       = $stats['total'] > 0 ? round($stats['display_count'] / $stats['total']) : 0;
  $hasFail        = $stats['mail_failed'] > 0;
@endphp

<style>
.kpi-card{border-radius:18px;padding:20px 18px;position:relative;overflow:hidden;color:white;box-shadow:0 8px 24px -4px var(--shadow)}
.kpi-card .blob1{position:absolute;top:-24px;right:-20px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,0.12);pointer-events:none}
.kpi-card .blob2{position:absolute;bottom:-30px;right:14px;width:70px;height:70px;border-radius:50%;background:rgba(255,255,255,0.07);pointer-events:none}
.kpi-card .blob3{position:absolute;top:50%;left:-16px;width:56px;height:56px;border-radius:50%;background:rgba(255,255,255,0.05);transform:translateY(-50%);pointer-events:none}
.kpi-icon{width:36px;height:36px;background:rgba(255,255,255,0.20);border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:14px;position:relative;box-shadow:0 1px 0 rgba(255,255,255,0.30) inset}
.kpi-num{font-size:clamp(30px,6.5vw,44px);font-weight:800;color:white;line-height:1;letter-spacing:-0.04em;font-family:'Inter',sans-serif;position:relative}
.kpi-label{font-size:12px;color:rgba(255,255,255,0.65);margin-top:5px;font-family:'Noto Sans JP',sans-serif;position:relative;letter-spacing:0.03em}
.kpi-footer{margin-top:14px;padding-top:12px;border-top:1px solid rgba(255,255,255,0.18);position:relative}

.cool-table{width:100%;border-collapse:collapse}
.cool-table thead tr{background:linear-gradient(135deg,#6366F1 0%,#818CF8 100%)}
.cool-table thead th{padding:13px 18px;text-align:left;font-size:10.5px;font-weight:700;color:rgba(255,255,255,0.72);text-transform:uppercase;letter-spacing:0.13em;font-family:'Inter',sans-serif;white-space:nowrap;border:none}
.cool-table tbody td{padding:15px 18px;border-bottom:1px solid #F1F5F9;vertical-align:middle}
.cool-table tbody tr:last-child td{border-bottom:none}
.cool-table tbody tr{transition:background 120ms,box-shadow 120ms}
.cool-table tbody tr:hover{background:#FAFBFF;box-shadow:inset 3px 0 0 #6366F1}
@keyframes pulse-dot{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.55;transform:scale(1.3)}}
</style>

{{-- ── Page header ── --}}
<div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:22px;flex-wrap:wrap;gap:12px">
  <div>
    <p style="font-size:11px;font-weight:700;color:#C7D2FE;text-transform:uppercase;letter-spacing:0.12em;margin-bottom:5px;font-family:'Inter',sans-serif">Overview</p>
    <h1 style="font-size:clamp(20px,4vw,24px);font-weight:800;color:#1E293B;line-height:1;letter-spacing:-0.025em;font-family:'Inter',sans-serif">ダッシュボード</h1>
  </div>
  @if($hasFail)
    <a href="{{ route('admin.notifications.index', ['status'=>'failed']) }}"
       style="display:inline-flex;align-items:center;gap:7px;background:linear-gradient(135deg,#EF4444,#DC2626);color:#fff;border:none;border-radius:10px;padding:9px 16px;font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;box-shadow:0 4px 12px rgba(239,68,68,0.35);transition:opacity 150ms;font-family:'Noto Sans JP',sans-serif"
       onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
      失敗 {{ $stats['mail_failed'] }}件
    </a>
  @endif
</div>

{{-- ── KPI grid ── --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-5">

  <div class="kpi-card" style="background:linear-gradient(135deg,#6366F1 0%,#8B5CF6 100%);--shadow:rgba(99,102,241,0.30)">
    <div class="blob1"></div><div class="blob2"></div><div class="blob3"></div>
    <div class="kpi-icon">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    </div>
    <p class="kpi-num">{{ $stats['total'] }}</p>
    <p class="kpi-label">登録者数</p>
    <div class="kpi-footer">
      <div style="display:flex;gap:16px">
        <div>
          <p style="font-size:9.5px;color:rgba(255,255,255,0.50);text-transform:uppercase;letter-spacing:0.08em;margin-bottom:3px;font-family:'Inter',sans-serif">完了</p>
          <p style="font-size:18px;font-weight:800;color:white;line-height:1;font-family:'Inter',sans-serif">{{ $stats['completed'] }}</p>
        </div>
        <div>
          <p style="font-size:9.5px;color:rgba(255,255,255,0.50);text-transform:uppercase;letter-spacing:0.08em;margin-bottom:3px;font-family:'Inter',sans-serif">途中</p>
          <p style="font-size:18px;font-weight:800;color:rgba(255,255,255,0.75);line-height:1;font-family:'Inter',sans-serif">{{ $stats['draft'] }}</p>
        </div>
      </div>
    </div>
  </div>

  <div class="kpi-card" style="background:linear-gradient(135deg,#3B82F6 0%,#06B6D4 100%);--shadow:rgba(59,130,246,0.28)">
    <div class="blob1"></div><div class="blob2"></div><div class="blob3"></div>
    <div class="kpi-icon">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
    </div>
    <p class="kpi-num">{{ number_format($stats['display_count']) }}</p>
    <p class="kpi-label">表示回数</p>
    <div class="kpi-footer">
      <div style="display:flex;align-items:center;gap:6px">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.55)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
        <p style="font-size:12px;color:rgba(255,255,255,0.65);font-family:'Inter',sans-serif">平均 <strong style="color:white;font-size:14px;font-weight:700">{{ $avgViews }}</strong> 回/人</p>
      </div>
    </div>
  </div>

  <div class="kpi-card" style="background:linear-gradient(135deg,#10B981 0%,#0D9488 100%);--shadow:rgba(16,185,129,0.28)">
    <div class="blob1"></div><div class="blob2"></div><div class="blob3"></div>
    <div class="kpi-icon">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
    </div>
    <p class="kpi-num">{{ $stats['contacts'] }}</p>
    <p class="kpi-label">連絡希望数</p>
    <div class="kpi-footer">
      <div style="display:flex;align-items:center;gap:6px">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.55)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="5 12 12 5 19 12"/></svg>
        <p style="font-size:12px;color:rgba(255,255,255,0.65);font-family:'Inter',sans-serif">連絡率 <strong style="color:white;font-size:14px;font-weight:700">{{ $contactRate }}%</strong></p>
      </div>
    </div>
  </div>

  <div class="kpi-card" style="background:{{ $hasFail ? 'linear-gradient(135deg,#EF4444 0%,#DC2626 100%)' : 'linear-gradient(135deg,#F59E0B 0%,#F97316 100%)' }};--shadow:{{ $hasFail ? 'rgba(239,68,68,0.28)' : 'rgba(245,158,11,0.28)' }}">
    <div class="blob1"></div><div class="blob2"></div><div class="blob3"></div>
    <div class="kpi-icon">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
    </div>
    <p class="kpi-num">{{ $stats['mail_sent'] }}</p>
    <p class="kpi-label">通知送信数</p>
    <div class="kpi-footer">
      @if($hasFail)
        <div style="display:flex;align-items:center;gap:6px">
          <span style="width:7px;height:7px;border-radius:50%;background:white;display:inline-block;flex-shrink:0;animation:pulse-dot 1.4s ease-in-out infinite"></span>
          <p style="font-size:12px;font-weight:600;color:white;font-family:'Noto Sans JP',sans-serif">失敗 {{ $stats['mail_failed'] }}件あり</p>
        </div>
      @else
        <div style="display:flex;align-items:center;gap:6px">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.70)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
          <p style="font-size:12px;color:rgba(255,255,255,0.65);font-family:'Inter',sans-serif">All sent successfully</p>
        </div>
      @endif
    </div>
  </div>

</div>

{{-- ── Completion bar ── --}}
<div style="background:#fff;border:1px solid #E8EAED;border-radius:16px;padding:18px 20px;margin-bottom:20px;box-shadow:0 2px 8px rgba(0,0,0,0.04)">
  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px">
    <div style="display:flex;align-items:center;gap:8px">
      <div style="width:28px;height:28px;background:#EEF2FF;border-radius:7px;display:flex;align-items:center;justify-content:center">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#6366F1" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
      </div>
      <p style="font-size:13.5px;font-weight:700;color:#1E293B;font-family:'Inter',sans-serif">プロフィール完了率</p>
    </div>
    <div style="display:flex;align-items:baseline;gap:3px">
      <span style="font-size:26px;font-weight:800;color:#6366F1;font-family:'Inter',sans-serif;line-height:1;letter-spacing:-0.03em">{{ $completionRate }}</span>
      <span style="font-size:14px;font-weight:600;color:#6366F1;font-family:'Inter',sans-serif">%</span>
    </div>
  </div>
  <div style="height:10px;background:#F1F5F9;border-radius:100px;overflow:hidden;position:relative">
    <div style="height:100%;width:{{ $completionRate }}%;background:linear-gradient(90deg,#6366F1,#8B5CF6);border-radius:100px;transition:width .8s ease;position:relative">
      <div style="position:absolute;right:0;top:0;bottom:0;width:4px;background:rgba(255,255,255,0.40);border-radius:100px"></div>
    </div>
  </div>
  <div style="display:flex;justify-content:space-between;margin-top:10px">
    <div style="display:flex;align-items:center;gap:5px">
      <span style="width:8px;height:8px;background:#10B981;border-radius:50%;display:inline-block"></span>
      <span style="font-size:12px;color:#10B981;font-weight:600;font-family:'Inter',sans-serif">完了 {{ $stats['completed'] }}名</span>
    </div>
    <div style="display:flex;align-items:center;gap:5px">
      <span style="width:8px;height:8px;background:#F59E0B;border-radius:50%;display:inline-block"></span>
      <span style="font-size:12px;color:#D97706;font-weight:600;font-family:'Inter',sans-serif">途中 {{ $stats['draft'] }}名</span>
    </div>
  </div>
</div>

{{-- ── Recent contacts ── --}}
<div style="background:#fff;border:1px solid #E8EAED;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.06)">

  <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-bottom:1px solid #F1F5F9">
    <div style="display:flex;align-items:center;gap:10px">
      <div style="width:32px;height:32px;background:linear-gradient(135deg,#6366F1,#8B5CF6);border-radius:9px;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 6px rgba(99,102,241,0.30)">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
      </div>
      <div>
        <h2 style="font-size:14px;font-weight:700;color:#1E293B;line-height:1;font-family:'Inter',sans-serif">最近の連絡希望</h2>
        <p style="font-size:11.5px;color:#94A3B8;margin-top:2px;font-family:'Inter',sans-serif">直近10件</p>
      </div>
    </div>
    <a href="{{ route('admin.notifications.index') }}"
       style="display:inline-flex;align-items:center;gap:5px;font-size:12.5px;font-weight:600;color:#6366F1;text-decoration:none;padding:7px 12px;border-radius:8px;background:#EEF2FF;border:1px solid #E0E7FF;transition:all 150ms;white-space:nowrap;font-family:'Noto Sans JP',sans-serif"
       onmouseover="this.style.background='#6366F1';this.style.color='#fff';this.style.borderColor='#6366F1'"
       onmouseout="this.style.background='#EEF2FF';this.style.color='#6366F1';this.style.borderColor='#E0E7FF'">
      すべて見る
      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
    </a>
  </div>

  @if($recentContacts->isEmpty())
    <div style="padding:56px 20px;text-align:center">
      <div style="width:52px;height:52px;background:#EEF2FF;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#A5B4FC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
      </div>
      <p style="font-size:14px;color:#94A3B8;font-family:'Noto Sans JP',sans-serif">連絡希望はまだありません</p>
    </div>
  @else
    <div style="overflow-x:auto;-webkit-overflow-scrolling:touch">
      <table class="cool-table" style="min-width:520px">
        <thead>
          <tr>
            <th style="width:40px;padding-left:20px">#</th>
            <th>送信者</th>
            <th>受信者</th>
            <th style="width:72px">種別</th>
            <th style="width:90px;padding-right:20px">日時</th>
          </tr>
        </thead>
        <tbody>
          @foreach($recentContacts as $cr)
          @php
            $fromName    = $cr->fromParticipant?->name ?? '—';
            $fromCompany = $cr->fromParticipant?->company?->company_name ?? '';
            $toName      = $cr->toParticipant?->name ?? '—';
            $toCompany   = $cr->toParticipant?->company?->company_name ?? '';
            $initial     = mb_strlen($fromName) > 0 ? mb_strtoupper(mb_substr($fromName, 0, 1)) : '?';
            $pal         = ['#6366F1','#3B82F6','#10B981','#F59E0B','#EC4899','#0891B2'];
            $cc          = mb_strlen($fromName) > 0 ? mb_ord(mb_substr($fromName, 0, 1)) : 0;
            $avc         = $pal[$cc % count($pal)];
          @endphp
          <tr>
            <td style="padding-left:20px;width:40px">
              <span style="font-size:11px;font-weight:600;color:#CBD5E1;font-family:'Inter',sans-serif">{{ str_pad($loop->index + 1, 2, '0', STR_PAD_LEFT) }}</span>
            </td>
            <td>
              <div style="display:flex;align-items:center;gap:10px">
                <div style="width:34px;height:34px;border-radius:10px;background:{{ $avc }};display:flex;align-items:center;justify-content:center;color:white;font-size:13px;font-weight:800;flex-shrink:0;font-family:'Inter',sans-serif;box-shadow:0 0 0 2px #fff,0 0 0 3.5px {{ $avc }}66">{{ $initial }}</div>
                <div>
                  <p style="font-size:13px;font-weight:600;color:#1E293B;line-height:1.3;font-family:'Noto Sans JP',sans-serif;white-space:nowrap">{{ $fromName }}</p>
                  @if($fromCompany)
                    <p style="font-size:11px;color:#94A3B8;line-height:1.3;font-family:'Noto Sans JP',sans-serif;white-space:nowrap">{{ $fromCompany }}</p>
                  @endif
                </div>
              </div>
            </td>
            <td>
              <div style="display:flex;align-items:center;gap:8px">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#C7D2FE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                <div>
                  <p style="font-size:13px;color:#475569;font-family:'Noto Sans JP',sans-serif;white-space:nowrap;font-weight:500">{{ $toName }}</p>
                  @if($toCompany)
                    <p style="font-size:11px;color:#94A3B8;font-family:'Noto Sans JP',sans-serif;white-space:nowrap">{{ $toCompany }}</p>
                  @endif
                </div>
              </div>
            </td>
            <td>
              @if($cr->is_resend)
                <span style="display:inline-flex;align-items:center;gap:4px;background:#FEF3C7;color:#D97706;font-size:11px;font-weight:700;padding:4px 9px;border-radius:100px;font-family:'Inter',sans-serif;white-space:nowrap">
                  <span style="width:4px;height:4px;border-radius:50%;background:currentColor"></span>再送
                </span>
              @else
                <span style="display:inline-flex;align-items:center;gap:4px;background:#EEF2FF;color:#6366F1;font-size:11px;font-weight:700;padding:4px 9px;border-radius:100px;font-family:'Inter',sans-serif;white-space:nowrap">
                  <span style="width:4px;height:4px;border-radius:50%;background:currentColor"></span>初回
                </span>
              @endif
            </td>
            <td style="padding-right:20px">
              <span style="font-family:'Inter',sans-serif;font-size:12px;color:#94A3B8;font-weight:500;white-space:nowrap">{{ $cr->created_at->format('m/d H:i') }}</span>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>

@endsection
