@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 2px solid #f0f0f0;">
            <h1 style="margin: 0; color: #2b2b2b; font-size: 28px;">إدارة القنوات</h1>
            <button onclick="openCreateModal()" style="background: linear-gradient(45deg, #4CAF50, #45a049); color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: 600; display: flex; align-items: center; gap: 8px; transition: all 0.3s;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 5v14m-7-7h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                إضافة قناة جديدة
            </button>
        </div>


        <div class="images-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            @forelse($images as $image)
                <div class="image-card" style="background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.3s, box-shadow 0.3s;">
                    <div class="image-preview" style="height: 200px; overflow: hidden; position: relative;">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                        <div class="image-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(transparent, rgba(0,0,0,0.7)); display: flex; flex-direction: column; align-items: flex-end; justify-content: flex-end; padding: 16px;">
                            <span style="color: white; font-weight: 600; font-size: 16px;">{{ $image->title }}</span>
                            <span style="color: #4CAF50; font-weight: 500; font-size: 12px; margin-top: 4px;">{{ $image->type_name }}</span>
                        </div>
                    </div>
                    <div class="image-content" style="padding: 16px;">
                        <div class="image-actions" style="display: flex; gap: 8px; justify-content: flex-end;">
                            <button onclick="openEditModal({{ $image->id }}, '{{ $image->title }}', '{{ $image->type }}')" style="background: #2196F3; color: white; border: none; padding: 8px 12px; border-radius: 6px; cursor: pointer; font-size: 12px; display: flex; align-items: center; gap: 4px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                تعديل
                            </button>
                            <button onclick="deleteImage({{ $image->id }}, '{{ $image->title }}')" style="background: #f44336; color: white; border: none; padding: 8px 12px; border-radius: 6px; cursor: pointer; font-size: 12px; display: flex; align-items: center; gap: 4px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m3 0v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6h14z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                حذف
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #6c757d;">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-bottom: 16px; opacity: 0.5;">
                        <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z" fill="currentColor"/>
                    </svg>
                    <p style="margin: 0; font-size: 18px;">لا توجد قنوات بعد</p>
                    <p style="margin: 8px 0 0 0; color: #999;">أضف قنوات جديدة لعرضها في الصفحة الرئيسية</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Create/Edit Modal -->
<div id="imageModal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8); backdrop-filter: blur(5px);">
    <div style="position: relative; margin: 5% auto; padding: 0; width: 90%; max-width: 500px; background: #fff; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); overflow: hidden; animation: modalSlideIn 0.3s ease-out;">
        <div style="padding: 20px; background: linear-gradient(135deg, #4CAF50, #45a049); color: white; display: flex; justify-content: space-between; align-items: center;">
                    <h2 id="modalTitle" style="margin: 0; font-size: 24px; font-weight: 700;">إضافة قناة جديدة</h2>
            <button onclick="closeModal()" style="background: none; border: none; color: white; font-size: 28px; cursor: pointer; padding: 0; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; border-radius: 50%; transition: background 0.3s;">&times;</button>
        </div>
        <form id="imageForm" method="POST" enctype="multipart/form-data" style="padding: 20px;">
            @csrf
            <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #2b2b2b;">عنوان القناة *</label>
                        <input type="text" name="title" id="imageTitle" required style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 16px; transition: border-color 0.3s;" placeholder="أدخل عنوان القناة">
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #2b2b2b;">نوع القناة *</label>
                <select name="type" id="imageType" required style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 16px; transition: border-color 0.3s;">
                    <option value="stadium">استاد الصعيد</option>
                    <option value="maqassa">المقاصة مباشر</option>
                    <option value="club">نادي بني سويف</option>
                </select>
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #2b2b2b;">صورة القناة *</label>
                <input type="file" name="image" id="imageFile" accept="image/*" required style="width: 100%; padding: 12px; border: 2px dashed #e0e0e0; border-radius: 8px; font-size: 16px; background: #f9f9f9;">
                <div id="imagePreview" style="margin-top: 12px; text-align: center;"></div>
            </div>
            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" onclick="closeModal()" style="padding: 12px 24px; border: 2px solid #e0e0e0; background: white; color: #666; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: 600; transition: all 0.3s;">إلغاء</button>
                <button type="submit" style="padding: 12px 24px; background: linear-gradient(45deg, #4CAF50, #45a049); color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: 600; transition: all 0.3s;">حفظ</button>
            </div>
        </form>
    </div>
</div>

<style>
    @keyframes modalSlideIn {
        from { opacity: 0; transform: translateY(-50px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .image-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    input:focus, textarea:focus {
        outline: none;
        border-color: #4CAF50 !important;
    }
</style>

<script>
    let isEditMode = false;
    let editImageId = null;

    function openCreateModal() {
        isEditMode = false;
        editImageId = null;
                document.getElementById('modalTitle').textContent = 'إضافة قناة جديدة';
        document.getElementById('imageForm').action = '{{ route("admin.images.store") }}';
        document.getElementById('imageForm').method = 'POST';
        document.getElementById('imageTitle').value = '';
        document.getElementById('imageType').value = 'stadium';
        document.getElementById('imageFile').value = '';
        document.getElementById('imageFile').required = true;
        document.getElementById('imagePreview').innerHTML = '';
        document.getElementById('imageModal').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function openEditModal(id, title, type) {
        isEditMode = true;
        editImageId = id;
        document.getElementById('modalTitle').textContent = 'تعديل القناة';
        document.getElementById('imageForm').action = '{{ route("admin.images.update", ":id") }}'.replace(':id', id);
        document.getElementById('imageForm').method = 'POST';
        document.getElementById('imageTitle').value = title;
        document.getElementById('imageType').value = type;
        document.getElementById('imageFile').required = false;
        document.getElementById('imagePreview').innerHTML = '';
        
        // Add hidden input for PUT method
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        document.getElementById('imageForm').appendChild(methodInput);
        
        document.getElementById('imageModal').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('imageModal').style.display = 'none';
        document.body.style.overflow = 'auto';
        
        // Remove method input if exists
        const methodInput = document.querySelector('input[name="_method"]');
        if (methodInput) {
            methodInput.remove();
        }
    }

    // Image preview
    document.getElementById('imageFile').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = `
                    <img src="${e.target.result}" style="max-width: 200px; max-height: 150px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                `;
            };
            reader.readAsDataURL(file);
        }
    });

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('imageModal');
        if (event.target === modal) {
            closeModal();
        }
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });

    // Delete image with SweetAlert
    function deleteImage(imageId, imageTitle) {
        Swal.fire({
            title: 'تأكيد الحذف',
            text: `هل أنت متأكد من حذف القناة "${imageTitle}"؟`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء',
            confirmButtonColor: '#f44336',
            cancelButtonColor: '#6c757d',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Create and submit form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ url('admin/images') }}/${imageId}`;
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                
                form.appendChild(csrfToken);
                form.appendChild(methodInput);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endsection
