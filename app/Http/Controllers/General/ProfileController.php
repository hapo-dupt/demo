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
        $data = request()->only(['full_name', 'email', 'gender', 'phone', 'address']);
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        unset($data['repassword']);
        if ($request->has('image')) {
            $storageFile = Storage::put('public/images/', $request->image);
            $data['image'] = basename($storageFile);
            Storage::delete('public/images/' . auth()->user()->image);
        }
        Member::findOrFail($request->id)->update($data);
        return redirect()->route('profiles.index')->with('success', trans('message.profile_success'));
    }
}
