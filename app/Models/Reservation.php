<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
    protected $fillable = [
        'user_id',
        'resource_id',
        'requested_at',
        'returned_at',
        'status',
    ];

    protected $dates = ['requested_at', 'returned_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}
