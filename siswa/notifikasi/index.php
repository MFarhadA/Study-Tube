<?php
include '../verificationLogin.php';
include 'listNotifikasi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi | Study Tube</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/Study-Tube/siswa/style.css">
</head>
<body>

    <!-- Sidebar -->
    <div id="sidebar" class="fixed top-0 left-0 h-screen bg-[#40BA6A]"></div>

    <!-- Main Content Area -->
    <div id="mainContent" class="main-content">
        
        <!-- Navbar -->
        <div class="fixed top-0 w-full bg-white z-50 shadow-sm">
            <div class="flex items-center space-x-5 p-2">
                <!-- Sidebar Button -->
                <button id="toggleSidebar" class="btn rounded-lg ring-1 ring-gray-400 bg-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <h1 class="font-poppins font-extrabold text-[#40BA6A] text-xl my-auto">Notifikasi</h1>
            </div>
        </div>
        
        <!-- Content -->
        <div class="container mt-12 p-3">
            <div class="col-rounded-shadow mx-auto p-2 px-3 max-h-[100vh]">
                <div class="font-poppins text-xl mt-2 mb-2 mx-auto">Notifikasi</div>
                <div id="notification" class="overflow-y-auto p-1 px-1 space-y-2 max-h-[80vh]">
                    <?php if ($resultnotifikasi && $resultnotifikasi->num_rows > 0): ?>
                        <?php while ($notifikasi = $resultnotifikasi->fetch_assoc()): ?>
                            <div class="flex rounded-lg ring-1 ring-gray-200 space-x-5 p-2 items-center">
                                <div class="flex-shrink-0 overflow-hidden w-[60px] h-[60px] rounded-full bg-white items-center">
                                    <div class="mx-auto">
                                        <img src="<?php echo $notifikasi['profile_photo']; ?>" class="w-full h-full object-cover">
                                    </div>
                                </div>
                                <h1 class="font-roboto">
                                    <span class="font-normal"><?php echo $notifikasi['message']; ?></span>
                                </h1>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="font-roboto mb-2 font-normal">Tidak ada notifikasi.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    
    </div>

    
    <script src="/Study-Tube/siswa/sidebar/sidebar.js"></script>

</body>
</html>