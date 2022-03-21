<?php

namespace App\Models;

use App\Models\Rol;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //return profile user image
    public function adminlte_image(){
       
       
        if(Auth::user()->profile_img != null || Auth::user()->profile_img != ''){
            return url('/').Auth::user()->profile_img;
        }else{
            if(Auth::user()->genero == 'MASCULINO'){
                return url('/').'/img/profile_image/men.png';
            }else{
                return url('/').'/img/profile_image/women_one.png';
                
            }
        }
        
        //return 'https://picsum.photos/300/300';
    }

    //return role user
    public function adminlte_desc(){
       return Rol::select('name')->where(['id' => Auth::user()->id_role])->first()->name;
    }
    //return profile user view
    public function adminlte_profile_url(){
        return '/user/profile';
    }


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
