<?php $__env->startSection('title', 'マッチング候補一覧'); ?>

<?php $__env->startSection('content'); ?>




<div class="relative -mx-5 -mt-8 overflow-hidden" style="height:160px">
  <img src="/images/tokyo-aerial.jpg" alt=""
       class="absolute inset-0 w-full h-full object-cover"
       style="object-position:center 30%"
       aria-hidden="true">
  
  <div class="absolute inset-0"
       style="background:linear-gradient(to bottom,rgba(0,0,0,0.05) 0%,rgba(0,0,0,0.62) 100%)"></div>
  <div class="absolute top-0 inset-x-0" style="height:3px;background:linear-gradient(90deg,#8B2635,#C04060,#8B2635)"></div>
  <div class="absolute inset-x-0 bottom-0 px-5 pb-5 flex items-end justify-between">
    <div>
      <p class="font-medium mb-0.5" style="font-size:10px;letter-spacing:0.20em;color:rgba(255,255,255,0.45)">MATCHING CANDIDATES</p>
      <h1 class="font-mincho text-white" style="font-size:22px;letter-spacing:0.04em;text-shadow:0 1px 8px rgba(0,0,0,0.35)">
        おすすめ相手一覧
      </h1>
    </div>
    <a href="<?php echo e(route('profile.edit')); ?>"
       class="flex items-center gap-1.5 font-medium"
       style="font-size:11px;color:rgba(255,255,255,0.82);letter-spacing:0.05em;
              background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.22);
              padding:6px 12px;backdrop-filter:blur(8px);transition:opacity 150ms"
       onmouseover="this.style.opacity='0.75'"
       onmouseout="this.style.opacity='1'">
      <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/>
      </svg>
      プロフィール編集
    </a>
  </div>
</div>


<div class="-mx-5 px-5 py-3 flex items-center justify-between"
     style="background:#FFFFFF;border-bottom:1px solid #E8E4DC">
  <?php if($candidates->isEmpty()): ?>
    <p class="font-medium text-fumi" style="font-size:13px">候補なし</p>
  <?php else: ?>
    <div class="flex items-center gap-2">
      <svg class="w-4 h-4 text-enji shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
      </svg>
      <p class="font-medium text-sumi" style="font-size:13px">
        <span class="font-tabular text-enji" style="font-size:16px;font-weight:700"><?php echo e($candidates->count()); ?></span>
        件の候補が見つかりました
      </p>
    </div>
    <p class="text-fumi" style="font-size:11px;letter-spacing:0.06em">マッチ度順</p>
  <?php endif; ?>
</div>



<div class="-mx-5 px-4 pt-4" style="background:#F0EDE8;min-height:60vh;padding-bottom:2rem">



<?php if($candidates->isEmpty()): ?>

<div class="bg-white rounded-lg overflow-hidden mb-4" style="border:1px solid #E0DDD8;box-shadow:0 1px 3px rgba(0,0,0,0.06)">

  
  <div class="relative overflow-hidden" style="height:180px">
    <img src="/images/tokyo-tower.jpg" alt=""
         class="w-full h-full object-cover"
         style="object-position:center 30%">
    <div class="absolute inset-0"
         style="background:linear-gradient(to bottom,rgba(0,0,0,0.04) 0%,rgba(240,237,232,0.96) 100%)"></div>
  </div>

  <div class="px-5 pt-2 pb-7 text-center">
    <h2 class="font-mincho text-sumi mb-2" style="font-size:18px;letter-spacing:0.04em">
      マッチング候補がありません
    </h2>
    <p class="text-fumi leading-relaxed mb-6" style="font-size:13px">
      プロフィールを充実させると、あなたに最適な<br>ビジネスパートナー候補が表示されます。
    </p>

    
    <div class="text-left mb-6 space-y-2.5">
      <?php $__currentLoopData = ['会社情報・事業内容を入力する','現在の課題を3件以上選択する','求めるパートナー像を選択する']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n => $tip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="flex items-center gap-3 px-4 py-3 rounded"
           style="background:#FAFAF7;border:1px solid #E8E4DC">
        <div class="w-5 h-5 rounded-full flex items-center justify-center shrink-0"
             style="background:#8B2635">
          <span class="font-tabular text-white font-bold" style="font-size:10px"><?php echo e($n+1); ?></span>
        </div>
        <p class="text-sumi" style="font-size:13px"><?php echo e($tip); ?></p>
        <svg class="w-4 h-4 text-fumi shrink-0 ml-auto" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
        </svg>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <a href="<?php echo e(route('profile.edit')); ?>"
       class="flex items-center justify-center gap-2 w-full font-medium tracking-widest"
       style="font-size:14px;background:#8B2635;color:#fff;min-height:48px;transition:opacity 150ms"
       onmouseover="this.style.opacity='0.85'"
       onmouseout="this.style.opacity='1'">
      <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/>
      </svg>
      プロフィールを入力する
    </a>
  </div>
