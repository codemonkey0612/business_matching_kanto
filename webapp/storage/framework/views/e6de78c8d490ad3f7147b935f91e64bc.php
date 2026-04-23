<?php $__env->startSection('title', 'プロフィール登録・編集'); ?>

<?php $__env->startSection('content'); ?>


<div class="relative -mx-5 -mt-8 mb-6 overflow-hidden" style="height:160px">
  <img src="/images/tokyo-tower.jpg" alt=""
       class="absolute inset-0 w-full h-full object-cover"
       style="object-position:center 30%"
       aria-hidden="true">
  
  <div class="absolute inset-0 pointer-events-none"
       style="background:linear-gradient(to top,rgba(0,0,0,0.76) 0%,rgba(0,0,0,0.08) 50%,transparent 100%)"></div>
  <div class="absolute inset-0 pointer-events-none"
       style="background:linear-gradient(to right,rgba(0,0,0,0.35) 0%,transparent 60%)"></div>
  <div class="absolute top-0 inset-x-0" style="height:3px; background:linear-gradient(90deg,#8B2635,#C04060,#8B2635)"></div>

  
  <div class="absolute top-4 right-5 font-tabular" aria-hidden="true"
       style="font-size:64px; line-height:1; color:rgba(255,255,255,0.07); font-weight:700; letter-spacing:-0.04em">05</div>

  <div class="absolute inset-x-0 bottom-0 px-5 pb-5 flex items-end justify-between">
    <div>
      <p class="font-medium mb-1"
         style="font-size:10px; letter-spacing:0.20em; color:rgba(255,255,255,0.40)">PROFILE SETUP</p>
      <h2 class="font-mincho text-white" style="font-size:22px; letter-spacing:0.04em">プロフィール登録</h2>
    </div>
    <div class="shrink-0 flex flex-col items-end gap-1.5">
      <p style="font-size:9px; letter-spacing:0.10em; color:rgba(255,255,255,0.35)">5 セクション</p>
      <div class="flex gap-1">
        <?php $__currentLoopData = range(1,5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="w-5 h-1 rounded-full" style="background:rgba(255,255,255,0.35)"></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </div>
</div>


<p class="text-fumi mb-6" style="font-size:14px">マッチングに使用する情報を入力してください</p>


<?php if($errors->any()): ?>
<div class="mb-6 px-4 py-4 bg-[#F8ECEE] border border-[#E8C9CE] rounded text-enji"
     style="font-size:14px" role="alert">
  <p class="font-medium mb-2">入力内容をご確認ください</p>
  <ul class="space-y-1 list-disc list-inside">
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <li><?php echo e($e); ?></li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </ul>
</div>
<?php endif; ?>

<form method="POST" action="<?php echo e(route('profile.update')); ?>" novalidate>
<?php echo csrf_field(); ?>


<section class="mb-6 reveal">
  <header class="flex items-center gap-3 mb-4">
    <div class="w-7 h-7 rounded flex items-center justify-center shrink-0"
         style="background:#FFF0F3; border:1px solid rgba(139,38,53,0.18)">
      <span class="font-tabular text-enji font-semibold" style="font-size:11px">01</span>
    </div>
    <h3 class="font-mincho text-sumi" style="font-size:17px">基本情報</h3>
    <div class="h-px flex-1" style="background:#E8E4DC"></div>
  </header>

  <div class="bg-white border border-[#E8E4DC] rounded p-5 space-y-4"
       style="box-shadow:0 2px 8px rgba(0,0,0,0.04)">

    
    <div>
      <label class="block font-medium text-fumi mb-2" style="font-size:14px">メールアドレス</label>
      <div class="w-full border border-[#E8E4DC] bg-washi rounded px-4 py-3 text-fumi select-none"
           style="font-size:15px" aria-readonly="true">
        <?php echo e($participant->email); ?>

      </div>
      <p class="mt-1.5 text-fumi" style="font-size:13px">
        ログインIDです。変更はサポートまでお問い合わせください
      </p>
    </div>

    
    <div>
      <label for="company_name" class="block font-medium text-fumi mb-2" style="font-size:14px">
        会社名 <span class="text-enji">*</span>
      </label>
      <input type="text" id="company_name" name="company_name"
             value="<?php echo e(old('company_name', $participant->company?->company_name)); ?>"
             required placeholder="株式会社〇〇"
             class="form-input <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
      <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="form-error"><?php echo e($message); ?></p>
      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    
    <div class="grid grid-cols-2 gap-3">
      <div>
        <label for="name" class="block font-medium text-fumi mb-2" style="font-size:14px">
          氏名 <span class="text-enji">*</span>
        </label>
        <input type="text" id="name" name="name"
               value="<?php echo e(old('name', $participant->name)); ?>"
               required placeholder="山田 太郎"
               class="form-input">
      </div>
      <div>
        <label for="name_kana" class="block font-medium text-fumi mb-2" style="font-size:14px">
          フリガナ <span class="text-enji">*</span>
        </label>
        <input type="text" id="name_kana" name="name_kana"
               value="<?php echo e(old('name_kana', $participant->name_kana)); ?>"
               required placeholder="ヤマダ タロウ"
               class="form-input">
      </div>
    </div>

    
    <div class="grid grid-cols-2 gap-3">
      <div>
        <label for="role_title" class="block font-medium text-fumi mb-2" style="font-size:14px">
          役職 <span class="text-enji">*</span>
        </label>
        <input type="text" id="role_title" name="role_title"
               value="<?php echo e(old('role_title', $participant->role_title)); ?>"
               required placeholder="代表取締役"
               class="form-input">
      </div>
      <div>
        <label for="phone_number" class="block font-medium text-fumi mb-2" style="font-size:14px">
          電話番号 <span class="text-enji">*</span>
        </label>
        <input type="tel" id="phone_number" name="phone_number"
               value="<?php echo e(old('phone_number', $participant->phone_number)); ?>"
               required placeholder="090-0000-0000"
               class="form-input">
      </div>
    </div>

    
    <div>
      <label for="industry_master_id" class="block font-medium text-fumi mb-2" style="font-size:14px">
        業種 <span class="text-enji">*</span>
      </label>
      <select id="industry_master_id" name="industry_master_id" required class="form-input bg-white">
        <option value="">選択してください</option>
        <?php $__currentLoopData = $industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($ind->id); ?>"
            <?php echo e(old('industry_master_id', $participant->company?->industry_master_id) == $ind->id ? 'selected' : ''); ?>>
            <?php echo e($ind->name); ?>

          </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
    </div>

    
    <div class="grid grid-cols-3 gap-3">
      <div class="col-span-2">
        <label for="address_text" class="block font-medium text-fumi mb-2" style="font-size:14px">
          住所 <span class="text-enji">*</span>
        </label>
        <input type="text" id="address_text" name="address_text"
               value="<?php echo e(old('address_text', $participant->company?->address_text)); ?>"
               required placeholder="東京都渋谷区〇〇1-2-3"
               class="form-input">
      </div>
      <div>
        <label for="prefecture_master_id" class="block font-medium text-fumi mb-2" style="font-size:14px">
          都道府県 <span class="text-enji">*</span>
        </label>
        <select id="prefecture_master_id" name="prefecture_master_id" required class="form-input bg-white">
          <option value="">選択</option>
          <?php $__currentLoopData = $prefectures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pref): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($pref->id); ?>"
              <?php echo e(old('prefecture_master_id', $participant->company?->prefecture_master_id) == $pref->id ? 'selected' : ''); ?>>
              <?php echo e($pref->name); ?>

            </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
    </div>

  </div>
