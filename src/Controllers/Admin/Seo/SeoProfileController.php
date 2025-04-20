<?php // app/Http/Controllers/SeoProfileController.php

namespace LilianBellini\PluginCmsLaravel\Controllers\Admin\Seo;

use LilianBellini\PluginCmsLaravel\Models\Admin\Seo\SeoProfile;
use Illuminate\Http\Request;
use LilianBellini\PluginCmsLaravel\Controllers\Controller;

class SeoProfileController extends Controller
{
    public function edit()
    {
        $profile = SeoProfile::firstOrCreate([]);
        return view('plugincmslaravel::admin.seo.edit', compact('profile'));
    }
    public function update(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'positioning' => 'required|string',
            'values' => 'nullable|string',
            'target_clients' => 'nullable|string',
            'locations' => 'nullable|string',
            'tone' => 'required|string',
            'priority_themes' => 'nullable|string',
            'blacklist' => 'nullable|string',
            'image_style_prompt' => 'nullable|string',
            'auto_publish_enabled' => 'nullable|boolean',
            'auto_publish_generated_article' => 'nullable|boolean',
            'generation_frequency' => 'nullable|in:daily,weekly_1,weekly_2,weekly_3',
            'article_mix_ratio'    => 'nullable|integer|min:0|max:100',
        ]);

    
        $data['values'] = explode(',', $data['values']);
        $data['target_clients'] = explode(',', $data['target_clients']);
        $data['locations'] = explode(',', $data['locations']);
        $data['priority_themes'] = explode(',', $data['priority_themes']);
        $data['blacklist'] = explode(',', $data['blacklist']);
    
        $profile = SeoProfile::first();
        $profile->update($data);
    
        return redirect()->back()->with('success', 'Profil SEO mis à jour avec succès.');
    }
    
}