</div>

<?php else: ?>



<?php
  // アバター背景色（会社名の文字コードから算出）
  $avatarPalette = [
    '#1E3A5F','#1A5C3A','#4A2060','#7C2D12','#1B5E7A','#44403C',
  ];
  // 画像ローテーション
  $cardImages = [
    '/images/tokyo-aerial.jpg',
    '/images/businessman.jpg',
    '/images/tokyo-blue.jpg',
    '/images/tower-upward.jpg',
    '/images/tokyo-tower.jpg',
  ];
?>

<div class="space-y-3">
<?php $__currentLoopData = $candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $mc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
  $c       = $mc->candidate;
  $delay   = ($idx % 5) * 70;
  $label   = $mc->match_label ?? '';
  $isHigh  = str_contains($label, '高');
  $isMid   = str_contains($label, '中');

  // マッチ度スタイル
  if ($isHigh) {
    $leftBorderColor = '#166534';
    $badgeBg         = '#DCFCE7';
    $badgeText       = '#166534';
    $badgeBorder     = '#BBF7D0';
  } elseif ($isMid) {
    $leftBorderColor = '#8B2635';
    $badgeBg         = '#FFF0F3';
    $badgeText       = '#8B2635';
    $badgeBorder     = '#FECACA';
  } else {
    $leftBorderColor = '#92400E';
    $badgeBg         = '#FEF3C7';
    $badgeText       = '#92400E';
    $badgeBorder     = '#FDE68A';
  }

  // アバター色（会社名ハッシュ）
  $companyStr  = $c->company?->company_name ?? $c->name ?? '';
  $charCode    = mb_strlen($companyStr) > 0 ? mb_ord(mb_substr($companyStr, 0, 1)) : 0;
  $avatarColor = $avatarPalette[$charCode % count($avatarPalette)];
  $initial     = mb_substr($companyStr ?: '?', 0, 1);

  // カードヘッダー画像
  $headerImg = $cardImages[$idx % count($cardImages)];
?>

