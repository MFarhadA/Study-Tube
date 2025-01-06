<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diskusi | Study Tube</title>
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
                <h1 class="font-poppins font-extrabold text-[#40BA6A] text-xl my-auto">Diskusi</h1>
            </div>
        </div>
        
        <!-- Content -->
        <div class="container mt-12 p-3">
            <div class="flex flex-row space-x-4">

                <!-- Kolom Kiri -->
                <div class="flex flex-col max-w-[30vh] space-y-2">
                    <div class="col-rounded-shadow p-2 px-3 max-h-[100vh]">
                        <div class="font-poppins text-xl mt-2 mb-2 mx-auto">Diskusi</div>
                        <div id="discussion" class="overflow-y-auto p-1 px-1 space-y-2 max-h-[40vh] scroll-smooth"></div>
                    </div>
                    <div class="col-rounded-shadow p-2 px-3 max-h-[100vh]">
                        <div class="font-poppins text-xl mt-2 mb-2 mx-auto">Request Diskusi</div>
                        <div id="req_discussion" class="overflow-y-auto p-1 px-1 space-y-2 max-h-[40vh] scroll-smooth"></div>
                    </div>
                </div>


                <!-- Kolom Kanan -->
                <div class="flex flex-auto">
                    <div class="col-rounded-shadow p-2 px-3 max-h-[100vh] w-full">
                        <div class="flex items-center py-2 pb-3 border-b-2">
                            <div class="flex overflow-hidden w-[50px] h-[50px] rounded-full bg-red z-10">
                                <div class="mx-auto">
                                    <img src="/Study-Tube/assets/foto_profil.jpg">
                                </div>
                            </div>
                            <div class="ml-5 flex-col text-ellipsis mt-1">
                                <div class="font-poppins mx-auto line-clamp-1">Muhammad Farhad Ajilla</div>
                                <div class="font-poppins font-normal mx-auto line-clamp-1 -mt-1">MAN Manba'ul Huda</div>
                            </div>
                            <div class="flex flex-auto justify-end text-ellipsis mt-1">
                                <button type="button" onclick="location='/login/index.html'"
                                        class="justify-end right-9 px-3 py-2 text-white font-semibold text-xl rounded-[15px] bg-[#D9534F] font-poppins transition-transform transform hover:scale-110">
                                        Keluar
                                </button>
                            </div>
                        </div>
                        <div id="message" class="flex-1 flex-col justify-end overflow-y-auto p-3 px-2 space-y-2 h-[calc(90vh-130px)]">
                            <!-- Jawab Pesan -->
                            <div class="flex pl-10 mt-3">
                                <div class="rounded-[15px] bg-[#40BA6A] inline-block p-2 px-3">
                                    <h1 class="font-roboto">
                                        <span class="font-normal text-white">Untuk membuat jawab pesan (pesan kita) muncul di kanan dan pesan orang muncul di kiri, kita bisa memanfaatkan Flexbox dan properti justify-end serta justify-start pada Tailwind CSS.</span> 
                                        <span class="flex font-normal text-[#228444] ml-1 justify-end">15:02</span>
                                    </h1>
                                </div>
                            </div>
                            <!-- Pesan Orang -->
                            <div class="flex pr-10 mt-3">
                                <div class="rounded-[15px] bg-gray-100 inline-block p-2 px-3">
                                    <h1 class="font-roboto">
                                        <span class="font-normal text-black">Untuk membuat jawab pesan (pesan Untuk membuat jawab pesan (pesan kita) muncul di kanan dan pesan orang muncul di kiri, kita bisa memanfaatkan Flexbox dan properti justify-end serta justify-start pada Tailwind CSS.</span> 
                                        <span class="flex font-normal text-gray-300 ml-1 justify-end">15:04</span>
                                    </h1>
                                </div>
                            </div>
                            <!-- Jawab Pesan -->
                            <div class="flex pl-10 mt-3">
                                <div class="rounded-[15px] bg-[#40BA6A] inline-block p-2 px-3">
                                    <h1 class="font-roboto">
                                        <span class="font-normal text-white">Untuk membuat jawab pesan (pesan kita) muncul di kanan dan pesan orang muncul di kiri, kita bisa memanfaatkan Flexbox dan properti justify-end serta justify-start pada Tailwind CSS.</span> 
                                        <span class="flex font-normal text-[#228444] ml-1 justify-end">15:02</span>
                                    </h1>
                                </div>
                            </div>
                            <!-- Pesan Orang -->
                            <div class="flex pr-10 mt-3">
                                <div class="rounded-[15px] bg-gray-100 inline-block p-2 px-3">
                                    <h1 class="font-roboto">
                                        <span class="font-normal text-black">Untuk membuat jawab pesan (pesan Untuk membuat jawab pesan (pesan kita) muncul di kanan dan pesan orang muncul di kiri, kita bisa memanfaatkan Flexbox dan properti justify-end serta justify-start pada Tailwind CSS.</span> 
                                        <span class="flex font-normal text-gray-300 ml-1 justify-end">15:04</span>
                                    </h1>
                                </div>
                            </div>
                            <!-- Jawab Pesan -->
                            <div class="flex pl-10 mt-3">
                                <div class="rounded-[15px] bg-[#40BA6A] inline-block p-2 px-3">
                                    <h1 class="font-roboto">
                                        <span class="font-normal text-white">Untuk membuat jawab pesan (pesan kita) muncul di kanan dan pesan orang muncul di kiri, kita bisa memanfaatkan Flexbox dan properti justify-end serta justify-start pada Tailwind CSS.</span> 
                                        <span class="flex font-normal text-[#228444] ml-1 justify-end">15:02</span>
                                    </h1>
                                </div>
                            </div>
                            <!-- Pesan Orang -->
                            <div class="flex pr-10 mt-3">
                                <div class="rounded-[15px] bg-gray-100 inline-block p-2 px-3">
                                    <h1 class="font-roboto">
                                        <span class="font-normal text-black">Untuk membuat jawab pesan (pesan Untuk membuat jawab pesan (pesan kita) muncul di kanan dan pesan orang muncul di kiri, kita bisa memanfaatkan Flexbox dan properti justify-end serta justify-start pada Tailwind CSS.</span> 
                                        <span class="flex font-normal text-gray-300 ml-1 justify-end">15:04</span>
                                    </h1>
                                </div>
                            </div>
                            <!-- Pesan Orang -->
                            <div class="flex pr-10 mt-3">
                                <div class="rounded-[15px] bg-gray-100 inline-block p-2 px-3">
                                    <h1 class="font-roboto">
                                        <span class="font-normal text-black">Untuk membuat jawab pesan (pesan Untuk membuat jawab pesan (pesan kita) muncul di kanan dan pesan orang muncul di kiri, kita bisa memanfaatkan Flexbox dan properti justify-end serta justify-start pada Tailwind CSS.</span> 
                                        <span class="flex font-normal text-gray-300 ml-1 justify-end">15:04</span>
                                    </h1>
                                </div>
                            </div>
                            <!-- Jawab Pesan -->
                            <div class="flex pl-10 mt-3">
                                <div class="rounded-[15px] bg-[#40BA6A] inline-block p-2 px-3">
                                    <h1 class="font-roboto">
                                        <span class="font-normal text-white">Untuk membuat jawab pesan (pesan kita) muncul di kanan dan pesan orang muncul di kiri, kita bisa memanfaatkan Flexbox dan properti justify-end serta justify-start pada Tailwind CSS.</span> 
                                        <span class="flex font-normal text-[#228444] ml-1 justify-end">15:02</span>
                                    </h1>
                                </div>
                            </div>
                            <!-- Pesan Orang -->
                            <div class="flex pr-10 mt-3">
                                <div class="rounded-[15px] bg-gray-100 inline-block p-2 px-3">
                                    <h1 class="font-roboto">
                                        <span class="font-normal text-black">Untuk membuat jawab pesan (pesan Untuk membuat jawab pesan (pesan kita) muncul di kanan dan pesan orang muncul di kiri, kita bisa memanfaatkan Flexbox dan properti justify-end serta justify-start pada Tailwind CSS.</span> 
                                        <span class="flex font-normal text-gray-300 ml-1 justify-end">15:04</span>
                                    </h1>
                                </div>
                            </div>
                            <!-- Pesan Orang -->
                            <div class="flex pr-10 mt-3">
                                <div class="rounded-[15px] bg-gray-100 inline-block p-2 px-3">
                                    <h1 class="font-roboto">
                                        <span class="font-normal text-black">Untuk membuat jawab pesan (pesan Untuk membuat jawab pesan (pesan kita) muncul di kanan dan pesan orang muncul di kiri, kita bisa memanfaatkan Flexbox dan properti justify-end serta justify-start pada Tailwind CSS.</span> 
                                        <span class="flex font-normal text-gray-300 ml-1 justify-end">15:04</span>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pesan -->
                        <div class="flex flex-col pt-2">
                            <div class="relative flex flex-row items-center bottom-0">
                                <div class="flex flex-auto items-center w-full p-2">
                                    <!-- Ikon Pesan -->
                                    <button class="absolute inset-y-0 left-0 flex items-center pl-4">
                                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14 10V18M18 14H10M26 14C26 15.5759 25.6896 17.1363 25.0866 18.5922C24.4835 20.0481 23.5996 21.371 22.4853 22.4853C21.371 23.5996 20.0481 24.4835 18.5922 25.0866C17.1363 25.6896 15.5759 26 14 26C12.4241 26 10.8637 25.6896 9.4078 25.0866C7.95189 24.4835 6.62902 23.5996 5.51472 22.4853C4.40042 21.371 3.5165 20.0481 2.91345 18.5922C2.31039 17.1363 2 15.5759 2 14C2 10.8174 3.26428 7.76516 5.51472 5.51472C7.76516 3.26428 10.8174 2 14 2C17.1826 2 20.2348 3.26428 22.4853 5.51472C24.7357 7.76516 26 10.8174 26 14Z" stroke="#48C774" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                    <!-- Input Pesan -->
                                    <input
                                    type="text"
                                    placeholder="tulis pesan..."
                                    class="flex flex-auto pl-11 pr-4 py-2 rounded-[15px] bg-white text-black font-poppins placeholder-gray-400 outline-none ring-2 ring-gray-200 focus:ring focus:ring-[#40BA6A] mr-1 w-auto"
                                    />
                                </div>
                                <button class="flex flex-auto right-0 mr-2 justify-end">
                                    <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21 42C26.5695 42 31.911 39.7875 35.8492 35.8492C39.7875 31.911 42 26.5695 42 21C42 15.4305 39.7875 10.089 35.8492 6.15076C31.911 2.21249 26.5695 0 21 0C15.4305 0 10.089 2.21249 6.15076 6.15076C2.21249 10.089 0 15.4305 0 21C0 26.5695 2.21249 31.911 6.15076 35.8492C10.089 39.7875 15.4305 42 21 42ZM12.4688 19.0312C11.9466 19.0312 11.4458 19.2387 11.0766 19.6079C10.7074 19.9771 10.5 20.4779 10.5 21C10.5 21.5221 10.7074 22.0229 11.0766 22.3921C11.4458 22.7613 11.9466 22.9688 12.4688 22.9688H24.5175L19.005 28.0875C18.6221 28.4426 18.3959 28.9352 18.3762 29.457C18.3565 29.9788 18.5449 30.4871 18.9 30.87C19.2551 31.2529 19.7477 31.4791 20.2695 31.4988C20.7913 31.5185 21.2996 31.3301 21.6825 30.975L30.87 22.4438C31.0688 22.2595 31.2274 22.0361 31.3358 21.7877C31.4443 21.5392 31.5003 21.2711 31.5003 21C31.5003 20.7289 31.4443 20.4608 31.3358 20.2123C31.2274 19.9639 31.0688 19.7405 30.87 19.5562L21.6825 11.025C21.4929 10.8492 21.2705 10.7125 21.0281 10.6226C20.7857 10.5327 20.5279 10.4915 20.2695 10.5012C19.7477 10.5209 19.2551 10.7471 18.9 11.13C18.5449 11.5129 18.3565 12.0212 18.3762 12.543C18.3959 13.0648 18.6221 13.5574 19.005 13.9125L24.5175 19.0312H12.4688Z" fill="#48C774"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>

    
    <script src="/Study-Tube/siswa/sidebar/sidebar.js"></script>
    <script src="script.js"></script>

</body>
</html>