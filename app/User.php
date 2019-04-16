<?php

namespace App;

use App\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username', 'email', 'password','profile_image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function changeUsername($request)
    {
            //update the username
            $this->find(Auth::user()->id)
                 ->update(['username' => $request->new_username]);
    }

    public function changeProfile($request)
    {
        //check if there's a uploaded image
        if ($request->hasFile('profile_image')) {

            //add time for image name
            $image_name = time() .'_' . $request->file('profile_image')
                                                ->getClientOriginalName();
            //prepare a destination for images
            $path = storage_path('app/public/profile_images/');

            //move the images
            $request->file('profile_image')->move($path, $image_name);

            // update profile in database
            $this->find(Auth::user()->id)->update(['profile_image' => $image_name]);
        }
        
    }

    public function changePassword($request)
    {
         //update the username
            $this->find(Auth::user()->id)
                 ->update(['password' => $request->new_password]);
    }
}
