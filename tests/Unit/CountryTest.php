<?php

namespace Tests\Unit;

use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CountryTest extends TestCase
{
    use RefreshDatabase;


    private static function createUserAndCountry()
    {
        $faker = \Faker\Factory::create();
        $user = User::factory()->create();

        $data = [
            'name' => $faker->country(),
            'iso' => $faker->countryCode(),
        ];

        $country = new Country();
        $countryId = $country->createCountry($user->id, $data);

        return ['userId' => $user->id, 'countryId' => $countryId];
    }


    public function testCreateCountry()
    {
        $data = self::createUserAndCountry();

        $this->assertTrue($data['countryId'] > 0);
    }


    public function testUpdateCountry()
    {
        $created = self::createUserAndCountry();

        $faker = \Faker\Factory::create();
        $data = [
            'name' => $faker->country(),
            'iso' => $faker->countryCode(),
        ];

        $country = new Country();
        $success = $country->updateCountry($created['userId'], $created['countryId'], $data);

        $this->assertEquals(1, $success);
    }


    public function testGetAllCounties()
    {
        $created = self::createUserAndCountry();

        $country = new Country();
        $countries = $country->getAllCountries($created['userId']);

        $this->assertTrue(count($countries) > 0);
    }


    public function testGetCountryById()
    {
        $created = self::createUserAndCountry();

        $country = new Country();
        $selectedCountry = $country->getCountryById($created['userId'], $created['countryId']);

        $this->assertEquals($created['countryId'], $selectedCountry->id);
    }


    public function testDeleteCountry()
    {
        $created = self::createUserAndCountry();

        $country = new Country();
        $deleted = $country->deleteCountry($created['userId'], $created['countryId']);

        $this->assertEquals(1, $deleted);
    }
}
