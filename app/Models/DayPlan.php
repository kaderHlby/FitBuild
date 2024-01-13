<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayPlan extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'planned_exercise_id'];
    public function PlanedExcercise()
{
    return $this->belongsToMany(PlanedExcercise::class, 'monthly_plan');
}

}
