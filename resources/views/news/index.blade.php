@extends('layouts.app', ['title' => 'الأخبار'])

@section('content')
<style>
    .container { 
        max-width: 1400px; 
        margin: 0 auto; 
        padding: 2rem; 
    }
    
    .page-header { 
        text-align: center; 
        margin-bottom: 4rem; 
    }
    
    .page-title { 
        font-size: 3rem; 
        font-weight: 800; 
        color: #2b2b2b; 
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .page-subtitle { 
        font-size: 1.2rem; 
        color: #6c757d;
    }
    
    .news-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr)); 
        gap: 2rem; 
    }
    
    .news-card { 
        background: white; 
        border-radius: 20px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
        overflow: hidden; 
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
        position: relative;
    }
    
    .news-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #667eea, #764ba2);
    }
    
    .news-card:hover { 
        transform: translateY(-10px); 
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }
    
    .news-image { 
        width: 100%; 
        height: 250px; 
        object-fit: cover;
        transition: all 0.3s ease;
    }
    
    .news-card:hover .news-image {
        transform: scale(1.05);
    }
    
    .news-content { 
        padding: 2rem; 
    }
    
    .news-title { 
        font-size: 1.5rem; 
        font-weight: 800; 
        color: #2b2b2b; 
        margin-bottom: 1rem; 
        line-height: 1.3;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .news-text { 
        color: #666; 
        line-height: 1.6; 
        margin-bottom: 1.5rem;
        font-size: 1rem;
    }
    
    .news-meta { 
        display: flex; 
        align-items: center; 
        justify-content: space-between; 
        color: #999; 
        font-size: 0.9rem;
        padding-top: 1rem;
        border-top: 1px solid #f0f0f0;
    }
    
    .news-time { 
        display: flex; 
        align-items: center; 
        gap: 0.5rem;
        background: #f8f9fa;
        padding: 0.5rem 1rem;
        border-radius: 20px;
    }
    
    .news-time svg { 
        width: 16px; 
        height: 16px; 
    }
    
    .status-badge { 
        padding: 0.5rem 1rem; 
        border-radius: 25px; 
        font-size: 0.8rem; 
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .status-published { 
        background: linear-gradient(135deg, #4facfe, #00f2fe);
        color: white;
        box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);
    }
    
    .status-scheduled { 
        background: linear-gradient(135deg, #f093fb, #f5576c);
        color: white;
        box-shadow: 0 4px 15px rgba(240, 147, 251, 0.3);
    }
    
    .no-news { 
        text-align: center; 
        padding: 4rem 2rem; 
        color: #6c757d;
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .no-news-icon { 
        font-size: 4rem; 
        margin-bottom: 1rem;
        opacity: 0.5;
    }
    
    .no-news-title { 
        font-size: 1.5rem; 
        font-weight: 700; 
        margin-bottom: 0.5rem;
        color: #2b2b2b;
    }
    
    .no-news-text { 
        font-size: 1rem; 
    }
    
    .back-btn { 
        display: inline-flex; 
        align-items: center; 
        gap: 0.5rem; 
        padding: 0.75rem 1.5rem; 
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white; 
        text-decoration: none; 
        border-radius: 50px; 
        margin-bottom: 2rem; 
        transition: all 0.3s ease;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
    }
    
    .back-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    
    .back-btn:hover::before {
        left: 100%;
    }
    
    .back-btn:hover { 
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }
</style>

<div class="container">
    <a href="{{ url('/') }}" class="back-btn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M19 12H5m7-7l-7 7 7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        العودة للرئيسية
    </a>

    <div class="page-header">
        <h1 class="page-title">الأخبار</h1>
        <p class="page-subtitle">تابع آخر الأخبار والتحديثات</p>
    </div>

    @if($news->count() > 0)
        <div class="news-grid">
            @foreach($news as $item)
                <article class="news-card">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="صورة الخبر" class="news-image">
                    @endif
                    
                    <div class="news-content">
                        <h2 class="news-title">{{ $item->title }}</h2>
                        
                        <div class="news-text">
                            {{ Str::limit($item->text, 120) }}
                        </div>
                        
                        <a href="{{ route('news.show', $item) }}" class="btn btn-primary" style="margin-top: 12px; display: inline-flex; align-items: center; gap: 6px; text-decoration: none;"></a>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" fill="currentColor"/>
                            </svg>
                            اقرأ المزيد
                        </a>
                        
                        <div class="news-meta">
                            <div class="news-time">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm1-10.59l3.3 1.9-1 1.73L11 13V7h2v4.41z" fill="currentColor"/>
                                </svg>
                                {{ $item->created_at->format('Y-m-d H:i') }}
                            </div>
                            
                            <span class="status-badge {{ $item->is_active ? 'status-published' : ($item->is_scheduled ? 'status-scheduled' : 'status-draft') }}">
                                {{ $item->is_active ? 'منشور' : ($item->is_scheduled ? 'مجدول' : 'مسودة') }}
                            </span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <div class="no-news">
            <div class="no-news-icon">📰</div>
            <h2 class="no-news-title">لا توجد أخبار بعد</h2>
            <p class="no-news-text">سيتم إضافة الأخبار قريباً</p>
        </div>
    @endif
</div>
@endsection
