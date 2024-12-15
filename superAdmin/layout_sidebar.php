<?php
$current_page = basename($_SERVER['PHP_SELF']); // Mendapatkan nama file saat ini
?>

<!-- Sidebar -->
<div id="sidebar" class="bg-blue-900 text-white w-full lg:w-1/5 h-auto lg:h-screen flex flex-col items-center py-8 hidden lg:flex">
    <div class="bg-white rounded-full p-4 mb-8">
        <i class="fas fa-user text-blue-900 text-4xl"></i>
    </div>
    <div class="flex flex-col space-y-8">
        <a href="index.php" class="p-4 rounded-lg <?= ($current_page == 'index.php') ? 'bg-blue-800' : '' ?>">
            <i class="fas fa-home text-2xl"></i>
            <span class="pl-3 font-bold text-lg">Home</span>
        </a>
        <a href="listadmin.php" class="p-4 rounded-lg <?= ($current_page == 'listadmin.php') ? 'bg-blue-800' : '' ?>">
            <!-- <i class="fas fa-handshake text-2xl"></i> -->
            <i class="fas fa-user-plus text-2xl"></i>
            <span class="pl-3 font-bold text-lg">Manage Admin</span>
        </a>
        <a href="listusers.php" class="p-4 rounded-lg <?= ($current_page == 'listusers.php') ? 'bg-blue-800' : '' ?>">
            <i class="fas fa-user-plus text-2xl"></i>
            <span class="pl-3 font-bold text-lg">Manage Users</span>
        </a>
        <a href="listcategoryscope.php" class="p-4 rounded-lg <?= ($current_page == 'listcategoryscope.php') ? 'bg-blue-800' : '' ?>">
            <i class="fas fa-handshake text-2xl"></i>
            <!-- <i class="fas fa-user-plus text-2xl"></i> -->
            <span class="pl-3 font-bold text-lg">Manage Category Scope</span>
        </a>
    </div>
    <button class="mt-auto bg-blue-800 text-white py-2 px-4 rounded-lg mb-8">
        <a href="logout.php" class="p-4">
            <i class="fas fa-sign-out-alt mr-2"></i>Logout
        </a>
    </button>
</div>