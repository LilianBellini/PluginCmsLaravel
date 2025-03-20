<?php

namespace LilianBellini\PluginCmsLaravel\Controllers\Auth;

use LilianBellini\PluginCmsLaravel\Controllers\Controller;
use LilianBellini\PluginCmsLaravel\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::HOME)
                    : view('plugincmslaravel::auth.verify-email');
    }
}
