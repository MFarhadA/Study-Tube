<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload | Study Tube</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/Study-Tube/guru/style.css">
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
                <h1 class="font-poppins font-extrabold text-[#40BA6A] text-xl my-auto">Upload</h1>
            </div>
        </div>
        
        <!-- Content -->
        <div class="container mt-12 p-3">

            <form method="POST" action="uploadVideo.php" enctype="multipart/form-data">

                <!-- Judul Video -->
                <div class="col-rounded-shadow mx-auto p-2 px-4 h-auto w-auto py-3 mb-3">
                    <div class="font-poppins text-lg mb-3 mx-auto">Judul Video</div>
                    <div class="relative flex items-center w-full mb-4">
                        <input
                            type="text"
                            name="judul"
                            placeholder="Masukkan judul video"
                            class="w-full pl-4 pr-4 py-2 rounded-lg bg-white text-black font-poppins placeholder-gray-400 outline-none ring-2 ring-gray-200 focus:ring focus:ring-[#40BA6A]"
                            required
                        />
                    </div>
                </div>

                <div class="col-rounded-shadow mx-auto p-2 px-4 h-auto w-auto py-3">

                    <!-- Video -->
                    <div class="font-poppins text-lg mx-auto">Video</div>
                        <div class="flex space-x-10 p-2 ml-2 items-center">
                            <!-- Video -->
                            <div class="overflow-hidden w-[250px] h-[150px] bg-[#40BA6A] rounded-lg flex items-center justify-center">
                                <video id="videoPreview" class="hidden w-full h-full object-cover" controls>
                                    Video tidak dapat diputar.
                                </video>
                                <svg id="defaultVideoIcon" viewBox="0,0,24,24" xmlns="http://www.w3.org/2000/svg" width="64" height="64" stroke-width="1" transform="rotate(0) matrix(1 0 0 1 0 0)">
                                    <path fill="rgb(255,255,255)" d="M4.5 4.5a3 3 0 0 0-3 3v9a3 3 0 0 0 3 3h8.25a3 3 0 0 0 3-3v-9a3 3 0 0 0-3-3zm15.44 14.25l-2.69-2.69V7.94l2.69-2.69c.944-.945 2.56-.276 2.56 1.06v11.38c0 1.336-1.616 2.005-2.56 1.06"></path>
                                </svg>
                            </div>
                            <!-- Teks dan Button -->
                            <div class="flex-grow ml-4">
                                <span class="font-roboto font-normal text-black">
                                    Rekomendasi ukuran 1280 x 720 pixels dengan ukuran 200MB atau kurang.
                                </span>
                                <div class="flex flex-auto mt-2 space-x-3 w-auto">
                                    <div class="flex flex-col space-y-2">
                                        <div class="flex flex-row space-x-3">
                                            <label for="video_file"
                                                class="py-1 px-6 w-[120px] text-white font-semibold rounded-lg bg-[#40BA6A] font-poppins cursor-pointer text-center">
                                                Pilih File
                                            </label>
                                            <input type="file" id="video_file" name="video_file" accept="video/*" required class="hidden">
                                            <!-- Tombol Hapus -->
                                            <button type="button" id="resetVideoButton" class="py-1 px-6 w-[100px] text-white font-semibold rounded-lg bg-[#D9534F] font-poppins cursor-pointer text-center">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Thumbnail -->
                    <div class="font-poppins text-lg mx-auto mt-4">Thumbnail</div>
                        <div class="flex space-x-10 p-2 ml-2 items-center">
                            <!-- Gambar Profil -->
                            <div class="overflow-hidden w-[125px] h-[70px] bg-[#40BA6A] rounded-lg flex items-center justify-center">
                                <img id="profileImage" src="" alt="Preview Gambar" class="w-full h-full object-cover hidden" />
                                <svg id="defaultImage" viewBox="0,0,16,16" xmlns="http://www.w3.org/2000/svg" width="30" height="30" stroke-width="1" transform="rotate(0) matrix(1 0 0 1 0 0)">
                                    <path fill="rgb(255,255,255)" d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71l-2.66-1.772a.5.5 0 0 0-.63.062zm5-6.5a1.5 1.5 0 1 0-3 0a1.5 1.5 0 0 0 3 0"></path>
                                </svg>
                            </div>
                            <!-- Teks dan Button -->
                            <div class="flex-grow ml-4">
                                <span class="font-roboto font-normal text-black">
                                    Rekomendasi ukuran 1280 x 720 pixels dengan ukuran 4MB atau kurang.
                                </span>
                                <div class="flex flex-auto mt-2 space-x-3 w-auto">
                                    <div class="flex flex-col space-y-2">
                                        <div class="flex flex-row space-x-3">
                                            <label for="profile_photo"
                                                class="py-1 px-6 w-[120px] text-white font-semibold rounded-lg bg-[#40BA6A] font-poppins cursor-pointer text-center">
                                                Pilih File
                                            </label>
                                            <input type="file" id="profile_photo" name="profile_photo" accept="image/*" required class="hidden">
                                            <!-- Tombol Hapus -->
                                            <button type="button" id="resetButton" class="py-1 px-6 w-[100px] text-white font-semibold rounded-lg bg-[#D9534F] font-poppins cursor-pointer text-center">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Modul -->
                    <span class="flex font-poppins text-lg mx-auto mt-4 space-x-2">
                        <h1 class="">Modul</h1>
                        <h1 class="text-gray-400 font-normal">*opsional</h1>
                    </span>
                        <div class="flex space-x-10 p-2 ml-2 items-center">
                            <!-- Gambar Profil -->
                            <div id="profileBg" class="overflow-hidden w-[125px] h-[70px] bg-[#40BA6A] rounded-lg flex items-center justify-center">
                                <svg width="24" height="32" viewBox="0 0 16 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.8182 9.42857H9.45455C8.87589 9.42857 8.32094 9.18023 7.91177 8.73818C7.5026 8.29613 7.27273 7.69658 7.27273 7.07143V0.196429C7.27273 0.144332 7.25357 0.0943701 7.21947 0.0575326C7.18538 0.0206951 7.13913 0 7.09091 0H2.90909C2.13755 0 1.39761 0.331122 0.852053 0.920522C0.306493 1.50992 0 2.30932 0 3.14286V18.8571C0 19.6907 0.306493 20.4901 0.852053 21.0795C1.39761 21.6689 2.13755 22 2.90909 22H13.0909C13.8624 22 14.6024 21.6689 15.1479 21.0795C15.6935 20.4901 16 19.6907 16 18.8571V9.625C16 9.5729 15.9808 9.52294 15.9467 9.4861C15.9127 9.44927 15.8664 9.42857 15.8182 9.42857ZM11.6364 17.2857H4.36364C4.17075 17.2857 3.98577 17.2029 3.84938 17.0556C3.71299 16.9082 3.63636 16.7084 3.63636 16.5C3.63636 16.2916 3.71299 16.0918 3.84938 15.9444C3.98577 15.7971 4.17075 15.7143 4.36364 15.7143H11.6364C11.8292 15.7143 12.0142 15.7971 12.1506 15.9444C12.287 16.0918 12.3636 16.2916 12.3636 16.5C12.3636 16.7084 12.287 16.9082 12.1506 17.0556C12.0142 17.2029 11.8292 17.2857 11.6364 17.2857ZM11.6364 13.3571H4.36364C4.17075 13.3571 3.98577 13.2744 3.84938 13.127C3.71299 12.9797 3.63636 12.7798 3.63636 12.5714C3.63636 12.363 3.71299 12.1632 3.84938 12.0158C3.98577 11.8685 4.17075 11.7857 4.36364 11.7857H11.6364C11.8292 11.7857 12.0142 11.8685 12.1506 12.0158C12.287 12.1632 12.3636 12.363 12.3636 12.5714C12.3636 12.7798 12.287 12.9797 12.1506 13.127C12.0142 13.2744 11.8292 13.3571 11.6364 13.3571Z" fill="white"/>
                                    <path d="M15.4191 7.68969L8.88227 0.627589C8.86956 0.613937 8.8534 0.604649 8.83581 0.600893C8.81823 0.597137 8.80001 0.599082 8.78344 0.606481C8.76688 0.613881 8.75271 0.626406 8.74271 0.642481C8.73272 0.658557 8.72735 0.677465 8.72727 0.69683V7.07143C8.72727 7.27981 8.8039 7.47966 8.94029 7.62701C9.07668 7.77436 9.26166 7.85714 9.45455 7.85714H15.355C15.3729 7.85706 15.3904 7.85126 15.4053 7.84046C15.4202 7.82966 15.4318 7.81435 15.4386 7.79646C15.4455 7.77856 15.4473 7.75888 15.4438 7.73988C15.4403 7.72088 15.4317 7.70342 15.4191 7.68969Z" fill="white"/>
                                </svg>
                            </div>
                            <!-- Teks dan Button -->
                            <div class="flex-grow ml-4">
                                <span class="font-roboto font-normal text-black">
                                    Rekomendasi ukuran 4MB.
                                </span>
                                <div class="flex flex-auto mt-2 space-x-3 w-auto">
                                    <div class="flex flex-col space-y-2">
                                        <div class="flex flex-row space-x-3">
                                            <label for="module_file"
                                                class="py-1 px-6 w-[120px] text-white font-semibold rounded-lg bg-[#40BA6A] font-poppins cursor-pointer text-center">
                                                Pilih File
                                            </label>
                                            <input type="file" id="module_file" name="module_file" accept=".pdf,.doc,.docx,.ppt,.pptx" class="hidden">
                                            <!-- Tombol Hapus -->
                                            <button type="button" id="resetFileButton" class="py-1 px-6 w-[100px] text-white font-semibold rounded-lg bg-[#D9534F] font-poppins cursor-pointer text-center">
                                            Hapus
                                            </button>
                                            <span id="fileNameDisplay"
                                            style="width: 250px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; display: inline-block;"
                                            class="font-roboto font-normal text-black mt-1 ml-2">
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>

                <button type="submit" name="upload"
                    class="py-1 px-6 w-[150px] text-white font-semibold text-2xl rounded-lg bg-[#40BA6A] font-poppins cursor-pointer mt-3 text-center right-0">
                    Upload
                </button>
            </form>
        </div>

        <div id="errorAlert" class="hidden fixed bg-[#D9534F] text-white p-4 rounded-[15px] bottom-5 left-1/2 transform -translate-x-1/2 shadow-lg z-50">
            <strong>Error:</strong> <span id="errorMessage"></span>
        </div>

    </div>
    
    <script src="/Study-Tube/guru/sidebar/sidebar.js"></script>
    <script src="script.js"></script>

    <!-- Script untuk preview video -->
    <script>
        const videoInput = document.getElementById('video_file');
        const videoPreview = document.getElementById('videoPreview');
        const defaultVideoIcon = document.getElementById('defaultVideoIcon');
        const resetVideoButton = document.getElementById('resetVideoButton');

        videoInput.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                const videoURL = URL.createObjectURL(file);
                videoPreview.src = videoURL;
                videoPreview.classList.remove('hidden');
                defaultVideoIcon.classList.add('hidden');
            }
        });

        resetVideoButton.addEventListener('click', function() {
            videoInput.value = '';
            videoPreview.src = '';
            videoPreview.classList.add('hidden');
            defaultVideoIcon.classList.remove('hidden');
        });
    </script>

    <!-- Script untuk preview thumbnail -->
    <script>
        const thumbnailInput = document.getElementById('profile_photo');
        const profileImage = document.getElementById('profileImage');
        const defaultImage = document.getElementById('defaultImage');
        const resetButton = document.getElementById('resetButton');

        thumbnailInput.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    profileImage.src = e.target.result;
                    profileImage.classList.remove('hidden');
                    defaultImage.classList.add('hidden');
                };

                reader.readAsDataURL(file);
            }
        });

        resetButton.addEventListener('click', function() {
            thumbnailInput.value = '';
            profileImage.classList.add('hidden');
            defaultImage.classList.remove('hidden');
        });
    </script>

    <!-- Script untuk preview modul -->
    <script>
        const moduleInput = document.getElementById('module_file');
        const profileBg = document.getElementById('profileBg');
        const fileNameDisplay = document.getElementById('fileNameDisplay');
        const resetFileButton = document.getElementById('resetFileButton');

        moduleInput.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                const fileExtension = file.name.split('.').pop().toLowerCase();
                const bgColors = {
                    doc: '#0078D4',
                    docx: '#0078D4',
                    pdf: '#D9534F',
                    ppt: '#FF8C00',
                    pptx: '#FF8C00',
                    default: '#CCCCCC',
                };
                const bgColor = bgColors[fileExtension] || bgColors.default;

                profileBg.style.backgroundColor = bgColor;
                fileNameDisplay.textContent = file.name;
            }
        });

        resetFileButton.addEventListener('click', function() {
            moduleInput.value = '';
            profileBg.style.backgroundColor = '#CCCCCC';
            fileNameDisplay.textContent = '';
        });
    </script>






</body>
</html>