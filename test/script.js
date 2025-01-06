// URL file PHP
const url = 'http://localhost/Study-Tube/test/data.php';

// Array users (akan diisi dari database)
let users = [];

// Fetch data dari file PHP
fetch(url)
    .then(response => response.json())
    .then(data => {
        // Assign data dari database ke array users
        users = data;

        // Tampilkan di console untuk memastikan data
        console.log("Users dari Database:", users);

        // Contoh manipulasi DOM menggunakan data users
        const userList = document.getElementById('user-list');
        users.forEach(user => {
            const listItem = document.createElement('li');
            listItem.innerHTML = `
                <img src="${user.img}" alt="${user.name}" width="50">
                <a href="${user.link}">${user.name}</a>
            `;
            userList.appendChild(listItem);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
