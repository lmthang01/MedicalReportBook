<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
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
        'status',
        'phone',
        'address',
        'avatar',
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
        'password' => 'hashed',
    ];

    // Hiển thị Active, Type
    const STATUS_DEFAULT = 1; // Chờ kích hoạt

    const STATUS_ACTIVE = 2;

    const STATUS_CANCEL = -1; 


    const ROLE_ADMIN = 'ADMIN';

    const ROLE_USER = 'USER';

    protected $setStatus = [
        self::STATUS_DEFAULT => [
            'name' => 'Tạm dừng, chờ kích hoạt',
            'class' => 'badge badge-info'
        ],
        self::STATUS_CANCEL => [
            'name' => 'Khóa / Block',
            'class' => 'badge badge-danger'
        ],
        self::STATUS_ACTIVE => [
            'name' => 'Hoạt động',
            'class' => 'badge badge-primary'
        ],
    ];

    // Hiển thị trạng thái ở view index
    public function getStatus(){
        return Arr::get($this->setStatus, $this->status, []);
    }

    // Hiển thị UserType ở view index
    public function userType(){
        return $this->belongsToMany(UserType::class, 'user_has_types', 'user_id', 'user_type_id');
    }
}
