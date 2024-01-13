<?php

namespace App\Models;

use App\Models\member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Excercise extends Model
{
    use HasFactory;

    public function PlanedExcercise():HasOne
    {
        return $this->hasOne(PlanedExcercise::class);
    }
    protected $fillable = [
        'name',
        'type',
        'description',
        'video',
        'EquipmentNeeded',


    ];
}
