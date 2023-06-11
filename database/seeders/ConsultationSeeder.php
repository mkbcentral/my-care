<?php

namespace Database\Seeders;

use App\Models\Consultation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Seeder;

class ConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Consultation::create([
            'name'=>'CONSULTATION GENERALE',
            'price_private'=>10,
            'price_suscribe'=>10,
            'hospital_id'=>1
        ]);
    }
}
