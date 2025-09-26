@extends('layouts.app', ['title' => 'إدارة الأخبار'])

@section('content')
<style>
    .container { 
        max-width: 1400px; 
        margin: 0 auto; 
        padding: 2rem; 
    }
    
    .card { 
        background: white; 
        border-radius: 20px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
        padding: 2rem; 
        margin-bottom: 2rem;
        border: 1px solid #e9ecef;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #667eea, #764ba2);
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }
    
    .page-header { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f0f0f0;
    }
    
    .page-title { 
        font-size: 2.5rem; 
        font-weight: 800; 
        color: #2b2b2b; 
        margin: 0;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .btn { 
        padding: 0.75rem 1.5rem; 
        border: none; 
        border-radius: 50px; 
        cursor: pointer; 
        font-size: 1rem; 
        transition: all 0.3s ease; 
        text-decoration: none; 
        display: inline-flex; 
        align-items: center; 
        gap: 0.5rem;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
    }
    
    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    
    .btn:hover::before {
        left: 100%;
    }
    
    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }
    
    .btn-primary { 
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }
    
    .btn-secondary { 
        background: linear-gradient(135deg, #6c757d, #5a6268);
        color: white;
    }
    
    .btn-danger { 
        background: linear-gradient(135deg, #ff6b6b, #ee5a52);
        color: white;
    }
    
    .btn-sm { 
        padding: 0.5rem 1rem; 
        font-size: 0.85rem; 
    }
    
    table { 
        width: 100%; 
        border-collapse: collapse;
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    th, td { 
        padding: 1.5rem 1rem; 
        text-align: right; 
        border-bottom: 1px solid #e9ecef;
    }
    
    th { 
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
    
    tbody tr:hover { 
        background: rgba(102, 126, 234, 0.05);
        transform: scale(1.01);
        transition: all 0.3s ease;
    }
    
    .news-text { 
        max-width: 300px; 
        overflow: hidden; 
        text-overflow: ellipsis; 
        white-space: nowrap;
        font-weight: 500;
    }
    
    .news-image { 
        width: 60px; 
        height: 60px; 
        object-fit: cover; 
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .news-image:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }
    
    .status-badge { 
        display: inline-block; 
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
    
    .status-draft { 
        background: linear-gradient(135deg, #ff6b6b, #ee5a52);
        color: white;
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
    }
    
    .actions { 
        display: flex; 
        gap: 0.5rem; 
        flex-wrap: wrap;
    }
    
    .no-image { 
        color: #6c757d; 
        font-size: 0.85rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
        text-align: center;
    }
</style>

<div class="container">
    <div class="page-header">
        <h1 class="page-title">إدارة الأخبار</h1>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 11H13V5h-2v6H5v2h6v6h2v-6h6v-2z" fill="currentColor"/>
            </svg>
            إضافة خبر جديد
        </a>
    </div>

    <div class="card">
        <h2 style="margin-bottom: 20px;">قائمة الأخبار</h2>
        <table>
            <thead>
                <tr>
                    <th>العنوان</th>
                    <th>الملخص</th>
                    <th>الصورة</th>
                    <th>الحالة</th>
                    <th>تاريخ الإنشاء</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $news)
                    <tr>
                        <td>
                            <div class="news-text" title="{{ $news->title }}">
                                {{ $news->title }}
                            </div>
                        </td>
                        <td>
                            <div class="news-text" title="{{ $news->text }}">
                                {{ Str::limit($news->text, 50) }}
                            </div>
                        </td>
                        <td>
                            @if($news->image)
                                <img src="{{ asset('storage/' . $news->image) }}" alt="صورة الخبر" class="news-image">
                            @else
                                <span class="no-image">لا توجد صورة</span>
                            @endif
                        </td>
                        <td>
                            <span class="status-badge {{ $news->is_active ? 'status-published' : ($news->is_scheduled ? 'status-scheduled' : 'status-draft') }}">
                                {{ $news->is_active ? 'منشور' : ($news->is_scheduled ? 'مجدول' : 'مسودة') }}
                            </span>
                            @if($news->scheduled_at)
                                <div style="font-size: 11px; color: #6c757d; margin-top: 4px;">
                                    {{ $news->scheduled_at->format('Y-m-d H:i') }}
                                </div>
                            @endif
                        </td>
                        <td>{{ $news->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.news.show', $news) }}" class="btn btn-secondary btn-sm" title="عرض">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" fill="currentColor"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.news.edit', $news) }}" class="btn btn-primary btn-sm" title="تعديل">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" fill="currentColor"/>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.news.delete', $news) }}" style="display: inline;" 
                                      onsubmit="return confirm('هل أنت متأكد من حذف هذا الخبر؟ لا يمكن التراجع بعد الحذف.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="حذف">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 7h12M9 7v10m6-10v10M4 7h16l-1 14a2 2 0 01-2 2H7a2 2 0 01-2-2L4 7zm4-3h8l1 3H7l1-3z" stroke="currentColor" stroke-width="1.5"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px; color: #6c757d;">
                            لا توجد أخبار بعد. 
                            <a href="{{ route('admin.news.create') }}" style="color: #4CAF50; text-decoration: none;">أضف خبراً جديداً</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
<script>
    @if(session('sweetalert'))
        Swal.fire({
            title: '{{ session('sweetalert.title') }}',
            text: '{{ session('sweetalert.message') }}',
            icon: '{{ session('sweetalert.type') }}',
            confirmButtonText: 'موافق',
            confirmButtonColor: '#4CAF50'
        });
    @endif
    @if($errors->any())
        Swal.fire({
            title: 'خطأ في البيانات',
            text: 'تحقق من الحقول المدخلة',
            icon: 'error',
            confirmButtonText: 'موافق',
            confirmButtonColor: '#dc3545'
        });
    @endif
</script>
@endsection


