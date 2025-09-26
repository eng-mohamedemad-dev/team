<?php

namespace App\Http\Controllers;

use App\Models\Ranking;

class RankingController extends Controller
{
    public function index()
    {
        return response()->json(
            Ranking::query()->orderByDesc('points')->orderByDesc('goal_diff')->get()
        );
    }
}