</section>


<section class="mb-6 reveal" style="transition-delay:0.08s">
  <header class="flex items-center gap-3 mb-4">
    <div class="w-7 h-7 rounded flex items-center justify-center shrink-0"
         style="background:#F0F7F4; border:1px solid rgba(74,93,79,0.18)">
      <span class="font-tabular font-semibold" style="font-size:11px; color:#4A5D4F">02</span>
    </div>
    <h3 class="font-mincho text-sumi" style="font-size:17px">事業内容</h3>
    <div class="h-px flex-1" style="background:#E8E4DC"></div>
  </header>

  <div class="bg-white border border-[#E8E4DC] rounded p-5 space-y-4"
       style="box-shadow:0 2px 8px rgba(0,0,0,0.04)">
    <div>
      <label for="business_summary_1" class="block font-medium text-fumi mb-2" style="font-size:14px">
        事業内容① <span class="text-enji">*</span>
      </label>
      <textarea id="business_summary_1" name="business_summary_1" rows="3" required
                placeholder="主な事業・サービス内容をご記載ください"
                class="form-input resize-none"
                style="height:auto"><?php echo e(old('business_summary_1', $participant->profile?->business_summary_1)); ?></textarea>
    </div>
    <div>
      <label for="business_summary_2" class="block font-medium text-fumi mb-2" style="font-size:14px">
        事業内容②
        <span class="font-normal text-fumi opacity-70">（任意）</span>
      </label>
      <textarea id="business_summary_2" name="business_summary_2" rows="3"
                placeholder="補足・サブ事業があれば記載してください"
                class="form-input resize-none"
                style="height:auto"><?php echo e(old('business_summary_2', $participant->profile?->business_summary_2)); ?></textarea>
    </div>
  </div>
