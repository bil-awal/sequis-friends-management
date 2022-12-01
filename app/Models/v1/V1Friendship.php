<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class V1Friendship extends Model
{
    use HasFactory;
    protected $table = 'v1_friendships';
    protected $fillable = [
        'requestor',
        'to',
        'status'
    ];
}
