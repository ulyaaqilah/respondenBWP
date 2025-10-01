<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin - Bugis Water Park</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to bottom right, #e0f7f7, #c2ffff);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }

    /* Background foto samar */
    body::before {
      content: "";
      position: absolute;
      inset: 0;
      background: url('https://www.goersapp.com/blog/wp-content/uploads/2025/07/Bugis-Waterpark-Adventure.webp') no-repeat center/cover;
      opacity: 0.15;
      z-index: -1;
    }

    /* Card utama */
    .login-card {
      width: 400px;
      background: #ffffffdd;
      backdrop-filter: blur(1px);
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 163, 163, 0.25);
      padding: 40px 35px;
      text-align: center;
      animation: fadeIn 0.8s ease-out;
      transition: transform 0.3s ease;
    }

    .login-card:hover {
      transform: translateY(-3px);
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(20px);}
      to {opacity: 1; transform: translateY(0);}
    }

    /* Logo */
    .login-card img.logo {
      width: 70px;
      margin-bottom: 10px;
    }

    /* Judul */
    .login-card h2 {
      margin-bottom: 30px;
      color: #008080;
      font-weight: 600;
      font-size: 1.8em;
      animation: fadeDown 1s ease-out forwards;
    }

    @keyframes fadeDown {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Form */
    form {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 15px;
    }

    input {
      width: 100%;
      max-width: 320px; 
      padding: 12px 15px;
      border-radius: 8px;
      border: 1px solid #cceaea;
      background: #f7ffff;
      font-size: 1em;
      transition: all 0.2s ease;
    }

    input:focus {
      outline: none;
      border-color: #00A3A3;
      box-shadow: 0 0 6px rgba(0,163,163,0.3);
    }

    /* Tombol */
    button {
      width: 100%;
      max-width: 350px; 
      padding: 12px;
      background: #00A3A3;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 1.05em;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s ease;
    }

    button:focus {
      outline: 2px solid #00A3A3;
      outline-offset: 2px;
    }

    button:hover {
      background: #008080;
      transform: translateY(-2px);
    }

    /* Alert Error */
    .alert {
      background: #ffefef;
      color: #b10000;
      border-left: 4px solid #ff5c5c;
      padding: 10px;
      border-radius: 6px;
      margin-top: 15px;
      font-size: 0.9em;
      width: 100%;
      max-width: 320px;
      text-align: left;
    }

    /* Footer kecil */
    .footer-text {
      margin-top: 15px;
      font-size: 0.85em;
      color: #00A3A3;
    }

    /* 🔹 Responsif untuk HP */
    @media (max-width: 480px) {
      .login-card {
        width: 90%;
        padding: 30px 20px;
      }

      .login-card h2 {
        font-size: 1.5em;
        margin-bottom: 20px;
      }

      input, button {
        max-width: 100%;
      }

      .login-card img.logo {
        width: 60px;
        margin-bottom: 8px;
      }
    }
  </style>
</head>
<body>
  <div class="login-card">
    {{-- 🖼 Logo --}}
    <img src="{{ asset('images/logo bwp.png') }}" alt="Logo" class="logo">
    <h2>Login Admin</h2>

    <form method="POST" action="{{ route('login.submit') }}">
      @csrf

      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>

      <button type="submit">Masuk</button>

      @if($errors->any())
        <div class="alert">
          {{ $errors->first() }}
        </div>
      @endif
    </form>

    <p class="footer-text">© 2025 Bugis Water Park</p>
  </div>
</body>
</html>
