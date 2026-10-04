<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PropertyTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'Apartment',
            'Villa',
            'House',
            'Office',
            'Commercial',
            'Land',
        ];

        foreach ($types as $type) {
            PropertyType::updateOrCreate(
                ['name' => $type],
                [
                    'slug' => Str::slug($type),
                    'description' => $type . ' property',
                    'is_active' => true,
                ]
            );
        }
    }
}