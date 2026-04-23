<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $__env->yieldContent('title', '管理画面'); ?> | BizMatch</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>tailwind.config={theme:{extend:{}}}</script>
<style>
/* ── Reset ── */
*,*::before,*::after{box-sizing:border-box}
body{
  margin:0;
  font-family:'Inter','Noto Sans JP',-apple-system,BlinkMacSystemFont,sans-serif;
  -webkit-font-smoothing:antialiased;
  background:#F3F4F8;
  color:#1E293B;
  line-height:1.6;
  font-size:15px;
}

/* ─────────────────────────────────────────
   Mobile layout: top bar + bottom tab bar
───────────────────────────────────────── */
.m-topbar{
  position:fixed;top:0;left:0;right:0;
  height:56px;
  background:#fff;
  border-bottom:1px solid #E8EAED;
  z-index:40;
  display:flex;align-items:center;
  padding:0 16px;
  gap:12px;
}
.m-bottomnav{
  position:fixed;bottom:0;left:0;right:0;
  background:#fff;
  border-top:1px solid #E8EAED;
  z-index:40;
  display:flex;
  padding-bottom:env(safe-area-inset-bottom,0px);
}
.m-tab{
  flex:1;display:flex;flex-direction:column;
  align-items:center;justify-content:center;
  gap:3px;padding:10px 4px;
  color:#94A3B8;
  text-decoration:none;
  font-size:10px;font-weight:600;
  font-family:'Noto Sans JP',sans-serif;
  letter-spacing:0.02em;
  transition:color 120ms ease;
  min-height:56px;
  border:none;background:transparent;cursor:pointer;
}
.m-tab svg{transition:transform 120ms ease}
.m-tab:active svg{transform:scale(0.90)}
.m-tab.active{color:#6366F1}
.m-tab span{font-size:10px}

/* Mobile main area */
.main-wrap{
  padding-top:56px;
  padding-bottom:calc(56px + env(safe-area-inset-bottom,0px));
  min-height:100vh;
}

/* ─────────────────────────────────────────
   Desktop layout: sidebar (≥1024px)
───────────────────────────────────────── */
.sidebar{
  display:none;
  position:fixed;top:0;left:0;bottom:0;
  width:240px;
  background:#fff;
  border-right:1px solid #E8EAED;
  z-index:30;
  flex-direction:column;
  overflow-y:auto;
}
@media(min-width:1024px){
  .m-topbar{display:none}
  .m-bottomnav{display:none}
  .sidebar{display:flex}
  .main-wrap{margin-left:240px;padding-top:0;padding-bottom:0}
}

/* ── Sidebar nav items ── */
.nav-item{
  display:flex;align-items:center;gap:10px;
  padding:9px 11px;border-radius:9px;
  font-size:13.5px;font-weight:500;
  color:#94A3B8;
  text-decoration:none;
  transition:color 120ms,background 120ms;
  font-family:'Noto Sans JP',sans-serif;
  letter-spacing:0.02em;
  width:100%;border:none;background:transparent;
  cursor:pointer;text-align:left;
}
.nav-item svg{opacity:.7;flex-shrink:0;transition:opacity 120ms}
.nav-item:hover{color:#334155;background:#F8FAFC}
.nav-item:hover svg{opacity:1}
.nav-item.active{color:#6366F1;background:#EEF2FF;font-weight:600}
.nav-item.active svg{opacity:1;color:#6366F1}

/* ── Cards ── */
.card{background:#fff;border-radius:16px;border:1px solid #E8EAED;box-shadow:0 1px 3px rgba(0,0,0,0.04)}

/* ── Buttons ── */
.btn{
  display:inline-flex;align-items:center;justify-content:center;
  gap:7px;padding:9px 17px;border-radius:9px;
  font-size:13.5px;font-weight:600;
  cursor:pointer;border:none;text-decoration:none;
  transition:all 150ms ease;white-space:nowrap;
  font-family:'Noto Sans JP',sans-serif;letter-spacing:0.02em;
  min-height:40px;-webkit-tap-highlight-color:transparent;
}
.btn-primary{background:#6366F1;color:#fff;box-shadow:0 1px 3px rgba(99,102,241,0.35)}
.btn-primary:hover{background:#4F46E5;box-shadow:0 4px 12px rgba(99,102,241,0.40)}
.btn-ghost{background:#fff;border:1.5px solid #E2E8F0;color:#475569}
.btn-ghost:hover{background:#F8FAFC;border-color:#CBD5E1}
.btn-danger{background:#FEF2F2;border:1.5px solid #FECACA;color:#DC2626}
.btn-danger:hover{background:#FEE2E2}

/* ── Form controls ── */
.form-ctrl{
  width:100%;background:#F8FAFC;border:1.5px solid #E2E8F0;
  border-radius:10px;padding:11px 14px;font-size:14px;
  color:#1E293B;font-family:'Noto Sans JP',sans-serif;
  min-height:44px;transition:border-color 150ms,box-shadow 150ms;
  -webkit-appearance:none;appearance:none;
}
.form-ctrl::placeholder{color:#CBD5E1}
.form-ctrl:focus{outline:none;border-color:#6366F1;box-shadow:0 0 0 3px rgba(99,102,241,0.12);background:#fff}

/* ── Badges ── */
.badge{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:100px;font-size:11.5px;font-weight:600;font-family:'Noto Sans JP',sans-serif}
.badge-green {background:#DCFCE7;color:#16A34A}
.badge-amber {background:#FEF3C7;color:#D97706}
.badge-red   {background:#FEE2E2;color:#DC2626}
.badge-indigo{background:#EEF2FF;color:#6366F1}
.badge-slate {background:#F1F5F9;color:#64748B}

/* ── Table ── */
.admin-table{width:100%;border-collapse:collapse}
.admin-table thead th{padding:11px 16px;text-align:left;font-size:11px;font-weight:700;color:#94A3B8;text-transform:uppercase;letter-spacing:0.08em;background:#FAFBFF;border-bottom:1px solid #E8EAED;white-space:nowrap;font-family:'Inter',sans-serif}
.admin-table tbody td{padding:14px 16px;border-bottom:1px solid #F1F5F9;color:#334155;font-size:13.5px;vertical-align:middle}
.admin-table tbody tr:last-child td{border-bottom:none}
.admin-table tbody tr:hover td{background:#FAFBFF}

/* ── Page animation ── */
@keyframes fadeUp{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
.page-in{animation:fadeUp .35s cubic-bezier(0.22,1,0.36,1) both}

/* ── Flash ── */
.flash-success{display:flex;align-items:center;gap:10px;padding:12px 16px;background:#DCFCE7;border:1px solid #BBF7D0;border-radius:10px;margin-bottom:20px;font-size:14px;color:#16A34A;font-family:'Noto Sans JP',sans-serif}

:focus-visible{outline:2px solid #6366F1;outline-offset:2px}
[x-cloak]{display:none!important}
@media(prefers-reduced-motion:reduce){*,*::before,*::after{animation-duration:.01ms!important;transition-duration:.01ms!important}}

</style>
</head>
<body>


<header class="m-topbar">
  <div style="display:flex;align-items:center;gap:9px">
    <div style="width:30px;height:30px;background:linear-gradient(135deg,#6366F1,#8B5CF6);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    </div>
    <span style="font-size:15px;font-weight:800;color:#1E293B;letter-spacing:-0.02em;font-family:'Inter',sans-serif">BizMatch</span>
    <span style="font-size:10px;font-weight:600;color:#94A3B8;letter-spacing:0.06em;text-transform:uppercase;font-family:'Inter',sans-serif">Admin</span>
  </div>
</header>


<aside class="sidebar">
  
  <div style="padding:20px 18px 16px;border-bottom:1px solid #F1F5F9">
    <div style="display:flex;align-items:center;gap:10px">
      <div style="width:32px;height:32px;background:linear-gradient(135deg,#6366F1,#8B5CF6);border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 2px 8px rgba(99,102,241,0.30)">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      </div>
      <div>
        <p style="font-size:14px;font-weight:800;color:#1E293B;letter-spacing:-0.02em;line-height:1;font-family:'Inter',sans-serif">BizMatch</p>
        <p style="font-size:10px;color:#CBD5E1;margin-top:2px;letter-spacing:0.08em;text-transform:uppercase">Admin Console</p>
      </div>
    </div>
  </div>

  
  <nav style="padding:14px 10px;flex:1" aria-label="管理メニュー">
    <p style="font-size:10px;font-weight:700;color:#CBD5E1;letter-spacing:0.12em;text-transform:uppercase;padding:0 9px;margin-bottom:6px;font-family:'Inter',sans-serif">Menu</p>

    <a href="<?php echo e(route('admin.dashboard')); ?>"
       class="nav-item <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/></svg>
      ダッシュボード
    </a>
    <a href="<?php echo e(route('admin.participants.index')); ?>"
       class="nav-item <?php echo e(request()->routeIs('admin.participants.*') ? 'active' : ''); ?>" style="margin-top:3px">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      参加者一覧
    </a>
    <a href="<?php echo e(route('admin.notifications.index')); ?>"
       class="nav-item <?php echo e(request()->routeIs('admin.notifications.*') ? 'active' : ''); ?>" style="margin-top:3px">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
      通知履歴
    </a>
  </nav>

  
  <div style="padding:12px 10px;border-top:1px solid #F1F5F9">
    <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
      <?php echo csrf_field(); ?>
      <button type="submit" class="nav-item">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        ログアウト
      </button>
    </form>
  </div>
</aside>


<div class="main-wrap">
  <div class="page-in" style="max-width:1100px;margin:0 auto;padding:20px 16px 8px">

    <?php if(session('success')): ?>
      <div class="flash-success" role="alert">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        <?php echo e(session('success')); ?>

      </div>
    <?php endif; ?>

    <?php echo $__env->yieldContent('content'); ?>
  </div>
</div>


<nav class="m-bottomnav" aria-label="メインメニュー">
  <a href="<?php echo e(route('admin.dashboard')); ?>"
     class="m-tab <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="<?php echo e(request()->routeIs('admin.dashboard') ? '2.2' : '1.6'); ?>" stroke-linecap="round" stroke-linejoin="round">
      <rect x="3" y="3" width="7" height="7" rx="1.5"/>
      <rect x="14" y="3" width="7" height="7" rx="1.5"/>
      <rect x="14" y="14" width="7" height="7" rx="1.5"/>
      <rect x="3" y="14" width="7" height="7" rx="1.5"/>
    </svg>
    <span>ホーム</span>
  </a>
  <a href="<?php echo e(route('admin.participants.index')); ?>"
     class="m-tab <?php echo e(request()->routeIs('admin.participants.*') ? 'active' : ''); ?>">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="<?php echo e(request()->routeIs('admin.participants.*') ? '2.2' : '1.6'); ?>" stroke-linecap="round" stroke-linejoin="round">
      <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
      <circle cx="9" cy="7" r="4"/>
      <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
      <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
    </svg>
    <span>参加者</span>
  </a>
  <a href="<?php echo e(route('admin.notifications.index')); ?>"
     class="m-tab <?php echo e(request()->routeIs('admin.notifications.*') ? 'active' : ''); ?>">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="<?php echo e(request()->routeIs('admin.notifications.*') ? '2.2' : '1.6'); ?>" stroke-linecap="round" stroke-linejoin="round">
      <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
      <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
    </svg>
    <span>通知</span>
  </a>
  <form method="POST" action="<?php echo e(route('admin.logout')); ?>" style="flex:1">
    <?php echo csrf_field(); ?>
    <button type="submit" class="m-tab" style="width:100%">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
        <polyline points="16 17 21 12 16 7"/>
        <line x1="21" y1="12" x2="9" y2="12"/>
      </svg>
      <span>ログアウト</span>
    </button>
  </form>
</nav>

</body>
</html>
<?php /**PATH C:\dev\business_matching\webapp\resources\views/layouts/admin.blade.php ENDPATH**/ ?>