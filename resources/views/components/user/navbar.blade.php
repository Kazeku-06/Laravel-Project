<nav class="bg-white shadow sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    <h1 class="text-lg font-semibold">Library App</h1>

    <ul class="flex items-center gap-4 ml-auto list-none">
      @forelse ($menus as $menu)
        <li
          @class([
            'px-3 py-1 text-sm font-medium transition-all duration-300 rounded hover:bg-gray-200',
            'text-gray-600' => $loggedIn,
            'text-red-600' => !$loggedIn,
          ])
        >
          <a class="text-black-100" href="{{ $menu['href'] }}">{{ $menu['label'] }}</a>
        </li>
      @empty
        <p class="text-sm text-red-600"></p>
      @endforelse

      @if ($loggedIn)
        <li class="flex items-center gap-3 lg:ml-4 relative">
          {{-- Tampilkan nama user --}}
          <p class="text-sm font-medium text-black hidden md:block">
            {{ $user->firstname ?? 'User' }} {{ $user->lastname ?? '' }}
          </p>

         {{-- Tombol avatar --}}
<button id="profileBtn"
    class="w-10 h-10 rounded-full overflow-hidden border border-gray-300 focus:outline-none bg-gray-200 flex items-center justify-center text-gray-800 font-semibold">
    @if ($user->profileimg)
        <img src="{{ asset('storage/' . $user->profileimg) }}"
            alt="Profile"
            class="object-cover w-full h-full">
    @else
        {{ strtoupper(substr($user->firstname ?? 'U', 0, 1)) }}
    @endif
</button>


          {{-- Dropdown menu --}}
         <!-- Profile Dropdown Menu -->
<div id="profileMenu"
    class="hidden absolute right-0 top-14 mt-2 w-48 bg-white border rounded shadow-lg z-50 text-sm text-gray-700 transition ease-out duration-200">

  <a href="{{ route('profile.student', Auth::user()->id) }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-user-edit mr-2"></i> Edit Profile
                    </a>


    {{-- Logout --}}
    <form method="POST" action="/logout">
        @csrf
        <button type="submit"
            class="w-full text-left px-4 py-2 hover:bg-gray-100 transition-all duration-150">
            🚪 Logout
        </button>
    </form>
</div>
        
      @else
        <li class="mt-4 flex flex-col gap-4 md:flex-row md:items-center lg:mt-0 lg:ml-4">
          <a href="/login"
            class="px-3 py-2 border border-gray-800 rounded text-xs font-medium block w-full transition-all duration-300 hover:bg-gray-800 hover:text-white lg:text-sm">
            Login
          </a>
          <a href="/register"
            class="px-3 py-2 bg-gray-800 rounded text-xs font-medium text-white block w-full lg:text-sm">
            Register
          </a>
        </li>
      @endif
    </ul>

    <button class="md:hidden text-xl" id="navButton">
      <i class="fas fa-bars"></i>
    </button>
  </div>

  {{-- Responsive dropdown --}}
  <div class="hidden px-6 pb-4 flex-col gap-3 md:hidden" id="navMenu">
    <a href="#" class="block py-1 font-medium hover:text-blue-600">Home</a>
    <a href="#" class="block py-1 font-medium hover:text-blue-600">Books</a>

    @if (!$loggedIn)
      <a href="/login"
        class="px-4 py-1 border border-gray-800 rounded text-sm hover:bg-gray-800 hover:text-white transition block text-center">
        Login
      </a>
      <a href="/register"
        class="px-4 py-1 mt-2 bg-gray-800 text-white rounded text-sm hover:bg-gray-700 transition block text-center">
        Register
      </a>
    @endif
  </div>
</nav>

{{-- Toggle script --}}
<script>
  const profileBtn = document.getElementById('profileBtn');
  const profileMenu = document.getElementById('profileMenu');

  document.addEventListener('click', function (e) {
    if (profileBtn.contains(e.target)) {
      profileMenu.classList.toggle('hidden');
    } else {
      if (!profileMenu.contains(e.target)) {
        profileMenu.classList.add('hidden');
      }
    }
  });
</script>
