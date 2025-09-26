@extends('layouts.app', ['title' => 'إضافة فريق'])

@section('content')
    <style>
        .form-wrap{max-width:640px;margin:24px auto;padding:0 12px}
        .card{background:#fff;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,.06);padding:22px}
        .card h2{margin:0 0 12px;text-align:center}
        .field{display:flex;flex-direction:column;gap:6px;margin-bottom:12px}
        .label{font-size:14px;color:#444;display:inline-flex;align-items:center;gap:6px}
        .control{padding:12px;border:1px solid #e6e6ef;border-radius:10px}
        .actions{display:flex;gap:10px;justify-content:flex-end;margin-top:8px}
        .btn{padding:10px 14px;border:0;border-radius:10px;background:#4CAF50;color:#fff;cursor:pointer}
        .btn:hover{background:#43a047}
        .btn-outline{background:transparent;color:#4CAF50;border:1px solid #4CAF50}
    </style>
    <div class="form-wrap">
        <div class="card">
            <h2>إضافة فريق</h2>
            <form method="POST" action="{{ route('admin.ranking.store') }}" id="rankingCreateForm">
                @csrf
                <div class="field">
                    <label class="label">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-4.418 0-8 2.239-8 5v3h16v-3c0-2.761-3.582-5-8-5z" fill="#4CAF50"/></svg>
                        اسم الفريق
                    </label>
                    <input class="control" name="team" placeholder="مثال: الأهلي" required>
                </div>
                <div class="field">
                    <label class="label">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10" stroke="#4CAF50" stroke-width="2"/><path d="M6 12h12M12 6v12" stroke="#4CAF50" stroke-width="2"/></svg>
                        لعب
                    </label>
                    <input class="control" type="number" name="played" id="played" min="0" step="1" inputmode="numeric" pattern="[0-9]*" value="0" required>
                </div>
                <div class="field">
                    <label class="label">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 13l4 4L19 7" stroke="#4CAF50" stroke-width="2"/></svg>
                        فوز
                    </label>
                    <input class="control" type="number" name="won" id="won" min="0" step="1" inputmode="numeric" pattern="[0-9]*" value="0" required>
                </div>
                <div class="field">
                    <label class="label">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12h16" stroke="#4CAF50" stroke-width="2"/></svg>
                        تعادل
                    </label>
                    <input class="control" type="number" name="draw" id="draw" min="0" step="1" inputmode="numeric" pattern="[0-9]*" value="0" required>
                </div>
                <div class="field">
                    <label class="label">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19 11H7m0 0l4-4m-4 4l4 4" stroke="#c62828" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        هزيمة
                    </label>
                    <input class="control" type="number" name="lost" id="lost" min="0" step="1" inputmode="numeric" pattern="[0-9]*" value="0" required>
                </div>
                <div class="field">
                    <label class="label">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 12l7 7 11-11" stroke="#4CAF50" stroke-width="2"/></svg>
                        له
                    </label>
                    <input class="control" type="number" name="goals_for" id="goals_for" min="0" step="1" inputmode="numeric" pattern="[0-9]*" value="0" required>
                </div>
                <div class="field">
                    <label class="label">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 12l-7 7-7-7" stroke="#c62828" stroke-width="2"/></svg>
                        عليه
                    </label>
                    <input class="control" type="number" name="goals_against" id="goals_against" min="0" step="1" inputmode="numeric" pattern="[0-9]*" value="0" required>
                </div>
                <div class="field">
                    <label class="label">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12h8M12 12l4-4m-4 4l4 4" stroke="#4CAF50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        الفرق
                    </label>
                    <input class="control" type="number" name="goal_diff" id="goal_diff" step="1" inputmode="numeric" pattern="[0-9]*" value="0" required>
                </div>
                <div class="field">
                    <label class="label">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="9" stroke="#4CAF50" stroke-width="2"/><text x="12" y="16" text-anchor="middle" font-size="10" fill="#4CAF50">PTS</text></svg>
                        النقاط
                    </label>
                    <input class="control" type="number" name="points" id="points" min="0" step="1" inputmode="numeric" pattern="[0-9]*" value="0" required>
                </div>
                <div class="actions">
                    <a class="btn btn-outline" href="{{ route('admin.ranking.index') }}">رجوع</a>
                    <button class="btn" type="submit" title="حفظ" aria-label="حفظ" id="createSaveBtn">حفظ</button>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
    <script>
        (function(){
            const won = document.getElementById('won');
            const draw = document.getElementById('draw');
            const lost = document.getElementById('lost');
            const played = document.getElementById('played');
            const gf = document.getElementById('goals_for');
            const ga = document.getElementById('goals_against');
            const gd = document.getElementById('goal_diff');
            const pts = document.getElementById('points');
            const form = document.getElementById('rankingCreateForm');
            const saveBtn = document.getElementById('createSaveBtn');

            function toInt(el){ const v = parseInt(el.value || '0', 10); return isNaN(v)?0:v; }
            function recalc(){
                const w = toInt(won), d = toInt(draw), l = toInt(lost);
                played.value = String(w + d + l);
                const gfor = toInt(gf), gag = toInt(ga);
                gd.value = String(gfor - gag);
                pts.value = String(w*3 + d);
            }
            [won,draw,lost,gf,ga].forEach(el => el.addEventListener('input', recalc));

            function validate(){
                const w = toInt(won), d = toInt(draw), l = toInt(lost);
                const p = toInt(played);
                if (w < 0 || d < 0 || l < 0) { Swal.fire('تحقق', 'القيم لا يمكن أن تكون سالبة', 'warning'); return false; }
                if (p !== w + d + l) { Swal.fire('تحقق', 'عدد "لعب" يجب أن يساوي مجموع فوز + تعادل + هزيمة', 'warning'); return false; }
                if (toInt(gd) !== (toInt(gf) - toInt(ga))) { Swal.fire('تحقق', 'الفارق يجب أن يساوي له - عليه', 'warning'); return false; }
                if (toInt(pts) !== (w*3 + d)) { Swal.fire('تحقق', 'النقاط يجب أن تساوي: 3×فوز + تعادل', 'warning'); return false; }
                return true;
            }

            if (form) {
                form.addEventListener('submit', function(e){
                    e.preventDefault();
                    if (!validate()) return;
                    if (saveBtn) saveBtn.disabled = true;
                    const fd = new FormData(form);
                    fetch(form.action, { method:'POST', headers:{ 'X-Requested-With':'XMLHttpRequest' }, body: fd })
                      .then(r => r.ok ? r.text() : Promise.reject())
                      .then(() => { Swal.fire('تم', 'تم إنشاء الفريق', 'success'); setTimeout(()=>{ window.location.href='{{ route('admin.ranking.index') }}'; }, 700); })
                      .catch(() => { Swal.fire('خطأ', 'تعذر إنشاء الفريق', 'error'); })
                      .finally(()=>{ if(saveBtn) saveBtn.disabled=false; });
                });
            }
        })();
    </script>
    @endpush
@endsection


