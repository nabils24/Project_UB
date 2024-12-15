<?php
require 'functions.php';
require 'layout_header.php';

$jusers = ambilsatubaris($conn, 'SELECT COUNT(uuid) as jumlahusers FROM users');
$usersDt = ambildata($conn, 'SELECT * FROM users WHERE role IN ("admin");');
?>
<!-- Main Content -->
<div class="flex-1 p-8">
    <div class="bg-blue-900 text-white p-6 rounded-lg mb-8 hidden lg:block">
        <h1 class="text-2xl font-bold">SUPER ADMIN DASHBOARD</h1>
        <p>Manage admin in here</p>
    </div>
    <div class="flex flex-col lg:flex-row space-y-8 lg:space-y-0 lg:space-x-8">

        <!-- List Users -->
        <div class="bg-white p-6 rounded-lg shadow-lg w-full lg:w-1/2">
            <h2 class="text-blue-900 text-xl font-bold mb-4">LIST USERS</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm leading-4 text-blue-900 font-semibold uppercase">Username</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm leading-4 text-blue-900 font-semibold uppercase">Id</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm leading-4 text-blue-900 font-semibold uppercase">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        if (@$usersDt) {
                            foreach ($usersDt as $user) : ?>
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-200"><?= $user['username'] ?></td>
                                    <td class="py-2 px-4 border-b border-gray-200"><?= $user['id'] ?></td>
                                    <td class="py-2 px-4 border-b border-gray-200"><?= $user['role'] ?></td>
                                </tr>
                        <?php endforeach;
                        } ?>
                    </tbody>
                </table>
            </div>
            <button class="bg-blue-900 text-white py-2 px-4 rounded mt-4"><a href="listuser.php" class="p-4">
                    <span class="font-bold text-sm">SEE ALL</span>
                </a></button>
        </div>
    </div>
</div>
</div>
<?php
require 'layout_sidebar_mobile.php';
?>
</body>

</html>