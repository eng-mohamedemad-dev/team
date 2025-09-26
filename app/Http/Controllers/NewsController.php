<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        // التحقق من الأخبار المجدولة التي حان وقتها
        $now = now();
        NewsItem::where('is_scheduled', true)
            ->where('is_active', false)
            ->where('scheduled_at', '<=', $now)
            ->update([
                'is_active' => true,
                'is_scheduled' => false,
                'scheduled_at' => null
            ]);

        // حذف الأخبار القديمة (أكثر من 7 أيام)
        NewsItem::where('created_at', '<', $now->subDays(7))->delete();

        $news = NewsItem::where('is_active', true)
            ->latest()
            ->paginate(12);
            
        return view('news.index', compact('news'));
    }

    public function show(NewsItem $news)
    {
        // التحقق من الأخبار المجدولة التي حان وقتها
        $now = now();
        NewsItem::where('is_scheduled', true)
            ->where('is_active', false)
            ->where('scheduled_at', '<=', $now)
            ->update([
                'is_active' => true,
                'is_scheduled' => false,
                'scheduled_at' => null
            ]);

        // حذف الأخبار القديمة (أكثر من 7 أيام)
        NewsItem::where('created_at', '<', $now->subDays(7))->delete();

        // التحقق من أن الخبر منشور
        if (!$news->is_active) {
            abort(404);
        }
        
        return view('news.show', compact('news'));
    }
}