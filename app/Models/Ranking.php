<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use HasFactory;

    protected $fillable = [
        'team', 'played', 'won', 'draw', 'lost', 'goals_for', 'goals_against', 'goal_diff', 'points'
    ];
}


