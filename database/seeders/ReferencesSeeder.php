<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReferencesSeeder extends Seeder
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
                'code' => 'overtime_method',
                'name' => 'Salary / 173',
                'expression' => '(salary / 173) * overtime_duration_total',
            ],
            [
                'code' => 'overtime_method',
                'name' => 'Fixed',
                'expression' => '10000 * overtime_duration_total',
            ],
            [
                'code' => 'employee_status',
                'name' => 'Tetap',
                'expression' => NULL,
            ],
            [
                'code' => 'employee_status',
                'name' => 'Percobaan',
                'expression' => NULL,
            ]
        ];

        foreach ($data as $item)
            \App\Models\Reference::create($item);
    }
}
