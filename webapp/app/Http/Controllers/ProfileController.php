<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\IndustryMaster;
use App\Models\IssueMaster;
use App\Models\PartnerTypeMaster;
use App\Models\Participant;
use App\Models\ParticipantProfile;
use App\Models\PrefectureMaster;
use App\Models\PurposeMaster;
use App\Services\MatchingEngine;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $participant = $request->attributes->get('participant');
        $participant->load(['company', 'profile', 'issues', 'partnerTypes', 'purposes']);

        return view('profile.edit', [
            'participant'   => $participant,
            'industries'    => IndustryMaster::orderBy('sort_order')->get(),
            'prefectures'   => PrefectureMaster::orderBy('sort_order')->get(),
            'issues'        => IssueMaster::where('is_active', true)->orderBy('sort_order')->get(),
            'partnerTypes'  => PartnerTypeMaster::where('is_active', true)->orderBy('sort_order')->get(),
            'purposes'      => PurposeMaster::orderBy('sort_order')->get(),
        ]);
    }

    public function update(Request $request, MatchingEngine $engine)
    {
        $participant = $request->attributes->get('participant');

        $data = $request->validate([
            'name'                  => ['required', 'string', 'max:80'],
            'name_kana'             => ['required', 'string', 'max:120'],
            'role_title'            => ['required', 'string', 'max:80'],
            'phone_number'          => ['required', 'string', 'max:30'],
            'company_name'          => ['required', 'string', 'max:150'],
            'industry_master_id'    => ['required', 'exists:industry_masters,id'],
            'address_text'          => ['required', 'string', 'max:255'],
            'prefecture_master_id'  => ['required', 'exists:prefecture_masters,id'],
            'business_summary_1'    => ['required', 'string', 'max:255'],
            'business_summary_2'    => ['nullable', 'string', 'max:255'],
            'issue_ids'             => ['required', 'array', 'min:1', 'max:10'],
            'issue_ids.*'           => ['exists:issue_masters,id'],
            'partner_type_ids'      => ['required', 'array', 'min:1', 'max:10'],
            'partner_type_ids.*'    => ['exists:partner_type_masters,id'],
            'purpose_ids'           => ['required', 'array', 'min:1', 'max:5'],
            'purpose_ids.*'         => ['exists:purpose_masters,id'],
            'issue_other_text'      => ['nullable', 'string', 'max:500'],
            'partner_other_text'    => ['nullable', 'string', 'max:500'],
        ]);

        $company = $participant->company;
        $companyData = [
            'company_name'          => $data['company_name'],
            'industry_master_id'    => $data['industry_master_id'],
            'address_text'          => $data['address_text'],
            'prefecture_master_id'  => $data['prefecture_master_id'],
        ];

        if ($company) {
            $company->update($companyData);
        } else {
            $company = Company::create($companyData);
        }

        $participant->update([
            'company_id'            => $company->id,
            'name'                  => $data['name'],
            'name_kana'             => $data['name_kana'],
            'role_title'            => $data['role_title'],
            'phone_number'          => $data['phone_number'],
            'registration_status'   => 'completed',
        ]);

        ParticipantProfile::updateOrCreate(
            ['participant_id' => $participant->id],
            [
                'business_summary_1'    => $data['business_summary_1'],
                'business_summary_2'    => $data['business_summary_2'] ?? '',
                'issue_other_text'      => $data['issue_other_text'] ?? null,
                'partner_other_text'    => $data['partner_other_text'] ?? null,
            ]
        );

        $participant->issues()->sync($data['issue_ids']);
        $participant->partnerTypes()->sync($data['partner_type_ids']);
        $participant->purposes()->sync($data['purpose_ids']);

        $engine->recalculateFor($participant->id);

        return redirect()->route('matching.index')->with('success', 'プロフィールを保存しました。');
    }
}