</section>


<?php $selectedPurposes = old('purpose_ids', $participant->purposes->pluck('id')->toArray()); ?>
<section class="mb-6 reveal" style="transition-delay:0.16s">
  <header class="flex items-center gap-3 mb-4">
    <div class="w-7 h-7 rounded flex items-center justify-center shrink-0"
         style="background:#F5F3FF; border:1px solid rgba(99,66,178,0.18)">
      <span class="font-tabular font-semibold" style="font-size:11px; color:#6342B2">03</span>
    </div>
    <h3 class="font-mincho text-sumi" style="font-size:17px">
      希望目的 <span class="text-enji" style="font-size:14px; font-family:inherit">*</span>
    </h3>
    <div class="h-px flex-1" style="background:#E8E4DC"></div>
  </header>

  <div class="bg-white border border-[#E8E4DC] rounded p-5"
       style="box-shadow: 0 1px 2px rgba(0,0,0,0.04)">
    <p class="text-fumi mb-4" style="font-size:14px">
      マッチングの優先度に使われます。1つ以上お選びください
    </p>
    <div class="flex flex-wrap gap-2">
      <?php $__currentLoopData = $purposes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <label class="cursor-pointer" for="purpose_<?php echo e($p->id); ?>">
        <input type="checkbox" id="purpose_<?php echo e($p->id); ?>" name="purpose_ids[]"
               value="<?php echo e($p->id); ?>" class="sr-only peer"
               <?php echo e(in_array($p->id, $selectedPurposes) ? 'checked' : ''); ?>>
        <span class="inline-flex items-center px-3 py-1.5 rounded-full font-medium select-none
                     transition-colors ease-out
                     border border-kiwari bg-white text-fumi
                     peer-checked:bg-sumi peer-checked:text-white peer-checked:border-sumi"
              style="font-size:13px; transition-duration:150ms">
          <?php echo e($p->name); ?>

        </span>
      </label>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php $__errorArgs = ['purpose_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
      <p class="mt-3 text-enji" style="font-size:13px"><?php echo e($message); ?></p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
  </div>
</section>


<?php
  $selectedIssues    = old('issue_ids', $participant->issues->pluck('id')->toArray());
  $issuesByCategory  = $issues->groupBy('category_name');
?>
<section class="mb-6 reveal" style="transition-delay:0.24s">
  <header class="flex items-center gap-3 mb-4">
    <div class="w-7 h-7 rounded flex items-center justify-center shrink-0"
         style="background:#FFF8EC; border:1px solid rgba(180,83,9,0.18)">
      <span class="font-tabular font-semibold" style="font-size:11px; color:#B45309">04</span>
    </div>
    <h3 class="font-mincho text-sumi" style="font-size:17px">
      現在の課題 <span class="text-enji" style="font-size:14px; font-family:inherit">*</span>
    </h3>
    <div class="h-px flex-1" style="background:#E8E4DC"></div>
  </header>

  
  <div class="bg-white border border-[#E8E4DC] rounded"
       style="box-shadow: 0 1px 2px rgba(0,0,0,0.04)"
       id="issue-section"
       x-data="{
         count: <?php echo e(count($selectedIssues)); ?>,
         search: '',
         cats: {
           <?php $__currentLoopData = $issuesByCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat => $catIssues): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php
               $catIds     = $catIssues->pluck('id')->toArray();
               $hasSelected = count(array_intersect($catIds, $selectedIssues)) > 0;
             ?>
             '<?php echo e(addslashes($cat)); ?>': <?php echo e($hasSelected ? 'true' : 'false'); ?>,
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         },
         openCat(cat) { this.cats[cat] = !this.cats[cat]; },
         showCat(cat) { return this.search !== '' || this.cats[cat]; },
         showItem(name) { return this.search === '' || name.includes(this.search); },
         updateCount() {
           this.count = document.querySelectorAll('#issue-section input[name=\'issue_ids[]\']:checked').length;
         }
       }"
       @change="updateCount()">

    
    <div class="px-5 pt-5 pb-4 border-b border-[#F0EDE6]">
      <div class="flex items-center justify-between mb-3">
        <p class="text-fumi" style="font-size:14px">1つ以上選択してください</p>
        <span class="font-medium text-enji" style="font-size:14px">
          <span x-text="count"></span>件選択中
        </span>
      </div>
      
      <div class="relative">
        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-fumi opacity-50 pointer-events-none"
             fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
        </svg>
        <input type="text" x-model="search"
               placeholder="課題を検索..."
               class="form-input pl-10"
               style="font-size:14px"
               aria-label="課題を検索">
      </div>
    </div>

    
    <?php $__currentLoopData = $issuesByCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat => $catIssues): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
      $catIds         = $catIssues->pluck('id')->toArray();
      $catSelected    = count(array_intersect($catIds, $selectedIssues));
      $catKey         = addslashes($cat);
    ?>
    <div class="border-b border-[#F0EDE6] last:border-b-0">
      
      <button type="button"
              @click="openCat('<?php echo e($catKey); ?>')"
              class="w-full flex items-center justify-between px-5 py-3.5 text-left
                     hover:bg-washi transition-colors ease-out select-none"
              style="transition-duration:150ms"
              :aria-expanded="cats['<?php echo e($catKey); ?>'].toString()">
        <span class="font-medium text-sumi" style="font-size:14px"><?php echo e($cat); ?></span>
        <div class="flex items-center gap-2 shrink-0">
          <?php if($catSelected > 0): ?>
            <span class="inline-block px-2 py-0.5 rounded-full bg-[#F8ECEE] text-enji border border-[#E8C9CE]"
                  style="font-size:11px"><?php echo e($catSelected); ?>件</span>
          <?php endif; ?>
          <svg class="w-4 h-4 text-fumi transition-transform ease-out"
               :class="cats['<?php echo e($catKey); ?>'] ? 'rotate-180' : ''"
               style="transition-duration:200ms"
               fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
          </svg>
        </div>
      </button>

      
      <div x-show="showCat('<?php echo e($catKey); ?>')"
           x-transition:enter="transition ease-out duration-150"
           x-transition:enter-start="opacity-0 -translate-y-1"
           x-transition:enter-end="opacity-100 translate-y-0"
           class="px-5 pb-4 pt-1">
        <div class="flex flex-wrap gap-2">
          <?php $__currentLoopData = $catIssues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $issue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <label x-show="showItem('<?php echo e(addslashes($issue->name)); ?>')"
                 class="cursor-pointer" for="issue_<?php echo e($issue->id); ?>">
            <input type="checkbox" id="issue_<?php echo e($issue->id); ?>" name="issue_ids[]"
                   value="<?php echo e($issue->id); ?>" class="sr-only peer"
                   <?php echo e(in_array($issue->id, $selectedIssues) ? 'checked' : ''); ?>>
            <span class="inline-flex items-center px-3 py-1.5 rounded-full font-medium select-none
                         transition-colors ease-out
                         border border-kiwari bg-white text-fumi
                         peer-checked:bg-sumi peer-checked:text-white peer-checked:border-sumi"
                  style="font-size:13px; transition-duration:150ms">
              <?php echo e($issue->name); ?>

            </span>
          </label>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <div class="px-5 py-4 bg-washi rounded-b">
      <label for="issue_other_text" class="block font-medium text-fumi mb-2" style="font-size:14px">
        その他の課題（自由記入）
      </label>
      <input type="text" id="issue_other_text" name="issue_other_text"
             value="<?php echo e(old('issue_other_text', $participant->profile?->issue_other_text)); ?>"
             placeholder="上記にない課題があれば入力してください"
             class="form-input">
    </div>
  </div>

  <?php $__errorArgs = ['issue_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <p class="mt-2 text-enji" style="font-size:13px"><?php echo e($message); ?></p>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</section>


<?php
  $selectedPartners    = old('partner_type_ids', $participant->partnerTypes->pluck('id')->toArray());
  $partnersByCategory  = $partnerTypes->groupBy('category_name');
?>
<section class="mb-8 reveal" style="transition-delay:0.10s">
  <header class="flex items-center gap-3 mb-4">
    <div class="w-7 h-7 rounded flex items-center justify-center shrink-0"
         style="background:#EFF6FF; border:1px solid rgba(37,99,235,0.18)">
      <span class="font-tabular font-semibold" style="font-size:11px; color:#2563EB">05</span>
    </div>
    <h3 class="font-mincho text-sumi" style="font-size:17px">
      求めている相手 <span class="text-enji" style="font-size:14px; font-family:inherit">*</span>
    </h3>
    <div class="h-px flex-1" style="background:#E8E4DC"></div>
  </header>

  <div class="bg-white border border-[#E8E4DC] rounded"
       style="box-shadow: 0 1px 2px rgba(0,0,0,0.04)"
       id="partner-section"
       x-data="{
         count: <?php echo e(count($selectedPartners)); ?>,
         search: '',
         cats: {
           <?php $__currentLoopData = $partnersByCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat => $catPartners): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php
               $catIds     = $catPartners->pluck('id')->toArray();
               $hasSelected = count(array_intersect($catIds, $selectedPartners)) > 0;
             ?>
             '<?php echo e(addslashes($cat)); ?>': <?php echo e($hasSelected ? 'true' : 'false'); ?>,
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         },
         openCat(cat) { this.cats[cat] = !this.cats[cat]; },
         showCat(cat) { return this.search !== '' || this.cats[cat]; },
         showItem(name) { return this.search === '' || name.includes(this.search); },
         updateCount() {
           this.count = document.querySelectorAll('#partner-section input[name=\'partner_type_ids[]\']:checked').length;
         }
       }"
       @change="updateCount()">

    <div class="px-5 pt-5 pb-4 border-b border-[#F0EDE6]">
      <div class="flex items-center justify-between mb-3">
        <p class="text-fumi" style="font-size:14px">1つ以上選択してください</p>
        <span class="font-medium text-enji" style="font-size:14px">
          <span x-text="count"></span>件選択中
        </span>
      </div>
      <div class="relative">
        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-fumi opacity-50 pointer-events-none"
             fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
        </svg>
        <input type="text" x-model="search"
               placeholder="相手を検索..."
               class="form-input pl-10"
               style="font-size:14px"
               aria-label="求めている相手を検索">
      </div>
    </div>

    <?php $__currentLoopData = $partnersByCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat => $catPartners): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
      $catIds      = $catPartners->pluck('id')->toArray();
      $catSelected = count(array_intersect($catIds, $selectedPartners));
      $catKey      = addslashes($cat);
    ?>
    <div class="border-b border-[#F0EDE6] last:border-b-0">
      <button type="button"
              @click="openCat('<?php echo e($catKey); ?>')"
              class="w-full flex items-center justify-between px-5 py-3.5 text-left
                     hover:bg-washi transition-colors ease-out select-none"
              style="transition-duration:150ms"
              :aria-expanded="cats['<?php echo e($catKey); ?>'].toString()">
        <span class="font-medium text-sumi" style="font-size:14px"><?php echo e($cat); ?></span>
        <div class="flex items-center gap-2 shrink-0">
          <?php if($catSelected > 0): ?>
            <span class="inline-block px-2 py-0.5 rounded-full bg-[#F8ECEE] text-enji border border-[#E8C9CE]"
                  style="font-size:11px"><?php echo e($catSelected); ?>件</span>
          <?php endif; ?>
          <svg class="w-4 h-4 text-fumi transition-transform ease-out"
               :class="cats['<?php echo e($catKey); ?>'] ? 'rotate-180' : ''"
               style="transition-duration:200ms"
               fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
          </svg>
        </div>
      </button>
      <div x-show="showCat('<?php echo e($catKey); ?>')"
           x-transition:enter="transition ease-out duration-150"
           x-transition:enter-start="opacity-0 -translate-y-1"
           x-transition:enter-end="opacity-100 translate-y-0"
           class="px-5 pb-4 pt-1">
        <div class="flex flex-wrap gap-2">
          <?php $__currentLoopData = $catPartners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <label x-show="showItem('<?php echo e(addslashes($pt->name)); ?>')"
                 class="cursor-pointer" for="partner_<?php echo e($pt->id); ?>">
            <input type="checkbox" id="partner_<?php echo e($pt->id); ?>" name="partner_type_ids[]"
                   value="<?php echo e($pt->id); ?>" class="sr-only peer"
                   <?php echo e(in_array($pt->id, $selectedPartners) ? 'checked' : ''); ?>>
            <span class="inline-flex items-center px-3 py-1.5 rounded-full font-medium select-none
                         transition-colors ease-out
                         border border-kiwari bg-white text-fumi
                         peer-checked:bg-enji peer-checked:text-white peer-checked:border-enji"
                  style="font-size:13px; transition-duration:150ms">
              <?php echo e($pt->name); ?>

            </span>
          </label>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div class="px-5 py-4 bg-washi rounded-b">
      <label for="partner_other_text" class="block font-medium text-fumi mb-2" style="font-size:14px">
        その他（自由記入）
      </label>
      <input type="text" id="partner_other_text" name="partner_other_text"
             value="<?php echo e(old('partner_other_text', $participant->profile?->partner_other_text)); ?>"
             placeholder="上記にない相手を探している場合は入力してください"
             class="form-input">
    </div>
  </div>

  <?php $__errorArgs = ['partner_type_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <p class="mt-2 text-enji" style="font-size:13px"><?php echo e($message); ?></p>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</section>


<div class="pb-12 reveal" style="transition-delay:0.18s">
  <div class="rounded-lg overflow-hidden" style="background:linear-gradient(135deg,#6B1525,#8B2635,#A03048); padding:1px">
    <button type="submit"
            class="w-full flex items-center justify-center gap-2 font-medium tracking-widest
                   rounded-lg py-4 min-h-[52px] transition-opacity ease-out select-none relative overflow-hidden"
            style="font-size:15px; background:linear-gradient(135deg,#7B1A28,#8B2635); color:#fff; transition-duration:150ms;"
            onmouseover="this.style.opacity='0.88'"
            onmouseout="this.style.opacity='1'"
            onmousedown="this.style.opacity='0.75'"
            onmouseup="this.style.opacity='0.88'">
      <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
      </svg>
      保存してマッチング結果を見る
    </button>
  </div>
  <div class="flex items-center justify-center gap-2 mt-3">
    <svg class="w-3.5 h-3.5 text-matcha" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
    </svg>
    <p class="text-center text-fumi" style="font-size:13px">
      保存後、おすすめ相手一覧が更新されます
    </p>
  </div>
</div>

</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\dev\business_matching\webapp\resources\views/profile/edit.blade.php ENDPATH**/ ?>