<?php

namespace App\Models;

use App\Models\Food;
use App\Models\User;
use App\Models\coach;
use App\Models\Excercise;
use App\Models\sendRequest;
use App\Models\Neutritionist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class member extends Model
{
    use HasFactory;

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function coaches():BelongsToMany
    {
        return $this->belongsToMany(Coach::class,'coach_member')
                    ->using(coach_member::class)
                    ->withPivot('status')
                    ->withTimestamps();
    }
    public function neutritionists():BelongsToMany
    {
        return $this->belongsToMany(Neutritionist::class,'_neutritionist_member')
                    ->using(NeutritionistMember::class)
                    ->withPivot('status')
                    ->withTimestamps();
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'ProfileImage',
        'phone_number',
        'Age',
        'illness',
        'Physical_case',
        'Hieght',
        'Wieght',
        'target_Wieght',
        'user_id',
    ];
}
