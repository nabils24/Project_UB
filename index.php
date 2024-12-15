<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background-image: url('https://i.ibb.co.com/zHwNK1x/fakta-unik-dan-menarik-universitas-brawijaya-1-1.jpg');
            /* Placeholder for background image */
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen bg-blue-900 bg-opacity-50">
    <div class="bg-slate-500 p-8 rounded-lg shadow-lg text-center text-white max-w-md w-full">
        <div class="mb-6">
            <div class="flex justify-center mb-4">
                <img alt="Universitas Brawijaya logo" class="mx-2" height="100" src="https://i.ibb.co.com/m8KX10h/ub-62-km-1.png" width="450" />
            </div>
            <hr class="border-t border-white mb-4">
            <h1 class="text-2xl font-bold text-white">Welcome!</h1>
            <p class="text-sm text-white">Please login with Nomor Induk Mahasiswa(NIM)</p>
        </div>
        <form method="POST" action="ceklogin.php">
            <?php if (isset($_GET['msg'])): ?>
                <div id="notification" class="bg-red-500 text-white p-2 rounded mb-4">
                    <?= $_GET['msg'];  ?>
                </div>
            <?php endif ?>
            <div class="mb-4">
                <div class="flex items-center border border-white rounded p-2">
                    <i class="fas fa-envelope text-white mr-2"></i>
                    <input name="nim" class="bg-transparent text-white w-full focus:outline-none" placeholder="enter your nim" type="text" />
                </div>
            </div>
            <div class="mb-4">
                <div class="flex items-center border border-white rounded p-2 relative">
                    <i class="fas fa-lock text-white mr-2"></i>
                    <input name="password" class="bg-transparent text-white w-full focus:outline-none" id="password" placeholder="enter your password" type="password" />
                    <i class="fas fa-eye text-white absolute right-2 cursor-pointer" id="togglePassword"></i>
                </div>
            </div>
            <!-- <div class="flex items-center mb-4">
                <input class="mr-2" id="stay-logged-in" type="checkbox"/>
                <label class="text-sm text-white" for="stay-logged-in">Stay logged in</label>
            </div> -->
            <button class="bg-gray-800 border border-white text-white py-2 px-4 rounded hover:bg-white hover:text-blue-900 transition" type="submit">SIGN IN</button>
        </form>
    </div>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>