<?php
namespace LilianBellini\PluginCmsLaravel\Controllers\Admin\Google;


use LilianBellini\PluginCmsLaravel\Controllers\Controller;
use Illuminate\Http\Request;
use LilianBellini\PluginCmsLaravel\Models\Admin\Google\GoogleApiCredential;
use LilianBellini\PluginCmsLaravel\Services\SearchConsoleService;

class GoogleCredentialController extends Controller
{
    protected $searchConsole;

    public function __construct(SearchConsoleService $searchConsole)
    {
        $this->searchConsole = $searchConsole;
    }

    public function edit()
    {
        $credentials = GoogleApiCredential::first();
    
        return view('plugincmslaravel::admin.google.edit', compact('credentials'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'client_id' => 'required|string',
            'client_secret' => 'required|string',
            'site_url' => 'required',
        ]);


        GoogleApiCredential::updateOrCreate([], $request->only(['client_id', 'client_secret', 'redirect_uri', 'site_url']));

        return redirect()->away($this->searchConsole->getAuthUrl());
    }


    public function handleGoogleCallback(Request $request)
    {

        $this->searchConsole->handleCallback($request->code);

        return redirect()->back()->with('success', 'Connexion réussie à Google Search Console');
    }
}
