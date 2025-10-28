@extends('layouts.user')

@section('title', 'Library App - Home')

@section('content')

{{-- Alerts --}}
  @if (session('success'))
    <div class="max-w-7xl mx-auto px-6 mt-4">
      <div class="bg-green-50 border border-green-400 text-green-700 px-4 py-3 rounded-md shadow-sm">
        {{ session('success') }}
      </div>
    </div>
  @endif

  @if (session('error'))
    <div class="max-w-7xl mx-auto px-6 mt-4">
      <div class="bg-red-50 border border-red-400 text-red-700 px-4 py-3 rounded-md shadow-sm">
        {{ session('error') }}
      </div>
    </div>
  @endif

  {{-- Table --}}
  <main class="max-w-7xl mx-auto px-6 py-10">
    <div class="mb-6">
      <h2 class="text-3xl font-semibold text-gray-800">📖 Riwayat Peminjaman</h2>
      <p class="text-gray-500 text-sm mt-1">Berikut daftar peminjaman buku Anda.</p>
    </div>

    <div class="bg-white shadow rounded-lg overflow-x-auto border">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-700 uppercase">
          <tr>
            <th class="px-6 py-3">#</th>
            <th class="px-6 py-3">Nama</th>
            <th class="px-6 py-3">Buku yang Dipinjam</th>
            <th class="px-6 py-3">Catatan</th>
            <th class="px-6 py-3">Denda</th>
            <th class="px-6 py-3">Status</th>
            <th class="px-6 py-3">Aksi</th>
          </tr>
        </thead>
        <tbody class="text-sm divide-y divide-gray-100">
          @forelse ($borrowings as $index => $borrowing)
            <tr class="hover:bg-gray-50 transition">
              <td class="px-6 py-4">{{ $index + 1 }}</td>
              <td class="px-6 py-4 font-medium text-gray-800">
                {{ $borrowing->user->firstname }} {{ $borrowing->user->lastname }}
              </td>
              <td class="px-6 py-4 text-gray-700">
                
                  @foreach ($borrowing->details as $detail)
                    {{ $detail->book->book_name }}
                  @endforeach
                
              </td>
              <td class="px-6 py-4 text-gray-600">
                {{ $borrowing->borrowing_notes ?? '-' }}
              </td>
              <td class="px-6 py-4 text-gray-700">
                Rp{{ number_format($borrowing->borrowing_fine ?? 0, 0, ',', '.') }}
              </td>
              <td class="px-6 py-4">
                @if ($borrowing->borrowing_isreturned)
                  <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                    ✔️ Dikembalikan
                  </span>
                @else
                  <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                    ⏳ Dipinjam
                  </span>
                @endif
              </td>
              <td class="px-6 py-4">
                @if (!$borrowing->borrowing_isreturned)
                  <form method="POST"
                        action="{{ route('user.borrowings.cancel', $borrowing->borrowing_id) }}"
                        onsubmit="return confirm('Apakah kamu yakin ingin membatalkan peminjaman ini?')">
                    @csrf
                    <button type="submit"
                            class="inline-block px-4 py-1.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-md transition">
                      Cancel
                    </button>
                  </form>
                @else
                  <span class="text-gray-400 text-sm">-</span>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                Belum ada peminjaman.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </main>

  {{-- Script --}}
  <script>
    const profileBtn = document.getElementById('profileBtn');
    const profileMenu = document.getElementById('profileMenu');

    document.addEventListener('click', function (e) {
      if (profileBtn?.contains(e.target)) {
        profileMenu.classList.toggle('hidden');
      } else if (!profileMenu?.contains(e.target)) {
        profileMenu?.classList.add('hidden');
      }
    });
  </script>

</body>
</html>




@endsection