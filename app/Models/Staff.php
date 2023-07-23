<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staffs';
    protected $guarded = [''];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

     // Location
     public function province()
     {
         return $this->belongsTo(Province::class, 'province_id_residence');
     }
     public function district()
     {
         return $this->belongsTo(District::class, 'district_id_residence');
     }
     public function ward()
     {
         return $this->belongsTo(Ward::class, 'ward_id_residence');
     }
}
