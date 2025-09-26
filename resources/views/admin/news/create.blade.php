@extends('layouts.app', ['title' => 'إضافة خبر جديد'])

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
    .scheduling-section { background: #f8f9fa; padding: 16px; border-radius: 8px; margin-top: 16px; }
    .scheduling-section.hidden { display: none; }
</style>

<div class="page-container">
    <div class="card">
        <h1 style="margin-bottom: 24px; color: #2b2b2b;">إضافة خبر جديد</h1>
        
        <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data" id="newsForm">
            @csrf
            
            <div class="form-group">
                <label for="title" class="form-label">عنوان الخبر *</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="اكتب عنوان الخبر هنا..." value="{{ old('title') }}" required>
                @error('title')
                    <div style="color: #dc3545; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="text" class="form-label">ملخص الخبر *</label>
                <textarea name="text" id="text" class="form-control" placeholder="اكتب ملخص الخبر هنا..." required>{{ old('text') }}</textarea>
                @error('text')
                    <div style="color: #dc3545; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content" class="form-label">محتوى الخبر الكامل</label>
                <textarea name="content" id="content" class="form-control" placeholder="اكتب محتوى الخبر الكامل هنا..." rows="8">{{ old('content') }}</textarea>
                @error('content')
                    <div style="color: #dc3545; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image" class="form-label">صورة الخبر</label>
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
                        <input type="radio" name="publish_type" id="publish_immediate" value="immediate" {{ old('publish_type', 'immediate') == 'immediate' ? 'checked' : '' }}>
                        <label for="publish_immediate">نشر فوري</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="publish_type" id="publish_scheduled" value="scheduled" {{ old('publish_type') == 'scheduled' ? 'checked' : '' }}>
                        <label for="publish_scheduled">جدولة للنشر</label>
                    </div>
                </div>
            </div>

            <div class="scheduling-section" id="schedulingSection" style="display: none;">
                <div class="form-group">
                    <label for="scheduled_at" class="form-label">وقت النشر المجدول</label>
                    <input type="datetime-local" name="scheduled_at" id="scheduled_at" class="form-control" value="{{ old('scheduled_at') }}">
                    @error('scheduled_at')
                        <div style="color: #dc3545; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left: 8px;">
                        <path d="M19 11H13V5h-2v6H5v2h6v6h2v-6h6v-2z" fill="currentColor"/>
                    </svg>
                    إضافة الخبر
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

    // معاينة الصورة
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.innerHTML = `<img src="${e.target.result}" class="image-preview" alt="معاينة الصورة">`;
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
