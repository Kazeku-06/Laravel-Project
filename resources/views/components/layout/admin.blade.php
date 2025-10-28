@props(['title' => 'Dashboard', 'stats' => []])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    
    @vite('resources/css/app.css')
</head>
<body>

    <x-admin.navbar />


        <x-admin.sidebar />





  <div class="mt-6 grid grid-cols-2 gap-y-4 gap-x-2 md:grid-cols-4 md:gap-x-4">
    @foreach ($stats as $stat)
        <div class="px-4 py-5 rounded bg-white border border-gray-200">
            <p class="font-medium text-sm">{{ $stat['judul'] }}</p>
            <hr class="w-full bg-gray-200 my-2">
            <p class="font-semibold text-xl">{{ $stat['jumlah'] }}</p>
        </div>
    @endforeach
</div>


    <script>
        document.getElementById('menuButton')?.addEventListener('click', () => {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>

</body>
</html>


