<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            [
                'name' => 'クリーニング',
                'memo' => '全体の掃除',
                'price' => 3000
            ],
            [
                'name' => 'レベリング',
                'memo' => 'フレットの高さ調整',
                'price' => 8000
            ],
            [
                'name' => 'リフレット',
                'memo' => 'フレット打ち替え',
                'price' => 15000
            ],
            [
                'name' => 'リフレット(メイプル)',
                'memo' => '塗装を伴うフレットの打ち替え',
                'price' => 20000
            ],
        ]);
    }
}
