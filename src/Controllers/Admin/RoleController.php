<?php

namespace Lilian\PluginCmsLaravel\Controllers\Admin;

use Lilian\PluginCmsLaravel\Controllers\Controller;
use Lilian\PluginCmsLaravel\Models\Role;

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
