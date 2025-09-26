<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        return view('admin.images.index', [
            'images' => Image::latest()->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:stadium,maqassa,club'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ]);

        $data = [
            'title' => $validated['title'],
            'type' => $validated['type'],
        ];

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('images', 'public');
        }

        Image::create($data);

        return redirect()->route('admin.images.index')->with('sweetalert', [
            'type' => 'success',
            'title' => 'تمت إضافة القناة بنجاح',
            'message' => 'تم إضافة القناة الجديدة بنجاح إلى النظام'
        ]);
    }

    public function update(Request $request, Image $image): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:stadium,maqassa,club'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ]);

        $data = [
            'title' => $validated['title'],
            'type' => $validated['type'],
        ];

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($image->image_path && \Storage::disk('public')->exists($image->image_path)) {
                \Storage::disk('public')->delete($image->image_path);
            }
            $data['image_path'] = $request->file('image')->store('images', 'public');
        }

        $image->update($data);
        return redirect()->route('admin.images.index')->with('sweetalert', [
            'type' => 'success',
            'title' => 'تم تحديث القناة بنجاح',
            'message' => 'تم تحديث بيانات القناة بنجاح'
        ]);
    }

    public function destroy(Image $image): RedirectResponse
    {
        // حذف الصورة المرتبطة إذا كانت موجودة
        if ($image->image_path && \Storage::disk('public')->exists($image->image_path)) {
            \Storage::disk('public')->delete($image->image_path);
        }
        
        $image->delete();
        return redirect()->route('admin.images.index')->with('sweetalert', [
            'type' => 'success',
            'title' => 'تم حذف القناة',
            'message' => 'تم حذف القناة بنجاح من النظام'
        ]);
    }
}