@extends('layouts.app', ['title' => 'تعديل الخبر'])

@section('content')
<style>
    .page-container { max-width: 800px; margin: 0 auto; padding: 20px; }
    .card { background: #fff; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,.06); padding: 24px; margin-bottom: 20px; }
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; margin-bottom: 8px; font-weight: 600; color: #2b2b2b; }
    .form-control { width: 100%; padding: 12px; border: 1px solid #e6e6ef; border-radius: 8px; font-size: 16px; }
    .form-control:focus { outline: none; border-color: #4CAF50; box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1); }
    textarea.form-control { min-height: 120px; resize: vertical; }
    .form-check { display: flex; align-items: center; gap: 8px; margin-bottom: 16px; }
    .form-check input { margin: 0; }
    .btn { padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; transition: all 0.2s; }
    .btn-primary { background: #4CAF50; color: #fff; }
    .btn-primary:hover { background: #43a047; transform: translateY(-1px); }
    .btn-secondary { background: #6c757d; color: #fff; }
    .btn-secondary:hover { background: #5a6268; }
    .btn-group { display: flex; gap: 12px; }
    .image-preview { max-width: 200px; max-height: 150px; border-radius: 8px; margin-top: 10px; }
    .current-image { max-width: 200px; max-height: 150px; border-radius: 8px; margin-top: 10px; }
    .scheduling-section { background: #f8f9fa; padding: 16px; border-radius: 8px; margin-top: 16px; }
    .scheduling-section.hidden { display: none; }
    .status-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
    .status-published { background: #d4edda; color: #155724; }
    .status-scheduled { background: #fff3cd; color: #856404; }
    .status-draft { background: #f8d7da; color: #721c24; }
</style>

<div class="page-container">
    <div class="card">
        <h1 style="margin-bottom: 24px; color: #2b2b2b;">تعديل الخبر</h1>
        
        <div style="margin-bottom: 20px;">
            <span class="status-badge {{ $news->is_active ? 'status-published' : ($news->is_scheduled ? 'status-scheduled' : 'status-draft') }}">
                {{ $news->is_active ? 'منشور' : ($news->is_scheduled ? 'مجدول' : 'مسودة') }}
            </span>
            @if($news->scheduled_at)
                <span style="margin-right: 16px; color: #6c757d; font-size: 14px;">
                    مجدول للنشر: {{ $news->scheduled_at->format('Y-m-d H:i') }}
                </span>
            @endif
        </div>
        
        <form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data" id="newsForm">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="title" class="form-label">عنوان الخبر *</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="اكتب عنوان الخبر هنا..." value="{{ old('title', $news->title) }}" required>
                @error('title')
                    <div style="color: #dc3545; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="text" class="form-label">ملخص الخبر *</label>
                <textarea name="text" id="text" class="form-control" placeholder="اكتب ملخص الخبر هنا..." required>{{ old('text', $news->text) }}</textarea>
                @error('text')
                    <div style="color: #dc3545; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content" class="form-label">محتوى الخبر الكامل</label>
                <textarea name="content" id="content" class="form-control" placeholder="اكتب محتوى الخبر الكامل هنا..." rows="8">{{ old('content', $news->content) }}</textarea>
                @error('content')
                    <div style="color: #dc3545; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image" class="form-label">صورة الخبر</label>
                @if($news->image)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ asset('storage/' . $news->image) }}" alt="الصورة الحالية" class="current-image">
                        <div style="font-size: 14px; color: #6c757d; margin-top: 5px;">الصورة الحالية</div>
                    </div>
                @endif
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                <div id="imagePreview"></div>
                @error('image')
                    <div style="color: #dc3545; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">نوع النشر</label>
                <div class="radio-group">
                    <div class="form-check">
                        <input type="radio" name="publish_type" id="publish_immediate" value="immediate" {{ old('publish_type', $news->is_active ? 'immediate' : 'scheduled') == 'immediate' ? 'checked' : '' }}>
                        <label for="publish_immediate">نشر فوري</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="publish_type" id="publish_scheduled" value="scheduled" {{ old('publish_type', $news->is_scheduled ? 'scheduled' : 'immediate') == 'scheduled' ? 'checked' : '' }}>
                        <label for="publish_scheduled">جدولة للنشر</label>
                    </div>
                </div>
            </div>

            <div class="scheduling-section" id="schedulingSection" style="display: {{ $news->is_scheduled || old('publish_type') == 'scheduled' ? 'block' : 'none' }};">
                <div class="form-group">
                    <label for="scheduled_at" class="form-label">وقت النشر المجدول</label>
                    <input type="datetime-local" name="scheduled_at" id="scheduled_at" class="form-control" 
                           value="{{ old('scheduled_at', $news->scheduled_at ? $news->scheduled_at->format('Y-m-d\TH:i') : '') }}">
                    @error('scheduled_at')
                        <div style="color: #dc3545; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left: 8px;">
                        <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    حفظ التعديلات
                </button>
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left: 8px;">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" fill="currentColor"/>
                    </svg>
                    إلغاء
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const immediateRadio = document.getElementById('publish_immediate');
    const scheduledRadio = document.getElementById('publish_scheduled');
    const schedulingSection = document.getElementById('schedulingSection');
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');

    // تبديل قسم الجدولة
    function toggleSchedulingSection() {
        if (scheduledRadio.checked) {
            schedulingSection.style.display = 'block';
        } else {
            schedulingSection.style.display = 'none';
        }
    }

    immediateRadio.addEventListener('change', toggleSchedulingSection);
    scheduledRadio.addEventListener('change', toggleSchedulingSection);

    // معاينة الصورة الجديدة
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.innerHTML = `<img src="${e.target.result}" class="image-preview" alt="معاينة الصورة الجديدة">`;
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.innerHTML = '';
        }
    });

    // التحقق من صحة النموذج
    document.getElementById('newsForm').addEventListener('submit', function(e) {
        if (scheduledRadio.checked) {
            const scheduledAt = document.getElementById('scheduled_at').value;
            if (!scheduledAt) {
                e.preventDefault();
                alert('يرجى تحديد وقت النشر المجدول');
                return;
            }
            
            const scheduledDate = new Date(scheduledAt);
            const now = new Date();
            if (scheduledDate <= now) {
                e.preventDefault();
                alert('وقت النشر المجدول يجب أن يكون في المستقبل');
                return;
            }
        }
    });

    // Initialize
    toggleSchedulingSection();
});
</script>
@endsection
