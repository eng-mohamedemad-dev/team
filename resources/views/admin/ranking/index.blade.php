@extends('layouts.app', ['title' => 'إدارة ترتيب الفرق'])

@section('content')
        <style>
            .wrap{max-width:1100px;margin:24px auto;padding:0 12px}
            .card{background:#fff;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,.06);padding:16px;margin-bottom:16px}
            .btn{padding:10px 14px;border:0;border-radius:8px;background:#4CAF50;color:#fff;cursor:pointer}
            .btn:hover{background:#43a047}
            .btn-outline{background:transparent;color:#4CAF50;border:1px solid #4CAF50}
            .btn-danger{background:#c62828}
                .btn-danger:hover{background:#b71c1c}
            .table-wrap{overflow-x:auto;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,.06)}
            table{width:100%;border-collapse:collapse;table-layout:fixed}
            thead th{background:#f7faf7;color:#2b2b2b;padding:10px;border-bottom:1px solid #e9ecef;text-align:center;vertical-align:middle;white-space:nowrap}
            tbody td{padding:10px;border-bottom:1px solid #eef2f4;text-align:center;vertical-align:middle}
            .actions{display:flex;gap:8px;justify-content:center;align-items:center}
            .actions .btn{min-width:40px;height:40px;padding:8px;display:flex;align-items:center;justify-content:center;border-radius:8px;transition:all 0.3s ease}
            .actions .btn:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(0,0,0,0.15)}
            .actions .btn-outline{border:2px solid #4CAF50;background:transparent;color:#4CAF50}
            .actions .btn-outline:hover{background:#4CAF50;color:white}
            .actions .btn-danger{background:#dc3545;border:none;color:white}
            .actions .btn-danger:hover{background:#c82333}
        </style>
        <div class="wrap">
            <div class="card table-wrap">
                <div style="display:flex; align-items:center; justify-content:space-between">
                    <h2 style="margin:0">الترتيب</h2>
                    <a class="btn" href="{{ route('admin.ranking.create') }}" title="إنشاء فريق" aria-label="إنشاء فريق" style="display:inline-flex;align-items:center;gap:6px">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19 11H13V5h-2v6H5v2h6v6h2v-6h6v-2z" fill="#fff"/></svg>
                    </a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>
                                <span style="display:inline-flex;align-items:center;gap:6px">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-4.418 0-8 2.239-8 5v3h16v-3c0-2.761-3.582-5-8-5z" fill="#4CAF50"/></svg>
                                    الفريق
                                </span>
                            </th>
                            <th><span style="display:inline-flex;align-items:center;gap:6px"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10" stroke="#4CAF50" stroke-width="2"/><path d="M6 12h12M12 6v12" stroke="#4CAF50" stroke-width="2"/></svg>لعب</span></th>
                            <th><span style="display:inline-flex;align-items:center;gap:6px"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 13l4 4L19 7" stroke="#4CAF50" stroke-width="2"/></svg>فوز</span></th>
                            <th><span style="display:inline-flex;align-items:center;gap:6px"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12h16" stroke="#4CAF50" stroke-width="2"/></svg>تعادل</span></th>
                            <th><span style="display:inline-flex;align-items:center;gap:6px"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19 11H7m0 0l4-4m-4 4l4 4" stroke="#c62828" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>هزيمة</span></th>
                            <th><span style="display:inline-flex;align-items:center;gap:6px"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 12l7 7 11-11" stroke="#4CAF50" stroke-width="2"/></svg>له</span></th>
                            <th><span style="display:inline-flex;align-items:center;gap:6px"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 12l-7 7-7-7" stroke="#c62828" stroke-width="2"/></svg>عليه</span></th>
                            <th><span style="display:inline-flex;align-items:center;gap:6px"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12h8M12 12l4-4m-4 4l4 4" stroke="#4CAF50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>الفرق</span></th>
                            <th><span style="display:inline-flex;align-items:center;gap:6px"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="9" stroke="#4CAF50" stroke-width="2"/></svg>النقاط</span></th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rows as $i => $r)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $r->team }}</td>
                            <td>{{ $r->played }}</td>
                            <td>{{ $r->won }}</td>
                            <td>{{ $r->draw }}</td>
                            <td>{{ $r->lost }}</td>
                            <td>{{ $r->goals_for }}</td>
                            <td>{{ $r->goals_against }}</td>
                            <td>{{ $r->goal_diff }}</td>
                            <td>{{ $r->points }}</td>
                            <td class="actions">
                                <a class="btn btn-outline" href="{{ route('admin.ranking.edit', $r->id) }}" title="تعديل" aria-label="تعديل">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1.003 1.003 0 000-1.42l-2.34-2.34a1.003 1.003 0 00-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z" fill="currentColor"/>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.ranking.delete', $r->id) }}" data-confirm data-title="تأكيد الحذف" data-text="لا يمكن التراجع بعد الحذف" data-ajax-delete style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" title="حذف" aria-label="حذف">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 7h12M9 7v10m6-10v10M4 7h16l-1 14a2 2 0 01-2 2H7a2 2 0 01-2-2L4 7zm4-3h8l1 3H7l1-3z" stroke="currentColor" stroke-width="1.5"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr><td colspan="11">لا توجد بيانات</td></tr>
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
            // تأكيدات الحذف
            document.querySelectorAll('form[data-confirm]')?.forEach(function(f){
                f.addEventListener('submit', function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: f.getAttribute('data-title') || 'تأكيد الحذف',
                        text: f.getAttribute('data-text') || 'لا يمكن التراجع بعد الحذف',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'حذف',
                        cancelButtonText: 'إلغاء'
                    }).then(function(r){ if(r.isConfirmed){
                        // إذا كانت فورم أجاكس حذف
                        if (f.hasAttribute('data-ajax-delete')) {
                            const token = f.querySelector('input[name="_token"]').value;
                            fetch(f.action, { method: 'POST', headers: { 'X-Requested-With':'XMLHttpRequest','X-CSRF-TOKEN': token }, body: new FormData(f) })
                              .then(() => {
                                  Swal.fire('تم', 'تم الحذف', 'success');
                                  // ازالة الصف من الجدول
                                  const tr = f.closest('tr');
                                  tr?.parentElement?.removeChild(tr);
                              })
                              .catch(() => Swal.fire('خطأ', 'تعذر تنفيذ الحذف', 'error'));
                        } else {
                            f.submit();
                        }
                    } });
                });
            });
        </script>
@endsection


