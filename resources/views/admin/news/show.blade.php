@extends('layouts.app', ['title' => 'عرض الخبر'])

@section('content')
<style>
    .container { max-width: 900px; margin: 0 auto; padding: 20px; }
    .card { background: #fff; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,.06); padding: 24px; margin-bottom: 20px; }
    .news-header { border-bottom: 1px solid #e9ecef; padding-bottom: 20px; margin-bottom: 24px; }
    .news-title { font-size: 28px; font-weight: 700; color: #2b2b2b; margin-bottom: 16px; line-height: 1.4; }
    .news-meta { display: flex; align-items: center; gap: 20px; margin-bottom: 16px; flex-wrap: wrap; }
    .meta-item { display: flex; align-items: center; gap: 8px; color: #6c757d; font-size: 14px; }
    .meta-item svg { width: 16px; height: 16px; }
    .status-badge { display: inline-block; padding: 6px 16px; border-radius: 20px; font-size: 14px; font-weight: 600; }
    .status-published { background: #d4edda; color: #155724; }
    .status-scheduled { background: #fff3cd; color: #856404; }
    .status-draft { background: #f8d7da; color: #721c24; }
    .news-content { font-size: 18px; line-height: 1.8; color: #2b2b2b; margin-bottom: 24px; }
    .news-image { max-width: 100%; height: auto; border-radius: 12px; margin: 24px 0; box-shadow: 0 8px 24px rgba(0,0,0,.1); }
    .btn { padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; transition: all 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
    .btn-primary { background: #4CAF50; color: #fff; }
    .btn-primary:hover { background: #43a047; transform: translateY(-1px); }
    .btn-secondary { background: #6c757d; color: #fff; }
    .btn-secondary:hover { background: #5a6268; }
    .btn-danger { background: #dc3545; color: #fff; }
    .btn-danger:hover { background: #c82333; }
    .btn-group { display: flex; gap: 12px; flex-wrap: wrap; }
    .actions-section { background: #f8f9fa; padding: 20px; border-radius: 8px; margin-top: 24px; }
    .actions-title { font-size: 18px; font-weight: 600; color: #2b2b2b; margin-bottom: 16px; }
</style>

<div class="container">
    <div class="card">
        <div class="news-header">
            <h1 class="news-title">{{ $news->text }}</h1>
            
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
                
                <span class="status-badge {{ $news->is_active ? 'status-published' : ($news->is_scheduled ? 'status-scheduled' : 'status-draft') }}">
                    {{ $news->is_active ? 'منشور' : ($news->is_scheduled ? 'مجدول' : 'مسودة') }}
                </span>
                
                @if($news->scheduled_at)
                    <div class="meta-item">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z" fill="currentColor"/>
                        </svg>
                        مجدول للنشر: {{ $news->scheduled_at->format('Y-m-d H:i') }}
                    </div>
                @endif
            </div>
        </div>

        @if($news->image)
            <img src="{{ asset('storage/' . $news->image) }}" alt="صورة الخبر" class="news-image">
        @endif

        <div class="news-content">
            {{ $news->text }}
        </div>

        <div class="actions-section">
            <h3 class="actions-title">الإجراءات</h3>
            <div class="btn-group">
                <a href="{{ route('admin.news.edit', $news) }}" class="btn btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" fill="currentColor"/>
                    </svg>
                    تعديل
                </a>
                
                @if(!$news->is_active)
                    <form method="POST" action="{{ route('admin.news.toggle', $news) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" fill="currentColor"/>
                            </svg>
                            نشر
                        </button>
                    </form>
                @else
                    <form method="POST" action="{{ route('admin.news.toggle', $news) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-secondary">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" fill="currentColor"/>
                            </svg>
                            إلغاء النشر
                        </button>
                    </form>
                @endif
                
                <form method="POST" action="{{ route('admin.news.delete', $news) }}" style="display: inline;" 
                      onsubmit="return confirm('هل أنت متأكد من حذف هذا الخبر؟ لا يمكن التراجع بعد الحذف.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 7h12M9 7v10m6-10v10M4 7h16l-1 14a2 2 0 01-2 2H7a2 2 0 01-2-2L4 7zm4-3h8l1 3H7l1-3z" stroke="currentColor" stroke-width="1.5"/>
                        </svg>
                        حذف
                    </button>
                </form>
                
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" fill="currentColor"/>
                    </svg>
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
