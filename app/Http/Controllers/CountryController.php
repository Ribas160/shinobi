<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryPostRequest;
use App\Models\Country;
use App\Rules\UniqueCountry;
use App\Rules\UniqueISO;

class CountryController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        $country = new Country();
        $userId = auth()->id();
        
        $countries = $country->getAllCountries($userId);

        return view('dashboard.index', [
            'countries' => $countries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CountryPostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CountryPostRequest $request): \Illuminate\Http\RedirectResponse
    {
        $country = new Country();
        $userId = auth()->id();

        $validated = $request->validated();
        $request->validate([
            'name' => [new UniqueCountry],
            'iso' => [new UniqueISO],
        ]);

        $country->createCountry($userId, $validated);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param int $countryId
     * @return \Illuminate\View\View
     */
    public function show(int $countryId)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $countryId
     * @return \Illuminate\View\View
     */
    public function edit(int $countryId): \Illuminate\View\View
    {
        $country = new Country();
        $userId = auth()->id();

        $c = $country->getCountryById($userId, $countryId);

        return view('dashboard.edit', [
            'country' => $c,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\CountryPostRequest  $request
     * @param int $countryId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CountryPostRequest $request, int $countryId): \Illuminate\Http\RedirectResponse
    {
        $country = new Country();
        $userId = auth()->id();

        $validated = $request->validated();

        $country->updateCountry($userId, $countryId, $validated);

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $countryId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $countryId): \Illuminate\Http\RedirectResponse
    {
        $country = new Country();
        $userId = auth()->id();

        $country->deleteCountry($userId, $countryId);

        return redirect('/');
    }
}
