@extends('layouts.user')

@section('title', 'Library App - Edit Profile')

@section('content')
<div class="flex-1 flex flex-col overflow-hidden">
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 px-4 py-6 md:px-10 md:py-8">

        <!-- Breadcrumb -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Edit Profile</h1>
            <p class="text-sm text-gray-500 mt-1">Update your personal information and profile picture</p>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @if ($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ $errors->first() }}',
                    confirmButtonColor: '#ef4444',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3b82f6',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Form Biodata -->
            <form action="{{ route('student.profile.update', $user->id) }}" method="POST" class="bg-white shadow-sm rounded-xl p-8 lg:col-span-2 space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                    <input type="text" name="firstname" value="{{ old('firstname', $user->firstname) }}"
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    @error('firstname')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}"
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    @error('lastname')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}"
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    @error('username')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="text" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    @error('email')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password (Leave blank if not changing)</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    @error('password')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>

                <div class="flex justify-end gap-4 pt-6">
                    <a href="{{ url()->previous() }}"
                        class="px-6 py-3 rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 transition font-medium">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-3 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition font-medium">
                        Save Changes
                    </button>
                </div>
            </form>

            <!-- Form Foto Profil -->
            <div class="bg-white shadow-sm rounded-xl p-8 h-fit lg:order-2">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Profile Picture</h2>
                <div class="divider my-2"></div>
                <div class="flex flex-col items-center gap-6">
                    <!-- Foto Profil -->
                    <div class="avatar">
                        <div class="w-48 h-48 rounded-full overflow-hidden border-2 border-gray-200 flex items-center justify-center bg-gray-100">
                            @if ($user->profileimg)
                                <img id="profilePreview" 
                                    src="{{ asset('storage/' . $user->profileimg) }}" 
                                    alt="Profile" 
                                    class="object-cover w-full h-full">
                            @else
                                <svg id="profilePreview" xmlns="http://www.w3.org/2000/svg" 
                                    class="h-24 w-24 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 
                                    2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 
                                    5v3h20v-3c0-3.3-6.7-5-10-5z"/>
                                </svg>
                            @endif
                        </div>
                    </div>

                    <!-- Form Upload Foto -->
                    <form action="{{ route('student.setting.updateProfileImage') }}" method="POST" enctype="multipart/form-data" class="w-full">
                        @csrf
                        @method('PATCH')
                        <div class="flex flex-col gap-4">
                            <div class="flex flex-col gap-y-2">
                                <input type="file" name="profileimg" accept="image/*"
                                    class="file-input file-input-bordered file-input-sm w-full bg-transparent rounded-lg"
                                    onchange="previewImage(event)" />
                                @error('profileimg')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit"
                                class="px-4 py-3 bg-gray-800 rounded-lg text-white font-medium hover:bg-gray-900 transition w-full">
                                Update Profile Picture
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Script auto-close alert and preview image -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alertBox = document.getElementById('alertBox');
        if (alertBox) {
            setTimeout(() => {
                alertBox.style.display = 'none';
            }, 3000);
        }
    });

    function previewImage(event) {
        const input = event.target;
        const previewContainer = document.querySelector('.avatar .w-48');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const oldSvg = previewContainer.querySelector('svg');
                if (oldSvg) oldSvg.remove();

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
@endsection