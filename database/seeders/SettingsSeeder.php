<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'key' => 'overtime_method',
                'value' => 1,
                'expression' => '(salary / 173) * overtime_duration_total',
            ]
        ];

        foreach ($data as $item)
            \App\Models\Setting::create($item);
    }
}
