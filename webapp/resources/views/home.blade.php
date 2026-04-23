<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ビジネスマッチング — 事業者間のビジネスマッチングシステム</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Noto+Sans+JP:wght@400;500;700&family=Shippori+Mincho:wght@400;500;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = { theme: { extend: { colors: {
    washi:'#FAFAF7', enji:'#8B2635', matcha:'#4A5D4F',
    sumi:'#1A1A1A', fumi:'#6B6558', kiwari:'#D4CFC4'
  }, screens: { lg: '1024px', xl: '1280px' } } } }
</script>
<style type="text/tailwindcss">
  html { font-size:15px; scroll-behavior:smooth }
  body {
    font-family:'Noto Sans JP',-apple-system,BlinkMacSystemFont,'Hiragino Sans',sans-serif;
    @apply antialiased text-sumi;
    font-feature-settings:"palt";
    letter-spacing:0.02em;
    line-height:1.7;
    background-color:#FAFAF7;
  }
  .font-mincho { font-family:'Shippori Mincho','Noto Serif JP',Georgia,serif; letter-spacing:0.05em }
  .font-tabular { font-family:'Inter',ui-monospace,monospace; font-variant-numeric:tabular-nums; letter-spacing:0 }

  @keyframes marquee-scroll { from{transform:translateX(0)} to{transform:translateX(-50%)} }
  .marquee-track { display:flex; width:max-content; animation:marquee-scroll 32s linear infinite }
  @media(prefers-reduced-motion:reduce){.marquee-track{animation:none}}

  .hero-item { opacity:0; transform:translateY(20px) }
  .hero-item.in { opacity:1; transform:translateY(0); transition:opacity .75s cubic-bezier(.22,1,.36,1),transform .75s cubic-bezier(.22,1,.36,1) }

  .reveal { opacity:0; transform:translateY(22px); transition:opacity .65s cubic-bezier(.22,1,.36,1),transform .65s cubic-bezier(.22,1,.36,1) }
  .reveal.is-visible { opacity:1; transform:translateY(0) }

  .card-lift { transition:transform .24s cubic-bezier(.22,1,.36,1),box-shadow .24s cubic-bezier(.22,1,.36,1); will-change:transform }
  .card-lift:hover { transform:translateY(-5px); box-shadow:0 20px 48px rgba(0,0,0,0.12),0 6px 16px rgba(0,0,0,0.07) !important }

  @keyframes shimmerPass { from{transform:translateX(-120%)} to{transform:translateX(120%)} }
  .cta-btn { position:relative; overflow:hidden }
  .cta-btn::after { content:''; position:absolute; inset:0; background:linear-gradient(110deg,transparent 35%,rgba(255,255,255,0.25) 50%,transparent 65%); transform:translateX(-120%); pointer-events:none }
  .cta-btn:hover::after { animation:shimmerPass .55s ease forwards }

  .metric-card { transition:transform .22s cubic-bezier(.22,1,.36,1),box-shadow .22s cubic-bezier(.22,1,.36,1) }
  .metric-card:hover { transform:translateY(-4px); box-shadow:0 16px 40px rgba(0,0,0,0.12) }

  :focus-visible { outline:2px solid #8B2635; outline-offset:2px }
  @media(prefers-reduced-motion:reduce){ *,*::before,*::after{animation-duration:.01ms!important;transition-duration:.01ms!important} }
</style>
</head>
<body>

{{-- ═══════════════════════════════════════════════
     §1  HERO
═══════════════════════════════════════════════ --}}
<section class="relative overflow-hidden" style="min-height:100svh;min-height:100vh">

  {{-- Background photo --}}
  <img src="/images/tokyo-sunset.jpg" alt="" class="absolute inset-0 w-full h-full object-cover"
       style="object-position:center 45%" loading="eager" aria-hidden="true">

  {{-- Overlay --}}
  <div class="absolute inset-0 pointer-events-none" aria-hidden="true"
       style="background:linear-gradient(135deg,rgba(6,6,16,0.60) 0%,transparent 52%),linear-gradient(0deg,rgba(6,6,16,0.70) 0%,transparent 58%)"></div>

  {{-- Top accent --}}
  <div class="absolute top-0 inset-x-0" style="height:3px;background:linear-gradient(90deg,#8B2635,#C04060,#8B2635)"></div>

  {{-- Seigaiha pattern --}}
  <div class="absolute inset-0 pointer-events-none" aria-hidden="true" style="opacity:0.05">
    <svg width="100%" height="100%"><defs>
      <pattern id="sg" x="0" y="0" width="44" height="44" patternUnits="userSpaceOnUse">
        <path d="M0,22 A22,22 0,0,1 44,22" fill="none" stroke="#fff" stroke-width="0.9"/>
        <path d="M7.33,22 A14.67,14.67 0,0,1 36.67,22" fill="none" stroke="#fff" stroke-width="0.65"/>
        <path d="M-22,44 A22,22 0,0,1 22,44" fill="none" stroke="#fff" stroke-width="0.9"/>
        <path d="M22,44 A22,22 0,0,1 66,44" fill="none" stroke="#fff" stroke-width="0.9"/>
      </pattern>
    </defs><rect width="100%" height="100%" fill="url(#sg)"/></svg>
  </div>

  {{-- Nav --}}
  <nav class="absolute top-0 left-0 right-0 z-10">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 py-5 flex items-center justify-between">
      <div class="flex items-center gap-3">
        {{-- Logo mark: two converging arrows meeting at a radiant match node --}}
        <svg width="34" height="34" viewBox="0 0 32 32" fill="none" aria-hidden="true">
          <defs>
            <radialGradient id="hglow" cx="50%" cy="50%" r="50%">
              <stop offset="0%" stop-color="white" stop-opacity="0.18"/>
              <stop offset="100%" stop-color="white" stop-opacity="0"/>
            </radialGradient>
          </defs>
          <!-- Ambient glow behind center -->
          <circle cx="16" cy="16" r="12" fill="url(#hglow)"/>
          <!-- Left arrow (Company A converging right) -->
          <polygon points="0,6 12,16 0,26" fill="white" opacity="0.82"/>
          <!-- Right arrow (Company B converging left) -->
          <polygon points="32,6 20,16 32,26" fill="white" opacity="0.82"/>
          <!-- Center match node — bright, prominent -->
          <circle cx="16" cy="16" r="6" fill="white"/>
          <!-- Inner accent ring -->
          <circle cx="16" cy="16" r="3.2" fill="none" stroke="rgba(139,38,53,0.22)" stroke-width="1.5"/>
        </svg>
        <div>
          <div style="font-size:17px;font-weight:800;color:#fff;letter-spacing:-0.025em;line-height:1;font-family:'Inter',sans-serif">BizMatch</div>
          <div style="font-size:8px;color:rgba(255,255,255,0.42);letter-spacing:0.12em;margin-top:3px;font-family:'Inter',sans-serif;text-transform:uppercase">ビジネスマッチング</div>
        </div>
      </div>
      <div class="flex items-center gap-6">
        <a href="{{ route('register.show') }}"
           class="font-medium text-white/65 hover:text-white transition-colors hidden lg:block"
           style="font-size:13px;letter-spacing:0.06em;transition-duration:150ms">新規登録</a>
        <a href="{{ route('login.show') }}"
           class="flex items-center gap-1.5 px-5 py-2 font-medium transition-opacity"
           style="font-size:13px;letter-spacing:0.06em;background:rgba(139,38,53,0.80);color:#fff;border:1px solid rgba(139,38,53,0.95);transition-duration:150ms"
           onmouseover="this.style.opacity='0.82'" onmouseout="this.style.opacity='1'">
          ログイン
        </a>
      </div>
    </div>
  </nav>

  {{-- Hero body --}}
  <div class="absolute inset-x-0 bottom-0 z-10" style="padding-bottom:max(3.5rem,env(safe-area-inset-bottom,3.5rem))">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
      <div class="lg:grid lg:grid-cols-2 lg:gap-20 lg:items-end">

        {{-- Left: headline + CTA --}}
        <div>
          {{-- Event badge --}}
          <div class="inline-flex items-center gap-2 mb-6 px-3 py-1.5 hero-item"
               style="border:1px solid rgba(139,38,53,0.60);background:rgba(139,38,53,0.16);backdrop-filter:blur(8px)">
            <div class="w-1.5 h-1.5 rounded-full animate-pulse" style="background:#E05070"></div>
            <span class="font-medium text-white" style="font-size:11px;letter-spacing:0.14em">
              SME BUSINESS MATCHING {{ date('Y') }}
            </span>
          </div>

          {{-- Headline --}}
          <h1 class="font-mincho text-white mb-5 hero-item"
              style="font-size:clamp(40px,7vw,72px);line-height:1.18;letter-spacing:0.04em;text-shadow:0 2px 20px rgba(0,0,0,0.40)">
            ビジネスの<br>可能性を、<br>広げる。
          </h1>

          {{-- Lead --}}
          <p class="mb-8 leading-relaxed hero-item"
             style="font-size:15px;color:rgba(255,255,255,0.70);max-width:380px;text-shadow:0 1px 6px rgba(0,0,0,0.30)">
            同会場の事業者と出会い、課題とビジョンを共有し、<br>
            新たなビジネスへの扉を開く。
          </p>

          {{-- CTAs --}}
          <div class="flex flex-col sm:flex-row gap-3 hero-item" style="max-width:420px">
            <a href="{{ route('register.show') }}"
               class="cta-btn flex-1 flex items-center justify-center gap-2 font-medium tracking-widest min-h-[52px]"
               style="font-size:14px;background:#8B2635;color:#fff;transition-duration:150ms"
               onmouseover="this.style.opacity='0.88'" onmouseout="this.style.opacity='1'">
              <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/>
              </svg>
              無料で新規登録
            </a>
            <a href="{{ route('login.show') }}"
               class="flex-1 flex items-center justify-center font-medium tracking-widest min-h-[52px]"
               style="font-size:14px;border:1px solid rgba(255,255,255,0.32);color:rgba(255,255,255,0.82);background:rgba(255,255,255,0.08);backdrop-filter:blur(8px);transition-duration:150ms"
               onmouseover="this.style.background='rgba(255,255,255,0.15)'"
               onmouseout="this.style.background='rgba(255,255,255,0.08)'">
              ログイン
            </a>
          </div>

          {{-- Scroll hint --}}
          <div class="flex items-center gap-2.5 mt-10 hero-item" aria-hidden="true">
            <div class="flex flex-col gap-1">
              <div class="w-px h-3 mx-auto" style="background:rgba(255,255,255,0.25)"></div>
              <div class="w-px h-3 mx-auto" style="background:rgba(255,255,255,0.12)"></div>
            </div>
            <span style="font-size:10px;letter-spacing:0.18em;color:rgba(255,255,255,0.28);font-family:'Inter',monospace">SCROLL</span>
          </div>
        </div>

        {{-- Right: floating stat cards (desktop only) --}}
        <div class="hidden lg:flex lg:flex-col lg:gap-4 lg:pb-6 lg:items-end hero-item">
          <div style="background:rgba(255,255,255,0.10);backdrop-filter:blur(14px);border:1px solid rgba(255,255,255,0.18);border-radius:14px;padding:20px 28px;min-width:220px">
            <p style="font-size:11px;letter-spacing:0.14em;color:rgba(255,255,255,0.45);font-family:'Inter',sans-serif;margin-bottom:8px">PARTICIPANTS</p>
            <p style="font-size:44px;font-weight:800;color:#fff;line-height:1;letter-spacing:-0.04em;font-family:'Inter',sans-serif">1,000+</p>
            <p style="font-size:13px;color:rgba(255,255,255,0.60);margin-top:6px;font-family:'Noto Sans JP',sans-serif">登録事業者数</p>
          </div>
          <div style="background:rgba(255,255,255,0.10);backdrop-filter:blur(14px);border:1px solid rgba(255,255,255,0.18);border-radius:14px;padding:20px 28px;min-width:220px">
            <p style="font-size:11px;letter-spacing:0.14em;color:rgba(255,255,255,0.45);font-family:'Inter',sans-serif;margin-bottom:8px">AI MATCHING</p>
            <p style="font-size:44px;font-weight:800;color:#fff;line-height:1;letter-spacing:-0.04em;font-family:'Inter',sans-serif">20</p>
            <p style="font-size:13px;color:rgba(255,255,255,0.60);margin-top:6px;font-family:'Noto Sans JP',sans-serif">件の最適候補を提案</p>
          </div>
          <div style="background:rgba(255,255,255,0.10);backdrop-filter:blur(14px);border:1px solid rgba(255,255,255,0.18);border-radius:14px;padding:20px 28px;min-width:220px">
            <p style="font-size:11px;letter-spacing:0.14em;color:rgba(255,255,255,0.45);font-family:'Inter',sans-serif;margin-bottom:8px">RESPONSE</p>
            <p class="font-mincho" style="font-size:38px;font-weight:700;color:#fff;line-height:1">即日</p>
            <p style="font-size:13px;color:rgba(255,255,255,0.60);margin-top:6px;font-family:'Noto Sans JP',sans-serif">連絡先が届く</p>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>


{{-- ═══════════════════════════════════════════════
     §2  KEY METRICS (mobile: 3-col compact / desktop: wider cards)
═══════════════════════════════════════════════ --}}
<section style="background:#FFFFFF;border-top:3px solid #8B2635">
  <div class="max-w-5xl mx-auto px-6 lg:px-10 pt-12 lg:pt-16 pb-12 lg:pb-16">

    <div class="flex items-center gap-2.5 mb-10 reveal">
      <div class="w-5 h-px" style="background:#8B2635"></div>
      <span class="font-medium text-fumi" style="font-size:10px;letter-spacing:0.18em">KEY NUMBERS</span>
    </div>

    <div class="grid grid-cols-3 gap-4 lg:gap-8">

      <div class="metric-card reveal rounded-xl px-4 lg:px-8 py-6 lg:py-8 text-center relative overflow-hidden"
           style="background:linear-gradient(135deg,#FFF5F7 0%,#FFE8EC 100%);border:1px solid rgba(139,38,53,0.14)">
        <div class="absolute top-0 left-0 right-0 h-0.5" style="background:#8B2635"></div>
        <p class="font-tabular font-bold counter text-enji mb-1.5"
           style="font-size:clamp(28px,5vw,44px);line-height:1;letter-spacing:-0.03em" data-count="1000">1,000</p>
        <p class="font-medium text-enji/60" style="font-size:clamp(9px,1.5vw,12px);letter-spacing:0.10em">名が参加</p>
        <div class="absolute bottom-3 right-3 opacity-10">
          <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#8B2635" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
          </svg>
        </div>
      </div>

      <div class="metric-card reveal rounded-xl px-4 lg:px-8 py-6 lg:py-8 text-center relative overflow-hidden"
           style="background:linear-gradient(135deg,#F0F7F4 0%,#DFF0E8 100%);border:1px solid rgba(74,93,79,0.16);transition-delay:0.08s">
        <div class="absolute top-0 left-0 right-0 h-0.5" style="background:#4A5D4F"></div>
        <p class="font-tabular font-bold counter"
           style="font-size:clamp(28px,5vw,44px);line-height:1;letter-spacing:-0.03em;color:#4A5D4F" data-count="20">20</p>
        <p class="font-medium" style="font-size:clamp(9px,1.5vw,12px);letter-spacing:0.10em;color:rgba(74,93,79,0.60);margin-top:6px">件の候補</p>
        <div class="absolute bottom-3 right-3 opacity-10">
          <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#4A5D4F" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"/>
          </svg>
        </div>
      </div>

      <div class="metric-card reveal rounded-xl px-4 lg:px-8 py-6 lg:py-8 text-center relative overflow-hidden"
           style="background:linear-gradient(135deg,#F5F3FF 0%,#EAE6FF 100%);border:1px solid rgba(99,66,178,0.14);transition-delay:0.16s">
        <div class="absolute top-0 left-0 right-0 h-0.5" style="background:#6342B2"></div>
        <p class="font-mincho font-bold" style="font-size:clamp(24px,4.5vw,38px);line-height:1;color:#6342B2">即日</p>
        <p class="font-medium" style="font-size:clamp(9px,1.5vw,12px);letter-spacing:0.10em;color:rgba(99,66,178,0.60);margin-top:6px">連絡先が届く</p>
        <div class="absolute bottom-3 right-3 opacity-10">
          <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#6342B2" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
          </svg>
        </div>
      </div>

    </div>

    <p class="text-center text-fumi mt-8 reveal" style="font-size:13px;transition-delay:0.22s">
      AI スコアリングがあなたに最適なパートナーを優先提案
    </p>

  </div>
</section>


{{-- ═══════════════════════════════════════════════
     §3  MARQUEE
═══════════════════════════════════════════════ --}}
<div class="overflow-hidden" style="background:#8B2635;padding:12px 0;border-top:1px solid rgba(255,255,255,0.15)">
  <div class="marquee-track" aria-hidden="true">
    @php
      $industries = ['製造業','IT・情報通信','建設・不動産','農業・食品','医療・介護','物流・運輸',
                     '金融・保険','小売・卸売','観光・ホテル','教育・研究','エネルギー','環境・リサイクル',
                     'コンサルティング','広告・メディア','飲食・フード'];
    @endphp
    @foreach(array_merge($industries, $industries) as $ind)
      <span class="font-medium text-white/90 shrink-0 px-5" style="font-size:12px;letter-spacing:0.10em">{{ $ind }}</span>
      <span class="text-white/25 shrink-0 px-1" style="font-size:8px">◆</span>
    @endforeach
  </div>
</div>


{{-- ═══════════════════════════════════════════════
     §4  STATEMENT — split layout on desktop
═══════════════════════════════════════════════ --}}
<section style="background:#FAFAF7">
  <div class="lg:grid lg:grid-cols-2 lg:items-stretch" style="max-width:1280px;margin:0 auto">

    {{-- Photo panel --}}
    <div class="relative overflow-hidden" style="min-height:260px">
      <img src="/images/tokyo-aerial.jpg" alt="" class="absolute inset-0 w-full h-full object-cover"
           style="object-position:center 38%" aria-hidden="true">
      <div class="absolute inset-0" style="background:linear-gradient(180deg,rgba(250,250,247,0) 50%,#FAFAF7 100%)"></div>
      {{-- Desktop: fade right into text --}}
      <div class="hidden lg:block absolute inset-0" style="background:linear-gradient(270deg,#FAFAF7 0%,transparent 40%)"></div>

      <div class="absolute top-5 left-5 flex items-center gap-2">
        <div class="px-2.5 py-1" style="background:rgba(255,255,255,0.88);backdrop-filter:blur(8px)">
          <p style="font-size:9px;letter-spacing:0.18em;color:#6B6558;font-weight:500">ABOUT THIS PLATFORM</p>
        </div>
      </div>


    </div>

    {{-- Text panel --}}
    <div class="px-6 lg:px-14 xl:px-20 pt-6 lg:pt-16 pb-12 lg:pb-16 flex flex-col justify-center">

      <h2 class="font-mincho text-sumi mb-6 reveal"
          style="font-size:clamp(22px,3.5vw,34px);line-height:1.48;letter-spacing:0.04em">
        事業者の出会いを、<br>テクノロジーで<br>最適化する。
      </h2>

      <div class="mb-5 pl-4 reveal" style="border-left:2px solid #8B2635;transition-delay:0.08s">
        <p class="text-fumi leading-relaxed" style="font-size:14px">
          参加事業者のプロフィール・課題・パートナー像を分析し、<br>
          最も相性の良い相手を優先的に提案します。
        </p>
      </div>

      <p class="text-fumi leading-relaxed mb-8 reveal" style="font-size:14px;transition-delay:0.15s">
        出会いを偶然に任せるのではなく、データに基づいた確かな接点を。
        会場でのビジネスマッチングを、より実りあるものへ。
      </p>

      <div class="flex flex-wrap gap-2 reveal" style="transition-delay:0.22s">
        @foreach(['AIスコアリング','双方向マッチング','即日通知','スマートフォン対応'] as $tag)
          <span class="px-3 py-1 text-fumi font-medium"
                style="font-size:12px;background:#fff;border:1px solid #E8E4DC;letter-spacing:0.02em">
            {{ $tag }}
          </span>
        @endforeach
      </div>

    </div>
  </div>
</section>


{{-- ═══════════════════════════════════════════════
     §5  STEPS — horizontal 3-col on desktop
═══════════════════════════════════════════════ --}}
<section style="background:#FFFFFF;border-top:1px solid #E8E4DC">
  <div class="max-w-6xl mx-auto px-6 lg:px-10 pt-14 lg:pt-20 pb-14 lg:pb-20">

    <div class="flex items-center justify-between mb-12 reveal">
      <div>
        <p class="font-medium text-fumi mb-1" style="font-size:10px;letter-spacing:0.18em">HOW IT WORKS</p>
        <h2 class="font-mincho text-sumi" style="font-size:clamp(22px,3vw,28px);letter-spacing:0.04em">ご利用の流れ</h2>
      </div>
      <div class="flex items-center gap-1.5" aria-hidden="true">
        <div class="w-2 h-2 rounded-full bg-enji"></div>
        <div class="w-2 h-2 rounded-full" style="background:#E8E4DC"></div>
        <div class="w-2 h-2 rounded-full" style="background:#E8E4DC"></div>
      </div>
    </div>

    {{-- Steps: stacked on mobile, 3-col on desktop --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 lg:gap-8">

      {{-- Step 01 --}}
      <div class="reveal card-lift rounded-xl overflow-hidden"
           style="border:1px solid #E8E4DC;background:#fff;box-shadow:0 2px 10px rgba(0,0,0,0.05)">
        <div class="h-1" style="background:linear-gradient(90deg,#8B2635,#C04060)"></div>
        <div class="p-6 lg:p-8">
          <div class="w-12 h-12 rounded-full flex items-center justify-center mb-5"
               style="background:#FFF5F7;border:1.5px solid rgba(139,38,53,0.20)">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#8B2635" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
            </svg>
          </div>
          <div class="flex items-baseline gap-3 mb-3">
            <span class="font-tabular font-semibold text-enji" style="font-size:11px;letter-spacing:0.14em">STEP 01</span>
            <h3 class="font-mincho text-sumi" style="font-size:18px">プロフィールを登録</h3>
          </div>
          <p class="text-fumi leading-relaxed" style="font-size:13.5px">
            会社情報・事業内容・課題・求めるパートナー像を入力。情報が充実するほどマッチング精度が高まります。
          </p>
        </div>
      </div>

      {{-- Step 02 --}}
      <div class="reveal card-lift rounded-xl overflow-hidden"
           style="border:1px solid #E8E4DC;background:#fff;box-shadow:0 2px 10px rgba(0,0,0,0.05);transition-delay:0.10s">
        <div class="h-1" style="background:linear-gradient(90deg,#4A5D4F,#6A8570)"></div>
        <div class="p-6 lg:p-8">
          <div class="w-12 h-12 rounded-full flex items-center justify-center mb-5"
               style="background:#F0F7F4;border:1.5px solid rgba(74,93,79,0.20)">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#4A5D4F" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z"/>
            </svg>
          </div>
          <div class="flex items-baseline gap-3 mb-3">
            <span class="font-tabular font-semibold" style="font-size:11px;letter-spacing:0.14em;color:#4A5D4F">STEP 02</span>
            <h3 class="font-mincho text-sumi" style="font-size:18px">おすすめ相手を確認</h3>
          </div>
          <p class="text-fumi leading-relaxed" style="font-size:13.5px">
            AIがスコアリングした上位候補を一覧表示。業種・地域・課題・パートナー条件を総合的に分析したマッチ度をご確認ください。
          </p>
        </div>
      </div>

      {{-- Step 03 --}}
      <div class="reveal card-lift rounded-xl overflow-hidden"
           style="border:1px solid #E8E4DC;background:#fff;box-shadow:0 2px 10px rgba(0,0,0,0.05);transition-delay:0.20s">
        <div class="h-1" style="background:linear-gradient(90deg,#6342B2,#8B5CF6)"></div>
        <div class="p-6 lg:p-8">
          <div class="w-12 h-12 rounded-full flex items-center justify-center mb-5"
               style="background:#F5F3FF;border:1.5px solid rgba(99,66,178,0.20)">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#6342B2" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
            </svg>
          </div>
          <div class="flex items-baseline gap-3 mb-3">
            <span class="font-tabular font-semibold" style="font-size:11px;letter-spacing:0.14em;color:#6342B2">STEP 03</span>
            <h3 class="font-mincho text-sumi" style="font-size:18px">連絡希望を送る</h3>
          </div>
          <p class="text-fumi leading-relaxed" style="font-size:13.5px">
            気になる相手に連絡希望を送信すると、双方の連絡先を記載したメールが即日届きます。あとは直接ご連絡いただくだけです。
          </p>
        </div>
      </div>

    </div>
  </div>
</section>


{{-- ═══════════════════════════════════════════════
     §6  PHOTO QUOTE BAND
═══════════════════════════════════════════════ --}}
<div class="relative overflow-hidden" style="height:220px;height:clamp(200px,28vw,340px)" aria-hidden="false">
  <img src="/images/businessman.jpg" alt="東京ビジネスシーン"
       class="absolute inset-0 w-full h-full object-cover" style="object-position:center 22%">
  <div class="absolute inset-0" style="background:linear-gradient(90deg,rgba(8,8,8,0.65) 0%,rgba(8,8,8,0.15) 60%,transparent 100%)"></div>
  <div class="absolute top-0 bottom-0 left-0 w-1 bg-enji"></div>
  <div class="absolute inset-0 flex items-center">
    <div class="max-w-7xl mx-auto px-8 lg:px-14 w-full">
      <blockquote>
        <p class="font-mincho text-white leading-relaxed"
           style="font-size:clamp(17px,2.5vw,26px);letter-spacing:0.06em;max-width:400px;text-shadow:0 2px 8px rgba(0,0,0,0.40)">
          "ビジネスパートナーとの<br>出会いが、ここにある。"
        </p>
        <footer class="mt-4">
          <p style="font-size:10px;letter-spacing:0.14em;color:rgba(255,255,255,0.38)">
            BUSINESS MATCHING PLATFORM {{ date('Y') }}
          </p>
        </footer>
      </blockquote>
    </div>
  </div>
</div>


{{-- ═══════════════════════════════════════════════
     §7  FEATURES — 4-col on desktop
═══════════════════════════════════════════════ --}}
<section style="background:#FAFAF7;border-top:1px solid #E8E4DC">
  <div class="max-w-6xl mx-auto px-6 lg:px-10 pt-14 lg:pt-20 pb-14 lg:pb-20">

    <div class="flex items-end justify-between mb-12">
      <div class="reveal">
        <p class="font-medium text-fumi mb-1" style="font-size:10px;letter-spacing:0.18em">FEATURES</p>
        <h2 class="font-mincho text-sumi" style="font-size:clamp(22px,3vw,28px);letter-spacing:0.04em">システムの特長</h2>
      </div>
      <div class="w-px h-12 opacity-25 reveal" style="background:#8B2635;transition-delay:0.08s"></div>
    </div>

    {{-- 2-col mobile / 4-col desktop --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">

      <div class="reveal card-lift rounded-xl p-5 lg:p-7 relative overflow-hidden"
           style="background:#fff;border:1px solid #E8E4DC;box-shadow:0 2px 6px rgba(0,0,0,0.03)">
        <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-5"
             style="background:linear-gradient(135deg,#FFF0F3,#FFD6DF)">
          <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#8B2635" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"/>
          </svg>
        </div>
        <p class="font-medium text-sumi mb-2" style="font-size:14px;letter-spacing:0.01em">AI スコアリング</p>
        <p class="text-fumi leading-relaxed" style="font-size:12.5px">
          多角的分析でマッチ度を数値化し、最適な候補を提案します。
        </p>
      </div>

      <div class="reveal card-lift rounded-xl p-5 lg:p-7 relative overflow-hidden"
           style="background:#fff;border:1px solid #E8E4DC;box-shadow:0 2px 6px rgba(0,0,0,0.03);transition-delay:0.08s">
        <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-5"
             style="background:linear-gradient(135deg,#F0F7F4,#C8E8D8)">
          <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#4A5D4F" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
          </svg>
        </div>
        <p class="font-medium text-sumi mb-2" style="font-size:14px">安全な連絡先管理</p>
        <p class="text-fumi leading-relaxed" style="font-size:12.5px">
          連絡先は希望成立時のみ、暗号化メールで双方に共有されます。
        </p>
      </div>

      <div class="reveal card-lift rounded-xl p-5 lg:p-7 relative overflow-hidden"
           style="background:#fff;border:1px solid #E8E4DC;box-shadow:0 2px 6px rgba(0,0,0,0.03);transition-delay:0.16s">
        <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-5"
             style="background:linear-gradient(135deg,#F5F3FF,#DDD6FE)">
          <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#6342B2" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 8.25h3m-3 3.75h3M6.75 16.5H6m.75 3h.75"/>
          </svg>
        </div>
        <p class="font-medium text-sumi mb-2" style="font-size:14px">スマートフォン最適化</p>
        <p class="text-fumi leading-relaxed" style="font-size:12.5px">
          会場でそのまま使えるモバイルファースト設計。登録からマッチングまで完結します。
        </p>
      </div>

      <div class="reveal card-lift rounded-xl p-5 lg:p-7 relative overflow-hidden"
           style="background:#fff;border:1px solid #E8E4DC;box-shadow:0 2px 6px rgba(0,0,0,0.03);transition-delay:0.24s">
        <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-5"
             style="background:linear-gradient(135deg,#FFF8EC,#FDDFA8)">
          <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#B45309" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
          </svg>
        </div>
        <p class="font-medium text-sumi mb-2" style="font-size:14px">リアルタイム更新</p>
        <p class="text-fumi leading-relaxed" style="font-size:12.5px">
          新たな参加者が登録されると候補リストが自動更新されます。
        </p>
      </div>

    </div>
  </div>
</section>


{{-- ═══════════════════════════════════════════════
     §8  FINAL CTA
═══════════════════════════════════════════════ --}}
<section style="position:relative;overflow:hidden;background:linear-gradient(135deg,#6B1525 0%,#8B2635 40%,#A03048 100%)">

  <div class="absolute inset-0" style="opacity:0.12">
    <img src="/images/tokyo-aerial.jpg" class="w-full h-full object-cover"
         style="object-position:center 40%" aria-hidden="true">
  </div>

  <div class="absolute inset-0 pointer-events-none" style="opacity:0.06" aria-hidden="true">
    <svg width="100%" height="100%"><defs>
      <pattern id="sg3" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
        <path d="M0,20 A20,20 0,0,1 40,20" fill="none" stroke="#fff" stroke-width="0.8"/>
        <path d="M6.67,20 A13.33,13.33 0,0,1 33.33,20" fill="none" stroke="#fff" stroke-width="0.6"/>
        <path d="M-20,40 A20,20 0,0,1 20,40" fill="none" stroke="#fff" stroke-width="0.8"/>
        <path d="M20,40 A20,20 0,0,1 60,40" fill="none" stroke="#fff" stroke-width="0.8"/>
      </pattern>
    </defs><rect width="100%" height="100%" fill="url(#sg3)"/></svg>
  </div>

  <div class="relative max-w-4xl mx-auto px-6 lg:px-10 pt-16 lg:pt-24 pb-16 lg:pb-24 text-center"
       style="padding-bottom:max(4rem,env(safe-area-inset-bottom,4rem))">

    <div class="flex items-center justify-center gap-3 mb-10" aria-hidden="true">
      <div class="h-px w-10" style="background:rgba(255,255,255,0.30)"></div>
      <div class="w-1.5 h-1.5 rounded-full" style="background:rgba(255,255,255,0.55)"></div>
      <div class="h-px w-10" style="background:rgba(255,255,255,0.30)"></div>
    </div>

    <h2 class="font-mincho text-white mb-4 reveal"
        style="font-size:clamp(28px,5vw,52px);line-height:1.28;letter-spacing:0.04em">
      さあ、はじめましょう。
    </h2>
    <p class="mx-auto mb-12 leading-relaxed reveal"
       style="transition-delay:0.10s;font-size:15px;color:rgba(255,255,255,0.62);max-width:420px">
      アカウントを作成してプロフィールを登録するだけ。<br>あなたのビジネスパートナーが待っています。
    </p>

    {{-- Buttons: stacked on mobile, side-by-side on desktop --}}
    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 reveal"
         style="transition-delay:0.18s;max-width:520px;margin:0 auto">
      <a href="{{ route('register.show') }}"
         class="cta-btn w-full sm:w-auto flex items-center justify-center gap-2 font-medium tracking-widest min-h-[54px] sm:px-10"
         style="font-size:15px;background:#fff;color:#8B2635;transition-duration:150ms;min-width:220px"
         onmouseover="this.style.opacity='0.90'" onmouseout="this.style.opacity='1'">
        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/>
        </svg>
        無料で新規登録
      </a>
      <a href="{{ route('login.show') }}"
         class="w-full sm:w-auto flex items-center justify-center font-medium min-h-[54px] sm:px-10"
         style="font-size:14px;border:1px solid rgba(255,255,255,0.32);color:rgba(255,255,255,0.80);background:rgba(255,255,255,0.10);transition-duration:200ms;min-width:220px"
         onmouseover="this.style.background='rgba(255,255,255,0.18)'"
         onmouseout="this.style.background='rgba(255,255,255,0.10)'">
        すでにアカウントをお持ちの方
      </a>
    </div>

    {{-- Footer --}}
    <div class="mt-20 pt-8 flex flex-col items-center gap-1.5" style="border-top:1px solid rgba(255,255,255,0.14)">
      <div class="flex items-center gap-2">
        <div class="w-0.5 h-4" style="background:rgba(255,255,255,0.35)"></div>
        <span class="font-mincho" style="font-size:13px;color:rgba(255,255,255,0.50);letter-spacing:0.06em">
          ビジネスマッチング
        </span>
      </div>
      <p style="font-size:11px;color:rgba(255,255,255,0.22);letter-spacing:0.05em">
        © {{ date('Y') }} Business Matching Platform. All rights reserved.
      </p>
    </div>

  </div>
</section>

<script>
(function() {
  var mq = window.matchMedia('(prefers-reduced-motion: reduce)');

  document.querySelectorAll('.hero-item').forEach(function(el, i) {
    setTimeout(function() { el.classList.add('in'); }, mq.matches ? 0 : 180 + i * 130);
  });

  if (mq.matches) {
    document.querySelectorAll('.reveal').forEach(function(el) { el.classList.add('is-visible'); });
    return;
  }
  if (!('IntersectionObserver' in window)) {
    document.querySelectorAll('.reveal').forEach(function(el) { el.classList.add('is-visible'); });
    return;
  }

  var revObs = new IntersectionObserver(function(entries) {
    entries.forEach(function(e) {
      if (!e.isIntersecting) return;
      e.target.classList.add('is-visible');
      revObs.unobserve(e.target);
    });
  }, { threshold: 0.10, rootMargin: '0px 0px -24px 0px' });
  document.querySelectorAll('.reveal').forEach(function(el) { revObs.observe(el); });

  function animateCount(el, target, duration) {
    var start = null;
    var step = function(ts) {
      if (!start) start = ts;
      var p = Math.min((ts - start) / duration, 1);
      var eased = 1 - Math.pow(1 - p, 3);
      el.textContent = Math.round(eased * target).toLocaleString('ja-JP');
      if (p < 1) requestAnimationFrame(step);
    };
    requestAnimationFrame(step);
  }
  var cntObs = new IntersectionObserver(function(entries) {
    entries.forEach(function(e) {
      if (!e.isIntersecting) return;
      animateCount(e.target, parseInt(e.target.dataset.count, 10), 1600);
      cntObs.unobserve(e.target);
    });
  }, { threshold: 0.5 });
  document.querySelectorAll('[data-count]').forEach(function(el) { cntObs.observe(el); });
})();
</script>

</body>
</html>
