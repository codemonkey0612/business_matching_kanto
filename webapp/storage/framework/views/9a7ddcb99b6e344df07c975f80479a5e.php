<?php $__env->startSection('title', '通知履歴'); ?>

<?php $__env->startSection('content'); ?>

<style>
.nt-table{width:100%;border-collapse:collapse}
.nt-table thead tr{background:linear-gradient(135deg,#0F172A 0%,#1E293B 50%,#334155 100%)}
.nt-table thead th{padding:14px 18px;text-align:left;font-size:10.5px;font-weight:700;color:rgba(255,255,255,0.50);text-transform:uppercase;letter-spacing:0.13em;font-family:'Inter',sans-serif;white-space:nowrap;border:none}
.nt-table thead th.th-center{text-align:center}
.nt-table tbody td{padding:16px 18px;border-bottom:1px solid #F1F5F9;vertical-align:middle}
.nt-table tbody tr:last-child td{border-bottom:none}
.nt-table tbody tr{transition:background 120ms,box-shadow 120ms}
.nt-table tbody tr.row-sent:hover   {background:linear-gradient(90deg,rgba(16,185,129,0.04) 0%,transparent 100%);box-shadow:inset 4px 0 0 #10B981}
.nt-table tbody tr.row-failed:hover {background:linear-gradient(90deg,rgba(239,68,68,0.04) 0%,transparent 100%);box-shadow:inset 4px 0 0 #EF4444}
.nt-table tbody tr.row-pending:hover{background:linear-gradient(90deg,rgba(245,158,11,0.04) 0%,transparent 100%);box-shadow:inset 4px 0 0 #F59E0B}

.f-select{background:#F8FAFC;border:1.5px solid #E2E8F0;border-radius:10px;padding:10px 34px 10px 12px;font-size:13.5px;color:#64748B;font-family:'Noto Sans JP',sans-serif;min-height:44px;cursor:pointer;-webkit-appearance:none;appearance:none;transition:border-color 150ms;min-width:148px}
.f-select:focus{outline:none;border-color:#6366F1;box-shadow:0 0 0 3px rgba(99,102,241,0.12)}

.status-pill{display:inline-flex;align-items:center;gap:6px;padding:6px 12px;border-radius:100px;font-size:12px;font-weight:700;font-family:'Noto Sans JP',sans-serif;white-space:nowrap}
.status-dot{width:6px;height:6px;border-radius:50%;flex-shrink:0}
.pill-sent   {background:linear-gradient(135deg,#DCFCE7,#D1FAE5);color:#15803D;border:1px solid #A7F3D0}
.pill-failed {background:linear-gradient(135deg,#FEE2E2,#FECACA);color:#DC2626;border:1px solid #FCA5A5}
.pill-pending{background:linear-gradient(135deg,#FEF3C7,#FDE68A);color:#B45309;border:1px solid #FCD34D}
@keyframes pulse-dot{0%,100%{opacity:1}50%{opacity:.4}}
.dot-pulse{animation:pulse-dot 1.4s ease-in-out infinite}
</style>


<div style="display:flex;flex-wrap:wrap;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:20px">
  <div>
    <p style="font-size:11px;font-weight:700;color:#94A3B8;text-transform:uppercase;letter-spacing:0.12em;margin-bottom:5px;font-family:'Inter',sans-serif">Management</p>
    <h1 style="font-size:clamp(20px,4vw,24px);font-weight:800;color:#1E293B;line-height:1;letter-spacing:-0.025em;font-family:'Inter',sans-serif">通知履歴</h1>
  </div>
  <div style="display:inline-flex;align-items:center;gap:10px;background:linear-gradient(135deg,#0F172A,#1E293B);border-radius:14px;padding:11px 20px;flex-shrink:0;box-shadow:0 4px 16px rgba(0,0,0,0.18)">
    <div style="width:28px;height:28px;background:rgba(255,255,255,0.10);border-radius:7px;display:flex;align-items:center;justify-content:center">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.65)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
    </div>
    <div>
      <p style="font-size:22px;font-weight:800;color:#fff;line-height:1;letter-spacing:-0.03em;font-family:'Inter',sans-serif"><?php echo e($logs->total()); ?></p>
      <p style="font-size:10px;color:rgba(255,255,255,0.40);font-family:'Inter',sans-serif;margin-top:1px;letter-spacing:0.05em">TOTAL LOGS</p>
    </div>
  </div>
</div>


<form method="GET"
      style="background:#fff;border:1px solid #E8EAED;border-radius:16px;padding:14px 16px;margin-bottom:16px;display:flex;flex-wrap:wrap;align-items:center;gap:10px;box-shadow:0 1px 4px rgba(0,0,0,0.04)">
  <div style="display:flex;align-items:center;gap:7px;flex-shrink:0">
    <div style="width:26px;height:26px;background:#EEF2FF;border-radius:7px;display:flex;align-items:center;justify-content:center">
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#6366F1" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
    </div>
    <label style="font-size:13px;font-weight:600;color:#475569;font-family:'Noto Sans JP',sans-serif;white-space:nowrap" for="status-filter">絞り込み</label>
  </div>
  <div style="position:relative">
    <select id="status-filter" name="status" class="f-select">
      <option value="">すべての状態</option>
      <option value="sent"    <?php echo e(request('status') === 'sent'    ? 'selected' : ''); ?>>✓ 送信済み</option>
      <option value="pending" <?php echo e(request('status') === 'pending' ? 'selected' : ''); ?>>◉ 保留中</option>
      <option value="failed"  <?php echo e(request('status') === 'failed'  ? 'selected' : ''); ?>>✕ 失敗</option>
    </select>
    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
         style="position:absolute;right:11px;top:50%;transform:translateY(-50%);pointer-events:none">
      <polyline points="6 9 12 15 18 9"/>
    </svg>
  </div>
  <button type="submit"
          style="display:inline-flex;align-items:center;gap:7px;background:linear-gradient(135deg,#1E293B,#334155);color:#fff;border:none;border-radius:10px;padding:10px 20px;font-size:13.5px;font-weight:600;cursor:pointer;min-height:44px;white-space:nowrap;font-family:'Noto Sans JP',sans-serif;box-shadow:0 2px 8px rgba(0,0,0,0.18);transition:opacity 150ms"
          onmouseover="this.style.opacity='0.80'" onmouseout="this.style.opacity='1'">
    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
    絞り込む
  </button>
  <?php if(request('status')): ?>
    <a href="<?php echo e(route('admin.notifications.index')); ?>"
       style="display:inline-flex;align-items:center;gap:5px;font-size:12.5px;color:#94A3B8;text-decoration:none;padding:9px 12px;border-radius:10px;min-height:44px;transition:all 150ms;font-family:'Noto Sans JP',sans-serif;white-space:nowrap;border:1.5px solid #E2E8F0"
       onmouseover="this.style.background='#F1F5F9';this.style.color='#64748B'"
       onmouseout="this.style.background='transparent';this.style.color='#94A3B8'">
      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
      </svg>
      クリア
    </a>
  <?php endif; ?>
  <?php
    $sentCount    = $logs->getCollection()->where('send_status','sent')->count();
    $failedCount  = $logs->getCollection()->where('send_status','failed')->count();
    $pendingCount = $logs->getCollection()->where('send_status','pending')->count();
  ?>
  <div style="margin-left:auto;display:flex;align-items:center;gap:8px;flex-wrap:wrap">
    <span style="display:inline-flex;align-items:center;gap:5px;font-size:11.5px;color:#15803D;font-weight:600;background:#DCFCE7;padding:4px 10px;border-radius:100px;border:1px solid #A7F3D0;font-family:'Inter',sans-serif">
      <span style="width:5px;height:5px;border-radius:50%;background:currentColor"></span><?php echo e($sentCount); ?>

    </span>
    <?php if($failedCount > 0): ?>
      <span style="display:inline-flex;align-items:center;gap:5px;font-size:11.5px;color:#DC2626;font-weight:600;background:#FEE2E2;padding:4px 10px;border-radius:100px;border:1px solid #FCA5A5;font-family:'Inter',sans-serif">
        <span class="dot-pulse" style="width:5px;height:5px;border-radius:50%;background:currentColor"></span>失敗 <?php echo e($failedCount); ?>

      </span>
    <?php endif; ?>
    <?php if($pendingCount > 0): ?>
      <span style="display:inline-flex;align-items:center;gap:5px;font-size:11.5px;color:#B45309;font-weight:600;background:#FEF3C7;padding:4px 10px;border-radius:100px;border:1px solid #FCD34D;font-family:'Inter',sans-serif">
        <span style="width:5px;height:5px;border-radius:50%;background:currentColor"></span>保留 <?php echo e($pendingCount); ?>

      </span>
    <?php endif; ?>
  </div>
</form>


<div style="background:#fff;border:1px solid #E8EAED;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.07)">

  <div style="display:flex;align-items:center;justify-content:space-between;padding:13px 20px;border-bottom:1px solid #F1F5F9;background:#FAFBFF">
    <p style="font-size:12.5px;color:#64748B;font-family:'Inter',sans-serif;font-weight:500">
      <?php if($logs->total() > 0): ?>
        <span style="color:#1E293B;font-weight:700"><?php echo e($logs->firstItem()); ?>–<?php echo e($logs->lastItem()); ?></span>
        <span style="color:#94A3B8"> / <?php echo e($logs->total()); ?>件</span>
      <?php else: ?>
        <span style="color:#94A3B8">0件</span>
      <?php endif; ?>
    </p>
    <div style="display:flex;align-items:center;gap:6px">
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#CBD5E1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      <span style="font-size:11.5px;color:#94A3B8;font-family:'Inter',sans-serif">最新順</span>
    </div>
  </div>

  <div style="overflow-x:auto;-webkit-overflow-scrolling:touch">
    <table class="nt-table" style="min-width:680px">
      <thead>
        <tr>
          <th style="padding-left:20px;width:44px">#</th>
          <th>送信先</th>
          <th>件名</th>
          <th class="th-center" style="width:90px">状態</th>
          <th class="th-center" style="width:64px">リトライ</th>
          <th style="width:108px">送信日時</th>
          <th>連絡希望元</th>
        </tr>
      </thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
          $rowClass = match($log->send_status) {
            'sent'    => 'row-sent',
            'failed'  => 'row-failed',
            'pending' => 'row-pending',
            default   => ''
          };
          $pal  = ['#6366F1','#3B82F6','#10B981','#F59E0B','#EC4899','#0891B2'];
          $name = $log->target?->name ?? '';
          $ini  = mb_strlen($name) > 0 ? mb_strtoupper(mb_substr($name, 0, 1)) : '?';
          $cc   = mb_strlen($name) > 0 ? mb_ord(mb_substr($name, 0, 1)) : 0;
          $avc  = $pal[$cc % count($pal)];
        ?>
        <tr class="<?php echo e($rowClass); ?>">
          <td style="padding-left:20px;width:44px">
            <span style="font-size:11px;font-weight:600;color:#CBD5E1;font-family:'Inter',sans-serif"><?php echo e(str_pad($loop->index + ($logs->currentPage()-1)*$logs->perPage() + 1, 2, '0', STR_PAD_LEFT)); ?></span>
          </td>
          <td>
            <div style="display:flex;align-items:center;gap:10px">
              <div style="width:36px;height:36px;border-radius:10px;background:<?php echo e($avc); ?>;display:flex;align-items:center;justify-content:center;color:white;font-size:14px;font-weight:800;flex-shrink:0;font-family:'Inter',sans-serif;box-shadow:0 0 0 2px #fff,0 0 0 3.5px <?php echo e($avc); ?>50"><?php echo e($ini); ?></div>
              <div>
                <p style="font-size:13px;font-weight:700;color:#1E293B;line-height:1.3;font-family:'Noto Sans JP',sans-serif;white-space:nowrap"><?php echo e($log->target?->name ?? '—'); ?></p>
                <p style="font-size:11px;color:#94A3B8;line-height:1.3;font-family:'Inter',sans-serif;white-space:nowrap;margin-top:1px"><?php echo e($log->target_email); ?></p>
              </div>
            </div>
          </td>
          <td style="max-width:220px">
            <p style="font-size:13px;color:#475569;font-family:'Noto Sans JP',sans-serif;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden"><?php echo e($log->mail_subject); ?></p>
          </td>
          <td style="text-align:center">
            <?php if($log->send_status === 'sent'): ?>
              <span class="status-pill pill-sent">
                <span class="status-dot" style="background:#16A34A"></span>送信済み
              </span>
            <?php elseif($log->send_status === 'failed'): ?>
              <span class="status-pill pill-failed">
                <span class="status-dot dot-pulse" style="background:#DC2626"></span>失敗
              </span>
            <?php else: ?>
              <span class="status-pill pill-pending">
                <span class="status-dot" style="background:#D97706"></span>保留中
              </span>
            <?php endif; ?>
          </td>
          <td style="text-align:center">
            <?php if($log->retry_count > 0): ?>
              <div style="display:inline-flex;align-items:center;justify-content:center;width:26px;height:26px;border-radius:7px;background:#FEE2E2;border:1px solid #FCA5A5">
                <span style="font-size:12px;font-weight:800;color:#DC2626;font-family:'Inter',sans-serif"><?php echo e($log->retry_count); ?></span>
              </div>
            <?php else: ?>
              <span style="font-size:12px;color:#CBD5E1;font-family:'Inter',sans-serif">—</span>
            <?php endif; ?>
          </td>
          <td>
            <?php if($log->sent_at): ?>
              <p style="font-size:13px;font-weight:600;color:#334155;font-family:'Inter',sans-serif;white-space:nowrap"><?php echo e($log->sent_at->format('m/d')); ?></p>
              <p style="font-size:11.5px;color:#94A3B8;font-family:'Inter',sans-serif;white-space:nowrap;margin-top:1px"><?php echo e($log->sent_at->format('H:i')); ?></p>
            <?php else: ?>
              <span style="font-size:12px;color:#CBD5E1;font-family:'Inter',sans-serif">—</span>
            <?php endif; ?>
          </td>
          <td>
            <?php $fromName = $log->contactRequest?->fromParticipant?->name ?? '—'; ?>
            <?php if($fromName !== '—'): ?>
              <div style="display:flex;align-items:center;gap:7px">
                <div style="width:22px;height:22px;border-radius:6px;background:#EEF2FF;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                  <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#818CF8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <span style="font-size:13px;color:#475569;font-family:'Noto Sans JP',sans-serif;white-space:nowrap;font-weight:500"><?php echo e($fromName); ?></span>
              </div>
            <?php else: ?>
              <span style="font-size:12px;color:#CBD5E1;font-family:'Inter',sans-serif">—</span>
            <?php endif; ?>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
          <td colspan="7" style="padding:0">
            <div style="padding:64px 24px;text-align:center">
              <div style="width:56px;height:56px;background:linear-gradient(135deg,#F1F5F9,#E2E8F0);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;box-shadow:0 4px 12px rgba(0,0,0,0.06)">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
              </div>
              <p style="font-size:15px;font-weight:600;color:#475569;font-family:'Noto Sans JP',sans-serif;margin-bottom:6px">通知履歴がありません</p>
              <p style="font-size:13px;color:#94A3B8;font-family:'Noto Sans JP',sans-serif">
                <?php if(request('status')): ?>
                  <a href="<?php echo e(route('admin.notifications.index')); ?>"
                     style="color:#6366F1;font-weight:600;text-decoration:none"
                     onmouseover="this.style.opacity='.70'" onmouseout="this.style.opacity='1'">絞り込みをクリア</a>
                <?php else: ?>
                  まだ通知は送信されていません
                <?php endif; ?>
              </p>
            </div>
          </td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>


<?php if($logs->hasPages()): ?>
  <div style="margin-top:16px"><?php echo e($logs->links()); ?></div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\dev\business_matching\webapp\resources\views/admin/notifications/index.blade.php ENDPATH**/ ?>