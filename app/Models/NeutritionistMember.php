<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NeutritionistMember extends Pivot
{
    use HasFactory;
    protected $guarded = [];
    protected $table = '_neutritionist_member';
    protected $fillable = [
        'member_id',
        'neutritionist_id',
        'status'
    ];
}
