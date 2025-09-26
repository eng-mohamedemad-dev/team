@extends('layouts.app', ['title' => $news->title])

@section('content')
<style>
    .container { max-width: 800px; margin: 0 auto; padding: 20px; }
    .back-btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background: #4CAF50; color: #fff; text-decoration: none; border-radius: 8px; margin-bottom: 24px; transition: all 0.2s; }
    .back-btn:hover { background: #43a047; transform: translateY(-1px); }
    .news-article { background: #fff; border-radius: 16px; box-shadow: 0 8px 24px rgba(0,0,0,.06); overflow: hidden; }
    .news-image { width: 100%; height: 400px; object-fit: cover; }
    .news-content { padding: 40px; }
    .news-title { font-size: 32px; font-weight: 700; color: #2b2b2b; margin-bottom: 20px; line-height: 1.3; }
    .news-meta { display: flex; align-items: center; gap: 24px; margin-bottom: 32px; padding-bottom: 20px; border-bottom: 1px solid #e9ecef; flex-wrap: wrap; }
    .meta-item { display: flex; align-items: center; gap: 8px; color: #6c757d; font-size: 16px; }
    .meta-item svg { width: 20px; height: 20px; }
    .news-text { font-size: 18px; line-height: 1.8; color: #2b2b2b; margin-bottom: 32px; }
    .news-actions { background: #f8f9fa; padding: 24px; border-radius: 12px; margin-top: 32px; }
    .actions-title { font-size: 18px; font-weight: 600; color: #2b2b2b; margin-bottom: 16px; }
    .btn { padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; transition: all 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
    .btn-primary { background: #4CAF50; color: #fff; }
    .btn-primary:hover { background: #43a047; transform: translateY(-1px); }
    .btn-secondary { background: #6c757d; color: #fff; }
    .btn-secondary:hover { background: #5a6268; }
    .btn-group { display: flex; gap: 12px; flex-wrap: wrap; }
</style>

<div class="container">
    <a href="{{ route('news.index') }}" class="back-btn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M19 12H5m7-7l-7 7 7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        العودة للأخبار
    </a>

    <article class="news-article">
        @if($news->image)
            <img src="{{ asset('storage/' . $news->image) }}" alt="صورة الخبر" class="news-image">
        @endif
        
        <div class="news-content">
            <h1 class="news-title">{{ $news->title }}</h1>
            
            <div class="news-meta">
                <div class="meta-item">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm1-10.59l3.3 1.9-1 1.73L11 13V7h2v4.41z" fill="currentColor"/>
                    </svg>
                    {{ $news->created_at->format('Y-m-d H:i') }}
                </div>
                
                <div class="meta-item">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" fill="currentColor"/>
                    </svg>
                    آخر تحديث: {{ $news->updated_at->format('Y-m-d H:i') }}
                </div>
            </div>
            
            <div class="news-summary" style="background: #f8f9fa; padding: 20px; border-radius: 12px; margin-bottom: 24px; border-left: 4px solid #4CAF50;">
                <h3 style="margin: 0 0 12px 0; color: #2b2b2b; font-size: 18px;">ملخص الخبر</h3>
                <p style="margin: 0; color: #6c757d; line-height: 1.6;">{{ $news->text }}</p>
            </div>
            
            @if($news->content)
                <div class="news-text">
                    <h3 style="margin: 0 0 16px 0; color: #2b2b2b; font-size: 20px;">محتوى الخبر الكامل</h3>
                    <div style="white-space: pre-line; line-height: 1.8;">{{ $news->content }}</div>
                </div>
            @endif
            
            <div class="news-actions">
                <h3 class="actions-title">مشاركة الخبر</h3>
                <div class="btn-group">
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($news->text) }}" target="_blank" class="btn btn-primary">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" fill="currentColor"/>
                        </svg>
                        تويتر
                    </a>
                    
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="btn btn-primary">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" fill="currentColor"/>
                        </svg>
                        فيسبوك
                    </a>
                    
                    <a href="https://wa.me/?text={{ urlencode($news->text) }}" target="_blank" class="btn btn-primary">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" fill="currentColor"/>
                        </svg>
                        واتساب
                    </a>
                    
                    <button onclick="copyToClipboard('{{ request()->url() }}')" class="btn btn-secondary">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z" fill="currentColor"/>
                        </svg>
                        نسخ الرابط
                    </button>
                </div>
            </div>
        </div>
    </article>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        Swal.fire({
            title: 'تم بنجاح',
            text: 'تم نسخ الرابط إلى الحافظة',
            icon: 'success',
            confirmButtonText: 'موافق',
            confirmButtonColor: '#4CAF50',
            timer: 2000,
            timerProgressBar: true
        });
    }, function(err) {
        console.error('Could not copy text: ', err);
        Swal.fire({
            title: 'خطأ',
            text: 'تعذر نسخ الرابط',
            icon: 'error',
            confirmButtonText: 'موافق',
            confirmButtonColor: '#dc3545'
        });
    });
}
</script>
@endsection
