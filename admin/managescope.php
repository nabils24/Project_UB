<?php
require 'functions.php';
require 'layout_header.php';

$jusers = ambilsatubaris($conn, 'SELECT COUNT(uuid) as jumlahusers FROM users');
$usersDt = ambildata($conn, 'SELECT * FROM users WHERE role IN ("admin");');
?>

<!-- Main Content -->
<div class="flex-1 p-8">
    <div class="bg-blue-900 text-white p-6 rounded-lg mb-8 hidden lg:block">
        <h1 class="text-2xl font-bold">List Scope</h1>
        <p>Add, display, edit, and delete scope data here</p>
    </div>

    <div class="bg-white p-4 rounded-md shadow-md w-full">
        <div class="flex items-center space-x-4 mb-4">
            <button id="scope-button" class="px-4 py-2 bg-white text-black border-b-4 border-black rounded-md" onclick="showSection('scope')">Scope</button>
            <button id="partnership-button" class="px-4 py-2 bg-white text-black border-b-4 border-black rounded-md" onclick="showSection('partnership')">Partnership</button>
            <button class="px-4 py-2 bg-blue-900 text-white rounded-md">Add New</button>
        </div>
        <div id="scope-section">
            <table class="w-full text-left">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Scope</th>
                        <th class="py-2 px-4 border-b">Amount of Partner</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border-b">Pendidikan dan Pengajaran</td>
                        <td class="py-2 px-4 border-b">7</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="partnership-section" style="display: none;">
            <table class="w-full text-left">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Logo</th>
                        <th class="py-2 px-4 border-b">Name of Partner</th>
                        <th class="py-2 px-4 border-b">Penanggungjawab</th>
                        <th class="py-2 px-4 border-b">Alamat</th>
                        <th class="py-2 px-4 border-b">Additional Information</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border-b">Partnership Example</td>
                        <td class="py-2 px-4 border-b">Details of Partnership</td>
                        <td class="py-2 px-4 border-b">Nabils</td>
                        <td class="py-2 px-4 border-b">Jalan Kembar 2</td>
                        <td class="flex justify-end px-6 py-4 border-b">
                            <button class="text-white bg-slate-300 hover:bg-slate-700 px-4 py-2 rounded">See</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>





<script>
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