<article
  x-data="{
    confirmOpen: false,
    companyName: '<?php echo e(addslashes($c->company?->company_name ?? $c->name ?? '')); ?>'
  }"
  class="card-reveal bg-white rounded-lg overflow-hidden"
  style="border:1px solid #E0DDD8;box-shadow:0 1px 4px rgba(0,0,0,0.07);
         border-left:3px solid <?php echo e($leftBorderColor); ?>;animation-delay:<?php echo e($delay); ?>ms">

  
  <div class="relative overflow-hidden" style="height:90px">
    <img src="<?php echo e($headerImg); ?>" alt="" aria-hidden="true"
         class="absolute inset-0 w-full h-full object-cover"
         style="object-position:center 40%">
    <div class="absolute inset-0"
         style="background:linear-gradient(to right,rgba(0,0,0,0.78) 0%,rgba(0,0,0,0.38) 60%,rgba(0,0,0,0.10) 100%)"></div>

    
    <div class="absolute inset-0 px-4 flex items-center gap-3.5">
      <div class="shrink-0 w-12 h-12 rounded-lg flex items-center justify-center"
           style="background:<?php echo e($avatarColor); ?>;border:1.5px solid rgba(255,255,255,0.22)">
        <span class="font-mincho text-white font-bold" style="font-size:20px;text-shadow:0 1px 3px rgba(0,0,0,0.30)">
          <?php echo e($initial); ?>

        </span>
      </div>
      <div class="flex-1 min-w-0">
        <h2 class="font-bold text-white leading-tight mb-0.5"
            style="font-size:15px;text-shadow:0 1px 4px rgba(0,0,0,0.35)"
            title="<?php echo e($c->company?->company_name ?? '（社名未登録）'); ?>">
          <?php echo e($c->company?->company_name ?? '（社名未登録）'); ?>

        </h2>
        <?php if($c->role_title || $c->name): ?>
          <p style="font-size:12px;color:rgba(255,255,255,0.68)">
            <?php echo e($c->role_title); ?><?php if($c->role_title && $c->name): ?>　<?php endif; ?><?php echo e($c->name); ?>

          </p>
        <?php endif; ?>
      </div>
    </div>

    
    <div class="absolute top-2.5 right-3">
      <span class="inline-flex items-center gap-1 font-medium px-2 py-0.5"
            style="font-size:11px;background:<?php echo e($badgeBg); ?>;color:<?php echo e($badgeText); ?>;
                   border:1px solid <?php echo e($badgeBorder); ?>;letter-spacing:0.04em">
        <?php if($isHigh): ?>
          <svg class="w-2.5 h-2.5 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/>
          </svg>
        <?php endif; ?>
        <?php echo e($label); ?>

      </span>
    </div>
  </div>


  
  <?php if($c->company?->industry || $c->company?->prefecture): ?>
  <div class="px-4 pt-3 pb-0 flex items-center gap-3 flex-wrap">
    <?php if($c->company?->prefecture): ?>
      <span class="inline-flex items-center gap-1 font-medium"
            style="font-size:12px;color:#1B5E7A;background:#EFF8FD;padding:3px 8px;border:1px solid #BAE6FD">
        <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
        </svg>
        <?php echo e($c->company->prefecture->name); ?>

      </span>
    <?php endif; ?>
    <?php if($c->company?->industry): ?>
      <span class="inline-flex items-center gap-1 font-medium"
            style="font-size:12px;color:#1A5C3A;background:#F0FDF4;padding:3px 8px;border:1px solid #BBF7D0">
        <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>
        </svg>
        <?php echo e($c->company->industry->name); ?>

      </span>
    <?php endif; ?>
  </div>
  <?php endif; ?>


  
  <?php if($c->profile?->business_summary_1): ?>
  <div class="px-4 pt-3 pb-0">
    <p class="font-medium mb-1.5" style="font-size:11px;color:#9A9286;letter-spacing:0.08em">事業内容</p>
    <p class="text-sumi leading-relaxed"
       style="font-size:13px;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden">
      <?php echo e($c->profile->business_summary_1); ?>

    </p>
  </div>
  <?php endif; ?>


  
  <?php if($c->issues->isNotEmpty() || $c->partnerTypes->isNotEmpty()): ?>
  <div class="px-4 pt-3 pb-0 space-y-2.5">

    <?php if($c->issues->isNotEmpty()): ?>
    <div>
      <p class="font-medium mb-1.5" style="font-size:11px;color:#9A9286;letter-spacing:0.08em">現在の課題</p>
      <div class="flex flex-wrap gap-1.5">
        <?php $__currentLoopData = $c->issues->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iss): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <span class="font-medium" style="font-size:11px;color:#44403C;background:#F5F2EC;
                                           padding:3px 8px;border:1px solid #E0DDD8">
            <?php echo e($iss->name); ?>

          </span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if($c->issues->count() > 5): ?>
          <span class="font-medium" style="font-size:11px;color:#9A9286;background:#EEEBE6;
                                           padding:3px 8px;border:1px solid #E0DDD8">
            +<?php echo e($c->issues->count() - 5); ?>件
          </span>
        <?php endif; ?>
      </div>
    </div>
    <?php endif; ?>

    <?php if($c->partnerTypes->isNotEmpty()): ?>
    <div>
      <p class="font-medium mb-1.5" style="font-size:11px;color:#9A9286;letter-spacing:0.08em">求めるパートナー</p>
      <div class="flex flex-wrap gap-1.5">
        <?php $__currentLoopData = $c->partnerTypes->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <span class="font-medium" style="font-size:11px;color:#8B2635;background:#FFF0F3;
                                           padding:3px 8px;border:1px solid rgba(139,38,53,0.18)">
            <?php echo e($pt->name); ?>

          </span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if($c->partnerTypes->count() > 4): ?>
          <span class="font-medium" style="font-size:11px;color:#B06070;background:#FDEEF1;
                                           padding:3px 8px;border:1px solid #F0CACF">
            +<?php echo e($c->partnerTypes->count() - 4); ?>件
          </span>
        <?php endif; ?>
      </div>
    </div>
    <?php endif; ?>

  </div>
  <?php endif; ?>


  
  <div class="mt-4 px-4 pb-4">
    <div class="pt-3.5" style="border-top:1px solid #EAE7E2">

      <?php if(isset($sentToIds[$c->id])): ?>
        
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-2">
            <div class="w-5 h-5 rounded-full flex items-center justify-center"
                 style="background:#DCFCE7;border:1px solid #BBF7D0">
              <svg class="w-3 h-3" fill="none" stroke="#166534" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
              </svg>
            </div>
            <p class="font-medium" style="font-size:13px;color:#166534">連絡希望を送信済み</p>
          </div>
          <button type="button" @click="confirmOpen = true"
                  class="font-medium"
                  style="font-size:12px;color:#6B6558;border:1px solid #D4CFC4;
                         padding:5px 12px;transition:opacity 150ms"
                  onmouseover="this.style.opacity='0.70'"
                  onmouseout="this.style.opacity='1'">
            再送する
          </button>
        </div>

      <?php else: ?>
        
        <button type="button" @click="confirmOpen = true"
                class="w-full flex items-center justify-center gap-2 font-medium tracking-widest select-none"
                style="font-size:14px;background:#8B2635;color:#fff;
                       min-height:46px;letter-spacing:0.06em;transition:opacity 150ms"
                onmouseover="this.style.opacity='0.88'"
                onmouseout="this.style.opacity='1'"
                onmousedown="this.style.opacity='0.75'"
                onmouseup="this.style.opacity='0.88'">
          <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
          </svg>
          連絡希望を送る
        </button>
      <?php endif; ?>

    </div>
  </div>


  
  <div x-show="confirmOpen" x-cloak
       class="fixed inset-0 z-50 flex items-end justify-center"
       role="dialog" aria-modal="true"
       :aria-label="'連絡希望送信の確認'">

    
    <div x-show="confirmOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-end="opacity-0"
         class="absolute inset-0"
         style="background:rgba(8,8,16,0.52);backdrop-filter:blur(2px)"
         @click="confirmOpen = false" aria-hidden="true"></div>

    
    <div x-show="confirmOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-end="opacity-0 translate-y-4"
         class="relative w-full max-w-lg bg-white z-10"
         style="padding-bottom:max(1.5rem,env(safe-area-inset-bottom,1.5rem));
                box-shadow:0 -4px 32px rgba(0,0,0,0.16)">

      
      <div style="height:3px;background:linear-gradient(90deg,#8B2635,#C04060,#8B2635)"></div>
      <div class="flex justify-center pt-3"><div class="w-9 h-1 rounded-full" style="background:#D4CFC4"></div></div>

      <div class="px-6 pt-5 pb-6">

        
        <div class="flex items-center gap-3 mb-5">
          <div class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0"
               style="background:#FFF0F3;border:1px solid rgba(139,38,53,0.18)">
            <svg class="w-4 h-4 text-enji" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
            </svg>
          </div>
          <h3 class="font-mincho text-sumi" style="font-size:17px">連絡希望の確認</h3>
        </div>

        
        <div class="px-4 py-3 mb-4 rounded"
             style="background:#FAFAF7;border:1px solid #E8E4DC">
          <p style="font-size:11px;color:#9A9286;letter-spacing:0.06em;margin-bottom:3px">送信先</p>
          <p class="font-bold text-sumi" style="font-size:15px" x-text="companyName"></p>
        </div>

        <p class="text-fumi leading-relaxed mb-6" style="font-size:13px">
          双方の連絡先をメールでお送りします。<br>送信後の取り消しはできません。よろしいですか？
        </p>

        <div class="flex gap-3">
          <button type="button" @click="confirmOpen = false"
                  class="flex-1 flex items-center justify-center font-medium"
                  style="font-size:14px;color:#6B6558;border:1px solid #D4CFC4;
                         background:#FAFAF7;min-height:46px;transition:opacity 150ms"
                  onmouseover="this.style.opacity='0.70'"
                  onmouseout="this.style.opacity='1'">
            キャンセル
          </button>
          <form method="POST" action="<?php echo e(route('contact.store')); ?>" class="flex-1">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="to_participant_id" value="<?php echo e($c->id); ?>">
            <button type="submit"
                    class="w-full flex items-center justify-center gap-1.5 font-medium tracking-widest select-none"
                    style="font-size:14px;background:#8B2635;color:#fff;min-height:46px;
                           letter-spacing:0.05em;transition:opacity 150ms"
                    onmouseover="this.style.opacity='0.88'"
                    onmouseout="this.style.opacity='1'">
              <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/>
              </svg>
              送信する
            </button>
          </form>
        </div>

      </div>
    </div>
  </div>

</article>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<div class="mt-5 text-center">
  <p style="font-size:12px;color:#B0A89E;letter-spacing:0.06em">
    全 <?php echo e($candidates->count()); ?> 件を表示中
  </p>
</div>

<?php endif; ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\dev\business_matching\webapp\resources\views/matching/index.blade.php ENDPATH**/ ?>