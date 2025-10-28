<x-layout.admin />
<div class="flex-1 flex flex-col overflow-hidden">
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 px-4 py-4 md:px-8 md:py-8">
        <div class="flex flex-col gap-1">
            <h1 class="font-semibold md:text-lg text-gray-800">Borrowing</h1>
            <div class="flex items-center gap-1">
                <p class="text-xs text-gray-400 md:text-sm">Admin</p>
                <p class="text-xs text-gray-400 md:text-sm">/</p>
                <p class="text-xs text-gray-400 md:text-sm">Borrowing</p>
            </div>
        </div>




             <livewire:admin.author.borrowing-table />


 <style>
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}
</style>
