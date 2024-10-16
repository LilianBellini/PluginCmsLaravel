<?php

namespace Lilian\PluginCmsLaravel\Controllers;

use Lilian\PluginCmsLaravel\Controllers\Controller;
use Lilian\PluginCmsLaravel\Requests\ProfileUpdateRequest;
use Lilian\PluginCmsLaravel\Models\Post\Category;
use Lilian\PluginCmsLaravel\Models\Newsletter;
use Lilian\PluginCmsLaravel\Models\Post\Post;
use Lilian\PluginCmsLaravel\Models\Post\Tag;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('plugincmslaravel::profile.edit', [
            'user' => $request->user(),
        ]);
    }

/**
 * Update the user's profile information.
 */
public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();
    $data = $request->validated();
    
    if ($request->hasFile('avatar')) {
        if ($user->avatar != null) {
            Storage::delete($user->avatar);
        }
        $avatarPath = $request->file('avatar')->store('images/profiles');
        $data['avatar'] = $avatarPath;
    }

    // Update the user's profile information
    $user->fill($data);

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        if ($user->avatar != null) {
            Storage::delete($user->avatar);
        }
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function index()
    {
        $categories = Category::count();
        $posts = Post::count();
        $tags = Tag::count();
        $users = User::count();
        $newsletters = NewsLetter::count();

        return view('plugincmslaravel::dashboard', compact('categories', 'posts', 'tags', 'users', 'newsletters'));
    }
}
