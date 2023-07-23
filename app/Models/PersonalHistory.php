<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalHistory extends Model
{
    use HasFactory;
    protected $table = 'personal_history_type';
    protected $guarded = [''];

    public function staff()
    {
        return $this->belongsTo(Department::class, 'staff_id');
    }
}
