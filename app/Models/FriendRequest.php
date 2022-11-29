<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    use HasFactory;
    protected $fillable = ['user1_id', 'user2_id'];
    public function friendRequest()
    {
        return $this->belongsTo(User::class);
    }
}