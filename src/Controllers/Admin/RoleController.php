<?php

namespace LilianBellini\PluginCmsLaravel\Controllers\Admin;

use LilianBellini\PluginCmsLaravel\Controllers\Controller;
use LilianBellini\PluginCmsLaravel\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('plugincmslaravel::admin.role.index', compact('roles'));
    }
}
