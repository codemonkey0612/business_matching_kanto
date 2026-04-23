<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndustryMasterSeeder extends Seeder
{
    public function run(): void
    {
        $industries = [
            'IT・Web',
            'ソフトウェア・SaaS',
            'システム開発',
            '広告・マーケティング',
            'デザイン・クリエイティブ',
            '製造業',
            '建設・不動産',
            '卸売・小売',
            '飲食・フード',
            '医療・介護・福祉',
            '教育・学習支援',
            '人材・HR',
            '金融・保険',
            '士業・専門サービス',
            '物流・運輸',
            'エネルギー・環境',
            '農林水産',
            '観光・旅行',
            'エンターテインメント',
            'コンサルティング',
            'その他',
        ];
        $now = now();
        foreach ($industries as $i => $name) {
            DB::table('industry_masters')->insert([
                'name' => $name,
                'sort_order' => $i + 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
