<?php

namespace LilianBellini\PluginCmsLaravel\Controllers\Api\Post;

use LilianBellini\PluginCmsLaravel\Controllers\Controller;
use LilianBellini\PluginCmsLaravel\Resources\Post\CategoryResource;
use LilianBellini\PluginCmsLaravel\Models\Post\Category;
use LilianBellini\PluginCmsLaravel\Traits\ApiResponse;

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
