<?php $__env->startSection('title', '参加者一覧'); ?>

<?php $__env->startSection('content'); ?>

<?php
  $pal = ['#6366F1','#3B82F6','#10B981','#F59E0B','#EC4899','#0891B2'];
?>

<style>
.pt-table{width:100%;border-collapse:collapse}
.pt-table thead tr{background:linear-gradient(135deg,#1E293B 0%,#334155 100%)}
.pt-table thead th{padding:13px 18px;text-align:left;font-size:10.5px;font-weight:700;color:rgba(255,255,255,0.55);text-transform:uppercase;letter-spacing:0.13em;font-family:'Inter',sans-serif;white-space:nowrap;border:none}
.pt-table thead th.th-center{text-align:center}
.pt-table tbody td{padding:15px 18px;border-bottom:1px solid #F1F5F9;vertical-align:middle}
.pt-table tbody tr:last-child td{border-bottom:none}
.pt-table tbody tr{transition:background 120ms,box-shadow 120ms}
.pt-table tbody tr:hover{background:linear-gradient(90deg,rgba(99,102,241,0.04) 0%,rgba(99,102,241,0.01) 100%);box-shadow:inset 4px 0 0 #6366F1}

.s-input{width:100%;background:#F8FAFC;border:1.5px solid #E2E8F0;border-radius:10px;padding:10px 12px 10px 38px;font-size:13.5px;color:#1E293B;font-family:'Noto Sans JP',sans-serif;min-height:44px;transition:border-color 150ms,box-shadow 150ms;box-sizing:border-box}
.s-input:focus{outline:none;border-color:#6366F1;box-shadow:0 0 0 3px rgba(99,102,241,0.12);background:#fff}
.s-select{width:100%;background:#F8FAFC;border:1.5px solid #E2E8F0;border-radius:10px;padding:10px 34px 10px 12px;font-size:13.5px;color:#64748B;font-family:'Noto Sans JP',sans-serif;min-height:44px;cursor:pointer;-webkit-appearance:none;appearance:none;transition:border-color 150ms;box-sizing:border-box}
.s-select:focus{outline:none;border-color:#6366F1;box-shadow:0 0 0 3px rgba(99,102,241,0.12)}
</style>


<div style="display:flex;flex-wrap:wrap;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:20px">
  <div>
    <p style="font-size:11px;font-weight:700;color:#94A3B8;text-transform:uppercase;letter-spacing:0.12em;margin-bottom:5px;font-family:'Inter',sans-serif">Management</p>
    <h1 style="font-size:clamp(20px,4vw,24px);font-weight:800;color:#1E293B;line-height:1;letter-spacing:-0.025em;font-family:'Inter',sans-serif">参加者一覧</h1>
  </div>
  <div style="display:inline-flex;align-items:center;gap:10px;background:linear-gradient(135deg,#1E293B,#334155);border-radius:14px;padding:11px 20px;flex-shrink:0;box-shadow:0 4px 16px rgba(0,0,0,0.15)">
    <div style="width:28px;height:28px;background:rgba(255,255,255,0.10);border-radius:7px;display:flex;align-items:center;justify-content:center">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.70)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    </div>
    <div>
      <p style="font-size:22px;font-weight:800;color:#fff;line-height:1;letter-spacing:-0.03em;font-family:'Inter',sans-serif"><?php echo e($participants->total()); ?></p>
      <p style="font-size:10px;color:rgba(255,255,255,0.45);font-family:'Inter',sans-serif;margin-top:1px;letter-spacing:0.05em">PARTICIPANTS</p>
    </div>
  </div>
</div>


<form method="GET"
      style="background:#fff;border:1px solid #E8EAED;border-radius:16px;padding:14px 16px;margin-bottom:16px;display:flex;flex-wrap:wrap;align-items:center;gap:10px;box-shadow:0 1px 4px rgba(0,0,0,0.04)">
  <div style="position:relative;flex:1;min-width:200px">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
         style="position:absolute;left:13px;top:50%;transform:translateY(-50%);pointer-events:none">
      <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
    </svg>
    <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="氏名・メール・会社名で検索"
           class="s-input" aria-label="参加者を検索">
  </div>
  <div style="position:relative;min-width:148px">
    <select name="status" class="s-select" aria-label="登録状態">
      <option value="">すべての状態</option>
      <option value="completed" <?php echo e(request('status')==='completed'?'selected':''); ?>>登録完了</option>
      <option value="draft"     <?php echo e(request('status')==='draft'?'selected':''); ?>>登録途中</option>
    </select>
    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
         style="position:absolute;right:11px;top:50%;transform:translateY(-50%);pointer-events:none">
      <polyline points="6 9 12 15 18 9"/>
    </svg>
  </div>
  <button type="submit"
          style="display:inline-flex;align-items:center;gap:7px;background:linear-gradient(135deg,#1E293B,#334155);color:#fff;border:none;border-radius:10px;padding:10px 20px;font-size:13.5px;font-weight:600;cursor:pointer;min-height:44px;white-space:nowrap;font-family:'Noto Sans JP',sans-serif;box-shadow:0 2px 8px rgba(0,0,0,0.18);transition:opacity 150ms"
          onmouseover="this.style.opacity='0.80'" onmouseout="this.style.opacity='1'">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
    </svg>
    検索
  </button>
  <?php if(request('q') || request('status')): ?>
    <a href="<?php echo e(route('admin.participants.index')); ?>"
       style="display:inline-flex;align-items:center;gap:5px;font-size:12.5px;color:#94A3B8;text-decoration:none;padding:9px 12px;border-radius:10px;min-height:44px;transition:all 150ms;font-family:'Noto Sans JP',sans-serif;white-space:nowrap;border:1.5px solid #E2E8F0"
       onmouseover="this.style.background='#F1F5F9';this.style.color='#64748B'"
       onmouseout="this.style.background='transparent';this.style.color='#94A3B8'">
      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
      </svg>
      クリア
    </a>
  <?php endif; ?>
</form>


<div style="background:#fff;border:1px solid #E8EAED;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.07)">

  
  <div style="display:flex;align-items:center;justify-content:space-between;padding:13px 20px;border-bottom:1px solid #F1F5F9;background:#FAFBFF">
    <p style="font-size:12.5px;color:#64748B;font-family:'Inter',sans-serif;font-weight:500">
      <?php if($participants->total() > 0): ?>
        <span style="color:#1E293B;font-weight:700"><?php echo e($participants->firstItem()); ?>–<?php echo e($participants->lastItem()); ?></span>
        <span style="color:#94A3B8"> / <?php echo e($participants->total()); ?>名</span>
      <?php else: ?>
        <span style="color:#94A3B8">0名</span>
      <?php endif; ?>
    </p>
    <div style="display:flex;align-items:center;gap:6px">
      <span style="width:7px;height:7px;border-radius:50%;background:#10B981;display:inline-block"></span>
      <span style="font-size:11.5px;color:#64748B;font-family:'Inter',sans-serif">完了</span>
      <span style="width:1px;height:12px;background:#E2E8F0;display:inline-block;margin:0 2px"></span>
      <span style="width:7px;height:7px;border-radius:50%;background:#F59E0B;display:inline-block"></span>
      <span style="font-size:11.5px;color:#64748B;font-family:'Inter',sans-serif">途中</span>
    </div>
  </div>

  <div style="overflow-x:auto;-webkit-overflow-scrolling:touch">
    <table class="pt-table" style="min-width:680px">
      <thead>
        <tr>
          <th style="padding-left:20px;width:44px">#</th>
          <th>参加者</th>
          <th>役職 / 業種</th>
          <th>所在地</th>
          <th class="th-center" style="width:86px">状態</th>
          <th style="width:90px">登録日</th>
          <th style="width:56px;padding-right:20px"></th>
        </tr>
      </thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
          $cs  = $p->company?->company_name ?? $p->name ?? '';
          $ini = mb_strlen($cs) > 0 ? mb_strtoupper(mb_substr($cs, 0, 1)) : '?';
          $cc  = mb_strlen($cs) > 0 ? mb_ord(mb_substr($cs, 0, 1)) : 0;
          $avc = $pal[$cc % count($pal)];
          $ok  = $p->registration_status === 'completed';
        ?>
        <tr>
          <td style="padding-left:20px;width:44px">
            <span style="font-size:11px;font-weight:600;color:#CBD5E1;font-family:'Inter',sans-serif"><?php echo e(str_pad($loop->index + ($participants->currentPage()-1)*$participants->perPage() + 1, 2, '0', STR_PAD_LEFT)); ?></span>
          </td>
          <td>
            <div style="display:flex;align-items:center;gap:12px">
              <div style="width:38px;height:38px;border-radius:11px;background:<?php echo e($avc); ?>;display:flex;align-items:center;justify-content:center;color:#fff;font-size:15px;font-weight:800;flex-shrink:0;font-family:'Inter',sans-serif;box-shadow:0 0 0 2.5px #fff,0 0 0 4.5px <?php echo e($avc); ?>50;letter-spacing:-0.01em"><?php echo e($ini); ?></div>
              <div>
                <p style="font-size:13.5px;font-weight:700;color:#1E293B;line-height:1.3;font-family:'Noto Sans JP',sans-serif;white-space:nowrap"><?php echo e($p->company?->company_name ?? '（会社名未登録）'); ?></p>
                <p style="font-size:11.5px;color:#94A3B8;line-height:1.4;font-family:'Noto Sans JP',sans-serif;white-space:nowrap;margin-top:1px"><?php echo e($p->name ?? '（氏名未登録）'); ?></p>
              </div>
            </div>
          </td>
          <td>
            <p style="font-size:13px;color:#475569;font-family:'Noto Sans JP',sans-serif;white-space:nowrap;line-height:1.3;font-weight:500"><?php echo e($p->role_title ?? '—'); ?></p>
            <?php if($p->company?->industry?->name): ?>
              <span style="display:inline-block;margin-top:4px;background:#F1F5F9;color:#64748B;font-size:11px;font-weight:600;padding:2px 8px;border-radius:5px;font-family:'Noto Sans JP',sans-serif;white-space:nowrap"><?php echo e($p->company->industry->name); ?></span>
            <?php else: ?>
              <p style="font-size:11.5px;color:#CBD5E1;margin-top:2px">—</p>
            <?php endif; ?>
          </td>
          <td>
            <?php if($p->company?->prefecture?->name): ?>
              <span style="display:inline-flex;align-items:center;gap:5px;font-size:12.5px;color:#64748B;font-family:'Noto Sans JP',sans-serif;white-space:nowrap;background:#F8FAFC;border:1px solid #E2E8F0;padding:4px 10px;border-radius:7px">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                <?php echo e($p->company->prefecture->name); ?>

              </span>
            <?php else: ?>
              <span style="font-size:12px;color:#CBD5E1">—</span>
            <?php endif; ?>
          </td>
          <td style="text-align:center">
            <?php if($ok): ?>
              <span style="display:inline-flex;align-items:center;gap:5px;background:linear-gradient(135deg,#DCFCE7,#D1FAE5);color:#15803D;font-size:11.5px;font-weight:700;padding:5px 11px;border-radius:100px;font-family:'Noto Sans JP',sans-serif;white-space:nowrap;border:1px solid #A7F3D0">
                <span style="width:5px;height:5px;border-radius:50%;background:currentColor;flex-shrink:0"></span>完了
              </span>
            <?php else: ?>
              <span style="display:inline-flex;align-items:center;gap:5px;background:linear-gradient(135deg,#FEF3C7,#FDE68A);color:#B45309;font-size:11.5px;font-weight:700;padding:5px 11px;border-radius:100px;font-family:'Noto Sans JP',sans-serif;white-space:nowrap;border:1px solid #FCD34D">
                <span style="width:5px;height:5px;border-radius:50%;background:currentColor;flex-shrink:0"></span>途中
              </span>
            <?php endif; ?>
          </td>
          <td>
            <p style="font-family:'Inter',sans-serif;font-size:12.5px;color:#475569;font-weight:600;white-space:nowrap"><?php echo e($p->created_at->format('Y/m/d')); ?></p>
            <p style="font-family:'Inter',sans-serif;font-size:11px;color:#94A3B8;white-space:nowrap;margin-top:1px"><?php echo e($p->created_at->format('H:i')); ?></p>
          </td>
          <td style="padding-right:20px">
            <a href="<?php echo e(route('admin.participants.show', $p)); ?>"
               style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:9px;background:#F8FAFC;border:1.5px solid #E2E8F0;color:#94A3B8;text-decoration:none;transition:all 150ms;flex-shrink:0"
               onmouseover="this.style.background='#6366F1';this.style.borderColor='#6366F1';this.style.color='#fff';this.style.boxShadow='0 4px 12px rgba(99,102,241,0.40)';this.style.transform='scale(1.08)'"
               onmouseout="this.style.background='#F8FAFC';this.style.borderColor='#E2E8F0';this.style.color='#94A3B8';this.style.boxShadow='none';this.style.transform='scale(1)'"
               aria-label="詳細を見る">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
              </svg>
            </a>
          </td>
        </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
          <td colspan="7" style="padding:0">
            <div style="padding:64px 24px;text-align:center">
              <div style="width:56px;height:56px;background:linear-gradient(135deg,#EEF2FF,#E0E7FF);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;box-shadow:0 4px 12px rgba(99,102,241,0.12)">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#A5B4FC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
              </div>
              <p style="font-size:15px;font-weight:600;color:#475569;font-family:'Noto Sans JP',sans-serif;margin-bottom:6px">該当する参加者が見つかりません</p>
              <p style="font-size:13px;color:#94A3B8;font-family:'Noto Sans JP',sans-serif;margin-bottom:16px">検索条件を変更してお試しください</p>
              <?php if(request('q') || request('status')): ?>
                <a href="<?php echo e(route('admin.participants.index')); ?>"
                   style="display:inline-flex;align-items:center;gap:6px;font-size:13px;color:#fff;font-weight:600;text-decoration:none;font-family:'Noto Sans JP',sans-serif;background:#6366F1;padding:9px 20px;border-radius:10px;box-shadow:0 4px 12px rgba(99,102,241,0.30);transition:opacity 150ms"
                   onmouseover="this.style.opacity='.80'" onmouseout="this.style.opacity='1'">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                  検索条件をリセット
                </a>
              <?php endif; ?>
            </div>
          </td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>


<?php if($participants->hasPages()): ?>
  <div style="margin-top:16px"><?php echo e($participants->links()); ?></div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\dev\business_matching\webapp\resources\views/admin/participants/index.blade.php ENDPATH**/ ?>