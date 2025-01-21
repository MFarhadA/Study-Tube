<?php

session_start();

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "study_tube";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['teacherID']) && !empty($_GET['teacherID'])) {
    $teacherID = $_GET['teacherID'];  // ID pembuat video
} else {
    echo "User tidak ditemukan.";
    exit;
}

$userID = $_SESSION['user_id'];
$sqlstudentID = "SELECT studentID FROM siswa JOIN user ON siswa.userID = user.userID WHERE user.userID = ?";
$stmtstudentID = $conn->prepare($sqlstudentID);
$stmtstudentID->bind_param("i", $userID);
$stmtstudentID->execute();
$resultstudentID = $stmtstudentID->get_result();

// Pastikan hasil query ada
if ($row = $resultstudentID->fetch_assoc()) {
    $studentID = $row['studentID'];  // Menyimpan studentID ke dalam variabel
} else {
    echo "Student ID tidak ditemukan.";
}

// Query untuk video
$sql = "
    SELECT
        u.name AS teacher_name, 
        u.profile_photo AS teacher_profile_photo,
        g.followers,
        g.teacherID
    FROM
        guru g
    JOIN
        user u ON g.userID = u.userID
    WHERE
        g.teacherID = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $teacherID);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); // Menyimpan hasil query dalam $row
} else {
    echo "Tidak ada data User ditemukan";
}

// Query untuk tabel video
$sqlVideo = "
    SELECT
        video.videoID AS video_id,
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
        guru.teacherID = ?
";
$stmt = $conn->prepare($sqlVideo);
$stmt->bind_param("i", $teacherID);
$stmt->execute();
$resultVideo = $stmt->get_result();
$stmt->close();

// Cek apakah siswa sudah mengikuti guru ini
$sqlCheckFollow = "
    SELECT 1 FROM ikuti
    WHERE studentID = ? AND teacherID = ?
