<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurposeMasterSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            '仕事を依頼したい',
            '仕事を受けたい',
            '協業したい',
            '課題相談したい',
        ];
        $now = now();
        foreach ($items as $i => $name) {
            DB::table('purpose_masters')->insert([
                'name' => $name,
                'sort_order' => $i + 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
