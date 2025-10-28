<x-layout.admin />

<div class="flex-1 flex flex-col overflow-hidden">
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 px-4 py-4 md:px-8 md:py-8">
        <div class="flex flex-col gap-1">
            <h1 class="font-semibold md:text-lg text-gray-800">Book</h1>
            <div class="flex items-center gap-1">
                <p class="text-xs text-gray-400 md:text-sm">Admin</p>
                <p class="text-xs text-gray-400 md:text-sm">/</p>
                <p class="text-xs text-gray-400 md:text-sm">Book</p>
            </div>
        </div>

        @if (session('success'))
            <div id="alertBox" class="bg-green-600 mt-4 rounded-md px-4 py-3 flex items-center">
                <i class="fas fa-check-circle text-white mr-2"></i>
                <span class="text-white font-medium text-sm">{{ session('success') }}</span>
            </div>
        @elseif (session('error'))
            <div id="alertBox" class="bg-red-600 mt-4 rounded-md px-4 py-3 flex items-center">
                <i class="fas fa-times-circle text-white mr-2"></i>
                <span class="text-white font-medium text-sm">{{ session('error') }}</span>
            </div>
        @endif

             <livewire:admin.author.book />

<!-- JavaScript to manage modal behavior -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Auto-hide alert
        const alertBox = document.getElementById('alertBox');
        if (alertBox) {
            setTimeout(() => {
                alertBox.style.display = 'none';
            }, 3000);
        }

        // Ensure all modals are closed on page load
        document.querySelectorAll('dialog').forEach(dialog => {
            if (dialog.open) {
                dialog.close();
            }
            dialog.removeAttribute('open');
        });

        // Function to open modal
        window.openModal = function(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.showModal();
            } else {
                console.error(`Modal with ID ${modalId} not found`);
            }
        };

        // Remove all existing click event listeners on table rows
        document.querySelectorAll('table tr').forEach(row => {
            const newRow = row.cloneNode(true);
            row.parentNode.replaceChild(newRow, row);
        });

        // Re-attach click event listeners to table rows
        document.querySelectorAll('table tr[onclick]').forEach(row => {
            const onclickAttr = row.getAttribute('onclick');
            row.removeAttribute('onclick');
            row.addEventListener('click', () => {
                eval(onclickAttr);
            });
        });

        // Log for debugging
        console.log('All modals closed on page load');
    });
</script>