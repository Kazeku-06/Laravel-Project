<x-layout.admin />
<div class="flex-1 flex flex-col overflow-hidden">
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 px-4 py-4 md:px-8 md:py-8">

        <!-- Breadcrumb -->
        <div class="flex flex-col gap-1 mb-6">
            <h1 class="font-semibold text-lg text-gray-800">Edit Profil</h1>
            <div class="flex items-center gap-1 text-sm text-gray-500">
                <span>Admin</span>
                <span>/</span>
                <span>Profil</span>
            </div>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div id="alertBox" class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Form Biodata -->
            <form action="{{ route('profile.update', $user->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-5 lg:col-span-2">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" name="firstname" value="{{ old('firstname', $user->firstname) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
                    @error('firstname')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
                    @error('lastname')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password (leave blank if not change)</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Repeat Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ url()->previous() }}"
                        class="px-4 py-2 rounded-md border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

            <!-- Form Foto Profil -->
            <div class="card w-full bg-white shadow rounded-md h-fit lg:order-2">
                <div class="px-4 py-4">
                    <h2 class="font-medium text-sm md:text-base">Personal Profile</h2>
                    <div class="divider mt-1 mb-2"></div>
                    <div class="flex flex-col items-center gap-4">

                        <!-- Foto Profil -->
                        <div class="avatar">
                            <div class="w-40 h-40 rounded-full overflow-hidden border-2 border-gray-300 flex items-center justify-center bg-gray-100">
                                @if ($user->profileimg)
                                    <img id="profilePreview" 
                                        src="{{ asset('storage/' . $user->profileimg) }}" 
                                        alt="Profile" 
                                        class="object-cover w-full h-full">
                                @else
                                    <svg id="profilePreview" xmlns="http://www.w3.org/2000/svg" 
                                        class="h-20 w-20 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 
                                        2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 
                                        5v3h20v-3c0-3.3-6.7-5-10-5z"/>
                                    </svg>
                                @endif
                            </div>
                        </div>

                        <!-- Form Upload Foto -->
                        <form action="{{ route('admin.settings.updateProfileImage') }}" method="POST" enctype="multipart/form-data" class="w-full">
                            @csrf
                            @method('PATCH')
                            <div class="flex flex-col gap-4">
                                <div class="flex flex-col gap-y-2">
                                    <input type="file" name="profileimg" accept="image/*"
                                        class="file-input file-input-bordered file-input-sm w-full bg-transparent"
                                        onchange="previewImage(event)" />
                                    @error('profileimg')
                                        <span class="text-sm text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit"
                                    class="px-3 py-2 bg-gray-800 rounded text-sm text-white font-medium block w-full transition-all duration-300">
                                    Update Personal Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </main>
</div>

<!-- Script auto-close alert -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alertBox = document.getElementById('alertBox');
        if (alertBox) {
            setTimeout(() => {
                alertBox.style.display = 'none';
            }, 3000);
        }
    });

    // Preview Foto Profil
    function previewImage(event) {
        const input = event.target;
        const previewContainer = document.querySelector('.avatar .w-40');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Hapus SVG jika ada
                const oldSvg = previewContainer.querySelector('svg');
                if (oldSvg) oldSvg.remove();

                // Cek apakah sudah ada img
                let img = previewContainer.querySelector('img');
                if (!img) {
                    img = document.createElement('img');
                    img.classList.add('object-cover', 'w-full', 'h-full');
                    previewContainer.appendChild(img);
                }
                img.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
