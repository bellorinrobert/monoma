<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $leadList = [
            [
                'name' => "Mi candidato",
                'source' => "Fotocada",
                'owner' => 2,
                'created_at' => "2020-09-01 16:16:16",
                'created_by' => 1
            ],
            [
                'name' => "Mi candidato 2",
                'source' => "Habitaclia",
                'owner' => 2,
                'created_at' => "2020-09-01 16:16:16",
                'created_by' => 1
            ]
        ];

        foreach($leadList as $lead) {

            \App\Models\Lead::factory()->create($lead);
        }
    }
}
