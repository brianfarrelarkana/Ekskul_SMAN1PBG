<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" src="{{ asset('img/Logo SMAN 1 PBG.png') }}">
  <title>Admin Ekskul | SMAN 1 Purbalingga</title>
  <link rel="stylesheet" href="/css/admin_berita.css">
  <style>
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
        <a href="/admin_dashboard">Dashboard</a>
        <a href="/admin_profile">Profil</a>
        <a href="/admin_berita" class="active">Berita</a>
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
        <h2 class="section-title">Manajemen Berita</h2>

        <div class="form-card">
          <h3 class="form-title">Tambah Berita/Pengumuman</h3>
          <form action="{{ url('/berita') }}" method="POST">
            @csrf
            <label for="judul">Judul Berita/Pengumuman</label>
            <input type="text" id="judul" name="judul" placeholder="Masukkan Judul Berita" required>

            <label for="isi">Isi Berita/Pengumuman</label>
            <input type="text" id="isi" name="isi" placeholder="Masukkan Isi Berita" required>

            <button type="submit" class="btn-submit">Buat</button>
          </form>
        </div>

        <div class="berita-list">
          @foreach ($berita as $b)
          <div class="berita-bubble" data-id="{{ $b->id }}" data-title="{{ $b->judul }}" data-body="{{ $b->isi }}">
            <div class="berita-header">
              <span class="berita-role">{{ $b->user->username }}</span>
              <span class="berita-date">{{ \Carbon\Carbon::parse($b->tanggal_dibuat)->translatedFormat('d M Y, H:i') }}</span>
            </div>
            <h4 class="berita-title">{{ $b->judul }}</h4>
            <p>{{ $b->isi }}</p>
          </div>
          @endforeach
        </div>

        <div class="modal" id="modal">
          <div class="modal-content">
            <span class="close-btn">&times;</span>
            <input type="text" id="modal-title" placeholder="Edit Judul">
            <textarea id="modal-body" rows="5" placeholder="Edit Isi"></textarea>
            <div class="modal-buttons">
              <button class="btn-edit">Simpan</button>
              <button class="btn-delete">Hapus</button>
            </div>
          </div>
        </div>
      </main>

      <footer>
        &copy; 2025 SMAN 1 Purbalingga. All Rights Reserved.
      </footer>
    </div>
  </div>

  <script src="{{ asset('js/admin/admin_berita.js') }}"></script>
  <script>
    const modal = document.getElementById("modal");
    const modalTitleInput = document.getElementById("modal-title");
    const modalBodyTextarea = document.getElementById("modal-body");
    const closeBtn = document.querySelector(".close-btn");
    const btnEdit = document.querySelector(".btn-edit");
    const btnDelete = document.querySelector(".btn-delete");

    let selectedBeritaId = null;

    document.querySelectorAll(".berita-bubble").forEach(bubble => {
      bubble.addEventListener("click", () => {
        selectedBeritaId = bubble.getAttribute("data-id");
        modalTitleInput.value = bubble.getAttribute("data-title");
        modalBodyTextarea.value = bubble.getAttribute("data-body");
        modal.style.display = "flex";
      });
    });

    closeBtn?.addEventListener("click", () => {
      modal.style.display = "none";
      selectedBeritaId = null;
    });

    window.addEventListener("click", (e) => {
      if (e.target === modal) {
        modal.style.display = "none";
        selectedBeritaId = null;
      }
    });

    btnEdit?.addEventListener("click", () => {
      if (!selectedBeritaId) return;

      fetch(`/berita/${selectedBeritaId}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
          },
          body: JSON.stringify({
            judul: modalTitleInput.value,
            isi: modalBodyTextarea.value
          })
        })
        .then(res => res.json())
        .then(data => {
          alert('Berita diperbarui!');
          location.reload();
        });
    });

    btnDelete?.addEventListener("click", () => {
      if (!selectedBeritaId) return;

      if (confirm("Yakin ingin menghapus berita ini?")) {
        fetch(`/berita/${selectedBeritaId}`, {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
          })
          .then(res => res.json())
          .then(data => {
            alert('Berita dihapus!');
            location.reload();
          });
      }
    });
  </script>

</body>

</html>