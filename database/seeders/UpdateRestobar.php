<?php

namespace Database\Seeders;

use App\Enums\AccommodationType;
use App\Models\Accommodation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateRestobar extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accommodations = Accommodation::where('type', AccommodationType::Restobar)->get();

        foreach ($accommodations as $accommodation) {
            $accommodation->update(['max_daily_capacity' => 5]);
        }
    }
}
