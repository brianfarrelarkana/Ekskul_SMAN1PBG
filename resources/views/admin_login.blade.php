<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" src="{{ asset('img/Logo SMAN 1 PBG.png') }}">
  <title>Admin Login | Ekskul</title>
  <link rel="stylesheet" href="{{ asset('css/admin_login.css') }}">
  <style>
    .password-wrapper {
      position: relative;
    }

    .password-wrapper input {
      width: 87%;
      padding: 10px 12px;
      border: none;
      border-bottom: 1px solid #ccc;
      font-size: 0.9rem;
      outline: none;
      padding-right: 40px;
    }

    .toggle-password {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
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
  </style>
</head>

<body>

  <div class="login-container">
    <div class="login-card">
      <div class="title-card">
        <img src="{{ asset('img/Logo SMAN 1 PBG.png') }}" alt="Logo SMAN 1 Purbalingga" class="logo">
        <div class="school-info">
          <div class="extra-info">Pusat Informasi Ekstrakurikuler</div>
          <h2>SMA NEGERI 1<br>PURBALINGGA</h2>
        </div>
      </div>

      @if ($errors->any())
      <div style="color: red;">
        {{ $errors->first() }}
      </div>
      @endif
      <form method="POST" action="{{ url('/admin_login') }}">
        @csrf
        <input type="text" name="username" placeholder="Username" required>

        <div class="password-wrapper">
          <input type="password" name="password" id="password" placeholder="Password" required>
          <button type="button" class="toggle-password" onclick="togglePassword('password', this)">
            <svg class="eye eye-open" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24"
              fill="none" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
              <circle cx="12" cy="12" r="3" />
            </svg>

            <svg class="eye eye-closed" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24"
              fill="none" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              style="display: none;">
              <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-5 0-9.27-3.11-11-8 1.13-2.84 3.12-5.16 5.61-6.44" />
              <path d="M1 1l22 22" />
              <path d="M9.88 9.88a3 3 0 0 0 4.24 4.24" />
              <path d="M4.22 4.22a10.94 10.94 0 0 1 14.14 0" />
            </svg>
          </button>
        </div>

        <button type="submit">Masuk</button>
      </form>
    </div>
  </div>

  <footer>
    &copy; 2025 SMAN 1 Purbalingga. All Rights Reserved
  </footer>

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