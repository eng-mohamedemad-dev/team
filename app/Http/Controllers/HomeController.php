<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use App\Models\Image;

class HomeController extends Controller
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

        $news = NewsItem::query()->where('is_active', true)->latest()->take(10)->get(['id', 'title', 'text', 'content', 'image', 'created_at']);
        $images = Image::latest()->get(['id', 'title', 'type', 'image_path']);
        
        return view('home', [
            'news' => $news,
            'images' => $images,
        ]);
    }
}


