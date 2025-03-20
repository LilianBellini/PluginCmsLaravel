<?php
namespace LilianBellini\PluginCmsLaravel\Controllers\Post;

use LilianBellini\PluginCmsLaravel\Controllers\Controller;
use LilianBellini\PluginCmsLaravel\Requests\Post\PageRequest;
use Illuminate\Http\Request;
use LilianBellini\PluginCmsLaravel\Models\Post\Page;

class PageController extends Controller
{

    public function index()
    {
        $pages = Page::with('user:id,name')->orderBy('id', 'desc')->paginate(15);

        return view('plugincmslaravel::post.page.index', compact('pages'));
    }

    public function create()
    {

        return view('plugincmslaravel::post.page.create');
    }

    public function store(PageRequest $request)
    {
        Page::create($request->validated());

        return to_route('post.page.index')->with('message', trans('post.page_created'));
    }

    public function update(PageRequest $request, Page $page)
    {
        $page->update($request->validated());

        return to_route('post.page.index')->with('message', trans('post.page_updated'));
    }

    public function edit(Page $page)
    {

        return view('plugincmslaravel::post.page.edit', compact('page'));
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return back()->with('message', trans('post.page_deleted'));
    }

    public function getSlug(Request $request)
    {
        $slug = $this->createSlug($request, Page::class);

        return response()->json(['slug' => $slug]);
    }
}
