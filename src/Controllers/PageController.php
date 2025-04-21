<?php
namespace LilianBellini\PluginCmsLaravel\Controllers;
use LilianBellini\PluginCmsLaravel\Controllers\Controller;
use LilianBellini\PluginCmsLaravel\Models\Page;
use LilianBellini\PluginCmsLaravel\Models\City;
use LilianBellini\PluginCmsLaravel\Models\Sector;
use LilianBellini\PluginCmsLaravel\Requests\StorePageRequest;

// PageController.php  (admin CRUD, différent du PageController public déjà montré)
class PageController extends Controller
{
    public function index()
    {
        $pages = Page::with('city.translations', 'sector.translations')->paginate(15);
        return view('plugincmslaravel::page.index', compact('pages'));
    }

    public function create()
    {
        return view('plugincmslaravel::page.form', [
            'cities' => City::with('translations')->get(),
            'sectors' => Sector::with('translations')->get(),
            'page' => null,
        ]);
    }

    public function store(StorePageRequest $r)
    {
        $page = Page::create($r->only(['city_id', 'sector_id', 'template']));

        foreach ($r->input('translations', []) as $locale => $fields) {
            if (!$locale || !isset($fields['data'])) {
                continue; // on ignore les champs mal formés
            }

            $data = json_decode($fields['data'], true);

            $page->translations()->create([
                'page_id' => $page->id,
                'locale' => $locale,
                'data' => $data,
            ]);
        }

        return redirect()->route('admin.page.index')->withSuccess('Page créée.');
    }





    public function edit(Page $page)
    {
        return view('plugincmslaravel::page.form', [
            'page' => $page,
            'cities' => City::with('translations')->get(),
            'sectors' => Sector::with('translations')->get(),
        ]);
    }

    public function update(StorePageRequest $r, Page $page)
    {
        // Mise à jour des données principales
        $page->update($r->only(['city_id', 'sector_id', 'template']));

        foreach ($r->input('translations', []) as $locale => $fields) {
            $data = json_decode($fields['data'] ?? '{}', true);

            $translation = $page->translations()->firstOrNew([
                'locale' => $locale,
            ]);

            $translation->data = $data;
            $translation->locale = $locale; // 👈 OBLIGATOIRE POUR LES NOUVEAUX
            $translation->save();
        }

        return redirect()->route('admin.page.index')->withSuccess('Page mise à jour.');
    }


    public function destroy(Page $page)
    {
        $page->delete();
        return back()->withSuccess('Supprimée');
    }
}
