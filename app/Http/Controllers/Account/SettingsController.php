<?php

namespace App\Http\Controllers\Account;

use App\Helpers\ActionTypeManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNewAdminRequest;
use App\Http\Requests\Accounts\UpdateCredentials;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class SettingsController extends Controller
{
    use ActionTypeManager;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //display forms
        return view('accounts.settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNewAdminRequest $request)
    {
 
        //collect all attributes
        $attributes = $request->except('confirm_password');

        //concat image with time upload
        $attributes['profile_image'] = time() . '_' . 
                                    $request->file('profile_image')
                                    ->getClientOriginalName();

        //successfully create new admin
        if ($this->user->create($attributes)) {
            
            //add time for image name
            $image_name = $attributes['profile_image'];

            //prepare a destination for images
            $path = storage_path('app/public/profile_images/');

            //move the images
            $request->file('profile_image')->move($path, $image_name);

        }

        return redirect()->back()->with('status','Successfully create new adminstrator.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCredentials $request)
    {

        $action = $this->getActionType($request->all());

        $this->user->$action($request);

        return redirect()->back()->with('status','Successfully update your information.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
