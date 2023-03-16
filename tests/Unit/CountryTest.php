<?php

namespace Tests\Unit;

use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CountryTest extends TestCase
{
    // use RefreshDatabase;

    public function testCreateCountry()
    {
        $faker = \Faker\Factory::create();

        $user = User::factory()->create();
        
        $data = [
            'name' => $faker->country(),
            'iso' => $faker->countryCode(),
        ];

        $country = new Country();
        $id = $country->createCountry($user->id, $data);

        $this->assertTrue($id > 0);
    }


    public function testUpdateCountry()
    {
        $faker = \Faker\Factory::create();

        $model = new User();
        $user = $model::take(1)->first();

        $data = [
            'name' => $faker->country(),
            'iso' => $faker->countryCode(),
        ];

        $country = new Country();
        $c = $country::take(1)->first();

        $success = $country->updateCountry($user->id, $c->id, $data);

        $this->assertEquals(1, $success);
    }


    public function testGetAllCounties()
    {
        $model = new User();
        $user = $model::take(1)->first();

        $country = new Country();
        $countries = $country->getAllCountries($user->id);

        $this->assertTrue(count($countries) > 0);
    }


    public function testGetCountryById()
    {
        $model = new User();
        $user = $model::take(1)->first();

        $country = new Country();
        $countries = $country->getAllCountries($user->id);
        
        $c = $countries[0];

        $selectedCountry = $country->getCountryById($user->id, $c->id);

        $this->assertEquals($c->id, $selectedCountry->id);
    }


    public function testDeleteCountry()
    {
        $model = new User();
        $user = $model::take(1)->first();

        $country = new Country();
        $countries = $country->getAllCountries($user->id);
        
        $c = $countries[0];

        $deleted = $country->deleteCountry($user->id, $c->id);

        $this->assertEquals(1, $deleted);
    }
}
