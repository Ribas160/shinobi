<?php

namespace App\Models;

use \Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Country extends Model
{
    use HasFactory;
    
    protected $guarded = [];


    /**
     * Create new country
     * 
     * @param int $userId
     * @param array $data
     * @return int
     */
    public function createCountry(int $userId, array $data): int 
    {
        DB::beginTransaction();
            try {
                $country = Country::create($data);
    
                DB::table('users_countries')->insert([
                    'user_id' => $userId,
                    'country_id' => $country->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } catch (Exception $e) {
                DB::rollBack();

                Log::error($e->getMessage());

                return 0;
            }

        DB::commit();

        return $country->id;
    }


    /**
     * Get all countries
     * 
     * @param int $userId
     * @return array/null
     */
    public function getAllCountries(int $userId): ?array
    {
        return DB::table("countries")
                            ->join("users_countries", "countries.id", "users_countries.country_id")
                            ->select("countries.*")
                            ->where("users_countries.user_id", $userId)
                            ->get()->toArray();
    }


    /**
     * Get country by id
     * 
     * @param int $userId
     * @param int $countryId
     * @return object/null
     */
    public function getCountryById(int $userId, int $countryId): ?object 
    {
        return DB::table("countries")
                            ->join("users_countries", "countries.id", "users_countries.country_id")
                            ->select("countries.*")
                            ->where("countries.id", $countryId)
                            ->where("users_countries.user_id", $userId)
                            ->first();
    }


    /**
     * Update country
     * 
     * @param int $userId
     * @param int $countryId
     * @param array $data
     * @return int
     */
    public function updateCountry(int $userId, int $countryId, array $data): int 
    {
        return DB::table("countries")
                            ->join("users_countries", "countries.id", "users_countries.country_id")
                            ->where("countries.id", $countryId)
                            ->where("users_countries.user_id", $userId)
                            ->update($data);
    }


    /**
     * Delete country
     * 
     * @param int $userId
     * @param int $countryId
     * @return int
     */
    public function deleteCountry(int $userId, int $countryId): int 
    {
        return DB::table("countries")
                            ->join("users_countries", "countries.id", "users_countries.country_id")
                            ->where("countries.id", $countryId)
                            ->where("users_countries.user_id", $userId)
                            ->delete();
    }
}
