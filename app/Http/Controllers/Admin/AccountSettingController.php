<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsInfoRequest;
use App\Models\UserInfo;
use App\Rules\MatchOldPassword;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $info = auth()->user()->info;

        // get the default inner page
        return view('admin.account.setting', compact('info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SettingsInfoRequest $request)
    {
        if (session()->has('signin_method')) {
            session()->forget('signin_method');
        }
        // save user name
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        auth()->user()->update($validated);

        // save on user info
        $info = UserInfo::where('user_id', auth()->user()->id)->first();

        if ($info === null) {
            // create new model
            $info = new UserInfo();
        }

        // attach this info to the customer
        $info->user()->associate(auth()->user());

        foreach ($request->only(array_keys($request->rules())) as $key => $value) {
            if (is_array($value)) {
                $value = serialize($value);
            }
            $info->$key = $value;
        }

        // include to save avatar
        if ($avatar = ImageService::upload()) {
            $info->avatar = $avatar;
        }

        if ($request->boolean('avatar_remove')) {
            ImageService::delete($info->avatar);
            $info->avatar = null;
        }
        $info->save();

        return redirect()->intended('admin/account/settings')->with('success', __('Successfully updated!'));
    }

    /**
     * Function to accept request for change email
     *
     * @param \Illuminate\Http\Request $request
     */
    public function changeEmail(Request $request)
    {
        session(['signin_method'=>'yes']);
        $request->validate([
            'email' => 'required|string|email|max:100|unique:users',
            'current_password' => ['required', new MatchOldPassword],
        ]);

        auth()->user()->update(['email' => $request->input('email')]);

        if ($request->expectsJson()) {
            return response()->json($request->all());
        }

        session()->forget('signin_method');
        return redirect()->intended('admin/account/settings')->with('success', __('Successfully updated!'));
    }

    /**
     * Function to accept request for change password
     *
     * @param \Illuminate\Http\Request $request
     */
    public function changePassword(Request $request)
    {
        session(['signin_method'=>'yes']);
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'password' => ['required', 'confirmed'],
        ]);

        auth()->user()->update(['password' => $request->input('password')]);

        if ($request->expectsJson()) {
            return response()->json($request->all());
        }
        session()->forget('signin_method');
        return redirect()->intended('admin/account/settings')->with('success', __('Successfully updated!'));
    }
}
