<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" src="{{ asset('img/Logo SMAN 1 PBG.png') }}">
  <title>Super Admin Ekskul | SMAN 1 Purbalingga</title>
  <link rel="stylesheet" href="{{ asset('css/superadmin/superadmin_dashboard.css') }}">
  <style>
    .ekskul-thumb {
      width: 64px;
      height: 64px;
      border-radius: 5px;
      background-size: contain;
      background-repeat: no-repeat;
      background-position: center;
      background-color: #fff;
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
      flex-direction: row;
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
        <a href="/superadmin_dashboard" class="active">Dashboard</a>
        <a href="/superadmin_ekskul">Ekstrakurikuler</a>
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
        <h2>Dashboard Super Admin</h2>
        <h3>Selamat datang kembali {{ Auth::user()->username }}!</h3>
        <div class="stat-box">
          <p>Jumlah Ekstrakurikuler</p>
          <h3>{{ $jumlahEkskul }}</h3>
        </div>

        <div class="ekskul-list">
          @foreach ($admins as $admin)
          <div class="ekskul-card">
            <div class="ekskul-thumb">
              @if ($admin->profile && $admin->profile->avatar)
              <img src="{{ $admin->profile->avatar ? asset('storage/' . $admin->profile->avatar) : asset('img/default_avatar.png') }}" alt="Avatar {{ $admin->profile->nama_ekskul }}">
              @else
              <img src="{{ asset('img/default_avatar.png') }}" alt="Default Avatar">
              @endif
            </div>
            <div class="ekskul-info">
              <h3>{{ $admin->profile->nama_ekskul ?? $admin->username }}</h3>
              <p>{{ $admin->profile->deskripsi ?? '-' }}</p>
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

  <script src="{{ asset('js/superadmin/superadmin_dashboard.js') }}"></script>

</body>

</html>