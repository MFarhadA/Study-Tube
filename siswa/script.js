
// URL file PHP
const guruMengikuti = '/Study-Tube/siswa/dataMengikuti.php';
const videoData = '/Study-Tube/siswa/dataVideo.php';

// Array users (akan diisi dari database)
let guru = [];
let video = [];

// Fetch data dari file PHP
fetch(guruMengikuti)
    .then(response => response.json())
    .then(data => {
        // Assign data dari database ke array users
        guru = data;

        // Tampilkan di console untuk memastikan data
        console.log("Guru dari Database:", guru);

        // Contoh manipulasi DOM menggunakan data users
        guru.forEach(user => {
            const card = `
                <div onclick="location.href='/Study-Tube/siswa/profil/index.php?teacherID=${user.teacherID}'" class="flex flex-col col-rounded-shadow p-3 w-[120px] h-[180px] space-y-2 cursor-pointer">
                  <div class="mx-auto overflow-hidden w-[75px] h-[75px] rounded-full bg-[#40BA6A] mb-1">
                    <div class="mx-auto">
                      <img src="${user.img}">
                    </div>
                  </div>
                  <h1 class="font-poppins text-center text-black text-ellipsis line-clamp-3">
                      ${user.name}
                  </h1>
                </div>
            `;
            const userList = document.getElementById('containerProfile');
            userList.innerHTML += card;
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });

fetch(videoData)
    .then(response => response.json())
    .then(data => {
        // Assign data dari database ke array video
        video = data;

        // Tampilkan di console untuk memastikan data
        console.log("Video dari Database:", video);

        // Manipulasi DOM menggunakan data video
        const userList = document.getElementById('containerVideo');
        if (!userList) {
            console.error('Element with id "containerVideo" not found.');
            return;
        }

        video.forEach(videoItem => {
            const { video_id, title, thumbnail, video, views, teacher_name, teacher_profile_photo } = videoItem;

            const card = `
                <div onclick="location.href='/Study-Tube/siswa/tonton/index.php?video=${encodeURIComponent(video)}&videoID=${video_id}'" class="w-[265px] h-[255px] col-rounded-shadow cursor-pointer p-2">
                    <div class="overflow-hidden w-[250px] h-[140px] rounded-lg bg-[#40BA6A]">
                        <div class="mx-auto item thumbnail">
                            <img src="${thumbnail}" alt="${title}" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <h1 class="font-roboto text-black text-ellipsis overflow-hidden line-clamp-2 mt-2">${title}</h1>
                    <div class="row mt-2">
                        <div class="flex space-x-3">
                            <div class="mx-auto overflow-hidden w-[40px] h-[40px] rounded-full bg-white">
                                <div class="mx-auto">
                                    <img src="${teacher_profile_photo}" alt="${teacher_name}" class="w-full h-full object-cover">
                                </div>
                            </div>
                            <div class="col">
                                <h1 class="font-roboto text-gray-400 text-sm truncate overflow-hidden">${teacher_name}</h1>
                                <h1 class="font-roboto text-gray-400 text-sm truncate overflow-hidden">${views} views</h1>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            userList.innerHTML += card;
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });

/*
// Data array yang akan digunakan
const container = document.getElementById('containerProfile');
const users = [
  { name: "Muhammad Farhad Ajilla", img: "../assets/foto_profil.jpg", link: "register/index.html" },
  { name: "Muhammad Farhad Ajilla", img: "../assets/foto_profil.jpg", link: "register/index.html" },
  { name: "Muhammad Farhad Ajilla", img: "../assets/foto_profil.jpg", link: "register/index.html" },
  { name: "Muhammad Farhad Ajilla", img: "../assets/foto_profil.jpg", link: "register/index.html" },
  { name: "Muhammad Farhad Ajilla", img: "../assets/foto_profil.jpg", link: "register/index.html" },
  { name: "Muhammad Farhad Ajilla", img: "../assets/foto_profil.jpg", link: "register/index.html" },
  { name: "Muhammad Farhad Ajilla", img: "../assets/foto_profil.jpg", link: "register/index.html" },
  { name: "Muhammad Farhad Ajilla", img: "../assets/foto_profil.jpg", link: "register/index.html" }
];
// Perulangan untuk menambahkan elemen
users.forEach(user => {
  const card = `
    <div onclick="location='${user.link}'" class="flex-shrink-0 scroll-ml-3 snap-start col-rounded-shadow overflow-hidden p-3 w-[120px] h-[180px] space-y-2 cursor-pointer">
      <div class="mx-auto overflow-hidden w-[75px] h-[75px] rounded-full bg-white">
        <div class="mx-auto">
          <img src="${user.img}" alt="${user.name}">
        </div>
      </div>
      <h1 class="font-poppins text-center text-black text-ellipsis overflow-hidden">${user.name}</h1>
    </div>
  `;
  container.innerHTML += card;
});
*/

/*
const videoData = [
    {
      link: '/assets/video.mp4',
      videoThumbnail: '../assets/video_thumbnail.jpg',
      title: 'Spinning Cats Spinning Cats Spinning Cats Spinning Cats Spinning Cats',
      profileImage: '../assets/foto_profil.jpg',
      authorName: 'M. Farhad Ajilla',
      views: '7.5k Views',
    },
    {
      link: '/assets/video.mp4',
      videoThumbnail: '../assets/video_thumbnail.jpg',
      title: 'Spinning Cats Spinning Cats Spinning Cats Spinning Cats Spinning Cats',
      profileImage: '../assets/foto_profil.jpg',
      authorName: 'M. Farhad Ajilla',
      views: '7.5k Views',
    },
    {
      link: '/assets/video.mp4',
      videoThumbnail: '../assets/video_thumbnail.jpg',
      title: 'Spinning Cats Spinning Cats Spinning Cats Spinning Cats Spinning Cats',
      profileImage: '../assets/foto_profil.jpg',
      authorName: 'M. Farhad Ajilla',
      views: '7.5k Views',
    },
    {
      link: '/assets/video.mp4',
      videoThumbnail: '../assets/video_thumbnail.jpg',
      title: 'Spinning Cats Spinning Cats Spinning Cats Spinning Cats Spinning Cats',
      profileImage: '../assets/foto_profil.jpg',
      authorName: 'M. Farhad Ajilla',
      views: '7.5k Views',
    },
    {
      link: '/assets/video.mp4',
      videoThumbnail: '../assets/video_thumbnail.jpg',
      title: 'Spinning Cats Spinning Cats Spinning Cats Spinning Cats Spinning Cats',
      profileImage: '../assets/foto_profil.jpg',
      authorName: 'M. Farhad Ajilla',
      views: '7.5k Views',
    },
    {
      link: '/assets/video.mp4',
      videoThumbnail: '../assets/video_thumbnail.jpg',
      title: 'Spinning Cats Spinning Cats Spinning Cats Spinning Cats Spinning Cats',
      profileImage: '../assets/foto_profil.jpg',
      authorName: 'M. Farhad Ajilla',
      views: '7.5k Views',
    }
  ];
  
  // Generate kartu untuk setiap video
  videoData.forEach(video => createCard(video));

function createCard(data) {
    // Data parameter berupa object dengan informasi untuk kartu
    const { link, videoThumbnail, title, profileImage, authorName, views } = data;
  
    // Membuat elemen HTML
    const cardHTML = `
      <div onclick="playVideo('${link}')" class="w-[265px] h-[255px] col-rounded-shadow cursor-pointer p-2">
        <div class="overflow-hidden w-[250px] h-[140px] rounded-lg bg-white">
          <div class="mx-auto item">
            <img src="${videoThumbnail}" alt="${title}">
          </div>
        </div>
        <h1 class="font-roboto text-black text-ellipsis overflow-hidden line-clamp-2 mt-2">${title}</h1>
        <div class="row mt-2">
          <div class="flex space-x-3">
            <div class="mx-auto overflow-hidden w-[40px] h-[40px] rounded-full bg-white">
              <div class="mx-auto">
                <img src="${profileImage}" alt="${authorName}">
              </div>
            </div>
            <div class="col">
              <h1 class="font-roboto text-gray-400 text-sm truncate overflow-hidden">${authorName}</h1>
              <h1 class="font-roboto text-gray-400 text-sm truncate overflow-hidden">${views}</h1>
            </div>
          </div>
        </div>
      </div>
      <div id="videoPopup" style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); justify-content: center; align-items: center; z-index: 9999;">
        <div class="video-container" style="position: fixed;">
          <video id="videoPlayer" controls autoplay width="80%">
            <source id="videoSource" src="" type="video/mp4">
            Your browser does not support the video tag.
          </video>
          <button onclick="closeVideo()" style="position: fixed; top: 10px; right: 10px; font-size: 20px; color: white; background: rgba(0, 0, 0, 0.5); border: none; padding: 5px 10px; cursor: pointer; z-index: 10000;">x</button>
        </div>
      </div>
      `;
  
    // Menambahkan elemen ke DOM
    const container = document.getElementById('containerVideo'); // Pastikan ada elemen dengan ID ini di HTML
    container.innerHTML += cardHTML;
  }
*/


