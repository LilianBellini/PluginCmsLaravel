<?php

namespace Lilian\PluginCmsLaravel\Controllers\Api\Post;

use Lilian\PluginCmsLaravel\Controllers\Controller;
use Lilian\PluginCmsLaravel\Resources\Post\CategoryResource;
use Lilian\PluginCmsLaravel\Models\Post\Category;
use Lilian\PluginCmsLaravel\Traits\ApiResponse;

class ApiCategoryController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $categories = Category::paginate(15);

        return $this->retrieveResponse(data: CategoryResource::collection($categories));
    }

    public function show($id)
    {
        $category = Category::with('posts')->whereId($id)->firstOrFail();

        return $this->retrieveResponse(data: CategoryResource::make($category));
    }
}
