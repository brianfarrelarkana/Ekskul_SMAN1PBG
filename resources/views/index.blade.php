<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" src="{{ asset('img/Logo SMAN 1 PBG.png') }}">
  <title>Ekskul | SMAN 1 Purbalingga</title>
  <link rel="stylesheet" href="{{ asset('css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  <link rel="stylesheet" href="{{ asset('css/tentang.css') }}">
  <link rel="stylesheet" href="{{ asset('css/jadwal.css') }}">
  <link rel="stylesheet" href="{{ asset('css/berita.css') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
</head>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<body>

  <header style="background-color: #c2e8ff;">
    <div class="container">
      <div class="header-left">
        <div class="logo-area">
          <img src="{{ asset('img/Logo SMAN 1 PBG.png') }}" alt="Logo Sekolah">
        </div>
        <div class="school-info">
          <span class="extra-info">Pusat Informasi Ekstrakurikuler</span>
          <h1>SMA NEGERI 1</h1>
          <span class="judul-paling-bawah">PURBALINGGA</span>
        </div>
      </div>
      <nav id="main-nav">
        <ul>
          <li><a href="#hero" class="active">Beranda</a></li>
          <li><a href="#tentang">Tentang</a></li>
          <li><a href="#jadwal">Jadwal</a></li>
          <li><a href="#berita">Berita</a></li>
        </ul>
      </nav>
      <div class="menu-toggle" id="mobile-menu">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </header>

  <section id="hero" class="hero">
    <div class="hero-text-container">
      <h1 class="hero-title">SELAMAT DATANG</h1>
      <p class="hero-subtitle">DI PUSAT INFORMASI EKSTRAKURIKULER</p>
      <p class="hero-schoolname">SMA NEGERI 1 PURBALINGGA</p>
      <button><a href="https://forms.gle/NhVtKWnCorWHjjqZ7">
          Pendaftaran Ekstrakurikuler ↗
        </a>
      </button>
    </div>
  </section>

  <section id="tentang">
    <div class="container">
      <div class="tentang-left">
        <div class="tentang-img-wrapper">
          <img src="{{ asset('img/SMAN 1 PBG (2).jpeg') }}" alt="SMAN 1 Purbalingga">
          <img src="{{ asset('img/SMAN 1 PBG (3).jpg') }}" alt="SMAN 1 Purbalingga">
        </div>
      </div>

      <div class="tentang-right">
        <div class="tentang-header">
          <img src="{{ asset('img/Logo SMAN 1 PBG.png') }}" alt="Emblem Sekolah">
          <h2 style="margin: 0;">SMA NEGERI 1 PURBALINGGA</h2>
        </div>

        <div>
          <h3>SMAN 1 Purbalingga</h3>
          <p>
            <a href="https://data-sekolah.zekolah.id/sekolah/sman-1-purbalingga-83705">SMAN 1 Purbalingga merupakan sekolah menengah atas negeri
              yang berlokasi di Jalan Letjend. MT Haryono, Purbalingga Kulon, Kabupaten Purbalingga, Jawa Tengah.
              Didirikan pada tanggal 16 Agustus 1962, sekolah ini telah lama menjadi pilihan utama bagi para siswa di Purbalingga dan sekitarnya.
              Dengan akreditasi A yang diraih pada tanggal 28 Oktober 2016, SMAN 1 Purbalingga membuktikan kualitas pendidikan yang tinggi dan komitmen
              untuk menghasilkan lulusan yang unggul.</a>
          </p>
        </div>

        <div class="tentang-link">
          <a href="https://sma1purbalingga.sch.id/">
            Web Resmi SMA Negeri 1 Purbalingga ↗
          </a>
        </div>

        <div>
          <h3>Pusat Informasi Ekstrakurikuler</h3>
          <p>
            Website Pusat Informasi Ekstrakurikuler SMAN 1 Purbalingga merupakan wadah yang digunakan untuk menyampaikan informasi
            mengenai ekstrakurikuler-ekstrakurikuler yang ada di SMAN 1 Purbalingga. Di website ini para siswa juga dapat melakukan pendaftaran ekstrakurikuler.
          </p>
        </div>

        <div class="tentang-link">
          <a href="/daftar_ekskul">
            Lihat Ekstrakurikuler
          </a>
        </div>
      </div>
    </div>
  </section>

  <section id="jadwal" class="jadwal-section" x-data="jadwalData()" style="background-color: #042558; padding: 50px 0;">
    <div class="container">
      <h1>
        JADWAL KEGIATAN EKSTRAKURIKULER
      </h1>

      <div class="jadwal-container">
        <div class="jadwal-grid">
          <template x-for="(hari, index) in jadwal" :key="index">
            <div class="jadwal-card">
              <h2 class="judul-hari" x-text="hari.hari"></h2>
              <template x-for="(kegiatan, i) in hari.kegiatan" :key="i">
                <div class="jadwal-item">
                  <strong x-text="kegiatan.nama"></strong>
                  <p x-text="kegiatan.waktu"></p>
                </div>
              </template>
            </div>
          </template>
        </div>
      </div>
    </div>
  </section>

  <script>
    function jadwalData() {
      return {
        jadwal: [],
        fetchJadwal() {
          fetch("{{ url('/api/jadwal') }}")
            .then(res => res.json())
            .then(data => {
              this.jadwal = data;
            })
            .catch(err => console.error('Gagal fetch jadwal:', err));
        },
        init() {
          this.fetchJadwal();
          setInterval(this.fetchJadwal, 30000);
        }
      };
    }
  </script>

  <section id="berita">
    <div class="container">
      <h2 class="section-title">Berita & Pengumuman</h2>
      <div class="berita-list">
        @foreach ($berita as $b)
        <div class="berita-bubble" data-title="{{ $b->judul }}" data-body="{{ $b->isi }}">
          <div class="berita-header">
            <span class="berita-role">{{ $b->user->username }}</span>
            <span class="berita-date">{{ \Carbon\Carbon::parse($b->created_at)->translatedFormat('d M Y, H:i') }}</span>
          </div>
          <h4 class="berita-title">{{ $b->judul }}</h4>
          <p>{{ $b->isi }}</p>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <div id="modal" class="modal">
    <div class="modal-content">
      <span class="close-btn" onclick="closeModal()">&times;</span>
      <h3 id="modal-title"></h3>
      <p id="modal-body"></p>
    </div>
  </div>

  <footer>
    <div class="footer-sections">
      <div class="footer-contact">
        <h4>Kontak SMAN 1 Purbalingga</h4>
        <a href="https://www.instagram.com/sma1pbg_id/"><img src="{{ asset('img/instagram.png') }}" alt="Instagram"> @sma1pbg_id</a>
        <a href="tel:0281891019"><img src="{{ asset('img/Telephone.png') }}" alt="Phone"> 0281891019</a>
        <a href="mailto:ganesha@sma1purbalingga.sch.id"><img src="{{ asset('img/Email.png') }}" alt="Email"> ganesha@sma1purbalingga.sch.id</a>
        <a href="https://sma1purbalingga.sch.id/"><img src="{{ asset('img/website.png') }}" alt="Website"> sma1purbalingga.sch.id</a>
        <a href="https://maps.app.goo.gl/asTCE4TEPknB4eQaA"><img src="{{ asset('img/Black PinPoint.png') }}" alt="Location"> <span>Jl. MT. Haryono, Dusun 1, Purbalingga Kulon, Kec. Purbalingga, Kabupaten Purbalingga, Jawa Tengah 53312</span></a>
      </div>

      <div class="footer-team">
        <h4>Kontak Tim Developer</h4>
        <a href="https://www.instagram.com/brian_farrel/"><img src="{{ asset('img/instagram.png') }}" alt="Instagram"> Ketua Tim</a>
      </div>
    </div>

    <div class="footer-bottom">
      <a href="/admin_login">&copy; 2025 SMA Negeri 1 Purbalingga. All Rights Reserved.</a>
    </div>
  </footer>

  <script src="{{ asset('js/home.js') }}"></script>
  <script src="{{ asset('js/berita.js') }}"></script>

</body>

</html>