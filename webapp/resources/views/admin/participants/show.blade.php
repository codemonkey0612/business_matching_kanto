@extends('layouts.admin')
@section('title', $participant->name ?? '参加者詳細')

@section('content')

{{-- ===== パンくずリスト + ページヘッダー ===== --}}
<nav class="flex items-center gap-2 mb-6 text-fumi" style="font-size:14px" aria-label="パンくず">
  <a href="{{ route('admin.participants.index') }}"
     class="hover:text-sumi transition-opacity"
     style="transition-duration:150ms">参加者一覧</a>
  <span aria-hidden="true">/</span>
  <span class="text-sumi font-medium">{{ $participant->name ?? '（未入力）' }}</span>
</nav>

{{-- 参加者の概要カード --}}
<div class="bg-white border border-[#E8E4DC] rounded p-5 mb-6 flex items-center gap-4"
     style="box-shadow: 0 1px 2px rgba(0,0,0,0.04)">

  {{-- 頭文字アバター（円形・和紙色） --}}
  <div class="w-12 h-12 rounded-full border border-[#E8E4DC] bg-washi
              flex items-center justify-center shrink-0
              font-medium text-fumi text-lg select-none"
       aria-hidden="true">
    {{ mb_substr($participant->company?->company_name ?? $participant->name ?? '?', 0, 1) }}
  </div>

  <div class="min-w-0 flex-1">
    <div class="flex items-center gap-3 flex-wrap">
      <h2 class="font-mincho text-[20px] text-sumi leading-tight">
        {{ $participant->name ?? '（未入力）' }}
      </h2>
      @if($participant->registration_status === 'completed')
        <span class="inline-block px-2 py-0.5 rounded-full bg-[#ECF0EC] text-matcha border border-[#C5D1C7] font-medium"
              style="font-size:11px">登録完了</span>
      @else
        <span class="inline-block px-2 py-0.5 rounded-full bg-[#FEF9EC] text-[#92620A] border border-[#F3DFA5] font-medium"
              style="font-size:11px">登録途中</span>
      @endif
    </div>
    <p class="text-fumi mt-0.5" style="font-size:14px">
      {{ $participant->role_title ? $participant->role_title . '　' : '' }}{{ $participant->company?->company_name ?? '' }}
    </p>
  </div>

  <div class="text-right shrink-0">
    <p class="text-fumi mb-0.5" style="font-size:12px">登録日</p>
    <p class="font-tabular text-sumi font-medium" style="font-size:14px">
      {{ $participant->created_at->format('Y/m/d') }}
    </p>
  </div>
</div>

