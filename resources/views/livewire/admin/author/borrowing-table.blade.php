<div>
    <div class="bg-white shadow-md rounded-lg p-6 mt-10">
        <h2 class="text-base font-semibold mb-4 text-gray-700">📖 Daftar Peminjaman</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-6 py-4 rounded-lg mb-6 shadow-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <input
                type="search"
                placeholder="Search Student borrowing by student name"
                wire:model.live.debounce.250ms="searchStudent"
                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
            >

            <br><br>

            <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                <thead class="bg-gray-50">
                    <tr class="text-gray-700 font-semibold text-xs uppercase tracking-wider">
                        <th class="px-4 py-3">Student Name</th>
                        <th class="px-4 py-3">Book</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Borrow date</th>
                        <th class="px-4 py-3">Denda</th>
                        <th class="px-4 py-3">Notes</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($borrowings as $borrowing)
                        <tr class="hover:bg-gray-50 cursor-pointer">
                            <td class="px-4 py-3">{{ $borrowing->user->firstname }} {{ $borrowing->user->lastname }}</td>
                            <td class="px-4 py-3">
                                <ul class="list-disc list-inside">
                                    @foreach($borrowing->details as $detail)
                                        {{ $detail->book->book_name ?? '-' }}
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-4 py-3">
                                <span class="{{ $borrowing->borrowing_isreturned ? 'text-green-700' : 'text-red-700' }} font-semibold">
                                    {{ $borrowing->borrowing_isreturned ? 'Returned' : 'Not Returned' }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ $borrowing->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3">
                                Rp {{ number_format($borrowing->fine, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3">
                                <form method="POST" action="{{ route('admin.borrowings.update', $borrowing->borrowing_id) }}" class="flex flex-col gap-2">
                                    @csrf
                                    <textarea name="borrowing_notes" class="w-72 h-20 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition">{{ $borrowing->borrowing_notes }}</textarea>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <button type="button"
                                        wire:click="showDetails('{{ $borrowing->borrowing_id }}')"
                                        class="min-w-[110px] bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-800 transition font-medium">
                                        Lihat Detail
                                    </button>
                                    <button type="submit"
                                        class="min-w-[110px] bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-800 focus:outline-none focus:ring-1 focus:ring-blue-500 transition font-medium">
                                        Simpan
                                    </button>
                                </div>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-600 font-medium">Borrowing data not found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($showModal && $selectedBorrowing)
        <!-- Popup tanpa background -->
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="bg-white border border-gray-200 shadow-2xl rounded-xl p-6 w-full max-w-lg mx-auto relative animate-[fadeIn_0.3s_ease-out_forwards]">
                <!-- Tombol close -->
                <button wire:click="$set('showModal', false)"
                    class="absolute top-3 right-3 text-gray-400 hover:text-red-500 text-xl font-bold focus:outline-none">
                    ✖
                </button>

                <!-- Judul -->
                <h2 class="text-xl font-bold mb-4 text-gray-800">📋 Detail Peminjaman</h2>

                <!-- Info Siswa -->
                <div class="space-y-2 text-gray-700 text-sm">
                    <div class="grid grid-cols-2 gap-y-1">
                        <p><strong>👤 Nama Siswa:</strong></p>
                        <p>{{ $selectedBorrowing->user->firstname }} {{ $selectedBorrowing->user->lastname }}</p>

                        <p><strong>📅 Tanggal Pinjam:</strong></p>
                        <p>{{ $selectedBorrowing->created_at->format('d M Y H:i') }}</p>

                        <p><strong>📦 Tanggal Pengembalian:</strong></p>
                        <p>
                            @if($selectedBorrowing->borrowing_isreturned)
                                {{ $selectedBorrowing->updated_at->format('d M Y H:i') }}
                            @else
                                <span class="text-red-500 font-semibold">Belum dikembalikan</span>
                            @endif
                        </p>
                    </div>

                    <!-- Buku -->
                    <div class="mt-4">
                        <strong>📚 Buku yang Dipinjam:</strong>
                        <div class="bg-gray-50 border border-gray-200 rounded-md p-3 mt-1">
                            <ul class="list-disc list-inside text-gray-700">
                                @foreach($selectedBorrowing->details as $detail)
                                    <li>{{ $detail->book->book_name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Tombol Tandai Selesai -->
                    @if(!$selectedBorrowing->borrowing_isreturned)
                        <div class="mt-6 flex justify-end">
                            <button wire:click="markAsReturned('{{ $selectedBorrowing->borrowing_id }}')"
                                class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition font-medium">
                                Tandai Selesai
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>

