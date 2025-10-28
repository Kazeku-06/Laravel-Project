<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>@yield('title', 'Library App - Home')</title>

  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
  
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  
  <!-- Tailwind CSS -->
      @vite('resources/css/app.css')

  <!-- Custom Styles -->
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  <!-- Navbar Komponen -->
  <x-user.navbar />

  <!-- Main Content -->
  @yield('content')

  <!-- Footer Komponen -->
  <x-user.footer />

  <!-- Toggle Menu Script -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const navButton = document.getElementById('navButton');
      const navMenu = document.getElementById('navMenu');
      navButton?.addEventListener('click', () => {
        navMenu.classList.toggle('hidden');
      });
    });
  </script>

</body>
</html>
