<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Friend extends Model
{
    use HasFactory;
    protected $fillable = ['user1_id', 'user2_id'];
    //add friend

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}