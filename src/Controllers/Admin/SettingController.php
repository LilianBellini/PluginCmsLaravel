<?php

namespace Systemin\PluginCmsLaravel\Controllers\Admin;

use Systemin\PluginCmsLaravel\Controllers\Controller;
use Systemin\PluginCmsLaravel\Requests\Admin\UpdateSettingRequest;
use Systemin\PluginCmsLaravel\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        return view('plugincmslaravel::admin.setting.index', compact('setting'));
    }

    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        $setting->update($request->validated());

        return back()->with('message', trans('admin.data_updated'));
    }
}
