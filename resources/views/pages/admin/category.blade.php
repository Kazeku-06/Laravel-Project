<x-layout.admin />


{{-- @extends('layouts.admin') --}}

    <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 px-4 py-4 md:px-8 md:py-8">
                <div class="flex flex-col gap-1">
                    <h1 class="font-semibold md:text-lg text-gray-800">Category</h1>
                    <div class="flex items-center gap-1">
                        <p class="text-xs text-gray-400 md:text-sm">Admin</p>
                        <p class="text-xs text-gray-400 md:text-sm">/</p>
                        <p class="text-xs text-gray-400 md:text-sm">Category</p>
                    </div>
                </div>


    
    
@if (session('success'))
    <div id="alertBox" role="alert" class="bg-green-600 mt-4 rounded-md px-4 py-3 flex items-center">
        <i class="fas fa-check-circle text-white mr-2"></i>
        <span class="text-white font-medium text-sm">{{ session('success') }}</span>
    </div>
@elseif (session('error'))
    <div id="alertBox" role="alert" class="bg-red-600 mt-4 rounded-md px-4 py-3 flex items-center">
        <i class="fas fa-times-circle text-white mr-2"></i>
        <span class="text-white font-medium text-sm">{{ session('error') }}</span>
    </div>
@endif


        <livewire:admin.author.category />







<script>
    // Saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function () {
        const alertBox = document.getElementById('alertBox');
        if (alertBox) {
            setTimeout(() => {
                alertBox.style.display = 'none';
            }, 2000); // 3000 ms = 3 detik
        }
    });
</script>
