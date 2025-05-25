<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    public function show(User $user): Factory|Application|View
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user): Factory|Application|View
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user):RedirectResponse
    {
//        $this->validate($request, [
//            'name' => 'required|max:50',
//            'introduction' => 'nullable|max:200',
//            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//        ]);
//
//        $user->update($request->only('name', 'introduction'));
//
//        if ($request->hasFile('avatar')) {
//            $user->updateAvatar($request->file('avatar'));
//        }
//
//        return redirect()->route('users.show', ['user' => $user])->with('success', 'Your password has been updated!');
   $user->update($request->all());
   return redirect()->route('users.show', $user->id)->with('success', 'Profile updated successfully.');

    }



}
