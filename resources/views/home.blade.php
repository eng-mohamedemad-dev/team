@extends('layouts.app', ['title' => 'الرئيسية'])

@section('content')
        <style>
            /* Hero Section */
            .hero { 
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white; 
                padding: 80px 0; 
                text-align: center; 
                position: relative; 
                overflow: hidden;
                min-height: 70vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                border-radius: 20px;
                margin: 2rem 0;
                box-shadow: 0 20px 60px rgba(102, 126, 234, 0.3);
            }
            
            .hero::before { 
                content: ''; 
                position: absolute; 
                top: 0; 
                left: 0; 
                right: 0; 
                bottom: 0; 
                background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="bubbles" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="2" fill="white" opacity="0.1"/><circle cx="80" cy="40" r="3" fill="white" opacity="0.1"/><circle cx="40" cy="80" r="1.5" fill="white" opacity="0.1"/><circle cx="60" cy="60" r="2.5" fill="white" opacity="0.08"/><circle cx="30" cy="70" r="1" fill="white" opacity="0.12"/></pattern></defs><rect width="100" height="100" fill="url(%23bubbles)"/></svg>'); 
                pointer-events: none;
                animation: float 20s ease-in-out infinite;
            }
            
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-20px) rotate(180deg); }
            }
            
            .bubbles {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
                pointer-events: none;
            }
            
            .bubble {
                position: absolute;
                bottom: -100px;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                animation: rise 15s infinite linear;
            }
            
            @keyframes rise {
                0% {
                    bottom: -100px;
                    transform: translateX(0);
                }
                50% {
                    transform: translateX(100px);
                }
                100% {
                    bottom: 100vh;
                    transform: translateX(-200px);
                }
            }
            
            .hero h1 { 
                font-size: 4.5rem; 
                margin-bottom: 2rem; 
                font-weight: 800;
                text-shadow: 0 4px 8px rgba(0,0,0,0.3);
                animation: fadeInUp 1s ease-out;
                line-height: 1.2;
                display: block;
                width: 100%;
                text-align: center;
            }
            
            .hero p { 
                font-size: 1.6rem; 
                margin-bottom: 0; 
                opacity: 0.95;
                max-width: 700px;
                margin-left: auto;
                margin-right: auto;
                animation: fadeInUp 1s ease-out 0.2s both;
                line-height: 1.6;
                font-weight: 300;
                display: block;
                width: 100%;
                text-align: center;
            }
            
            .cta { 
                display: flex; 
                gap: 1.5rem; 
                justify-content: center; 
                flex-wrap: wrap;
                animation: fadeInUp 1s ease-out 0.4s both;
            }
            
            .btn { 
                background: linear-gradient(45deg, #4facfe, #00f2fe);
                color: white; 
                padding: 1rem 2rem; 
                border: none; 
                border-radius: 50px; 
                cursor: pointer; 
                transition: all 0.3s ease;
                font-weight: 600;
                font-size: 1.1rem;
                box-shadow: 0 8px 25px rgba(79, 172, 254, 0.3);
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
                box-shadow: 0 12px 35px rgba(79, 172, 254, 0.4);
            }
            
            .btn-outline{ 
                background: transparent; 
                color: white; 
                border: 2px solid rgba(255,255,255,0.3);
                backdrop-filter: blur(10px);
            }
            
            .btn-outline:hover{ 
                background: rgba(255,255,255,0.1);
                border-color: white;
                transform: translateY(-3px);
            }
            /* Section Title */
            .section-title{ 
                text-align:center; 
                font-size: 2.5rem; 
                margin: 3rem 0; 
                color: #2b2b2b; 
                position: relative;
                font-weight: 800;
                background: linear-gradient(135deg, #667eea, #764ba2);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                text-shadow: 0 4px 8px rgba(0,0,0,0.1);
            }
            
            .section-title::after{ 
                content: ''; 
                display: block; 
                width: 100px; 
                height: 4px; 
                border-radius: 4px; 
                background: linear-gradient(90deg, #667eea, #764ba2); 
                margin: 1rem auto 0;
                box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
            }
            /* News Ticker */
            .ticker { 
                position: relative; 
                background: linear-gradient(135deg, #1a1a2e, #16213e, #0f3460); 
                color: #fff; 
                overflow: hidden; 
                border-radius: 20px; 
                margin: 2rem 0; 
                border: 2px solid rgba(255,255,255,0.1); 
                box-shadow: 0 20px 40px rgba(0,0,0,0.3), inset 0 0 0 1px rgba(255,255,255,0.05);
                backdrop-filter: blur(10px);
            }
            .ticker::before, .ticker::after{ 
                content:''; 
                position:absolute; 
                top:0; 
                bottom:0; 
                width:80px; 
                pointer-events:none; 
                z-index:2 
            }
            .ticker::before{ 
                left:0; 
                background: linear-gradient(90deg, rgba(26,26,46,.8), rgba(26,26,46,0)); 
            }
            .ticker::after{ 
                right:0; 
                background: linear-gradient(270deg, rgba(26,26,46,.8), rgba(26,26,46,0)); 
            }
            .ticker__track { 
                display: inline-block; 
                white-space: nowrap; 
                padding: 20px 0; 
                animation: marquee 15s linear infinite; 
            }
            .ticker:hover .ticker__track{ 
                animation-play-state: paused; 
            }
            .ticker__item { 
                display: inline-flex; 
                align-items: center; 
                gap:16px; 
                margin-inline: 40px; 
                color: #fff; 
                text-shadow: 0 2px 4px rgba(0,0,0,.5);
                padding: 12px 20px;
                background: rgba(255,255,255,.05);
                border-radius: 12px;
                border: 1px solid rgba(255,255,255,.1);
                backdrop-filter: blur(5px);
                transition: all 0.3s ease;
            }
            .ticker__item:hover {
                background: rgba(255,255,255,.1);
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(0,0,0,.2);
            }
            .ticker__dot{ 
                width:8px; 
                height:8px; 
                border-radius:50%; 
                background: linear-gradient(45deg, #00ff88, #00d4aa); 
                box-shadow: 0 0 12px rgba(0,255,136,.6);
                animation: pulse 2s infinite;
            }
            .ticker__image{ 
                width:40px; 
                height:30px; 
                object-fit:cover; 
                border-radius:8px; 
                border: 2px solid rgba(255,255,255,.3);
                box-shadow: 0 4px 12px rgba(0,0,0,.3);
            }
            .ticker__text {
                font-size: 16px;
                font-weight: 500;
                max-width: 300px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
            .ticker__time{ 
                font-size:13px; 
                color:#a0a0a0; 
                display:inline-flex; 
                align-items:center; 
                gap:6px;
                background: rgba(0,0,0,.2);
                padding: 4px 8px;
                border-radius: 6px;
                border: 1px solid rgba(255,255,255,.1);
            }
            .ticker__time svg{ 
                opacity:.8; 
                width: 14px;
                height: 14px;
            }
            @keyframes marquee { 
                0% { transform: translateX(100%); } 
                100% { transform: translateX(-100%); } 
            }
            @keyframes pulse {
                0%, 100% { opacity: 1; transform: scale(1); }
                50% { opacity: 0.7; transform: scale(1.1); }
            }
            
            /* Responsive Design */
            @media (max-width: 768px) {
                .hero h1 { 
                    font-size: 2.5rem; 
                    margin-bottom: 1.5rem;
                }
                
                .hero p { 
                    font-size: 1.2rem; 
                    max-width: 90%;
                }
                
                .hero {
                    padding: 60px 20px;
                    min-height: 60vh;
                }
            }
            
            @media (max-width: 480px) {
                .hero h1 { 
                    font-size: 2rem; 
                }
                
                .hero p { 
                    font-size: 1rem; 
                }
            }
            .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px,1fr)); gap: 16px; }
            .card { background: #fff; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,.06); padding: 16px; }
            .table-wrap{ overflow-x:auto; border-radius:12px; box-shadow:0 8px 24px rgba(0,0,0,.06); background:#fff }
            table{ width:100%; border-collapse:collapse }
            thead th{ background:#f7faf7; color:#2b2b2b; padding:12px; border-bottom:1px solid #e9ecef; font-weight:700 }
            tbody td{ padding:12px; border-bottom:1px solid #eef2f4 }
            tbody tr:nth-child(even){ background:#fbfdfb }
            .btn { background: var(--primary); color: #fff; padding: 10px 16px; border: none; border-radius: 10px; cursor: pointer; transition:.2s }
            .btn:hover { background: #43a047; transform: translateY(-1px) }
            .btn-outline{ background:transparent; color:var(--primary); border:1px solid var(--primary) }
            .btn-outline:hover{ background:var(--primary); color:#fff }
            .scroll-top{ position:fixed; right:16px; bottom:16px; width:44px; height:44px; border-radius:50%; display:flex; align-items:center; justify-content:center; background:#2f2f2f; color:#fff; cursor:pointer; box-shadow:0 6px 14px rgba(0,0,0,.2) }
            footer { background: #333; color: #fff; text-align: center; padding: 22px; margin-top: 36px; }
            
            /* Image Modal Styles */
            .image-modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8); backdrop-filter: blur(5px); }
            .image-modal-content { position: relative; margin: 5% auto; padding: 0; width: 90%; max-width: 800px; background: #fff; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); overflow: hidden; animation: modalSlideIn 0.3s ease-out; }
            .image-modal-header { padding: 20px; background: linear-gradient(135deg, #4CAF50, #45a049); color: white; display: flex; justify-content: space-between; align-items: center; }
            .image-modal-title { font-size: 24px; font-weight: 700; margin: 0; }
            .image-modal-close { background: none; border: none; color: white; font-size: 28px; cursor: pointer; padding: 0; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; border-radius: 50%; transition: background 0.3s; }
            .image-modal-close:hover { background: rgba(255,255,255,0.2); }
            .image-modal-body { padding: 20px; }
            .image-modal-image { width: 100%; max-height: 500px; object-fit: contain; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.1); }
            .image-modal-description { margin-top: 16px; color: #666; line-height: 1.6; font-size: 16px; }
            .image-modal-actions { padding: 20px; background: #f8f9fa; display: flex; gap: 12px; justify-content: center; }
            .image-modal-btn { padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: 600; transition: all 0.3s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
            .image-modal-btn-primary { background: #4CAF50; color: white; }
            .image-modal-btn-primary:hover { background: #45a049; transform: translateY(-2px); }
            .image-modal-btn-secondary { background: #6c757d; color: white; }
            .image-modal-btn-secondary:hover { background: #5a6268; }
            @keyframes modalSlideIn { from { opacity: 0; transform: translateY(-50px); } to { opacity: 1; transform: translateY(0); } }
            .image-btn:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(76, 175, 80, 0.4); }
        </style>
        <div class="container">
            <section class="hero" id="home">
                <div class="bubbles">
                    <span class="bubble" style="left:12%; width:50px; height:50px; animation-delay:0s"></span>
                    <span class="bubble" style="left:30%; width:70px; height:70px; animation-delay:1s"></span>
                    <span class="bubble" style="left:48%; width:60px; height:60px; animation-delay:2s"></span>
                    <span class="bubble" style="left:66%; width:80px; height:80px; animation-delay:1.5s"></span>
                    <span class="bubble" style="left:86%; width:55px; height:55px; animation-delay:.5s"></span>
                </div>
                <h1>اهلاً بك في الموقع الرسمي</h1>
                <p>متابعة الترتيب، الأخبار، وكل جديد بسهولة.</p>
                
                @if($images->count() > 0)
                    <div class="image-buttons" style="margin-top: 20px; display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
                        @foreach($images as $image)
                            @php
                                $buttonStyle = match($image->type) {
                                    'stadium' => 'background: linear-gradient(45deg, #FF6B35, #F7931E); box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);',
                                    'maqassa' => 'background: linear-gradient(45deg, #2196F3, #1976D2); box-shadow: 0 4px 15px rgba(33, 150, 243, 0.3);',
                                    'club' => 'background: linear-gradient(45deg, #4CAF50, #45a049); box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);',
                                    default => 'background: linear-gradient(45deg, #9C27B0, #7B1FA2); box-shadow: 0 4px 15px rgba(156, 39, 176, 0.3);'
                                };
                                $iconPath = match($image->type) {
                                    'stadium' => 'M12 2L3 7v10l9 5 9-5V7l-9-5zm0 2.18L19 8l-7 3.89L5 8l7-3.82zM5 10.53l7 3.89 7-3.89V16l-7 3.89L5 16v-5.47z',
                                    'maqassa' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z',
                                    'club' => 'M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z',
                                    default => 'M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z'
                                };
                            @endphp
                            <button class="image-btn" onclick="openImageModal({{ $image->id }}, '{{ $image->title }}', '{{ asset('storage/' . $image->image_path) }}')" style="{{ $buttonStyle }} color: white; border: none; padding: 12px 20px; border-radius: 25px; cursor: pointer; font-size: 14px; font-weight: 600; transition: all 0.3s ease;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left: 8px;">
                                    <path d="{{ $iconPath }}" fill="currentColor"/>
                                </svg>
                                {{ $image->type_name }}
                            </button>
                        @endforeach
                </div>
                @endif
            </section>

            <section aria-label="ticker" class="ticker" id="news-ticker">
                <div class="ticker__track" id="tickerTrack">
                    @forelse(($news ?? []) as $item)
                        <a href="{{ route('news.show', $item->id) }}" class="ticker__item" style="text-decoration: none; color: inherit;">
                            <span class="ticker__dot"></span>
                            @if(data_get($item,'image'))
                                <img src="{{ asset('storage/' . data_get($item,'image')) }}" alt="صورة الخبر" class="ticker__image">
                            @endif
                            <div style="display: flex; flex-direction: column; gap: 4px; flex: 1;">
                                <span class="ticker__title" style="font-weight: 600; font-size: 14px;">{{ data_get($item,'title') }}</span>
                                <span class="ticker__text" style="font-size: 13px; opacity: 0.9;">{{ Str::limit(data_get($item,'text'), 60) }}</span>
                            </div>
                            <span class="ticker__time">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm1-10.59l3.3 1.9-1 1.73L11 13V7h2v4.41z" fill="currentColor"/></svg>
                                {{ data_get($item,'created_at') ? data_get($item,'created_at')->format('H:i') : '' }}
                            </span>
                        </a>
                    @empty
                        <span class="ticker__item"><span class="ticker__dot"></span>لا توجد أخبار بعد. أضف خبراً من لوحة التحكم.</span>
                    @endforelse
                </div>
            </section>

            <h2 class="section-title" id="ranking">ترتيب الفرق</h2>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الفريق</th>
                            <th>لعب</th>
                            <th>فوز</th>
                            <th>تعادل</th>
                            <th>هزيمة</th>
                            <th>له</th>
                            <th>عليه</th>
                            <th>الفرق</th>
                            <th>نقاط</th>
                        </tr>
                    </thead>
                    <tbody id="rankingTable">
                        <tr><td colspan="10" style="text-align:center">جارِ التحميل...</td></tr>
                    </tbody>
                </table>
            </div>

            <!-- تمت إزالة سكشن التواصل هنا لأنه أصبح جزءاً من القالب العام ويظهر في كل الصفحات. -->
                        </div>
        
        <!-- Image Modal -->
        <div id="imageModal" class="image-modal">
            <div class="image-modal-content">
                <div class="image-modal-header">
                    <h2 class="image-modal-title" id="modalTitle">عنوان الصورة</h2>
                    <button class="image-modal-close" onclick="closeImageModal()">&times;</button>
                        </div>
                <div class="image-modal-body">
                    <img id="modalImage" class="image-modal-image" src="" alt="صورة">
                    <div id="modalDescription" class="image-modal-description"></div>
                    </div>
                <div class="image-modal-actions">
                    <button class="image-modal-btn image-modal-btn-primary" onclick="downloadImage()">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M17 9l-5 5-5-5M12 12.8V2.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        تحميل الصورة
                    </button>
                    <button class="image-modal-btn image-modal-btn-secondary" onclick="closeImageModal()">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        إغلاق
                    </button>
                </div>
            </div>
        </div>

        <script>
            // تحميل جدول الترتيب مباشرة في الصفحة
            (function loadRanking(){
                fetch('{{ url('/api/ranking') }}')
                  .then(r => r.json())
                  .then(data => {
                      const body = document.getElementById('rankingTable');
                      body.innerHTML = '';
                      data.forEach((row, i) => {
                          const tr = document.createElement('tr');
                          tr.innerHTML = `<td>${i+1}</td><td>${row.team}</td><td>${row.played}</td><td>${row.won}</td><td>${row.draw}</td><td>${row.lost}</td><td>${row.goals_for}</td><td>${row.goals_against}</td><td>${row.goal_diff}</td><td>${row.points}</td>`;
                          body.appendChild(tr);
                      });
                  })
                  .catch(() => {
                      document.getElementById('rankingTable').innerHTML = '<tr><td colspan="10">تعذر التحميل</td></tr>';
                  });
            })();

            // زر العودة للأعلى
            const topBtn = document.createElement('div');
            topBtn.className = 'scroll-top';
            topBtn.textContent = '↑';
            topBtn.onclick = () => window.scrollTo({ top:0, behavior:'smooth' });
            document.body.appendChild(topBtn);
            
            // Image Modal Functions
            let currentImageUrl = '';
            
            function openImageModal(id, title, imageUrl) {
                document.getElementById('modalTitle').textContent = title;
                document.getElementById('modalImage').src = imageUrl;
                document.getElementById('modalDescription').textContent = 'قناة ' + title;
                document.getElementById('imageModal').style.display = 'block';
                currentImageUrl = imageUrl;
                document.body.style.overflow = 'hidden';
            }
            
            function closeImageModal() {
                document.getElementById('imageModal').style.display = 'none';
                document.body.style.overflow = 'auto';
            }
            
            function downloadImage() {
                if (currentImageUrl) {
                    const link = document.createElement('a');
                    link.href = currentImageUrl;
                    link.download = document.getElementById('modalTitle').textContent + '.jpg';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            }
            
            // Close modal when clicking outside
            window.onclick = function(event) {
                const modal = document.getElementById('imageModal');
                if (event.target === modal) {
                    closeImageModal();
                }
            }
            
            // Close modal with Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeImageModal();
                }
            });
        </script>
@endsection


