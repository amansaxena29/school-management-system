<x-app-layout>
<style>
/* Make sizing predictable */
*,
*::before,
*::after { box-sizing: border-box; }

.page-wrap { padding: 50px; display: flex; justify-content: center; }
.container { width: 100%; max-width: 980px; }

.glass-box{
    background: rgba(15,23,42,0.82);
    backdrop-filter: blur(20px);
    border-radius: 28px;
    padding: 45px;
    box-shadow: 0 40px 120px rgba(0,0,0,0.6);
    color: #e5e7eb;
}

.title{
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 25px;
    background: linear-gradient(90deg, #38bdf8, #818cf8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.back-btn{
    display: inline-block;
    margin-bottom: 15px;
    color: #38bdf8;
    text-decoration: none;
    font-weight: 700;
}

.form-grid{
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 16px 18px;
    margin-top: 10px;
}

.field{ display: flex; flex-direction: column; gap: 8px; }

label{
    font-size: 13px;
    font-weight: 600;
    color: rgba(229,231,235,0.85);
}

input, textarea{
    width: 100%;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    padding: 14px 18px;
    border-radius: 14px;
    color: white;
    outline: none;
}

input:focus, textarea:focus{ border-color: rgba(56,189,248,0.7); }

textarea{ min-height: 110px; resize: vertical; }
.full{ grid-column: 1 / -1; }

.actions{
    margin-top: 18px;
    display: flex;
    justify-content: flex-end;
}

button{
    background: linear-gradient(90deg, #38bdf8, #6366f1);
    padding: 12px 28px;
    border-radius: 14px;
    font-weight: 700;
    color: #020617;
    border: none;
    cursor: pointer;
}

/* ✅ Photo UI */
.photo-wrap{
    display:flex;
    gap:14px;
    align-items:center;
    padding: 14px;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.05);
}
.photo-preview{
    width: 86px;
    height: 86px;
    border-radius: 50%;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.18);
    background: rgba(56,189,248,0.12);
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight: 900;
    color:#93c5fd;
    flex: 0 0 86px;
}
.photo-preview img{ width:100%; height:100%; object-fit:cover; display:block; }
.hint{ font-size: 12px; color: rgba(229,231,235,0.72); font-weight: 700; }

.error-box{
    margin: 12px 0;
    padding: 12px 14px;
    border-radius: 14px;
    background: rgba(239,68,68,0.12);
    border: 1px solid rgba(239,68,68,0.25);
    color: #fecaca;
    font-weight: 800;
}

@media (max-width: 760px){
    .page-wrap { padding: 22px; }
    .glass-box { padding: 24px; border-radius: 20px; }
    .form-grid { grid-template-columns: 1fr; }
    .actions { justify-content: stretch; }
    button { width: 100%; }
}
</style>

<div class="page-wrap">
    <div class="container">
        <a class="back-btn" href="{{ route('students.class', $student->class) }}">← Back to Class {{ $student->class }}</a>

        <div class="glass-box">
            <h1 class="title">✏️ Edit Student</h1>

            @if ($errors->any())
              <div class="error-box">
                {{ $errors->first() }}
              </div>
            @endif

            {{-- ✅ IMPORTANT: enctype for file upload --}}
            <form method="POST" action="{{ route('students.update', $student) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-grid">

                    {{-- ✅ PHOTO FIELD --}}
                    <div class="field full">
                        <label>Student Photo</label>

                        @php
                          $photoUrl = !empty($student->photo_path) ? asset($student->photo_path) : null;
                          $initial = !empty($student->name) ? strtoupper(substr(trim($student->name),0,1)) : 'S';
                        @endphp

                        <div class="photo-wrap">
                            <div class="photo-preview" id="photoPreviewBox">
                                @if($photoUrl)
                                  <img id="photoPreviewImg" src="{{ $photoUrl }}" alt="Student Photo">
                                @else
                                  <span id="photoPreviewText">{{ $initial }}</span>
                                  <img id="photoPreviewImg" src="" alt="" style="display:none;">
                                @endif
                            </div>

                            <div style="flex:1;min-width:0;">
                                <input type="file" name="photo" accept="image/png,image/jpeg,image/jpg,image/webp" onchange="previewPhoto(this)">
                                <div class="hint">Allowed: JPG, JPEG, PNG, WEBP • Max: 512 KB</div>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label>Student Name</label>
                        <input name="name" value="{{ old('name', $student->name) }}" placeholder="Student Name" required>
                    </div>

                    <div class="field">
                        <label>Class</label>
                        <input name="class" value="{{ old('class', $student->class) }}" placeholder="Class" required>
                    </div>

                    <div class="field">
                        <label>Roll No</label>
                        <input name="roll_no" value="{{ old('roll_no', $student->roll_no) }}" placeholder="Roll No" required>
                    </div>

                    <div class="field">
                        <label>Phone Number</label>
                        <input name="phone" value="{{ old('phone', $student->phone) }}" placeholder="Phone Number" required>
                    </div>

                    <div class="field">
                        <label>Father's Name</label>
                        <input name="father_name" value="{{ old('father_name', $student->father_name) }}" placeholder="Father's Name">
                    </div>

                    <div class="field">
                        <label>Mother's Name</label>
                        <input name="mother_name" value="{{ old('mother_name', $student->mother_name) }}" placeholder="Mother's Name">
                    </div>

                    <div class="field">
                        <label>Religion</label>
                        <input name="religion" value="{{ old('religion', $student->religion) }}" placeholder="Religion">
                    </div>

                    <div class="field">
                        <label>Citizenship</label>
                        <input name="citizenship" value="{{ old('citizenship', $student->citizenship) }}" placeholder="Citizenship">
                    </div>

                    <div class="field full">
                        <label>Address</label>
                        <textarea name="address" placeholder="Address">{{ old('address', $student->address) }}</textarea>
                    </div>
                </div>

                <div class="actions">
                    <button type="submit">Update Student</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewPhoto(input){
  const box = document.getElementById('photoPreviewBox');
  const img = document.getElementById('photoPreviewImg');
  const txt = document.getElementById('photoPreviewText');

  if (!input.files || !input.files[0]) return;

  const file = input.files[0];

  // optional: client-side size check (same as backend)
  if (file.size > 512 * 1024) {
    alert('File too large. Max 512 KB.');
    input.value = '';
    return;
  }

  const url = URL.createObjectURL(file);

  if (txt) txt.style.display = 'none';
  img.style.display = 'block';
  img.src = url;
}
</script>
</x-app-layout>
