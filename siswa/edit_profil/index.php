<?php
    include '../verificationLogin.php';
    include 'dataProfil.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil | Study Tube</title>
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
                <h1 class="font-poppins font-extrabold text-[#40BA6A] text-xl my-auto">Edit Profil</h1>
            </div>
        </div>
        
        <!-- Content -->
        <div class="container mt-12 p-3">
            <div class="col-rounded-shadow mx-auto p-2 px-4 h-auto w-auto py-3">
                <div class="font-poppins text-lg mb-3 mx-auto">Foto Profil</div>
                <form method="POST" action="updateFotoProfil.php" enctype="multipart/form-data">
                    <div class="flex space-x-10 p-2 ml-2 items-center">
                        <!-- Gambar Profil -->
                        <div class="flex-shrink-0 overflow-hidden w-[60px] h-[60px] rounded-full scale-150">
                            <img id="foto_profil" src="<?php echo $dataProfil['profile_photo']; ?>" class="w-full h-full object-cover">
                        </div>
                        <!-- Teks dan Button -->
                        <div class="flex-grow ml-4">
                            <span class="font-roboto font-normal text-black">
                                Rekomendasi ukuran 96 x 96 pixels dengan ukuran 4MB atau kurang.
                            </span>
                            <div class="flex flex-auto mt-2 space-x-3 w-auto">
                                <div class="flex flex-col space-y-2">
                                    <div class="flex flex-row">
                                        <label for="profile_photo"
                                            class="py-1 px-6 w-[120px] text-[#40BA6A] font-semibold rounded-lg bg-white ring-2 ring-[#40BA6A] font-poppins cursor-pointer text-center">
                                            Pilih File
                                        </label>
                                        <input type="file" id="profile_photo" name="profile_photo" accept="image/*" required class="hidden">
                                        <span id="fileNameDisplay"
                                            style="width: 150px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; display: inline-block;"
                                            class="font-roboto font-normal text-black mt-1 ml-2">
                                        </span>
                                    </div>
                                    <button type="submit"
                                            class="py-1 px-6 w-[100px] text-white font-semibold rounded-lg bg-[#40BA6A] font-poppins cursor-pointer">
                                        Ganti
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <form action="editProfil.php" method="POST">
                <div class="col-rounded-shadow mx-auto p-2 px-4 h-auto w-auto py-3 mt-3">
                    <div class="font-poppins text-lg mb-3 mx-auto">Identitas</div>

                    <!-- Nama -->
                    <div class="font-roboto font-normal mb-2 mx-auto">Nama</div>
                    <div class="relative flex items-center w-full mb-4">
                        <input
                            type="text"
                            name="nama"
                            value="<?php echo $dataProfil['nama']; ?>"
                            class="w-full pl-4 pr-4 py-2 rounded-lg bg-white text-black font-poppins placeholder-gray-400 outline-none ring-2 ring-gray-200 focus:ring focus:ring-[#40BA6A]"
                        />
                    </div>

                    <!-- Asal Sekolah -->
                    <div class="font-roboto font-normal mb-2 mx-auto">Asal Sekolah</div>
                    <div class="relative flex items-center w-full mb-4">
                        <input
                            type="text"
                            name="nama_sekolah"
                            value="<?php echo $dataProfil['nama_sekolah']; ?>"
                            class="w-full pl-4 pr-4 py-2 rounded-lg bg-white text-black font-poppins placeholder-gray-400 outline-none ring-2 ring-gray-200 focus:ring focus:ring-[#40BA6A]"
                        />
                    </div>

                    <!-- Email -->
                    <div class="font-roboto font-normal mb-2 mx-auto">E-mail</div>
                    <div class="relative flex items-center w-full mb-4">
                        <input
                            type="text"
                            name="email"
                            value="<?php echo $dataProfil['email']; ?>"
                            class="w-full pl-4 pr-4 py-2 rounded-lg bg-white text-black font-poppins placeholder-gray-400 outline-none ring-2 ring-gray-200 focus:ring focus:ring-[#40BA6A]"
                        />
                    </div>

                    <!-- Password -->
                    <div class="font-roboto font-normal mb-2 mx-auto">Password</div>
                    <div class="relative flex items-center w-full mb-3">
                        <input
                            type="password"
                            name="password"
                            value="<?php echo $dataProfil['password']; ?>"
                            class="w-full pl-4 pr-4 py-2 rounded-lg bg-white text-black font-poppins placeholder-gray-400 outline-none ring-2 ring-gray-200 focus:ring focus:ring-[#40BA6A]"
                        />
                    </div>
                    <div class="relative flex items-center w-full mb-4">
                        <input
                            type="password"
                            name="password_confirmation"
                            placeholder="konfirmasi Password"
                            class="w-full pl-4 pr-4 py-2 rounded-lg bg-white text-black font-poppins placeholder-gray-400 outline-none ring-2 ring-gray-200 focus:ring focus:ring-[#40BA6A]"
                        />
                    </div>

                    <button type="submit" class="py-1 px-6 w-[100px] text-white font-semibold rounded-lg bg-[#40BA6A] font-poppins cursor-pointer">
                        Ganti
                    </button>
                </div>
            </form>
        </div>
    <div id="errorAlert" class="hidden fixed bg-[#D9534F] text-white p-4 rounded-[15px] bottom-5 left-1/2 transform -translate-x-1/2 shadow-lg z-50">
    <strong>Error:</strong> <span id="errorMessage"></span>
    </div>
    </div>
    
    <script src="/Study-Tube/siswa/sidebar/sidebar.js"></script>
    <script src="script.js"></script>

</body>
</html>