<?php

namespace Lilian\PluginCmsLaravel\Controllers\Admin;

use Lilian\PluginCmsLaravel\Controllers\Controller;
use Lilian\PluginCmsLaravel\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('role')->orderBy('id', 'desc')->paginate(15);

        return view('plugincmslaravel::admin.user.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('plugincmslaravel::admin.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate(['role_id' => 'required|exists:roles,id']);
        $user->role_id = $validated['role_id'];
        $user->update();

        return to_route('admin.user.index')->with('success', 'Rôle mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        if ($user->avatar != null) {
            Storage::delete($user->avatar);
        }
        $user->delete();

        return back()->with('success', "Utilisateur a été supprimé");
    }


    public function search(Request $request)
    {
        $searched_text = $request->input('query');

        $users = User::query()
            ->with('role') // Charger la relation des rôles
            ->where(function ($query) use ($searched_text) {
                $query->where('name', 'LIKE', "%{$searched_text}%")
                    ->orWhere('email', 'LIKE', "%{$searched_text}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(15);

        if ($request->ajax()) {
            $html = '';

            foreach ($users as $user) {
                $html .= view('plugincmslaravel::admin.user.lign', compact('user'))->render();
            }

            return response()->json(['html' => $html]);
        }

        return view('plugincmslaravel::admin.user.index', compact('users'));
    }
}
