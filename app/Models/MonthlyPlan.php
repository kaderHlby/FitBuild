<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MonthlyPlan extends Pivot
{
    use HasFactory;
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function DayPlan()
    {
        return $this->belongsToMany(DayPlan::class, 'monthly_plan');
    }

    public function PlanedExcercise()
    {
        return $this->belongsToMany(PlanedExcercise::class, 'monthly_plan');
    }
    protected $guarded = [];
    protected $table = 'monthly_plan';
    protected $fillable = [
        'member_id',
        'day_plan_id',
        'planed_excercise_id'
    ];
}
