<?php

namespace App\Models;

use App\Models\member;
use App\Models\Request;
use App\Models\Excercise;
use App\Models\sendRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class coach extends Model
{
    use HasFactory;
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function members():BelongsToMany
    {
        return $this->belongsToMany(Member::class,'coach_member')
                    ->using(coach_member::class)
                    ->withPivot('status')
                    ->withTimestamps();
    }
    protected $fillable = [

        'name',
        'email',
        'password',
        'WorkHours',
        'gender',
        'phone_number',
        'Age',
        'user_id',

    ];

}
