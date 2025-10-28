<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Library - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
</head>

<body class="bg-gray-100 font-[Poppins]">
    <header class="bg-white border-b border-b-gray-200 shadow-md px-4 py-3 flex justify-between items-center md:px-8">
        <div class="font-semibold text-gray-800">Admin Library</div>

        <button class="lg:hidden rounded-md focus:outline-none" id="menuButton">
            <i class="fas fa-bars text-gray-800"></i>
        </button>

        @auth
            <div class="relative hidden lg:flex lg:items-center lg:gap-4">
                <!-- Nama User -->
                <p class="font-medium text-sm text-gray-800 hidden md:block">
                    {{ Auth::user()->firstname ?? 'User' }} {{ Auth::user()->lastname ?? '' }}
                </p>

                <!-- Tombol Profile -->
                <button id="profileDropdownButton"
                    class="flex items-center justify-center w-10 h-10 rounded-full overflow-hidden border border-gray-300 focus:outline-none bg-gray-200 text-gray-800 font-semibold">
                    @if (Auth::user()->profileimg)
                        <img src="{{ asset('storage/' . Auth::user()->profileimg) }}"
                            alt="Profile"
                            class="object-cover w-full h-full">
                    @else
                        {{ strtoupper(substr(Auth::user()->firstname ?? 'U', 0, 1)) }}
                    @endif
                </button>

                <!-- Dropdown -->
                <div id="profileDropdown"
                    class="hidden absolute top-12 right-0 w-40 bg-white border border-gray-200 shadow-lg rounded-md z-50">
                    <a href="{{ route('profile.edit', Auth::user()->id) }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-user-edit mr-2"></i> Edit Profile
                    </a>
                    <form method="POST" action="{{ route('auth.logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const button = document.getElementById('profileDropdownButton');
                    const dropdown = document.getElementById('profileDropdown');

                    if (button && dropdown) {
                        button.addEventListener('click', function (e) {
                            dropdown.classList.toggle('hidden');
                            e.stopPropagation();
                        });

                        document.addEventListener('click', function (e) {
                            if (!dropdown.contains(e.target) && !button.contains(e.target)) {
                                dropdown.classList.add('hidden');
                            }
                        });
                    }
                });
            </script>
        @endauth
    </header>
</body>
</html>