";
$stmtCheckFollow = $conn->prepare($sqlCheckFollow);
$stmtCheckFollow->bind_param("ii", $studentID, $row['teacherID']);
$stmtCheckFollow->execute();
$resultCheckFollow = $stmtCheckFollow->get_result();
$isFollowing = $resultCheckFollow->num_rows > 0;  // true jika sudah mengikuti, false jika belum
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
                <h1 class="font-poppins font-extrabold text-[#40BA6A] text-xl my-auto">Guru</h1>
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
                  class="w-full pl-10 pr-4 py-2 rounded-lg bg-white text-black font-poppins placeholder-gray-400 outline-none ring-2 ring-gray-200 focus:ring focus:ring-[#40BA6A]"
                />
            </form>

            <!-- Profile Card -->
            <div class="bg-[#48C774] text-white flex items-center justify-between p-3 rounded-lg mb-6 shadow-md w-auto mx-auto">
                <div class="flex items-center">
                    <div class="flex-shrink-0 overflow-hidden w-[60px] h-[60px] rounded-full bg-white items-center z-1 mr-4">
                        <div class="mx-auto">
                            <img id="profilePhoto" src="<?= htmlspecialchars($row['teacher_profile_photo']); ?>">
                        </div>
                    </div>
                    <div>
                    <p class="text-lg font-poppins"><?= htmlspecialchars($row['teacher_name']); ?></p>
                    <p class="text-sm font-roboto text-[#228444]"><?= htmlspecialchars($row['followers']); ?> Pengikut</p>
                        <div class="flex text-white">
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span class="text-gray-300">&#9733;</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4 w-full md:w-auto">

                    <!-- Tombol Ikuti/Mengikuti -->
                    <form action="follow.php" method="POST" class="inline">
                        <input type="hidden" name="teacherID" value="<?= $row['teacherID']; ?>">
                        <input type="hidden" name="studentID" value="<?= $studentID; ?>">
                        <input type="hidden" name="action" value="<?= $isFollowing ? 'unfollow' : 'follow'; ?>">
                        <button 
                            type="submit" 
                            class="<?= $isFollowing ? 'bg-[#48C774] text-white ring-2 ring-white' : 'bg-white text-[#48C774]' ?> font-poppins px-4 py-2 rounded">
                            <?= $isFollowing ? 'Mengikuti' : 'Ikuti' ?>
                        </button>
                    </form>

                    <button class="hidden flex items-center bg-white text-[#48C774] font-poppins px-4 py-2 rounded">
                        <div class="flex items-center mr-3 space-x-1">
                            <svg width="26" height="25" viewBox="0 0 26 25" fill="#228444" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.4409 9.57993C13.8606 9.93892 14.4919 9.8897 14.8508 9.47C15.2098 9.0503 15.1606 8.41905 14.7409 8.06007L13.4409 9.57993ZM11.6364 7.9L11.638 6.9H11.6364V7.9ZM14.7359 16.9442C15.1579 16.588 15.2113 15.9571 14.8551 15.535C14.4989 15.113 13.868 15.0596 13.4459 15.4158L14.7359 16.9442ZM0 12.5C0 19.3031 4.99234 25 11.3636 25V23C6.28757 23 2 18.3994 2 12.5H0ZM11.3636 25C17.7349 25 22.7273 19.3031 22.7273 12.5H20.7273C20.7273 18.3994 16.4397 23 11.3636 23V25ZM22.7273 12.5C22.7273 5.69686 17.7349 0 11.3636 0V2C16.4397 2 20.7273 6.6006 20.7273 12.5H22.7273ZM11.3636 0C4.99234 0 0 5.69686 0 12.5H2C2 6.6006 6.28757 2 11.3636 2V0ZM14.7409 8.06007C13.8704 7.31544 12.7754 6.9019 11.638 6.9L11.6347 8.9C12.2852 8.90108 12.9231 9.13703 13.4409 9.57993L14.7409 8.06007ZM11.6364 6.9C8.71791 6.9 6.54545 9.51955 6.54545 12.5H8.54545C8.54545 10.3975 10.0363 8.9 11.6364 8.9V6.9ZM6.54545 12.5C6.54545 15.4805 8.71791 18.1 11.6364 18.1V16.1C10.0363 16.1 8.54545 14.6025 8.54545 12.5H6.54545ZM11.6364 18.1C12.8134 18.1 13.8875 17.6602 14.7359 16.9442L13.4459 15.4158C12.9263 15.8544 12.3008 16.1 11.6364 16.1V18.1ZM10.8182 2C13.133 2 16.4765 2.28757 19.2098 3.75042C20.5606 4.47334 21.7454 5.4742 22.5967 6.86012C23.4468 8.24409 24 10.0698 24 12.5H26C26 9.75518 25.3713 7.55591 24.3009 5.81332C23.2317 4.07268 21.7574 2.84541 20.1535 1.98708C16.9777 0.287428 13.2303 0 10.8182 0V2ZM24 12.5C24 14.9302 23.4468 16.7559 22.5967 18.1399C21.7454 19.5258 20.5606 20.5267 19.2098 21.2496C16.4765 22.7124 13.133 23 10.8182 23V25C13.2303 25 16.9777 24.7126 20.1535 23.0129C21.7574 22.1546 23.2317 20.9273 24.3009 19.1867C25.3713 17.4441 26 15.2448 26 12.5H24Z"/>
                            </svg>
                            <p>50</p>
                        </div>
                        <p class="text-[#48C774]">join diskusi</p>
                    </button>
                </div>
            </div>

            <!-- List Video -->
            <?php if ($resultVideo && $resultVideo->num_rows > 0): ?>
                <h1 class="font-poppins mb-2 text-xl">Video</h1>

                <div class="container p-2 mb-2">
                    <div class="space-x-2 space-y-3">

                        <!-- Hasil Video -->
                        <div id="containerVideo" class="flex flex-wrap gap-3">
                            <?php if ($resultVideo && $resultVideo->num_rows > 0): ?>
                                <?php while ($video = $resultVideo->fetch_assoc()): ?>
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
                        </div>
                    </div>
                </div>
            <?php endif; ?>

    <script src="/Study-Tube/siswa/sidebar/sidebar.js"></script>
    <script src="script.js"></script>
</body>
</html>