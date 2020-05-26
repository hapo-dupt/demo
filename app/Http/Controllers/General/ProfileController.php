<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Member;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Return to profile page view
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('generals.profile');
    }

    /**
     * Update profile
     * @param ProfileRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(ProfileRequest $request)
    {
        $data = request()->except(['_token']);
        if ($request->password != null) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }
        unset($data['repassword']);
        if (array_key_exists('image', $data)) {
            $storageFile = Storage::put('public/images/', $data['image']);
            $data['image'] = basename($storageFile);
            Storage::delete('public/images/'.auth()->user()->image);
        }
        Member::findOrFail($request->id)->update($data);
        return redirect()->route('profiles.index')->with('success', trans('message.profile_success'));
    }
}
