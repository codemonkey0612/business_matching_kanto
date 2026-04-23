<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<style>
  body { font-family: -apple-system, BlinkMacSystemFont, "Hiragino Sans", sans-serif; background: #f3f4f6; margin: 0; padding: 24px; }
  .wrap { max-width: 520px; margin: 0 auto; background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #e5e7eb; }
  .head { background: #111827; color: #fff; padding: 24px; }
  .head h1 { margin: 0; font-size: 18px; }
  .body { padding: 24px; font-size: 14px; color: #374151; line-height: 1.7; }
  .box { background: #f8fafc; border: 1px solid #e5e7eb; border-radius: 12px; padding: 16px; margin: 16px 0; }
  .box dt { font-size: 11px; color: #6b7280; font-weight: 700; }
  .box dd { margin: 0 0 10px; font-weight: 600; }
  .box dd:last-child { margin-bottom: 0; }
  .foot { padding: 16px 24px; background: #f9fafb; border-top: 1px solid #e5e7eb; font-size: 12px; color: #6b7280; }
</style>
</head>
<body>
<div class="wrap">
  <div class="head"><h1>連絡希望のお知らせ</h1></div>
  <div class="body">
    <p>{{ $target->name ?? $target->email }} 様</p>

    @if($isSender)
    <p>以下の方への連絡希望を送信しました。<br>相手の方にも同様のメールが届いています。</p>
    @else
    <p>以下の方からあなたへの連絡希望が届きました。<br>直接ご連絡ください。</p>
    @endif

    <div class="box">
      <dl>
        <dt>会社名</dt>
        <dd>{{ $counterpart->company?->company_name ?? '（未登録）' }}</dd>
        <dt>氏名</dt>
        <dd>{{ $counterpart->name ?? '—' }}（{{ $counterpart->role_title ?? '—' }}）</dd>
        <dt>メールアドレス</dt>
        <dd>{{ $counterpart->email }}</dd>
        <dt>電話番号</dt>
        <dd>{{ $counterpart->phone_number ?? '—' }}</dd>
      </dl>
    </div>

    <p>このメールに返信せず、上記の連絡先へ直接ご連絡ください。</p>
  </div>
  <div class="foot">このメールはビジネスマッチングシステムより自動送信されています。</div>
</div>
</body>
</html>
