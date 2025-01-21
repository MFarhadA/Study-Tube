<?php
include 'verificationLogin.php';

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "study_tube";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangkap parameter pencarian
$q = isset($_GET['search']) ? $_GET['search'] : '';

// Query untuk tabel guru
$sqlGuru = "
    SELECT 
        userID, 
        name AS guru_name, 
        profile_photo AS guru_photo 
    FROM 
        user 
    WHERE 
        role = 2 
        AND name LIKE '%" . $conn->real_escape_string($q) . "%'
";
$resultGuru = $conn->query($sqlGuru);

// Query untuk tabel video
$sqlVideo = "
    SELECT 
        video.title AS video_title, 
        video.thumbnail AS video_thumbnail, 
        video.video AS video_path, 
        video.views AS video_views, 
        user.name AS guru_name, 
        user.profile_photo AS guru_photo 
    FROM 
        video
    INNER JOIN 
        guru 
    ON 
        video.teacherID = guru.teacherID
    INNER JOIN 
        user 
    ON 
        guru.userID = user.userID
    WHERE 
        video.title LIKE '%" . $conn->real_escape_string($q) . "%'
";
$resultVideo = $conn->query($sqlVideo);
$noResults = ($resultGuru->num_rows === 0 && $resultVideo->num_rows === 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian | Study Tube</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/Study-Tube/siswa/style.css">
</head>
<body>

    <!-- Sidebar -->
    <div id="sidebar" class="fixed top-0 left-0 h-screen bg-[#40BA6A]">
    </div>

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
                <h1 class="font-poppins font-extrabold text-[#40BA6A] text-xl my-auto">Beranda</h1>
            </div>
        </div>

        <!-- Content -->
        <div class="container mt-12 p-3 my-min px-4 overflow-y-hidden">

            <!--Pencarian -->

            <form action="/Study-Tube/siswa/pencarian/index.php" method="GET" class="relative flex items-center w-full p-2 mb-2">
                    
                    <!-- Ikon Pencarian -->
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.414-1.414l3.387 3.387a1 1 0 01-1.414 1.414l-3.387-3.387zM8 14a6 6 0 100-12 6 6 0 000 12z" clip-rule="evenodd" />
                    </svg>
                    </span>
                
                    <!-- Input Pencarian -->
                    <input
                    type="text"
                    name="search"
                    placeholder="Pencarian"
                    value="<?= htmlspecialchars($q) ?>"
                    class="w-full pl-10 pr-4 py-2 rounded-lg bg-white text-black font-poppins placeholder-gray-400 outline-none ring-2 ring-gray-200 focus:ring focus:ring-[#40BA6A]"
                    />
            </form>

            <!-- Guru -->
            <?php if ($resultGuru && $resultGuru->num_rows > 0): ?>
                <h1 class="font-roboto mb-2 text-xl">Guru</h1>

                <div class="row overflow-x-auto p-2 mb-2">
                    <div class="flex space-x-3 snap-x">
                        <!-- Hasil Guru -->
                        <div id="containerProfile" class="flex flex-auto gap-3">
                            <?php if ($resultGuru && $resultGuru->num_rows > 0): ?>
                                <?php while ($guru = $resultGuru->fetch_assoc()): ?>
                                    <div
                                        onclick="location='profile.php?id=<?= htmlspecialchars($guru['userID']) ?>'" 
                                        class="flex flex-col col-rounded-shadow p-3 w-[120px] h-[180px] space-y-2 cursor-pointer"
                                    >
                                        <div class="mx-auto overflow-hidden w-[75px] h-[75px] rounded-full bg-white mb-1">
                                            <img src="<?= htmlspecialchars($guru['guru_photo']) ?>" alt="<?= htmlspecialchars($guru['guru_name']) ?>" class="w-full h-full object-cover">
                                        </div>
                                        <h1 class="font-poppins text-center text-black text-ellipsis line-clamp-3">
                                            <?= htmlspecialchars($guru['guru_name']) ?>
                                        </h1>
                                    </div>                              
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p class="font-roboto mb-2 text-l">Tidak ada hasil</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Video -->
            <?php if ($resultVideo && $resultVideo->num_rows > 0): ?>
                <h1 class="font-roboto mb-2 text-xl">Video</h1>

                <div class="container p-2 mb-2">
                    <div class="space-x-2 space-y-3">

                        <!-- Hasil Video -->
                        <div id="containerVideo" class="flex flex-wrap gap-3">
                            <?php if ($resultVideo && $resultVideo->num_rows > 0): ?>
                                <?php while ($video = $resultVideo->fetch_assoc()): ?>
                                    <div
                                        onclick="playVideo('<?= htmlspecialchars($video['video_path']) ?>')" 
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
                                                <div class="mx-auto overflow-hidden w-[40px] h-[40px] rounded-full bg-white">
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
                                <p class="font-roboto mb-2 text-l">Tidak ada hasil</p>
                            <?php endif; ?>

                            <div id="videoPopup" style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); justify-content: center; align-items: center; z-index: 9999;">
                                <div class="video-container" style="position: fixed;">
                                    <video id="videoPlayer" controls autoplay width="80%">
                                        <source id="videoSource" src="" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <button onclick="closeVideo()" style="position: fixed; top: 10px; right: 10px; font-size: 20px; color: white; background: rgba(0, 0, 0, 0.5); border: none; padding: 5px 10px; cursor: pointer; z-index: 10000;">x</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($noResults): ?>
                <p class="font-roboto text-center text-xl text-black">Tidak ada hasil ditemukan</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="/Study-Tube/siswa/sidebar/sidebar.js"></script>
    <script src="script.js"></script>
</body>
</html>

<?php
$conn->close();
?>
