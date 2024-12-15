<?php
require 'functions.php';
require 'layout_header.php';

$jusers = ambilsatubaris($conn, 'SELECT COUNT(uuid) as jumlahusers FROM users');
$usersDt = ambildata($conn, 'SELECT * FROM users WHERE role IN ("admin");');
?>

<!-- Main Content -->
<div class="flex-1 p-8">
    <div class="bg-blue-900 text-white p-6 rounded-lg mb-8 hidden lg:block">
        <h1 class="text-2xl font-bold">List Admin</h1>
        <p>Manage all admin</p>
    </div>

    <div class="flex flex-col lg:flex-row space-y-8 lg:space-y-0 lg:space-x-8">
        <!-- Table -->
        <div class="overflow-x-auto w-full">
            <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg">
                <thead class="bg-blue-900 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Id</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Password</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Time Added</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Row -->
                    <?php $no = 1;
                    if (@$usersDt) {
                        foreach ($usersDt as $user) : ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><?= $no ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?= $user['username'] ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?= $user['id'] ?></td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    <?= str_repeat('*', strlen($user['password'])) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap"><?= $user['role'] ?></td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    <?= date('d M Y, H:i', strtotime($user['created_at'])) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button onclick="openEditModal('<?= $user['uuid'] ?>', '<?= $user['username'] ?>', '<?= $user['id'] ?>', '<?= $user['password'] ?>', '<?= $user['role'] ?>')"
                                        class="text-white bg-green-500 hover:bg-green-600 px-4 py-2 rounded">Edit</button>
                                    <button onclick="confirmDelete('<?= $user['uuid'] ?>')" class="text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded">Delete</button>
                                </td>
                            </tr>
                    <?php $no++;
                        endforeach;
                    } ?>
                </tbody>
            </table>
            <!-- Add User Button -->
            <div class="flex justify-end mt-4 mb-4">
                <button onclick="openaddModal()" class="bg-blue-900 hover:bg-blue-500 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                    Add User
                </button>
            </div>

        </div>
    </div>
</div>

<!-- Add Modal -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div id="addModalContent"
        class="bg-white p-8 rounded-lg shadow-lg w-1/3 transform transition duration-500 ease-in-out translate-y-[-100px] opacity-0">

        <h2 class="text-2xl font-bold mb-4">Add Admin</h2>

        <!-- Display error message if 'error=empty_fields' is in URL -->
        <?php if (isset($_GET['error']) && $_GET['error'] === 'empty_fields'): ?>
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                <strong>Error:</strong> All fields are required!
            </div>
        <?php endif; ?>

        <form action="add_admin.php" method="POST">
            <input type="hidden" id="Adduuid" name="add_uuid">
            <div class="mb-4">
                <label for="AddID" class="block text-sm font-medium text-gray-700">ID</label>
                <input type="text" id="AddID" name="add_id"
                    class="mt-1 p-2 border border-gray-300 rounded w-full" required>
            </div>
            <div class="mb-4">
                <label for="AddUsername" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="AddUsername" name="add_username"
                    class="mt-1 p-2 border border-gray-300 rounded w-full" required>
            </div>
            <div class="mb-4">
                <label for="AddPassword" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="text" id="AddPassword" name="add_password"
                    class="mt-1 p-2 border border-gray-300 rounded w-full">
            </div>
            <div class="mb-4">
                <label for="AddRole" class="block text-sm font-medium text-gray-700">Role</label>
                <select id="AddRole" name="add_role"
                    class="mt-1 p-2 border border-gray-300 rounded w-full">
                    <option value="admin">Admin</option>
                    <!-- <option value="superAdmin">Super Admin</option> -->
                </select>
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeaddModal()"
                    class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div id="editModalContent"
        class="bg-white p-8 rounded-lg shadow-lg w-1/3 transform transition duration-500 ease-in-out translate-y-[-100px] opacity-0">

        <h2 class="text-2xl font-bold mb-4">Edit Admin</h2>

        <!-- Display error message if 'error=empty_fields' is in URL -->
        <?php if (isset($_GET['error']) && $_GET['error'] === 'empty_fields'): ?>
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                <strong>Error:</strong> All fields are required!
            </div>
        <?php endif; ?>

        <form action="edit_admin.php" method="POST">
            <input type="hidden" id="editUuid" name="edit_uuid">
            <div class="mb-4">
                <label for="editID" class="block text-sm font-medium text-gray-700">ID</label>
                <input type="text" id="editID" name="edit_id"
                    class="mt-1 p-2 border border-gray-300 rounded w-full" required>
            </div>
            <div class="mb-4">
                <label for="editUsername" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="editUsername" name="edit_username"
                    class="mt-1 p-2 border border-gray-300 rounded w-full" required>
            </div>
            <div class="mb-4">
                <label for="editPassword" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="text" id="editPassword" name="edit_password"
                    class="mt-1 p-2 border border-gray-300 rounded w-full">
            </div>
            <div class="mb-4">
                <label for="editRole" class="block text-sm font-medium text-gray-700">Role</label>
                <select id="editRole" name="edit_role"
                    class="mt-1 p-2 border border-gray-300 rounded w-full">
                    <option value="admin">Admin</option>
                    <!-- <option value="superAdmin">Super Admin</option> -->
                </select>
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeEditModal()"
                    class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
            </div>
        </form>
    </div>
</div>



<script>
    function openaddModal() {
        const modal = document.getElementById('addModal');
        const modalContent = document.getElementById('addModalContent');

        modal.classList.remove('hidden');
        modalContent.classList.remove('translate-y-[-100px]', 'opacity-0');
        modalContent.classList.add('translate-y-0', 'opacity-100');
    }

    function closeaddModal() {
        const modal = document.getElementById('addModal');
        const modalContent = document.getElementById('addModalContent');

        modalContent.classList.remove('translate-y-0', 'opacity-100');
        modalContent.classList.add('translate-y-[-100px]', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 500);
    }

    function openEditModal(uuid, username, id, password, role) {
        document.getElementById('editUuid').value = uuid;
        document.getElementById('editID').value = id;
        document.getElementById('editUsername').value = username;
        document.getElementById('editRole').value = role;

        const modal = document.getElementById('editModal');
        const modalContent = document.getElementById('editModalContent');

        modal.classList.remove('hidden');
        modalContent.classList.remove('translate-y-[-100px]', 'opacity-0');
        modalContent.classList.add('translate-y-0', 'opacity-100');
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        const modalContent = document.getElementById('editModalContent');

        modalContent.classList.remove('translate-y-0', 'opacity-100');
        modalContent.classList.add('translate-y-[-100px]', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 500);
    }

    function confirmDelete(uuid) {
        if (confirm("Are you sure you want to delete this user?")) {
            window.location.href = 'delete_admin.php?uuid=' + uuid;
        }
    }

    function showNotification() {
        const urlParams = new URLSearchParams(window.location.search);
        const success = urlParams.get('success');
        const error = urlParams.get('error');
        const warning = urlParams.get('warning');
        if (success) {
            toastr.success(success, 'Notification', {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: 5000
            });
        } else if (error) {
            toastr.error(error, 'Notification', {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: 5000
            });
        } else if (warning) {
            toastr.warning(warning, 'Notification', {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: 5000
            });
        }

    }

    window.onload = showNotification;
</script>

</div>
<?php
require 'layout_sidebar_mobile.php';
?>
</body>

</html>