<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>管理者ログイン | BizMatch</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>tailwind.config={theme:{extend:{}}}</script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{font-size:15px}
body{
  font-family:'Inter','Noto Sans JP',-apple-system,sans-serif;
  -webkit-font-smoothing:antialiased;
  min-height:100vh;
  min-height:100dvh;
  display:flex;
  flex-direction:column;
  background:#F3F4F8;
}

/* ─── Mobile: full-page form ─── */
.login-wrap{
  flex:1;
  display:flex;
  flex-direction:column;
  align-items:center;
  justify-content:center;
  padding:24px 20px;
  padding-bottom:calc(24px + env(safe-area-inset-bottom,0px));
}
.login-card{
  width:100%;
  max-width:420px;
  background:#fff;
  border-radius:20px;
  box-shadow:0 4px 24px rgba(0,0,0,0.08),0 1px 3px rgba(0,0,0,0.04);
  overflow:hidden;
}

/* Card header gradient strip */
.card-header{
  background:linear-gradient(135deg,#6366F1 0%,#8B5CF6 100%);
  padding:28px 28px 24px;
  position:relative;
  overflow:hidden;
}
.card-header::before{
  content:'';position:absolute;
  top:-30px;right:-30px;
  width:120px;height:120px;
  border-radius:50%;
  background:rgba(255,255,255,0.10);
}
.card-header::after{
  content:'';position:absolute;
  bottom:-40px;left:20px;
  width:80px;height:80px;
  border-radius:50%;
  background:rgba(255,255,255,0.06);
}

/* Card body */
.card-body{padding:28px}

/* Form field */
.field{
  width:100%;
  background:#F8FAFC;
  border:1.5px solid #E2E8F0;
  border-radius:12px;
  padding:13px 16px;
  font-size:15px;
  color:#1E293B;
  font-family:'Noto Sans JP',sans-serif;
  min-height:50px;
  transition:border-color 150ms,box-shadow 150ms,background 150ms;
  -webkit-appearance:none;
  letter-spacing:0.02em;
}
.field::placeholder{color:#CBD5E1}
.field:focus{
  outline:none;
  border-color:#6366F1;
  box-shadow:0 0 0 3px rgba(99,102,241,0.14);
  background:#fff;
}
.field.err{border-color:#EF4444}
.field.err:focus{box-shadow:0 0 0 3px rgba(239,68,68,0.12)}

/* Slide up anim */
@keyframes slideUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
.anim{animation:slideUp .50s cubic-bezier(0.22,1,0.36,1) both}

/* Desktop: side-by-side */
@media(min-width:900px){
  body{flex-direction:row;background:none}
  .left-panel{
    display:flex;
    width:50%;
    background:linear-gradient(150deg,#4F46E5 0%,#7C3AED 60%,#A855F7 100%);
    flex-direction:column;
    position:relative;
    overflow:hidden;
    min-height:100vh;min-height:100dvh;
  }
  .login-wrap{
    width:50%;
    background:#F3F4F8;
    justify-content:center;
    padding:40px 40px;
  }
  .login-card{
    box-shadow:0 8px 40px rgba(0,0,0,0.10),0 1px 3px rgba(0,0,0,0.05);
  }
}
@media(max-width:899px){
  .left-panel{display:none}
}

:focus-visible{outline:2px solid #6366F1;outline-offset:2px}
@media(prefers-reduced-motion:reduce){*,*::before,*::after{animation-duration:.01ms!important}}
</style>
</head>
<body>


<div class="left-panel">
  
  <div style="position:absolute;width:400px;height:400px;border-radius:50%;background:rgba(255,255,255,0.06);top:-100px;right:-100px"></div>
  <div style="position:absolute;width:250px;height:250px;border-radius:50%;background:rgba(255,255,255,0.05);bottom:50px;left:-60px"></div>
  <div style="position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,0.10) 1px,transparent 1px);background-size:28px 28px"></div>

  <div style="position:relative;z-index:10;flex:1;display:flex;flex-direction:column;padding:48px 52px">
    
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:auto">
      <div style="width:38px;height:38px;background:rgba(255,255,255,0.18);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;backdrop-filter:blur(8px)">
        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      </div>
      <div>
        <p style="font-size:16px;font-weight:800;color:white;letter-spacing:-0.02em;line-height:1;font-family:'Inter',sans-serif">BizMatch</p>
        <p style="font-size:10px;color:rgba(255,255,255,0.50);letter-spacing:0.10em;text-transform:uppercase;margin-top:2px">Admin Console</p>
      </div>
    </div>

    
    <div style="flex:1;display:flex;flex-direction:column;justify-content:center;padding:40px 0">
      <div style="display:inline-flex;align-items:center;gap:7px;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.20);border-radius:100px;padding:5px 14px;width:fit-content;margin-bottom:24px">
        <span style="width:6px;height:6px;border-radius:50%;background:rgba(255,255,255,0.80);flex-shrink:0"></span>
        <span style="font-size:11.5px;color:rgba(255,255,255,0.85);font-weight:600;letter-spacing:0.04em;font-family:'Inter',sans-serif">Secure Admin Access</span>
      </div>
      <h1 style="font-size:clamp(26px,3.5vw,38px);font-weight:800;color:white;line-height:1.20;letter-spacing:-0.02em;margin-bottom:16px;font-family:'Noto Sans JP',sans-serif">
        ビジネスマッチング<br>運営管理システム
      </h1>
      <p style="font-size:14px;color:rgba(255,255,255,0.58);line-height:1.80;font-family:'Noto Sans JP',sans-serif;max-width:300px">
        参加者の管理・統計確認・<br>通知履歴の閲覧が行えます。
      </p>

      
      <div style="display:flex;flex-wrap:wrap;gap:8px;margin-top:32px">
        <?php $__currentLoopData = ['参加者管理','統計ダッシュボード','通知追跡']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <span style="display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.18);border-radius:100px;padding:5px 12px;font-size:12.5px;color:rgba(255,255,255,0.85);font-family:'Noto Sans JP',sans-serif">
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            <?php echo e($f); ?>

          </span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>

    <p style="font-size:11.5px;color:rgba(255,255,255,0.30);font-family:'Inter',sans-serif">© <?php echo e(date('Y')); ?> BizMatch. All rights reserved.</p>
  </div>
</div>


<div class="login-wrap">
  <div class="login-card anim" x-data="{showPw:false}">

    
    <div class="card-header">
      <div style="position:relative;z-index:1">
        
        <div style="display:flex;align-items:center;gap:9px;margin-bottom:20px" class="block lg:hidden">
          <div style="width:28px;height:28px;background:rgba(255,255,255,0.20);border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </div>
          <span style="font-size:14px;font-weight:800;color:white;letter-spacing:-0.02em;font-family:'Inter',sans-serif">BizMatch Admin</span>
        </div>
        <p style="font-size:10.5px;font-weight:700;color:rgba(255,255,255,0.55);text-transform:uppercase;letter-spacing:0.12em;margin-bottom:6px;font-family:'Inter',sans-serif">Administrator</p>
        <h2 style="font-size:22px;font-weight:800;color:white;letter-spacing:-0.02em;line-height:1.2;font-family:'Noto Sans JP',sans-serif">管理者ログイン</h2>
      </div>
    </div>

    
    <div class="card-body">

      <?php if($errors->any()): ?>
        <div style="display:flex;align-items:flex-start;gap:9px;padding:12px 14px;background:#FEF2F2;border:1.5px solid #FECACA;border-radius:10px;margin-bottom:20px;font-size:13.5px;color:#DC2626;font-family:'Noto Sans JP',sans-serif" role="alert">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;margin-top:1px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          <?php echo e($errors->first()); ?>

        </div>
      <?php endif; ?>

      <form method="POST" action="<?php echo e(route('admin.login')); ?>" novalidate>
        <?php echo csrf_field(); ?>

        <div style="margin-bottom:18px">
          <label for="login_id" style="display:block;font-size:13px;font-weight:600;color:#475569;margin-bottom:7px;font-family:'Noto Sans JP',sans-serif">ログインID</label>
          <input type="text" id="login_id" name="login_id"
                 value="<?php echo e(old('login_id')); ?>"
                 autocomplete="username" required
                 placeholder="管理者IDを入力"
                 class="field <?php echo e($errors->has('login_id') ? 'err' : ''); ?>">
          <?php $__errorArgs = ['login_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p style="font-size:12px;color:#EF4444;margin-top:5px;font-family:'Noto Sans JP',sans-serif"><?php echo e($message); ?></p>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div style="margin-bottom:24px">
          <label for="admin_pw" style="display:block;font-size:13px;font-weight:600;color:#475569;margin-bottom:7px;font-family:'Noto Sans JP',sans-serif">パスワード</label>
          <div style="position:relative">
            <input :type="showPw?'text':'password'" id="admin_pw" name="password"
                   autocomplete="current-password" required
                   placeholder="パスワードを入力"
                   class="field" style="padding-right:50px">
            <button type="button" @click="showPw=!showPw"
                    style="position:absolute;right:14px;top:50%;transform:translateY(-50%);color:#CBD5E1;background:none;border:none;cursor:pointer;padding:6px;display:flex;align-items:center;justify-content:center;transition:color 120ms;min-width:44px;min-height:44px"
                    onmouseover="this.style.color='#6366F1'" onmouseout="this.style.color='#CBD5E1'"
                    :aria-label="showPw?'パスワードを隠す':'パスワードを表示'">
              <svg x-show="!showPw" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
              <svg x-show="showPw" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
            </button>
          </div>
        </div>

        <button type="submit"
                style="width:100%;background:linear-gradient(135deg,#6366F1,#8B5CF6);color:white;border:none;border-radius:12px;padding:15px 20px;font-size:15px;font-weight:700;font-family:'Noto Sans JP',sans-serif;letter-spacing:0.04em;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:all 200ms ease;box-shadow:0 4px 16px rgba(99,102,241,0.35);min-height:52px;-webkit-tap-highlight-color:transparent"
                onmouseover="this.style.boxShadow='0 6px 24px rgba(99,102,241,0.50)';this.style.transform='translateY(-1px)'"
                onmouseout="this.style.boxShadow='0 4px 16px rgba(99,102,241,0.35)';this.style.transform='translateY(0)'">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
          ログイン
        </button>
      </form>

      <p style="text-align:center;margin-top:20px;font-size:12px;color:#CBD5E1;font-family:'Inter',sans-serif">
        管理者専用ページ
      </p>
    </div>
  </div>
</div>

</body>
</html>
<?php /**PATH C:\dev\business_matching\webapp\resources\views/admin/login.blade.php ENDPATH**/ ?>