{{-- ===== 基本情報 + 会社情報 ===== --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

  {{-- 基本情報 --}}
  <div class="bg-white border border-[#E8E4DC] rounded p-5"
       style="box-shadow: 0 1px 2px rgba(0,0,0,0.04)">
    <h3 class="font-medium text-sumi mb-4 pb-3 border-b border-[#F0EDE6]" style="font-size:14px; letter-spacing:0.04em">
      基本情報
    </h3>
    <dl class="space-y-3" style="font-size:14px">
      <div class="flex gap-3">
        <dt class="text-fumi shrink-0" style="width:60px; font-size:13px">氏名</dt>
        <dd class="font-medium text-sumi">
          {{ $participant->name ?? '—' }}
          @if($participant->name_kana)
            <span class="font-normal text-fumi ml-2" style="font-size:13px">{{ $participant->name_kana }}</span>
          @endif
        </dd>
      </div>
      <div class="flex gap-3">
        <dt class="text-fumi shrink-0" style="width:60px; font-size:13px">役職</dt>
        <dd class="text-sumi">{{ $participant->role_title ?? '—' }}</dd>
      </div>
      <div class="flex gap-3">
        <dt class="text-fumi shrink-0" style="width:60px; font-size:13px">メール</dt>
        <dd class="text-sumi break-all" style="font-size:13px">{{ $participant->email }}</dd>
      </div>
      <div class="flex gap-3">
        <dt class="text-fumi shrink-0" style="width:60px; font-size:13px">電話</dt>
        <dd class="font-tabular text-sumi">{{ $participant->phone_number ?? '—' }}</dd>
      </div>
    </dl>
  </div>

  {{-- 会社情報 --}}
  <div class="bg-white border border-[#E8E4DC] rounded p-5"
       style="box-shadow: 0 1px 2px rgba(0,0,0,0.04)">
    <h3 class="font-medium text-sumi mb-4 pb-3 border-b border-[#F0EDE6]" style="font-size:14px; letter-spacing:0.04em">
      会社情報
    </h3>
    @if($participant->company)
    <dl class="space-y-3" style="font-size:14px">
      <div class="flex gap-3">
        <dt class="text-fumi shrink-0" style="width:60px; font-size:13px">会社名</dt>
        <dd class="font-medium text-sumi">{{ $participant->company->company_name }}</dd>
      </div>
      <div class="flex gap-3">
        <dt class="text-fumi shrink-0" style="width:60px; font-size:13px">業種</dt>
        <dd class="text-sumi">{{ $participant->company->industry?->name ?? '—' }}</dd>
      </div>
      <div class="flex gap-3">
        <dt class="text-fumi shrink-0" style="width:60px; font-size:13px">都道府県</dt>
        <dd class="text-sumi">{{ $participant->company->prefecture?->name ?? '—' }}</dd>
      </div>
      <div class="flex gap-3">
        <dt class="text-fumi shrink-0" style="width:60px; font-size:13px">住所</dt>
        <dd class="text-sumi leading-relaxed" style="font-size:13px">{{ $participant->company->address_text }}</dd>
      </div>
    </dl>
    @else
    <p class="text-fumi" style="font-size:14px">未入力</p>
    @endif
  </div>
</div>

{{-- ===== 事業内容・希望 ===== --}}
@if($participant->profile)
<div class="bg-white border border-[#E8E4DC] rounded p-5 mb-4"
     style="box-shadow: 0 1px 2px rgba(0,0,0,0.04)">
  <h3 class="font-medium text-sumi mb-4 pb-3 border-b border-[#F0EDE6]" style="font-size:14px; letter-spacing:0.04em">
    事業内容・希望
  </h3>
  <div class="space-y-4" style="font-size:14px">
    <div>
      <p class="text-fumi mb-1" style="font-size:12px">事業内容①</p>
      <p class="text-sumi leading-relaxed">{{ $participant->profile->business_summary_1 }}</p>
    </div>
    @if($participant->profile->business_summary_2)
    <div class="pt-3 border-t border-[#F0EDE6]">
      <p class="text-fumi mb-1" style="font-size:12px">事業内容②</p>
      <p class="text-sumi leading-relaxed">{{ $participant->profile->business_summary_2 }}</p>
    </div>
    @endif
    @if($participant->profile->issue_other_text)
    <div class="pt-3 border-t border-[#F0EDE6]">
      <p class="text-fumi mb-1" style="font-size:12px">課題（その他）</p>
      <p class="text-sumi">{{ $participant->profile->issue_other_text }}</p>
    </div>
    @endif
    @if($participant->profile->partner_other_text)
    <div class="pt-3 border-t border-[#F0EDE6]">
      <p class="text-fumi mb-1" style="font-size:12px">求める相手（その他）</p>
      <p class="text-sumi">{{ $participant->profile->partner_other_text }}</p>
    </div>
    @endif
  </div>
</div>
@endif

{{-- ===== 目的・課題・相手 タグ一覧 ===== --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
  <div class="bg-white border border-[#E8E4DC] rounded p-4"
       style="box-shadow: 0 1px 2px rgba(0,0,0,0.04)">
    <h4 class="text-fumi mb-3" style="font-size:12px; letter-spacing:0.06em">希望目的</h4>
    <div class="flex flex-wrap gap-1.5">
      @forelse($participant->purposes as $p)
        <span class="badge">{{ $p->name }}</span>
      @empty
        <span class="text-fumi" style="font-size:13px">未選択</span>
      @endforelse
    </div>
  </div>
  <div class="bg-white border border-[#E8E4DC] rounded p-4"
       style="box-shadow: 0 1px 2px rgba(0,0,0,0.04)">
    <h4 class="text-fumi mb-3" style="font-size:12px; letter-spacing:0.06em">現在の課題</h4>
    <div class="flex flex-wrap gap-1.5">
      @forelse($participant->issues as $iss)
        <span class="badge">{{ $iss->name }}</span>
      @empty
        <span class="text-fumi" style="font-size:13px">未選択</span>
      @endforelse
    </div>
  </div>
  <div class="bg-white border border-[#E8E4DC] rounded p-4"
       style="box-shadow: 0 1px 2px rgba(0,0,0,0.04)">
    <h4 class="text-fumi mb-3" style="font-size:12px; letter-spacing:0.06em">求めている相手</h4>
    <div class="flex flex-wrap gap-1.5">
      @forelse($participant->partnerTypes as $pt)
        <span class="badge-enji">{{ $pt->name }}</span>
      @empty
        <span class="text-fumi" style="font-size:13px">未選択</span>
      @endforelse
    </div>
  </div>
</div>

{{-- ===== マッチング候補 ===== --}}
<div class="bg-white border border-[#E8E4DC] rounded overflow-hidden mb-4"
     style="box-shadow: 0 1px 2px rgba(0,0,0,0.04)">
  <div class="flex items-center justify-between px-5 py-4 border-b border-[#E8E4DC]">
    <div class="flex items-center gap-2">
      <h3 class="font-medium text-sumi" style="font-size:14px; letter-spacing:0.03em">
        マッチング候補
      </h3>
      <span class="font-tabular text-fumi" style="font-size:13px">
        {{ $participant->matchingCandidates->count() }}件
      </span>
    </div>
    <form method="POST" action="{{ route('admin.participants.recalculate', $participant) }}">
      @csrf
      <button type="submit"
              class="inline-flex items-center gap-1.5 border border-[#D4CFC4] text-fumi
                     rounded px-3 py-1.5 bg-washi transition-opacity ease-out"
              style="font-size:13px; transition-duration:150ms;"
              onmouseover="this.style.opacity='0.75'"
              onmouseout="this.style.opacity='1'">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/>
        </svg>
        再計算
      </button>
    </form>
  </div>

  @if($participant->matchingCandidates->isEmpty())
    <p class="px-5 py-8 text-center text-fumi" style="font-size:14px">候補なし</p>
  @else
  <table class="admin-table w-full">
    <thead>
      <tr>
        <th style="width:50px">順位</th>
        <th>相手</th>
        <th style="width:80px">ラベル</th>
        <th style="width:70px">スコア</th>
      </tr>
    </thead>
    <tbody>
      @foreach($participant->matchingCandidates as $mc)
      <tr>
        <td class="font-tabular text-fumi text-center">{{ $mc->rank_no }}</td>
        <td>
          <a href="{{ route('admin.participants.show', $mc->candidate) }}"
             class="font-medium text-enji hover:opacity-75 transition-opacity"
             style="font-size:14px; transition-duration:150ms">
            {{ $mc->candidate?->company?->company_name ?? '—' }}
          </a>
          <p class="text-fumi mt-0.5" style="font-size:12px">{{ $mc->candidate?->name }}</p>
        </td>
        <td>
          <span class="inline-block px-2 py-0.5 rounded-full bg-[#ECF0EC] text-matcha border border-[#C5D1C7] font-medium"
                style="font-size:11px">{{ $mc->match_label }}</span>
        </td>
        <td class="font-tabular text-sumi font-medium">{{ $mc->score_total }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endif
</div>

{{-- ===== 送信済み連絡希望 ===== --}}
<div class="bg-white border border-[#E8E4DC] rounded overflow-hidden"
     style="box-shadow: 0 1px 2px rgba(0,0,0,0.04)">
  <div class="flex items-center gap-2 px-5 py-4 border-b border-[#E8E4DC]">
    <h3 class="font-medium text-sumi" style="font-size:14px; letter-spacing:0.03em">
      送信済み連絡希望
    </h3>
    <span class="font-tabular text-fumi" style="font-size:13px">
      {{ $participant->sentContactRequests->count() }}件
    </span>
  </div>

  @if($participant->sentContactRequests->isEmpty())
    <p class="px-5 py-8 text-center text-fumi" style="font-size:14px">送信なし</p>
  @else
  <table class="admin-table w-full">
    <thead>
      <tr>
        <th>送信先</th>
        <th>会社名</th>
        <th style="width:110px">日時</th>
      </tr>
    </thead>
    <tbody>
      @foreach($participant->sentContactRequests as $cr)
      <tr>
        <td class="font-medium text-sumi">{{ $cr->toParticipant?->name ?? '—' }}</td>
        <td class="text-fumi" style="font-size:13px">
          {{ $cr->toParticipant?->company?->company_name ?? '—' }}
        </td>
        <td class="font-tabular text-fumi" style="font-size:13px">
          {{ $cr->created_at->format('Y/m/d H:i') }}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endif
</div>

@endsection
