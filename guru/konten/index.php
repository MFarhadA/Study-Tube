<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Study Tube</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/Study-Tube/guru/style.css">
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
            <div class="flex flex-col h-[48vh] space-y-4">

                    <!-- Video -->
                    <div class="col-rounded-shadow p-4 w-full h-full bg-white shadow-lg rounded-lg">
                        <div class="flex justify-between items-center mb-4">
                            <h1 class="font-poppins text-xl">Video</h1>
                            <button 
                                type="button"
                                onclick="location='/Study-Tube/guru/upload/index.php'" 
                                class="py-2 px-3 text-white font-semibold text-xl rounded-[15px] bg-[#40BA6A] font-poppins transition-transform transform hover:scale-110">
                                Upload
                            </button>
                        </div>

                        <!-- Wrapper untuk tabel -->
                        <div class="relative w-full">
                            <!-- Header Tabel -->
                            <table class="table-auto w-full border-collapse" style="border-spacing: 0">
                                <thead class="font-poppins bg-gray-100 sticky top-0 z-10">
                                    <tr>
                                        <th class="p-2 text-left w-[140px]">Thumbnail</th>
                                        <th class="p-2 text-left">Judul</th>
                                        <th class="p-2 text-left w-[130px]">Status</th>
                                        <th class="p-2 text-left w-[120px]">Views</th>
                                        <th class="p-2 text-left w-[130px]">Koin</th>
                                    </tr>
                                </thead>
                            </table>

                            <!-- List Video -->
                            <div id="list-video" class="overflow-auto max-h-[360px]">
                                <table class="table-auto w-full" style="border-spacing: 0">
                                    <tbody>
                                        <?php
                                        for ($i = 0; $i < 10; $i++) {
                                            echo '
                                            <tr onclick="location.href=\'/Study-Tube/siswa/tonton/index.php\'" class="font-roboto font-normal items-center cursor-pointer hover:bg-gray-100">
                                                <td class="p-2 w-[125px]">
                                                    <div class="overflow-hidden w-[125px] h-[70px] bg-gray-100 rounded-lg">
                                                        <img src="/Study-Tube/assets/video_thumbnail.jpg" alt="Thumbnail" class="w-full h-full object-cover">
                                                    </div>
                                                </td>
                                                <td class="p-2 text-black line-clamp-3 overflow-hidden mr-3">
                                                    <div class="line-clamp-3 overflow-hidden text-ellipsis">
                                                        how to make video (real no clickbait) how to make video (real no clickbait)
                                                    </div>
                                                </td>
                                                <td class="p-2 font-poppins text-[#40BA6A] w-[130px] text-ellipsis">Diterima</td>
                                                <td class="p-2 text-black w-[130px] text-ellipsis">10000</td>
                                                <td class="p-2 text-black w-[100px] text-ellipsis">1</td>
                                            </tr>
                                            ';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>





                    <!-- Modul -->

                    <div class="col-rounded-shadow p-4 w-full h-full bg-white shadow-lg rounded-lg">
                        <div class="flex justify-between items-center mb-4">
                            <h1 class="font-poppins text-xl">Modul</h1>
                        </div>

                        <!-- Wrapper untuk tabel -->
                        <div class="relative w-full">
                            <!-- Header Tabel -->
                            <table class="table-auto w-full border-collapse" style="border-spacing: 0">
                                <thead class="font-poppins bg-gray-100 sticky top-0 z-10">
                                    <tr>
                                        <th class="p-2 text-left w-[140px]">Modul</th>
                                        <th class="p-2 text-left">Judul</th>
                                        <th class="p-2 text-left w-[130px]">Jenis</th>
                                        <th class="p-2 text-left w-[130px]">Status</th>
                                        <th class="p-2 text-left w-[120px]">Views</th>
                                        <th class="p-2 text-left w-[130px]">Koin</th>
                                    </tr>
                                </thead>
                            </table>

                            <!-- List Modul -->
                            <div id="list-modul" class="overflow-auto max-h-[320px]">
                                <table class="table-auto w-full" style="border-spacing: 0">
                                    <tbody>
                                        <?php
                                        for ($i = 0; $i < 10; $i++) {
                                            echo '
                                            <tr onclick="location.href=\'/Study-Tube/siswa/tonton/index.php\'" class="font-roboto font-normal items-center cursor-pointer hover:bg-gray-100">
                                                <td class="p-2 w-[125px]">
                                                    <div class="overflow-hidden w-[125px] h-[70px] bg-[#0078D4] rounded-lg flex items-center justify-center">
                                                        <svg width="25" height="34" viewBox="0 0 16 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M15.8182 9.42857H9.45455C8.87589 9.42857 8.32094 9.18023 7.91177 8.73818C7.5026 8.29613 7.27273 7.69658 7.27273 7.07143V0.196429C7.27273 0.144332 7.25357 0.0943701 7.21947 0.0575326C7.18538 0.0206951 7.13913 0 7.09091 0H2.90909C2.13755 0 1.39761 0.331122 0.852053 0.920522C0.306493 1.50992 0 2.30932 0 3.14286V18.8571C0 19.6907 0.306493 20.4901 0.852053 21.0795C1.39761 21.6689 2.13755 22 2.90909 22H13.0909C13.8624 22 14.6024 21.6689 15.1479 21.0795C15.6935 20.4901 16 19.6907 16 18.8571V9.625C16 9.5729 15.9808 9.52294 15.9467 9.4861C15.9127 9.44927 15.8664 9.42857 15.8182 9.42857ZM11.6364 17.2857H4.36364C4.17075 17.2857 3.98577 17.2029 3.84938 17.0556C3.71299 16.9082 3.63636 16.7084 3.63636 16.5C3.63636 16.2916 3.71299 16.0918 3.84938 15.9444C3.98577 15.7971 4.17075 15.7143 4.36364 15.7143H11.6364C11.8292 15.7143 12.0142 15.7971 12.1506 15.9444C12.287 16.0918 12.3636 16.2916 12.3636 16.5C12.3636 16.7084 12.287 16.9082 12.1506 17.0556C12.0142 17.2029 11.8292 17.2857 11.6364 17.2857ZM11.6364 13.3571H4.36364C4.17075 13.3571 3.98577 13.2744 3.84938 13.127C3.71299 12.9797 3.63636 12.7798 3.63636 12.5714C3.63636 12.363 3.71299 12.1632 3.84938 12.0158C3.98577 11.8685 4.17075 11.7857 4.36364 11.7857H11.6364C11.8292 11.7857 12.0142 11.8685 12.1506 12.0158C12.287 12.1632 12.3636 12.363 12.3636 12.5714C12.3636 12.7798 12.287 12.9797 12.1506 13.127C12.0142 13.2744 11.8292 13.3571 11.6364 13.3571Z" fill="white"/>
                                                            <path d="M15.4191 7.68969L8.88227 0.627589C8.86956 0.613937 8.8534 0.604649 8.83581 0.600893C8.81823 0.597137 8.80001 0.599082 8.78344 0.606481C8.76688 0.613881 8.75271 0.626406 8.74271 0.642481C8.73272 0.658557 8.72735 0.677465 8.72727 0.69683V7.07143C8.72727 7.27981 8.8039 7.47966 8.94029 7.62701C9.07668 7.77436 9.26166 7.85714 9.45455 7.85714H15.355C15.3729 7.85706 15.3904 7.85126 15.4053 7.84046C15.4202 7.82966 15.4318 7.81435 15.4386 7.79646C15.4455 7.77856 15.4473 7.75888 15.4438 7.73988C15.4403 7.72088 15.4317 7.70342 15.4191 7.68969Z" fill="white"/>
                                                        </svg>
                                                    </div>
                                                </td>
                                                <td class="p-2 text-black line-clamp-3 overflow-hidden mr-3">
                                                    <div class="line-clamp-3 overflow-hidden text-ellipsis">
                                                        how to make video (real no clickbait) how to make video (real no clickbait)
                                                    </div>
                                                </td>
                                                <td class="p-2 font-poppins text-[#0078D4] w-[130px] text-ellipsis">Word</td>
                                                <td class="p-2 font-poppins text-[#40BA6A] w-[130px] text-ellipsis">Diterima</td>
                                                <td class="p-2 text-black w-[130px] text-ellipsis">10000</td>
                                                <td class="p-2 text-black w-[100px] text-ellipsis">1</td>
                                            </tr>
                                            ';
                                        }
                                        ?>
                                    </tbody>
                                </table>
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