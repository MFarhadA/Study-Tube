<?php
include '../verificationLogin.php';
include 'listFavorit.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda | Study Tube</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/Study-Tube/siswa/style.css">
</head>
<body>
    <!-- Sidebar -->
    <div id="sidebar" class="fixed top-0 left-0 h-screen bg-[#40BA6A]">
    </div>

    <!-- Main Content Area -->
    <div id="mainContent" class="main-content bg-white">
        
        <!-- Navbar -->
        <div class="fixed top-0 w-full bg-white z-50 shadow-sm">
            <div class="flex items-center space-x-5 p-2">
                <!-- Sidebar Button -->
                <button id="toggleSidebar" class="btn btn-secondary col-rounded bg-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <h1 class="font-poppins font-extrabold text-[#40BA6A] text-xl my-auto">Favorit</h1>
            </div>
        </div>
        
        <!-- Content -->
        <div class="container mt-12 p-3 my-min px-4 overflow-y-hidden">

            <!-- List Video -->
                <h1 class="font-poppins mb-2 text-xl mt-4">Favorit</h1>

                <div class="container p-2 mb-2">
                    <div class="space-x-2 space-y-3">

                        <!-- Hasil Video -->
                        <div id="containerVideo" class="flex flex-wrap gap-3">
                            <?php if ($resultFavorit && $resultFavorit->num_rows > 0): ?>
                                <?php while ($video = $resultFavorit->fetch_assoc()): ?>
                                    <div
                                        onclick="location.href='/Study-Tube/siswa/tonton/index.php?video=<?php echo urlencode($video['video_path']); ?>&videoID=<?php echo $video['video_id']; ?>'"
                                        class="w-[265px] h-[255px] col-rounded-shadow cursor-pointer p-2"
                                    >
                                        <div class="overflow-hidden w-[250px] h-[140px] rounded-lg bg-white">
                                            <div class="mx-auto item thumbnail">
                                                <img
                                                    src="<?= htmlspecialchars($video['video_thumbnail']) ?>" 
                                                    alt="<?= htmlspecialchars($video['video_title']) ?>"
                                                    class="w-full h-full object-cover"
                                                >
                                            </div>
                                        </div>
                                        <h1 class="font-roboto text-black text-ellipsis overflow-hidden line-clamp-2 mt-2">
                                            <?= htmlspecialchars($video['video_title']) ?>
                                        </h1>
                                        <div class="row mt-2">
                                            <div class="flex space-x-3">
                                                <div class="mx-auto overflow-hidden w-[40px] h-[40px] rounded-full bg-[#40BA6A]">
                                                    <div class="mx-auto">
                                                        <img 
                                                            src="<?= htmlspecialchars($video['guru_photo']) ?>" 
                                                            alt="<?= htmlspecialchars($video['guru_name']) ?>" 
                                                            class="w-full h-full object-cover"
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <h1 class="font-roboto text-gray-400 text-sm truncate overflow-hidden">
                                                        <?= htmlspecialchars($video['guru_name']) ?>
                                                    </h1>
                                                    <h1 class="font-roboto text-gray-400 text-sm truncate overflow-hidden">
                                                        <?= htmlspecialchars($video['video_views']) ?> views
                                                    </h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p class="font-roboto font-normal mb-2 text-l">Belum ada video favorit.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

    
    </div>

    <script src="/Study-Tube/siswa/sidebar/sidebar.js"></script>
    <script src="script.js"></script>

</body>
</html>