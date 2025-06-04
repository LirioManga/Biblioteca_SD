<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id', 'gender', 'birthdate', 'phone', 'address'];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
