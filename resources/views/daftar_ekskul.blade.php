<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" src="{{ asset('img/Logo SMAN 1 PBG.png') }}">
  <title>Daftar Ekskul | SMAN 1 Purbalingga</title>
  <link rel="stylesheet" href="{{ asset('css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
  <link rel="stylesheet" href="{{ asset('css/daftar_ekskul.css') }}">
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
  </style>
</head>

<body>

  <header class="header-ekskul">
    <a href="/" class="back-btn">
      <img src="{{ asset('img/back-arrow.png') }}" alt="Kembali">
    </a>
    <h1>Daftar Ekstrakurikuler</h1>
  </header>

  <main>
    <section class="ekskul-section">
      @foreach ($profiles as $profile)
      <div class="ekskul-card" onclick="location.href='/ekskul/{{ $profile->id }}'">
        <div class="ekskul-thumb" style="background-image: url('{{ $profile->avatar ? asset('storage/' . $profile->avatar) : asset('img/default_avatar.png') }}');"></div>
        <div class="ekskul-info">
          <h3>{{ $profile->nama_ekskul }}</h3>
          <p>{{ $profile->deskripsi }}</p>
        </div>
      </div>
      @endforeach
    </section>
  </main>

  <footer>
    <div class="footer-bottom">
      &copy; 2025 SMAN 1 Purbalingga. All Rights Reserved.
    </div>
  </footer>

</body>

</html>