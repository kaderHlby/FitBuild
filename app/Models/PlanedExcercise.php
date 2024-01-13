<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanedExcercise extends Model
{
    use HasFactory;
    public function Excercise(): BelongsTo
    {
        return $this->belongsTo(Excercise::class);
    }
    public function DayPlan()
    {
        return $this->belongsToMany(DayPlan::class, 'monthly_plan');
    }

    protected $fillable = ['Duration', 'repeat_count','cycle_repetitions','excercise_id'];
}
