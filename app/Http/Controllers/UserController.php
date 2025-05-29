<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public  function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }
    public function show(User $user): Factory|Application|View
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user): Factory|Application|View
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user):RedirectResponse
    {
        $this->authorize('update', $user);
        $data = $request->all();
        if ($request->avatar)
        {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 416);
            if ($result === false) {
                return redirect()->back()->withErrors('Image upload failed. Please try again.');
            }
            $data['avatar'] = $result['path'];
        }
        $user->update($data);

   return redirect()->route('users.show', $user->id)
       ->with('success', 'Profile updated successfully.');
    }
}
