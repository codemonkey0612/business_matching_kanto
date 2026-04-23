<?php $__env->startSection('title', '連絡希望 送信完了'); ?>

<?php $__env->startSection('content'); ?>


<div class="relative -mx-5 -mt-8 mb-8 overflow-hidden" style="height:200px">
  <img src="/images/tokyo-blue.jpg" alt=""
       class="absolute inset-0 w-full h-full object-cover"
       style="object-position:center 50%"
       aria-hidden="true">
  <div class="absolute inset-0 pointer-events-none"
       style="background:rgba(8,8,20,0.52)"></div>
  <div class="absolute top-0 inset-x-0" style="height:3px; background:linear-gradient(90deg,#8B2635,#6B3040,#8B2635)"></div>

  
  <div class="absolute inset-0 flex flex-col items-center justify-center" aria-hidden="true">
    <svg width="52" height="52" viewBox="0 0 72 72" fill="none">
      <circle cx="36" cy="36" r="33" stroke="rgba(139,38,53,0.75)" stroke-width="1.5"/>
      <circle cx="36" cy="36" r="26" stroke="rgba(139,38,53,0.40)" stroke-width="0.75"/>
      <path d="M22 36 L31 45 L50 25" stroke="#8B2635" stroke-width="2.2"
            stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <p class="font-mincho text-white mt-4" style="font-size:20px; letter-spacing:0.06em">
      連絡希望を送りました
    </p>
    <p class="font-medium mt-1" style="font-size:10px; letter-spacing:0.18em; color:rgba(255,255,255,0.35)">
      CONTACT REQUEST SENT
    </p>
  </div>
</div>


<div class="text-center">

  
  <p class="text-fumi leading-relaxed mb-8 px-2" style="font-size:14px">
    双方の連絡先を含むメールをお送りしました。<br>
    メールをご確認のうえ、直接ご連絡ください。
  </p>

  
  <div class="flex items-center justify-center gap-3 mb-8" aria-hidden="true">
    <div class="h-px w-10" style="background:rgba(139,38,53,0.30)"></div>
    <div class="w-1.5 h-1.5 rounded-full" style="background:rgba(139,38,53,0.45)"></div>
    <div class="h-px w-10" style="background:rgba(139,38,53,0.30)"></div>
  </div>

  
  <div class="bg-white border border-[#E8E4DC] rounded px-5 py-4 mb-8 text-left"
       style="box-shadow:0 1px 2px rgba(0,0,0,0.04)">
    <div class="flex items-center gap-2 mb-3">
      <div class="w-px h-4 bg-enji"></div>
      <p class="font-medium text-sumi" style="font-size:13px; letter-spacing:0.04em">ご注意</p>
    </div>
    <ul class="space-y-2.5 text-fumi" style="font-size:13px">
      <li class="flex items-start gap-2">
        <span class="text-enji mt-0.5 shrink-0">・</span>
        メールが届かない場合は、迷惑メールフォルダをご確認ください
      </li>
      <li class="flex items-start gap-2">
        <span class="text-enji mt-0.5 shrink-0">・</span>
        連絡はメールに記載の連絡先へ直接お願いします
      </li>
    </ul>
  </div>

  
  <a href="<?php echo e(route('matching.index')); ?>"
     class="inline-flex items-center justify-center gap-2 bg-enji text-white font-medium tracking-widest
            rounded px-8 py-3.5 min-h-[48px] w-full
            transition-opacity ease-out"
     style="font-size:15px; transition-duration:150ms;"
     onmouseover="this.style.opacity='0.85'"
     onmouseout="this.style.opacity='1'">
    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
    </svg>
    候補一覧へ戻る
  </a>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\dev\business_matching\webapp\resources\views/matching/sent.blade.php ENDPATH**/ ?>