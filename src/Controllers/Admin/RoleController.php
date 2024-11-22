<?php

namespace Systemin\PluginCmsLaravel\Controllers\Admin;

use Systemin\PluginCmsLaravel\Controllers\Controller;
use Systemin\PluginCmsLaravel\Models\Role;

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
