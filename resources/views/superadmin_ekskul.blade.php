<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" src="{{ asset('img/Logo SMAN 1 PBG.png') }}">
  <title>Super Admin Ekskul | SMAN 1 Purbalingga</title>
  <link rel="stylesheet" href="{{ asset('css/superadmin/superadmin_ekskul.css') }}">
  <style>
    .form-card input,
    .password-wrapper input {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 0.95rem;
      box-sizing: border-box;
      margin-bottom: 10px;
    }

    .password-wrapper {
      position: relative;
      width: 100%;
    }

    .toggle-password {
      position: absolute;
      top: 50%;
      right: 12px;
      transform: translateY(-50%);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 4px;
      border: none;
      background: none;
    }

    .icon-eye {
      width: 20px;
      height: 20px;
    }

    .eye {
      width: 20px;
      height: 20px;
    }

    .eye-closed {
      display: none;
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
  </style>
</head>

<body>

  <div class="admin-container">
    <button id="hamburgerBtn" class="hamburger">&#9776;</button>
    <aside class="sidebar" id="sidebar">
      <div class="logo-section">
        <img src="{{ asset('img/Logo SMAN 1 PBG.png') }}" alt="Logo Sekolah">
        <div class="school-text">
          <span class="small">Pusat Informasi Ekstrakurikuler</span>
          <h1>SMA NEGERI 1<br>PURBALINGGA</h1>
        </div>
      </div>
      <nav class="nav-links">
        <a href="/superadmin_dashboard">Dashboard</a>
        <a href="/superadmin_ekskul" class="active">Ekstrakurikuler</a>
        <a href="/superadmin_berita">Berita</a>
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
        <h2 class="section-title">Manajemen Ekstrakurikuler</h2>

        <form method="POST" action="{{ url('/superadmin_ekskul') }}" class="form-card">
          @csrf
          <h3 class="form-title">Tambah Ekstrakurikuler</h3>

          <label for="username">Username</label>
          <input type="text" name="username" required>

          <label for="password">Password</label>
          <div class="password-wrapper">
            <input type="password" name="password" id="password" required>
            <span class="toggle-password" onclick="togglePassword('password', this)">
              <svg class="eye eye-open" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                <circle cx="12" cy="12" r="3" />
              </svg>
              <svg class="eye eye-closed" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-5 0-9.27-3.11-11-8 1.13-2.84 3.12-5.16 5.61-6.44" />
                <path d="M1 1l22 22" />
                <path d="M9.88 9.88a3 3 0 0 0 4.24 4.24" />
                <path d="M4.22 4.22a10.94 10.94 0 0 1 14.14 0" />
              </svg>
            </span>
          </div>


          <label for="password_confirmation">Konfirmasi Password</label>
          <div class="password-wrapper">
            <input type="password" name="password_confirmation" id="password_confirmation" required>
            <span class="toggle-password" onclick="togglePassword('password_confirmation', this)">
              <svg class="eye eye-open" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                <circle cx="12" cy="12" r="3" />
              </svg>
              <svg class="eye eye-closed" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-5 0-9.27-3.11-11-8 1.13-2.84 3.12-5.16 5.61-6.44" />
                <path d="M1 1l22 22" />
                <path d="M9.88 9.88a3 3 0 0 0 4.24 4.24" />
                <path d="M4.22 4.22a10.94 10.94 0 0 1 14.14 0" />
              </svg>
            </span>
          </div>

          <button type="submit" class="btn-submit">Buat</button>
        </form>

        <div class="ekskul-list">
          @foreach ($admins as $admin)
          <div class="ekskul-card">
            <div class="ekskul-thumb">
              @if ($admin->avatar)
              <img src="{{ $admin->profile->avatar ? asset('storage/' . $admin->profile->avatar) : asset('img/default_avatar.png') }}" alt="Avatar {{ $admin->profile->nama_ekskul }}">
              @else
              <img src="{{ asset('img/default_avatar.png') }}" alt="Default Avatar">
              @endif
            </div>
            <div class="ekskul-info">
              <h3>{{ $admin->username }}</h3>
              <p>{{ $admin->profile->deskripsi ?? '-' }}</p>
            </div>
            <div class="action-buttons">
              <form action="{{ url('/superadmin_ekskul/' . $admin->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn-delete" onclick="return confirm('Yakin ingin menghapus ekskul ini?')">Hapus</button>
              </form>
            </div>
          </div>
          @endforeach
        </div>
      </main>

      <footer>
        &copy; 2025 SMAN 1 Purbalingga. All Rights Reserved.
      </footer>
    </div>
  </div>

  <script src="{{ asset('js/superadmin/superadmin_ekskul.js') }}"></script>
  <script>
    function togglePassword(inputId, el) {
      const input = document.getElementById(inputId);
      const eyeOpen = el.querySelector('.eye-open');
      const eyeClosed = el.querySelector('.eye-closed');

      if (input.type === "password") {
        input.type = "text";
        eyeOpen.style.display = "none";
        eyeClosed.style.display = "inline";
      } else {
        input.type = "password";
        eyeOpen.style.display = "inline";
        eyeClosed.style.display = "none";
      }
    }
  </script>

</body>

</html>