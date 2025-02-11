<?php
    include 'verificationLogin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda | Study Tube</title>
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
                  class="w-full pl-10 pr-4 py-2 rounded-lg bg-white text-black font-poppins placeholder-gray-400 outline-none ring-2 ring-gray-200 focus:ring focus:ring-[#40BA6A]"
                />
            </form>

            <!-- SEKOLAH, GURU, MATA PELAJARAN -->
            <div class="row text-center p-2 mb-2 hidden">
                <div class="flex space-x-3">
                <div onclick="location='register/index.html'" class="col truncate my-max shadow-md py-4 text-white text-2xl font-poppins rounded-[10px] bg-[#40BA6A] cursor-pointer">
                    SEKOLAH
                </div>
                <div onclick="location='register/index.html'" class="col truncate my-max shadow-md py-4 text-white text-2xl font-poppins rounded-[10px] bg-[#40BA6A] cursor-pointer">
                    GURU
                </div>
                <div onclick="location='register/index.html'" class="col truncate my-max shadow-md py-4 text-white text-2xl font-poppins rounded-[10px] bg-[#40BA6A] cursor-pointer">
                    MATA PELAJARAN
                </div>
                </div>
            </div>

            <div class="col truncate my-max shadow-md py-4 text-white text-2xl font-poppins rounded-[10px] bg-[#40BA6A] text-center mb-2">
                    SELAMAT DATANG DI STUDY TUBE
            </div>

            <!-- Mengikuti -->
            <h1 class="font-roboto mb-2 text-xl">Mengikuti</h1>

            <div class="row overflow-x-auto p-2 mb-2">
                <div class="flex space-x-3 snap-x">

                    <!--
                    <div onclick="location='register/index.html'" class="flex-shrink-0 col-rounded overflow-hidden p-3 w-[120px] h-[190px] space-y-3 cursor-pointer">
                        <div class="mx-auto overflow-hidden w-[60px] h-[60px] rounded-full bg-white z-10">
                            <div class="mx-auto">
                                <img src="../assets/foto_profil.jpg">
                            </div>
                        </div>
                        <h1 class="font-poppins text-xl text-center text-[#40BA6A] text-ellipsis overflow-hidden">Muhammad Farhad Ajilla</h1>
                    </div>
                    -->

                    <div id="containerProfile" class="flex flex-auto gap-3">
                        <!-- Perulangan Mengikuti -->
                    </div>
                </div>
            </div>

            <h1 class="font-roboto mb-2 text-xl">Direkomendasikan untuk anda</h1>

            <div class="container p-2 mb-2">
                <div class="space-x-2 space-y-3">

                    <!--
                    <div onclick="location='register/index.html'" class="flex-shrink-0 overflow-hidden w-[250px] h-[230px] cursor-pointer">
                        <div class="overflow-hidden w-[250px] h-[140px] rounded-lg bg-white z-10">
                            <div class="mx-auto">
                                <img src="../assets/video_thumbnail.jpg">
                            </div>
                        </div>
                        <h1 class="font-roboto text-black text-ellipsis overflow-hidden line-clamp-2 mt-2">Spinning Cats</h1>
                        <div class="row mt-2">
                            <div class="flex space-x-3">
                                <div class="mx-auto overflow-hidden w-[40px] h-[40px] rounded-full bg-white z-10">
                                    <div class="mx-auto">
                                        <img src="../assets/foto_profil.jpg">
                                    </div>
                                </div>
                                <div class="col">
                                    <h1 class="font-roboto text-[#40BA6A] text-sm truncate overflow-hidden">M. Farhad Ajilla</h1>
                                    <h1 class="font-roboto text-[#40BA6A] text-sm truncate overflow-hidden">7.5k Views</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    -->

                    <div id="containerVideo" class="flex flex-wrap gap-3">
                        <!--Perulangan Mengikuti -->
                    </div>
                </div>
            </div>
        </div>

    
    </div>

    <script src="/Study-Tube/siswa/sidebar/sidebar.js"></script>
    <script src="script.js"></script>

</body>
</html>