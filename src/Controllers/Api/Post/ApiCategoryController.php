<?php

namespace Systemin\PluginCmsLaravel\Controllers\Api\Post;

use Systemin\PluginCmsLaravel\Controllers\Controller;
use Systemin\PluginCmsLaravel\Resources\Post\CategoryResource;
use Systemin\PluginCmsLaravel\Models\Post\Category;
use Systemin\PluginCmsLaravel\Traits\ApiResponse;

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
