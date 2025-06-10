<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" src="{{ asset('img/Logo SMAN 1 PBG.png') }}">
  <title>Detail Ekskul | SMAN 1 Purbalingga</title>
  <link rel="stylesheet" href="{{ asset('css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
  <link rel="stylesheet" href="{{ asset('css/ekskul.css') }}">
  <style>
    .galeri-section {
      padding: 40px 20px;
      background-color: #042558;
      text-align: center;
    }

    .galeri-section h2 {
      font-size: 1.2rem;
      font-weight: 700;
      margin-bottom: 20px;
    }

    .galeri-grid {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 20px;
    }

    .galeri-item {
      width: 240px;
      height: 160px;
      background-color: #ccc;
      border-radius: 8px;
      overflow: hidden;
    }

    .galeri-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 8px;
    }
  </style>
</head>

<body>

  <header class="header-ekskul">
    <a href="/daftar_ekskul" class="back-btn">
      <img src="{{ asset('img/back-arrow.png') }}" alt="Kembali">
    </a>
    <h1>{{ $profile->nama_ekskul }}</h1>
  </header>

  <section class="detail-container">
    <div class="detail-image">
      <img src="{{ $profile->banner ? asset('storage/' . $profile->banner) : asset('img/default-banner.png') }}" alt="Banner Ekskul">
    </div>
    <div class="detail-info">
      <h2>{{ $profile->nama_ekskul }}</h2>
      <p>
        {{ $profile->deskripsi }}
      </p>
      <a href="https://forms.gle/NhVtKWnCorWHjjqZ7" class="btn-daftar">Daftar ↗</a>
    </div>
  </section>

  <section id="video-perkenalan">
    <h2>Video Perkenalan Ekstrakurikuler</h2>
    @php
    function getYoutubeId($url) {
    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);
    return $matches[1] ?? null;
    }

    $youtubeId = getYoutubeId($profile->link_youtube);
    @endphp

    @if($youtubeId)
    <div class="video-container">
      <iframe width="560" height="315"
        src="https://www.youtube.com/embed/{{ $youtubeId }}"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen>
      </iframe>
    </div>
    @else
    <p>Tidak ada video perkenalan.</p>
    @endif
  </section>

  <section class="jadwal-section">
    <h2>JADWAL EKSTRAKURIKULER</h2>
    <p>
      @if($profile->jadwal)
      {{ $profile->jadwal->hari }}, {{ \Carbon\Carbon::parse($profile->jadwal->waktu_mulai)->format('H:i') }}–{{ \Carbon\Carbon::parse($profile->jadwal->waktu_selesai)->format('H:i') }}.
      @else
      Jadwal belum tersedia.
      @endif
    </p>
  </section>

  <section class="galeri-section">
    <h2>GALERI</h2>
    <div class="galeri-grid">
      @foreach($profile->galeri as $galeri)
      <div class="galeri-item">
        <img src="{{ asset('storage/' . $galeri->path) }}" alt="Galeri Foto">
      </div>
      @endforeach
    </div>
  </section>

  <footer>
    <div class="footer-bottom">
      &copy; 2025 SMAN 1 Purbalingga. All Rights Reserved.
    </div>
  </footer>

</body>

</html>