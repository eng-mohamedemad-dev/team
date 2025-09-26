<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('admin.news.index', [
            'items' => NewsItem::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function show(NewsItem $news)
    {
        return view('admin.news.show', compact('news'));
    }

    public function edit(NewsItem $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string', 'max:500'],
            'content' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'publish_type' => ['required', 'in:immediate,scheduled'],
            'scheduled_at' => ['nullable', 'date', 'after:now']
        ]);

        $data = [
            'title' => $validated['title'],
            'text' => $validated['text'],
            'content' => $validated['content'],
            'is_active' => $validated['publish_type'] === 'immediate',
            'is_scheduled' => $validated['publish_type'] === 'scheduled',
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        if ($data['is_scheduled']) {
            $data['scheduled_at'] = $validated['scheduled_at'];
        } else {
            $data['scheduled_at'] = null;
        }

        NewsItem::create($data);

        return redirect()->route('admin.news.index')->with('sweetalert', [
            'type' => 'success',
            'title' => 'تمت الإضافة بنجاح',
            'message' => 'تم إضافة الخبر بنجاح إلى قاعدة البيانات'
        ]);
    }

    public function update(Request $request, NewsItem $news): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string', 'max:500'],
            'content' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'publish_type' => ['required', 'in:immediate,scheduled'],
            'scheduled_at' => ['nullable', 'date', 'after:now']
        ]);

        $data = [
            'title' => $validated['title'],
            'text' => $validated['text'],
            'content' => $validated['content'],
            'is_active' => $validated['publish_type'] === 'immediate',
            'is_scheduled' => $validated['publish_type'] === 'scheduled',
        ];

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($news->image && \Storage::disk('public')->exists($news->image)) {
                \Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        if ($data['is_scheduled']) {
            $data['scheduled_at'] = $validated['scheduled_at'];
        } else {
            $data['scheduled_at'] = null;
        }

        $news->update($data);
        return redirect()->route('admin.news.index')->with('sweetalert', [
            'type' => 'success',
            'title' => 'تم التحديث بنجاح',
            'message' => 'تم تحديث بيانات الخبر بنجاح'
        ]);
    }


    public function destroy(NewsItem $news): RedirectResponse
    {
        // حذف الصورة المرتبطة إذا كانت موجودة
        if ($news->image && \Storage::disk('public')->exists($news->image)) {
            \Storage::disk('public')->delete($news->image);
        }
        
        $news->delete();
        return back()->with('sweetalert', [
            'type' => 'success',
            'title' => 'تم الحذف',
            'message' => 'تم حذف الخبر بنجاح من قاعدة البيانات'
        ]);
    }
}


