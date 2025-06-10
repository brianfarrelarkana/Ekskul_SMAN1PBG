<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" src="{{ asset('img/Logo SMAN 1 PBG.png') }}" />
  <title>Admin Ekskul | SMAN 1 Purbalingga</title>
  <link rel="stylesheet" href="{{ asset('css/admin/admin_profile.css') }}" />
  <style>
    .sidebar {
      width: 240px;
      background-color: #042558;
      color: white;
      display: flex;
      flex-direction: column;
      padding: 10px 0 0;
      box-sizing: border-box;
    }

    .logout {
      width: 100%;
      margin-top: auto;
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 16px 20px;
      color: white;
      cursor: pointer;
      font-size: 0.95rem;
      background: none;
      border: none;
    }

    .jadwal-row {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }

    .jadwal-group {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .jadwal-group select,
    .jadwal-group input {
      padding: 10px;
      font-size: 0.95rem;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .file-preview {
      display: flex;
      align-items: center;
      gap: 10px;
      margin: 10px 0;
    }

    .file-preview img {
      width: 160px;
      height: 80px;
      object-fit: cover;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    .file-preview span {
      font-size: 0.9rem;
      color: #666;
    }
  </style>
</head>

<body>

  <div class="admin-container">
    <button id="hamburgerBtn" class="hamburger">&#9776;</button>
    <aside class="sidebar" id="sidebar">
      <div class="logo-section">
        <img src="{{ asset('img/Logo SMAN 1 PBG.png') }}" alt="Logo Sekolah" />
        <div class="school-text">
          <span class="small">Pusat Informasi Ekstrakurikuler</span>
          <h1>SMA NEGERI 1<br />PURBALINGGA</h1>
        </div>
      </div>
      <nav class="nav-links">
        <a href="/admin_dashboard">Dashboard</a>
        <a href="/admin_profile" class="active">Profil</a>
        <a href="/admin_berita">Berita</a>
        <a href="https://forms.gle/NhVtKWnCorWHjjqZ7">Laporan Kegiatan Ekstrakurikuler ↗</a>
      </nav>
      <form method="POST" action="{{ url('/logout') }}">
        @csrf
        <button type="submit" class="logout">
          <img src="{{ asset('img/logout.png') }}" alt="Logout">
          <span>Log Out</span>
        </button>
      </form>
    </aside>

    <div class="content-area">
      <main class="main-content">
        <h2 class="section-title">Profil</h2>

        <div class="form-card">
          <form action="{{ url('/admin_profile') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @php
            $bannerUrl = ($profile && $profile->banner) ? asset('storage/' . $profile->banner) : asset('img/default-banner.png');
            @endphp
            <div class="header-cover" id="bannerPreview" style="background-image: url('{{ $bannerUrl }}');">
              <label class="edit-overlay" for="bannerInput">
                <img src="{{ asset('img/white edit.png') }}" class="edit-icon" />
              </label>
              <input type="file" id="bannerInput" name="banner" accept="image/*" hidden />
            </div>

            <div class="avatar-container">
              <div class="avatar-wrapper">
                <img src="{{ ($profile && $profile->avatar) ? asset('storage/' . $profile->avatar) : asset('img/default_avatar.png') }}"
                  class="avatar" id="avatarPreview" />
                <label class="edit-overlay" for="avatarInput">
                  <img src="{{ asset('img/white edit.png') }}" class="edit-icon" />
                </label>
                <input type="file" id="avatarInput" name="avatar" accept="image/*" hidden />
              </div>
            </div>

            <label>Nama Ekstrakurikuler</label>
            <input type="text" name="nama_ekskul" placeholder="Masukkan nama ekskul" value="{{ $profile->nama_ekskul ?? '' }}">

            <label>Deskripsi Ekstrakurikuler</label>
            <textarea name="deskripsi" placeholder="Deskripsi singkat" rows="5">{{ $profile->deskripsi ?? '' }}</textarea>

            <label>Link YouTube Video Perkenalan Ekstrakurikuler</label>
            <input type="url" name="link_youtube" placeholder="https://youtube.com/..." value="{{ $profile->link_youtube ?? '' }}">

            <div class="jadwal-row">
              <div class="jadwal-group">
                <label>Hari</label>
                <select name="hari" required>
                  <option value="">Pilih Hari</option>
                  @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                  <option value="{{ $hari }}" {{ (isset($profile->jadwal) && $profile->jadwal && $profile->jadwal->hari == $hari) ? 'selected' : '' }}>
                    {{ $hari }}
                  </option>
                  @endforeach
                </select>
              </div>
              <div class="jadwal-group">
                <label>Waktu Mulai</label>
                <input type="time" name="waktu_mulai" value="{{ $profile->jadwal->waktu_mulai ?? '' }}" required>
              </div>
              <div class="jadwal-group">
                <label>Waktu Selesai</label>
                <input type="time" name="waktu_selesai" value="{{ $profile->jadwal->waktu_selesai ?? '' }}" required>
              </div>
            </div>

            @for ($i = 1; $i <= 3; $i++)
              @php
              $foto=($profile && isset($profile->galeri[$i - 1])) ? $profile->galeri[$i - 1]->path : null;
              @endphp
              <label>Foto Galeri {{ $i }}</label>
              <div class="file-preview" id="preview-galeri-{{ $i }}">
                <img src="{{ $foto ? asset('storage/' . $foto) : asset('img/default-galeri.png') }}" alt="Preview {{ $i }}">
                <span>{{ $foto ?? 'Belum ada file' }}</span>
              </div>
              <input type="file" name="galeri_{{ $i }}" id="galeri-{{ $i }}-upload" accept="image/*">
              @endfor

              <button type="submit" class="btn-submit">Simpan</button>
          </form>
        </div>
      </main>

      <footer>
        &copy; 2025 SMAN 1 Purbalingga. All Rights Reserved.
      </footer>
    </div>
  </div>

  <script src="{{ asset('js/admin/admin_profile.js') }}"></script>
  <script>
    document.getElementById('avatarInput').addEventListener('change', function(e) {
      const preview = document.getElementById('avatarPreview');
      preview.src = URL.createObjectURL(e.target.files[0]);
    });

    document.getElementById('bannerInput').addEventListener('change', function(e) {
      const banner = document.getElementById('bannerPreview');
      banner.style.backgroundImage = `url(${URL.createObjectURL(e.target.files[0])})`;
    });

    ['galeri-1', 'galeri-2', 'galeri-3'].forEach((id, index) => {
      const input = document.getElementById(`${id}-upload`);
      const previewImg = document.querySelector(`#preview-${id} img`);
      const previewText = document.querySelector(`#preview-${id} span`);

      input.addEventListener('change', function() {
        if (this.files && this.files[0]) {
          previewImg.src = URL.createObjectURL(this.files[0]);
          previewText.textContent = this.files[0].name;
        }
      });
    });
  </script>

</body>

</html>