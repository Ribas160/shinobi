<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::take(1)->first();
        
        $data = [
            [
                'name' => 'Israel',
                'iso' => 'IL',
            ],
            [
                'name' => 'Cyprus',
                'iso' => 'CY',
            ],
            [
                'name' => 'Greece',
                'iso' => 'GR',
            ],
        ];

        $country = new Country();

        foreach ($data as $c) {
            $country->createCountry($user->id, $c);
        }
    }
}
