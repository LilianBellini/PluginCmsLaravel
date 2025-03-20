<?php
namespace LilianBellini\PluginCmsLaravel\Controllers\Admin;

use LilianBellini\PluginCmsLaravel\Models\Newsletter;
use Illuminate\Http\Request;
use LilianBellini\PluginCmsLaravel\Controllers\Controller;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::latest()->paginate(15);
        return view('plugincmslaravel::admin.newsletters.index', compact('newsletters'));
    }

    public function create()
    {
        return view('plugincmslaravel::admin.newsletters.edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        Newsletter::create($request->all());

        return redirect()->route('admin.newsletters.index')->with('success', 'Mail crée');
    }

    public function edit($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        return view('plugincmslaravel::admin.newsletters.edit', compact('newsletter'));
    }

    public function update(Request $request, $id)
    {
        $newsletter = Newsletter::findOrFail($id);

        $request->validate([
            'email' => 'required|email|unique:newsletters,email,' . $id,
        ]);

        $newsletter->update($request->all());

        return redirect()->route('admin.newsletters.index')->with('success', 'Adresse mail modifiée');
    }

    public function destroy($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->delete();

        return redirect()->route('admin.newsletters.index')->with('success', 'Adresse mail supprimée');
    }
}
