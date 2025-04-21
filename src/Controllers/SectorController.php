<?php

namespace LilianBellini\PluginCmsLaravel\Controllers;
use LilianBellini\PluginCmsLaravel\Controllers\Controller;
use LilianBellini\PluginCmsLaravel\Models\Sector;
use LilianBellini\PluginCmsLaravel\Requests\StoreSectorRequest;

class SectorController extends Controller
{
    public function index()
    {
        $sectors = Sector::with('translations')->paginate(15);
        return view('plugincmslaravel::sector.index', compact('sectors'));
    }
    public function create()
    {
        return view('plugincmslaravel::sector.form');
    }
    public function store(StoreSectorRequest $r)
    {
        $sector = Sector::create();
        foreach ($r->input('translations') as $locale => $data) {
            $sector->translations()->create(['locale' => $locale] + $data);
        }
        return redirect()->route('admin.page.sector.index')->withSuccess('Secteur créée.');
    }
    public function edit(Sector $sector)
    {
        return view('plugincmslaravel::sector.form', compact('sector'));
    }
    public function update(StoreSectorRequest $r, Sector $Sector)
    {
        $Sector->translations()->delete();
        foreach ($r->input('translations') as $locale => $data) {
            $Sector->translations()->create(['locale' => $locale] + $data);
        }
        return back()->withSuccess('Mise à jour enregistrée.');
    }
    public function destroy(Sector $Sector)
    {
        $Sector->delete();
        return back()->withSuccess('Supprimé');
    }
}
