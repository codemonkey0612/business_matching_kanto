<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>新規登録 | ビジネスマッチング</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Noto+Sans+JP:wght@400;500;700&family=Shippori+Mincho:wght@400;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = { theme: { extend: { colors: { washi:'#FAFAF7', enji:'#8B2635', matcha:'#4A5D4F', sumi:'#1A1A1A', fumi:'#6B6558', kiwari:'#D4CFC4' } } } }
</script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style type="text/tailwindcss">
  html { font-size: 15px; }
  body {
    font-family: 'Noto Sans JP', -apple-system, BlinkMacSystemFont, 'Hiragino Sans', sans-serif;
    @apply antialiased bg-washi text-sumi;
    font-feature-settings: "palt";
    letter-spacing: 0.02em;
    line-height: 1.7;
  }
  .font-mincho { font-family: 'Shippori Mincho', 'Noto Serif JP', Georgia, serif; letter-spacing: 0.06em; }
  .form-input {
    @apply w-full border border-kiwari bg-white text-sumi
           rounded px-4 py-3 min-h-[44px]
           transition-all ease-out placeholder:text-kiwari;
    font-size: 15px;
    font-family: inherit;
    transition-duration: 150ms;
  }
  .form-input:focus {
    outline: none; border-color: #8B2635;
    box-shadow: 0 0 0 3px rgba(139, 38, 53, 0.10);
  }
  .form-input.is-error { border-color: #8B2635; }
  :focus-visible { outline: 2px solid #8B2635; outline-offset: 2px; }
  @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; } }
  @keyframes formSlide {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .form-panel { animation: formSlide 0.55s cubic-bezier(0.22,1,0.36,1) 0.20s both; }
  .form-input {
    transition: border-color 0.20s ease, box-shadow 0.20s ease,
                transform 0.18s cubic-bezier(0.22,1,0.36,1) !important;
  }
  .form-input:focus { transform: translateY(-1px); }
  @keyframes shimmerPass {
    from { transform: translateX(-120%); }
    to   { transform: translateX(120%); }
  }
  .btn-shimmer { position: relative; overflow: hidden; }
  .btn-shimmer::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(110deg, transparent 35%, rgba(255,255,255,0.22) 50%, transparent 65%);
    transform: translateX(-120%);
    pointer-events: none;
  }
  .btn-shimmer:hover::after { animation: shimmerPass 0.55s ease forwards; }
