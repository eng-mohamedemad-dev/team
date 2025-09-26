<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ranking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index()
    {
        return view('admin.ranking.index', [
            'rows' => Ranking::orderByDesc('points')->orderByDesc('goal_diff')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.ranking.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'team' => ['required', 'string', 'max:255'],
            'played' => ['required', 'integer', 'min:0'],
            'won' => ['required', 'integer', 'min:0'],
            'draw' => ['required', 'integer', 'min:0'],
            'lost' => ['required', 'integer', 'min:0'],
            'goals_for' => ['required', 'integer', 'min:0'],
            'goals_against' => ['required', 'integer', 'min:0'],
            'goal_diff' => ['required', 'integer'],
            'points' => ['required', 'integer', 'min:0'],
        ]);

        Ranking::create($data);

        return back()->with('sweetalert', [
            'type' => 'success',
            'title' => 'تمت الإضافة بنجاح',
            'message' => 'تم إضافة الفريق بنجاح إلى جدول الترتيب'
        ]);
    }

    public function update(Request $request, Ranking $ranking): RedirectResponse
    {
        $data = $request->validate([
            'team' => ['required', 'string', 'max:255'],
            'played' => ['required', 'integer', 'min:0'],
            'won' => ['required', 'integer', 'min:0'],
            'draw' => ['required', 'integer', 'min:0'],
            'lost' => ['required', 'integer', 'min:0'],
            'goals_for' => ['required', 'integer', 'min:0'],
            'goals_against' => ['required', 'integer', 'min:0'],
            'goal_diff' => ['required', 'integer'],
            'points' => ['required', 'integer', 'min:0'],
        ]);

        $ranking->update($data);
        return back()->with('sweetalert', [
            'type' => 'success',
            'title' => 'تم التحديث بنجاح',
            'message' => 'تم تحديث بيانات الفريق بنجاح'
        ]);
    }

    public function edit(Ranking $ranking)
    {
        return view('admin.ranking.edit', [ 'ranking' => $ranking ]);
    }

    public function destroy(Ranking $ranking): RedirectResponse
    {
        $ranking->delete();
        return back()->with('sweetalert', [
            'type' => 'success',
            'title' => 'تم الحذف',
            'message' => 'تم حذف الفريق بنجاح من جدول الترتيب'
        ]);
    }
}


