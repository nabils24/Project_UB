<div id="sidebar-mobile" class="bg-blue-900 text-white w-full h-screen fixed top-0 left-0 z-50 hidden lg:hidden">
    <div class="flex flex-col items-center py-8">
        <div class="bg-white rounded-full p-4 mb-8">
            <i class="fas fa-user text-blue-900 text-4xl"></i>
        </div>
        <div class="flex flex-col space-y-8">
            <a href="#" class="bg-blue-800 p-4 rounded-lg">
                <i class="fas fa-home text-2xl"></i>
            </a>
            <a href="#" class="p-4">
                <i class="fas fa-handshake text-2xl"></i>
            </a>
            <a href="#" class="p-4">
                <i class="fas fa-file-alt text-2xl"></i>
            </a>
        </div>
        <button class="mt-auto bg-blue-800 text-white py-2 px-4 rounded-lg mb-8">
            <i class="fas fa-sign-out-alt mr-2"></i>Logout
        </button>
    </div>
</div>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar-mobile');
        sidebar.classList.toggle('hidden');
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>