</style>
</head>
<body class="bg-washi min-h-screen flex flex-col">

  {{-- ===== 写真ヒーローパネル ===== --}}
  <div class="relative shrink-0 overflow-hidden" style="height: min(52vh, 370px);">

    {{-- 臙脂グラデーション帯（最上部） --}}
    <div class="absolute top-0 inset-x-0 z-10" style="height:3px; background:linear-gradient(90deg,#8B2635,#6B3040,#8B2635)"></div>

    {{-- 高層ビル（東京・ビジネス街） --}}
    <img src="/images/tower-upward.jpg"
         alt=""
         class="absolute inset-0 w-full h-full object-cover"
         style="object-position:center 55%"
         loading="eager"
         aria-hidden="true">

    <div class="absolute inset-0 pointer-events-none" aria-hidden="true"
         style="background:
           linear-gradient(135deg, rgba(6,6,16,0.24) 0%, transparent 44%),
           linear-gradient(180deg, transparent 36%, rgba(6,6,16,0.65) 100%)"></div>

    {{-- 青海波文様 --}}
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true" style="opacity:0.07">
      <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <pattern id="seigaiha" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
            <path d="M 0,20 A 20,20 0 0,1 40,20"            fill="none" stroke="#fff" stroke-width="0.8"/>
            <path d="M 6.67,20 A 13.33,13.33 0 0,1 33.33,20" fill="none" stroke="#fff" stroke-width="0.6"/>
            <path d="M 13.33,20 A 6.67,6.67 0 0,1 26.67,20"  fill="none" stroke="#fff" stroke-width="0.5"/>
            <path d="M -20,40 A 20,20 0 0,1 20,40"           fill="none" stroke="#fff" stroke-width="0.8"/>
            <path d="M 20,40 A 20,20 0 0,1 60,40"            fill="none" stroke="#fff" stroke-width="0.8"/>
          </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#seigaiha)"/>
      </svg>
    </div>

    <div class="absolute bottom-0 left-0 right-0 px-6 pb-8 z-10">
      <div class="flex items-center gap-2 mb-3">
        <div class="w-0.5 h-4 bg-enji"></div>
        <p class="font-medium" style="font-size:10px; letter-spacing:0.18em; color:rgba(255,255,255,0.45)">
          BUSINESS MATCHING PLATFORM
        </p>
      </div>
      <h1 class="font-mincho text-white mb-2"
          style="font-size:clamp(26px,7.5vw,34px); line-height:1.25; letter-spacing:0.05em;
                 text-shadow:0 2px 16px rgba(0,0,0,0.40)">
        新規登録
      </h1>
      <p style="font-size:13px; color:rgba(255,255,255,0.62)">
        ビジネスマッチングシステムに参加登録します
      </p>
    </div>
  </div>

  {{-- ===== セクション帯 ===== --}}
  <div style="background:#8B2635; padding:10px 24px">
    <div class="max-w-sm mx-auto flex items-center gap-3">
      <span class="font-medium text-white/90" style="font-size:10px; letter-spacing:0.22em">REGISTER</span>
      <div class="h-px flex-1" style="background:rgba(255,255,255,0.22)"></div>
      <span style="font-size:11px; color:rgba(255,255,255,0.55); letter-spacing:0.06em">アカウントを作成</span>
    </div>
  </div>

  {{-- ===== フォームセクション ===== --}}
  <div class="form-panel px-5 pt-8 pb-10" style="background:#FAFAF7" x-data="{ showPw: false, showPwC: false }">
    <div class="max-w-sm mx-auto">

      {{-- バリデーションエラー --}}
      @if($errors->any())
        <div class="mb-6 px-4 py-3 bg-[#F8ECEE] border border-[#E8C9CE] rounded text-enji"
             style="font-size:14px" role="alert">
          <ul class="space-y-0.5 list-disc list-inside">
            @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf

          {{-- メールアドレス --}}
          <div class="mb-5">
            <label for="email" class="block font-medium text-fumi mb-2" style="font-size:14px">
              メールアドレス
            </label>
            <input
              type="email" id="email" name="email"
              value="{{ old('email') }}"
              autocomplete="email" required
              placeholder="example@company.co.jp"
              class="form-input @error('email') is-error @enderror">
            @error('email')
              <p class="mt-1.5 text-enji" style="font-size:13px">{{ $message }}</p>
            @enderror
          </div>

          {{-- パスワード --}}
          <div class="mb-5">
            <label for="password" class="block font-medium text-fumi mb-2" style="font-size:14px">
              パスワード
              <span class="font-normal text-fumi opacity-70">（英数字混在・8文字以上）</span>
            </label>
            <div class="relative">
              <input
                :type="showPw ? 'text' : 'password'"
                id="password" name="password"
                autocomplete="new-password" required
                placeholder="••••••••"
                class="form-input pr-12 @error('password') is-error @enderror">
              <button type="button" @click="showPw = !showPw"
                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-fumi hover:text-sumi p-1"
                :aria-label="showPw ? 'パスワードを隠す' : 'パスワードを表示'">
                <svg x-show="!showPw" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <svg x-show="showPw" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true" style="display:none">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                </svg>
              </button>
            </div>
            @error('password')
              <p class="mt-1.5 text-enji" style="font-size:13px">{{ $message }}</p>
            @enderror
          </div>

          {{-- パスワード確認 --}}
          <div class="mb-6">
            <label for="password_confirmation" class="block font-medium text-fumi mb-2" style="font-size:14px">
              パスワード（確認）
            </label>
            <div class="relative">
              <input
                :type="showPwC ? 'text' : 'password'"
                id="password_confirmation" name="password_confirmation"
                autocomplete="new-password" required
                placeholder="••••••••"
                class="form-input pr-12">
              <button type="button" @click="showPwC = !showPwC"
                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-fumi hover:text-sumi p-1"
                :aria-label="showPwC ? 'パスワードを隠す' : 'パスワードを表示'">
                <svg x-show="!showPwC" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <svg x-show="showPwC" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true" style="display:none">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                </svg>
              </button>
            </div>
          </div>

          {{-- 利用規約同意 --}}
          <div class="mb-7 p-4 bg-washi border border-[#E8E4DC] rounded">
            <label class="flex items-start gap-3 cursor-pointer" for="agree">
              <input
                type="checkbox" id="agree" name="agree" value="1"
                class="mt-1 w-4 h-4 rounded-sm border-kiwari cursor-pointer shrink-0
                       accent-enji
                       @error('agree') outline outline-2 outline-enji @enderror">
              <span class="text-fumi leading-relaxed" style="font-size:14px">
                <a href="#" class="text-enji underline underline-offset-2 hover:opacity-75 transition-opacity"
                   style="transition-duration:150ms">利用規約</a>および
                <a href="#" class="text-enji underline underline-offset-2 hover:opacity-75 transition-opacity"
                   style="transition-duration:150ms">個人情報の取り扱いについて</a>
                に同意のうえ登録します
              </span>
            </label>
            @error('agree')
              <p class="mt-2 text-enji" style="font-size:13px">{{ $message }}</p>
            @enderror
          </div>

          {{-- 登録ボタン --}}
          <button type="submit"
                  class="btn-shimmer w-full flex items-center justify-center
                         bg-enji text-white font-medium tracking-widest
                         rounded py-3.5 min-h-[48px]
                         transition-opacity ease-out select-none"
                  style="font-size:15px; transition-duration:150ms;"
                  onmouseover="this.style.opacity='0.85'"
                  onmouseout="this.style.opacity='1'"
                  onmousedown="this.style.opacity='0.70'"
                  onmouseup="this.style.opacity='0.85'">
            登録する
          </button>
        </form>

        {{-- 区切り線 --}}
        <div class="flex items-center gap-3 my-7">
          <div class="h-px flex-1 bg-[#E8E4DC]"></div>
          <div class="h-px w-3 bg-enji opacity-50"></div>
          <div class="w-1 h-1 bg-enji rounded-full opacity-60"></div>
          <div class="h-px w-3 bg-enji opacity-50"></div>
          <div class="h-px flex-1 bg-[#E8E4DC]"></div>
        </div>

        <p class="text-center text-fumi" style="font-size:13px">
          すでにアカウントをお持ちの方は
          <a href="{{ route('login.show') }}"
             class="text-enji font-medium underline underline-offset-2 hover:opacity-75 transition-opacity"
             style="transition-duration:150ms">
            ログイン
          </a>
        </p>

    </div>
  </div>

</body>
</html>
