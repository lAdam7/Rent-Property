<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Property;
use App\Models\PropertyFrequency;
use App\Models\PropertyType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::truncate();
        PropertyFrequency::truncate();
        Property::truncate();

        PropertyFrequency::create([
            'name' => 'weekly'
        ]);
        PropertyFrequency::create([
            'name' => 'fortnightly'
        ]);
        PropertyFrequency::create([
            'name' => 'monthly'
        ]);
        PropertyType::create([
            'name' => 'detached'
        ]);
        PropertyType::create([
            'name' => 'semi-detached'
        ]);
        PropertyType::create([
            'name' => 'terraced'
        ]);
        PropertyType::create([
            'name' => 'flat'
        ]);

        User::create([
            'forename' => 'Adam',
            'surname' => 'Lyon',
            'email' => 'a.lyon2077@gmail.com',
            'email_verified_at' => now(),
            'password' => 'TestTest',
            'landlord' => true
        ]);

        User::factory(20)->create();
        Property::factory(50)->create();
    }
}
