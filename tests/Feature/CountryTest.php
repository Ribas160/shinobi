<?php

namespace Tests\Feature;

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

        return ['user' => $user, 'countryId' => $countryId];
    }

    
    public function testIndex()
    {
        $created = self::createUserAndCountry();

        $response = $this->actingAs($created['user'])->get('/');
        $response->assertSuccessful();
    }


    public function testStore()
    {
        $faker = \Faker\Factory::create();
        $user = User::factory()->create();

        $data = [
            'name' => $faker->country(),
            'iso' => $faker->countryCode(),
        ];

        $response = $this->actingAs($user)->post('/country', $data);
        $response->assertStatus(302);

        $country = new Country();
        $countries = $country->getAllCountries($user->id);

        $this->assertEquals($data, ['name' => $countries[0]->name, 'iso' => $countries[0]->iso]);
    }


    public function testUpdate()
    {
        $created = self::createUserAndCountry();
        
        $faker = \Faker\Factory::create();
        $data = [
            'name' => $faker->country(),
            'iso' => $faker->countryCode(),
        ];

        $response = $this->actingAs($created['user'])->patch('/country/' . $created['countryId'], $data);
        $response->assertStatus(302);

        $country = new Country();
        $c = $country->getCountryById($created['user']->id, $created['countryId']);

        $this->assertEquals($data, ['name' => $c->name, 'iso' => $c->iso]);
    }


    public function testDestroy()
    {
        $created = self::createUserAndCountry();

        $response = $this->actingAs($created['user'])->delete('/country/' . $created['countryId']);
        $response->assertStatus(302);

        $country = new Country();
        $c = $country->getCountryById($created['user']->id, $created['countryId']);

        $this->assertNull($c);
    }
}
