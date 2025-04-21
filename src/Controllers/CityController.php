<?php

namespace LilianBellini\PluginCmsLaravel\Controllers;
use LilianBellini\PluginCmsLaravel\Controllers\Controller;
use LilianBellini\PluginCmsLaravel\Models\City;
use LilianBellini\PluginCmsLaravel\Requests\StoreCityRequest;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with('translations')->paginate(15);
        return view('plugincmslaravel::city.index', compact('cities'));
    }
    public function create()
    {
        return view('plugincmslaravel::city.form');
    }
    public function store(StoreCityRequest $r)
    {
        $city = City::create();
        foreach ($r->input('translations') as $locale => $data) {
            $city->translations()->create(['locale' => $locale] + $data);
        }
        return redirect()->route('admin.page.city.index')->withSuccess('Ville créée.');
    }
    public function edit(City $city)
    {
        return view('plugincmslaravel::city.form', compact('city'));
    }
    public function update(StoreCityRequest $r, City $city)
    {
        $city->translations()->delete();
        foreach ($r->input('translations') as $locale => $data) {
            $city->translations()->create(['locale' => $locale] + $data);
        }
        return back()->withSuccess('Mise à jour enregistrée.');
    }
    public function destroy(City $city)
    {
        $city->delete();
        return back()->withSuccess('Supprimé');
    }
}
