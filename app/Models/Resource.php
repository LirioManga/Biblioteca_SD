<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'description',
        'type',
        'owner_id',
        'file_path',
       
    ];
    protected $casts = [
        'available' => 'boolean',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
