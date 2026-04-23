<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'ビジネスマッチング')</title>
{{-- フォント読み込み: Shippori Mincho（見出し）, Noto Sans JP（本文）, Inter（数字・英字） --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Noto+Sans+JP:wght@400;500;700&family=Shippori+Mincho:wght@400;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          washi:   '#FAFAF7',
          surface: '#FFFFFF',
          enji:    '#8B2635',
          matcha:  '#4A5D4F',
          sumi:    '#1A1A1A',
          fumi:    '#6B6558',
          kiwari:  '#D4CFC4',
          boder:   '#E8E4DC',
        }
      }
    }
  }
</script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style type="text/tailwindcss">
  /* ===== ベース ===== */
  html { font-size: 15px; }

  body {
    font-family: 'Noto Sans JP', -apple-system, BlinkMacSystemFont, 'Hiragino Sans', 'Yu Gothic UI', sans-serif;
    @apply antialiased text-sumi;
    font-feature-settings: "palt";
    letter-spacing: 0.02em;
    line-height: 1.7;
    background-color: #FAFAF7;
  }

  /* ===== タイポグラフィ ===== */
  .font-mincho {
    font-family: 'Shippori Mincho', 'Noto Serif JP', 'HiraMinProN-W3', Georgia, serif;
    letter-spacing: 0.05em;
  }
  .font-tabular {
    font-family: 'Inter', ui-monospace, monospace;
    font-variant-numeric: tabular-nums;
    letter-spacing: 0;
  }

  /* ===== ボタン ===== */
  /* 主要アクション: 臙脂色 */
  .btn-primary {
    @apply inline-flex items-center justify-center gap-2
           bg-enji text-white font-medium tracking-widest
           rounded px-6 py-3 min-h-[44px] w-full
           transition-opacity ease-out select-none;
    font-size: 15px;
    transition-duration: 150ms;
  }
  .btn-primary:hover  { opacity: 0.85; }
  .btn-primary:active { opacity: 0.70; }

  /* 補助アクション: アウトライン */
  .btn-secondary {
    @apply inline-flex items-center justify-center gap-2
           bg-surface text-enji border border-enji font-medium tracking-widest
           rounded px-6 py-3 min-h-[44px]
           transition-opacity ease-out select-none;
    font-size: 15px;
    transition-duration: 150ms;
  }
  .btn-secondary:hover  { opacity: 0.75; }
  .btn-secondary:active { opacity: 0.60; }

  /* ゴースト: テキストのみ */
  .btn-ghost {
    @apply inline-flex items-center justify-center gap-1.5
           text-fumi font-medium
           px-3 py-2 min-h-[44px] rounded
           transition-opacity ease-out select-none;
    font-size: 14px;
    transition-duration: 150ms;
  }
  .btn-ghost:hover { opacity: 0.65; }

  /* ===== フォーム ===== */
  .form-input {
    @apply w-full border border-kiwari bg-surface text-sumi
           rounded px-4 py-3 min-h-[44px]
           transition-all ease-out placeholder:text-kiwari;
    font-size: 15px;
    font-family: inherit;
    line-height: 1.5;
    transition-duration: 150ms;
  }
  .form-input:focus {
    outline: none;
    border-color: #8B2635;
    box-shadow: 0 0 0 3px rgba(139, 38, 53, 0.10);
  }
  .form-input.is-error { border-color: #8B2635; }

  .form-label {
    @apply block font-medium text-fumi mb-2;
    font-size: 14px;
    letter-spacing: 0.03em;
  }
  .form-error {
    @apply text-enji mt-1.5;
    font-size: 13px;
    letter-spacing: 0.02em;
  }
  .form-hint {
    @apply text-fumi mt-1.5;
    font-size: 13px;
  }

  /* ===== カード ===== */
  .card {
    @apply bg-surface border border-[#E8E4DC] rounded;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
  }

  /* ===== チップ（選択肢） ===== */
  .chip-off {
    @apply inline-flex items-center px-3 py-1.5 rounded-full
           bg-surface text-fumi border border-kiwari
           font-medium select-none cursor-pointer
           transition-colors ease-out;
    font-size: 13px;
    transition-duration: 150ms;
  }
  .chip-on {
    @apply inline-flex items-center px-3 py-1.5 rounded-full
           bg-sumi text-white border border-sumi
           font-medium select-none cursor-pointer
           transition-colors ease-out;
    font-size: 13px;
    transition-duration: 150ms;
  }

  /* ===== バッジ ===== */
  .badge {
    @apply inline-block px-2.5 py-0.5 rounded-full
           bg-[#F5F2EC] text-fumi border border-[#E8E4DC] font-medium;
    font-size: 12px;
  }
  .badge-matcha {
    @apply inline-block px-2.5 py-0.5 rounded-full
           bg-[#ECF0EC] text-matcha border border-[#C5D1C7] font-medium;
    font-size: 12px;
  }
  .badge-enji {
    @apply inline-block px-2.5 py-0.5 rounded-full
           bg-[#F8ECEE] text-enji border border-[#E8C9CE] font-medium;
    font-size: 12px;
  }

  /* ===== 区切り線 ===== */
  .divider { @apply border-t border-kiwari; }

  /* ===== セクション見出し（明朝体） ===== */
  .section-head {
    font-family: 'Shippori Mincho', 'Noto Serif JP', Georgia, serif;
    @apply text-sumi font-bold;
    font-size: 18px;
    letter-spacing: 0.05em;
  }

  /* ===== モーション ===== */
  @media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
      animation-duration: 0.01ms !important;
      transition-duration: 0.01ms !important;
    }
  }

  /* ===== フォーカス ===== */
  :focus-visible {
    outline: 2px solid #8B2635;
    outline-offset: 2px;
  }

  /* ===== Alpine.js 非表示 ===== */
  [x-cloak] { display: none !important; }

  /* ===== スクロールリビール ===== */
  .reveal {
    opacity: 0;
    transform: translateY(22px);
    transition: opacity 0.65s cubic-bezier(0.22, 1, 0.36, 1),
                transform 0.65s cubic-bezier(0.22, 1, 0.36, 1);
  }
  .reveal.is-visible { opacity: 1; transform: translateY(0); }

  /* カード個別リビール（アニメーション使用でhover transitionと競合を避ける） */
  @keyframes cardReveal {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .card-reveal { opacity: 0; }
  .card-reveal.is-visible {
    animation: cardReveal 0.60s cubic-bezier(0.22, 1, 0.36, 1) forwards;
  }

  /* ===== カードホバーリフト ===== */
  .card-lift {
    transition: transform 0.24s cubic-bezier(0.22, 1, 0.36, 1),
                box-shadow 0.24s cubic-bezier(0.22, 1, 0.36, 1);
    will-change: transform;
  }
  .card-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 18px 44px rgba(0,0,0,0.12), 0 4px 14px rgba(0,0,0,0.07) !important;
  }

  /* ===== ボタンシマー ===== */
  @keyframes shimmerPass {
    from { transform: translateX(-120%); }
    to   { transform: translateX(120%); }
  }
  .btn-primary {
    position: relative;
    overflow: hidden;
  }
  .btn-primary::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(110deg, transparent 35%, rgba(255,255,255,0.22) 50%, transparent 65%);
    transform: translateX(-120%);
    pointer-events: none;
  }
  .btn-primary:hover::after {
    animation: shimmerPass 0.55s ease forwards;
  }

  /* ===== フォーム入力強化 ===== */
  .form-input {
    transition: border-color 0.20s ease, box-shadow 0.20s ease,
                transform 0.18s cubic-bezier(0.22, 1, 0.36, 1) !important;
  }
  .form-input:focus { transform: translateY(-1px); }

  /* ===== ページインアニメーション ===== */
  @keyframes pageFade {
    from { opacity: 0; transform: translateY(6px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .page-enter { animation: pageFade 0.45s cubic-bezier(0.22, 1, 0.36, 1) both; }
</style>
</head>
<body>

{{-- ===== ヘッダー ===== --}}
<header class="sticky top-0 z-20" style="background:#FFFFFF; border-bottom:1px solid #E8E4DC;
       box-shadow:0 1px 12px rgba(0,0,0,0.06)">
  {{-- 臙脂グラデーション帯 --}}
  <div style="height:3px; background:linear-gradient(90deg,#8B2635,#C04060,#8B2635)"></div>
  <div class="max-w-lg mx-auto px-5 py-3 flex items-center justify-between">

    {{-- ロゴ --}}
    <div class="flex items-center gap-2.5">
      <div class="flex items-center gap-1.5">
        <div class="w-0.5 h-5 bg-enji"></div>
        <div class="w-0.5 h-3.5 bg-enji opacity-40"></div>
      </div>
      <span class="font-mincho text-sumi" style="font-size:15px; letter-spacing:0.06em">ビジネスマッチング</span>
      <span class="px-1.5 py-0.5 font-medium"
            style="font-size:9px; letter-spacing:0.10em; background:#FFF0F3; color:#8B2635;
                   border:1px solid rgba(139,38,53,0.18)">BETA</span>
    </div>

    {{-- ログアウト --}}
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit"
              class="flex items-center gap-1.5 font-medium transition-opacity"
              style="font-size:12px; letter-spacing:0.06em; color:#6B6558; transition-duration:150ms"
              onmouseover="this.style.color='#1A1A1A'"
              onmouseout="this.style.color='#6B6558'">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
        </svg>
        ログアウト
      </button>
    </form>

  </div>
</header>

{{-- ===== メインコンテンツ ===== --}}
<main class="max-w-lg mx-auto px-5 py-8 page-enter">

  {{-- 成功メッセージ --}}
  @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-end="opacity-0"
         class="mb-6 flex items-start gap-3 px-4 py-3.5
                bg-[#ECF0EC] border border-[#C5D1C7] rounded"
         role="alert">
      {{-- チェックアイコン --}}
      <svg class="w-4 h-4 mt-0.5 shrink-0 text-matcha" fill="none" stroke="currentColor"
           stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
      </svg>
      <span class="text-matcha" style="font-size:14px">{{ session('success') }}</span>
      <button @click="show = false" class="ml-auto text-matcha/60 hover:text-matcha transition-opacity"
              aria-label="閉じる">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
  @endif

  {{-- 情報メッセージ --}}
  @if(session('info'))
    <div class="mb-6 px-4 py-3.5 bg-[#F5F2EC] border border-[#E8E4DC] rounded text-fumi"
         style="font-size:14px" role="status">
      {{ session('info') }}
    </div>
  @endif

  @yield('content')
</main>

<script>
(function () {
  if (!('IntersectionObserver' in window)) return;
  var mq = window.matchMedia('(prefers-reduced-motion: reduce)');

  /* スクロールリビール */
  var revObs = new IntersectionObserver(function (entries) {
    entries.forEach(function (e) {
      if (!e.isIntersecting) return;
      e.target.classList.add('is-visible');
      revObs.unobserve(e.target);
    });
  }, { threshold: 0.10, rootMargin: '0px 0px -20px 0px' });

  document.querySelectorAll('.reveal, .card-reveal').forEach(function (el) {
    revObs.observe(el);
  });

  /* カード遅延（stagger） */
  document.querySelectorAll('.card-reveal').forEach(function (el, i) {
    if (!mq.matches) el.style.animationDelay = (i % 4 * 75) + 'ms';
  });
})();
</script>

</body>
</html>
