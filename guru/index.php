<?php
    include 'dataPengikut.php';
    include 'dataRating.php';
    include 'dataVideo.php';
    include 'dataModul.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Study Tube</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
                <h1 class="font-poppins font-extrabold text-[#40BA6A] text-xl my-auto">Dashboard</h1>
            </div>
        </div>
        
        <!-- Content -->
        <div class="container mt-12 p-3">
            <div class="flex flex-row h-[90vh] space-x-4">

                <!-- Bagian Kiri -->
                <div class="flex flex-row space-x-2">

                    <!-- Pengikut -->
                    <div class="col-rounded-shadow p-3 flex-auto">
                        <h1 class="font-poppins text-xl mx-auto line-clamp-1 mb-3">Pengikut</h1>

                        <p class="font-roboto font-normal text-lg mx-auto line-clamp-1">total pengikut</p>
                        <h1 class="font-poppins text-4xl mx-auto line-clamp-1 rounded-lg ring-1 ring-gray-200 p-2">
                            <?php echo $resultPengikut->num_rows; ?>
                        </h1>

                        <p class="font-roboto font-normal text-lg mx-auto line-clamp-1 mb-2">list pengikut</p>
                        <div id="list-pengikut" class="flex flex-col space-y-3 overflow-auto max-h-[calc(100%-180px)] p-1">
                            <?php if ($resultPengikut && $resultPengikut->num_rows > 0): ?>
                                <?php while ($pengikut = $resultPengikut->fetch_assoc()): ?>
                                    <div class="flex items-center rounded-lg ring-1 ring-gray-200 p-2" title="<?= htmlspecialchars($pengikut['pengikut_nama_murid']); ?>">
                                        <div class="flex-shrink-0 overflow-hidden w-[50px] h-[50px] rounded-full bg-white items-center mr-3">
                                            <div class="mx-auto">
                                                <img id="profilePhoto" src="<?= htmlspecialchars($pengikut['pengikut_foto_profil_murid']); ?>">
                                            </div>
                                        </div>
                                        <p class="text-lg font-roboto font-normal line-clamp-1"><?= htmlspecialchars($pengikut['pengikut_nama_murid']); ?></p>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p class="text-lg font-roboto font-normal">Belum ada pengikut.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Rating -->

                    <div class="col-rounded-shadow p-3 flex-auto">
                        <h1 class="font-poppins text-xl mx-auto line-clamp-1 mb-3">Rating</h1>

                        <p class="font-roboto font-normal text-lg mx-auto line-clamp-1">Total Rating</p>
                        <h1 class="font-poppins text-4xl mx-auto line-clamp-1 rounded-lg ring-1 ring-gray-200 p-2">
                            <?php 
                            // Hitung rata-rata rating jika ada data
                            if ($resultRating && $resultRating->num_rows > 0) {
                                $totalScore = 0;
                                $numRatings = 0;
                                while ($row = $resultRating->fetch_assoc()) {
                                    $totalScore += $row['skor_rating'];
                                    $numRatings++;
                                }
                                echo number_format($totalScore / $numRatings, 1); // Rata-rata dengan 1 angka desimal
                                $resultRating->data_seek(0); // Reset pointer hasil query untuk digunakan lagi
                            } else {
                                echo "0.0";
                            }
                            ?>
                        </h1>
                        <p class="font-roboto font-normal text-lg mx-auto line-clamp-1 mb-2">List Rating</p>
                        <div id="list-rating" class="flex flex-col space-y-3 overflow-auto max-h-[calc(100%-180px)] p-1">
                            <?php if ($resultRating && $resultRating->num_rows > 0): ?>
                                <?php while ($rating = $resultRating->fetch_assoc()): ?>
                                    <div class="flex items-center rounded-lg ring-1 ring-gray-200 p-2" title="<?= htmlspecialchars($rating['rating_nama_murid']); ?>">
                                        <div class="flex-shrink-0 overflow-hidden w-[50px] h-[50px] rounded-full bg-white items-center mr-3">
                                            <div class="mx-auto">
                                                <img id="profilePhoto" src="<?= htmlspecialchars($rating['rating_foto_profil_murid']); ?>" alt="Foto Profil">
                                            </div>
                                        </div>
                                        <div class="flex flex-col text-left -space-y-2">
                                            <p class="text-lg font-roboto font-normal line-clamp-1"><?= htmlspecialchars($rating['rating_nama_murid']); ?></p>
                                            <div class="flex flex-row text-[#FFCC00]">
                                                <?php 
                                                // Tampilkan bintang berdasarkan rating_score
                                                for ($i = 1; $i <= 5; $i++): 
                                                    if ($i <= $rating['skor_rating']): ?>
                                                        <span>&#9733;</span> <!-- Bintang aktif -->
                                                    <?php else: ?>
                                                        <span class="text-gray-300">&#9733;</span> <!-- Bintang tidak aktif -->
                                                    <?php endif; 
                                                endfor; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p class="text-lg font-roboto font-normal">Belum ada rating.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

                <!-- Bagian Kanan -->
                <div class="flex flex-row flex-auto space-x-4">

                    <!-- Video -->

                        <div class="col-rounded-shadow p-2 px-3 w-full">
                            <h1 class="font-poppins text-xl mx-auto line-clamp-1 p-2 mb-2">Video</h1>
                            <div id="list-video" class="flex flex-col space-y-3 overflow-auto max-h-[calc(100%-75px)] p-1">

                                <?php if ($resultVideo && $resultVideo->num_rows > 0): ?>
                                    <?php while ($video = $resultVideo->fetch_assoc()): ?>
                                        <div onclick="location.href=/Study-Tube/siswa/tonton/index.php?" class="w-full h-auto rounded-lg ring-1 ring-gray-200 py-2 px-3 cursor-pointer">
                                            <p class="font-roboto text-black text-ellipsis line-clamp-2 mb-1">
                                                <?= htmlspecialchars($video['title']); ?>
                                            </p>
                                            <div class="flex items-center space-x-3">
                                                <!-- Thumbnail -->
                                                <div class="overflow-hidden w-[125px] h-[70px] bg-white flex items-center justify-center">
                                                    <div class="mx-auto item thumbnail">
                                                        <img src="<?= htmlspecialchars($video['thumbnail']); ?>" alt="" class="object-cover">
                                                    </div>
                                                </div>
                                                <!-- Title and Details -->
                                                <div class="flex-1">
                                                    <!-- Title -->
                                                    
                                                    <!-- Views and Koin -->
                                                    <div class="flex justify-between items-center">
                                                        <div>
                                                            <h1 class="font-roboto font-normal text-black text-sm truncate overflow-hidden">Views</h1>
                                                            <h1 class="font-roboto font-normal text-black text-sm truncate overflow-hidden">Koin</h1>
                                                        </div>
                                                        <div class="text-right">
                                                            <h1 class="font-roboto font-normal text-black text-sm truncate overflow-hidden"><?= htmlspecialchars($video['views']); ?></h1>
                                                            <h1 class="font-roboto font-normal text-black text-sm truncate overflow-hidden">1</h1>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <p class="text-lg font-roboto font-normal">Belum ada video tersedia.</p>
                                <?php endif; ?>

                            </div>
                        </div>


                    <!-- Modul -->

                        <div class="col-rounded-shadow p-2 px-3 w-full">
                            <h1 class="font-poppins text-xl mx-auto line-clamp-1 p-2 mb-2">Modul</h1>
                            <div id="list-modul" class="flex flex-col space-y-3 overflow-auto max-h-[calc(100%-75px)] p-1">
                            
                            <?php if ($resultModul && $resultModul->num_rows > 0): ?>
                                <?php while ($modul = $resultModul->fetch_assoc()): ?>
                                    <?php
                                        // Menentukan background color berdasarkan file extension
                                        $file = htmlspecialchars($modul['modul']);
                                        if (strpos($file, '.pdf') !== false) {
                                            $bgColor = 'bg-[#D9534F]'; // Warna untuk PDF
                                        } elseif (strpos($file, '.docx') !== false || strpos($file, '.doc') !== false) {
                                            $bgColor = 'bg-[#0078D4]'; // Warna untuk DOC dan DOCX
                                        } elseif (strpos($file, '.pptx') !== false || strpos($file, '.ppt') !== false) {
                                            $bgColor = 'bg-[#FF8C00]'; // Warna untuk PPT dan PPTX
                                        } else {
                                            $bgColor = 'bg-[#CCCCCC]'; // Warna default jika tidak ada ekstensi yang cocok
                                        }
                                    ?>
                                    <div onclick="location.href=/Study-Tube/siswa/tonton/index.php?" class="w-full h-auto rounded-lg ring-1 ring-gray-200 py-2 px-3 cursor-pointer items-center">
                                        <div class="flex flex-1 overflow-hidden rounded-lg mt-1 <?= $bgColor ?> px-2 py-1">
                                            <p class="font-roboto text-white text-ellipsis line-clamp-1 pl-2"><?= htmlspecialchars($modul['title']); ?></p>
                                        </div>
                                        <div class="flex flex-1 justify-between items-center mt-1">
                                            <div>
                                                <h1 class="font-roboto font-normal text-black text-sm truncate overflow-hidden">Unduhan</h1>
                                                <h1 class="font-roboto font-normal text-black text-sm truncate overflow-hidden">Koin</h1>
                                            </div>
                                            <div class="text-right">
                                                <h1 class="font-roboto font-normal text-black text-sm truncate overflow-hidden"><?= htmlspecialchars($modul['download']); ?></h1>
                                                <h1 class="font-roboto font-normal text-black text-sm truncate overflow-hidden">1</h1>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p class="text-lg font-roboto font-normal">Belum ada modul tersedia.</p>
                            <?php endif; ?>

                            </div>
                        </div>

                </div>
            
            </div>
        </div>

    
    </div>

    
    <script src="/Study-Tube/guru/sidebar/sidebar.js"></script>
    <script src="script.js"></script>

</body>
</html>