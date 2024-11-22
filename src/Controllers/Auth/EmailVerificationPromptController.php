<?php

namespace Systemin\PluginCmsLaravel\Controllers\Auth;

use Systemin\PluginCmsLaravel\Controllers\Controller;
use Systemin\PluginCmsLaravel\Providers\RouteServiceProvider;
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
