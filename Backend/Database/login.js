// function show() {
//     var p = document.getElementById('password');
//     p.setAttribute('type', 'text');
// }

// function hide() {
//     var p = document.getElementById('password');
//     p.setAttribute('type', 'password');
// }

// var pwShown = 0;
// document.getElementById("eye").addEventListener("click", function () {
//     if (pwShown == 0) {
//         pwShown = 1;
//         show();
//     } else {
//         pwShown = 0;
//         hide();
//     }
// }, false);

// function signin() {
//     var username = document.getElementById("username");
//     var password = document.getElementById("password");
//     if (username.value == "") {
//         alert("Please enter your username");
//         username.focus();
//         return false;
//     }
//     if (password.value != "") {
//         if (password.value.length < 8) {
//             alert("Password must be at least 8 characters");
//             password.focus();
//             return false;
//         }
//     } else {
//         alert("Please enter your password");
//         password.focus();
//         return false;
//     }
// }

// function Email(email) {
//     return /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/.test(email);
// }

// function admin(username, password) {
//     if (username === "admin" && password === "password") {
//         window.location.href = "home.html";
//         return true;
//     } else {
//         return false;
//     }
// }


// const loginForm = document.querySelector('#login-form');
// loginForm.addEventListener('submit', async (event) => {
//     event.preventDefault();
//     const formData = new FormData(loginForm);

//     const data = {};
//     for (const pair of formData.entries()) {
//         const key = pair[0];
//         const value = pair[1];
//         data[key] = value;
//     }
//     try {
//         const response = await fetch('/api/login', {
//             method: 'POST',
//             body: JSON.stringify(data),
//             headers: {
//                 'Content-Type': 'application/json'
//             }
//         });
//         if (response.ok) {
//             window.location.href = 'home.html';
//         } else {
//             console.error('Login error: ', response.statusText);
//         }
//     } catch (error) {
//         console.error('login error: ', error);
//     }
// });

// async function login() {
//     var username = document.getElementById("txt-input");
//     var password = document.getElementById("pws");

//     if (username.value === "" || password.value === "") {
//         alert("Please enter your username and password");
//         return false;
//     }

//     const data = {
//         username: username.value,
//         password: password.value
//     };

//     try {
//         const response = await fetch('/api/login', {
//             method: 'POST',
//             body: JSON.stringify(data),
//             headers: {
//                 'Content-Type': 'application/json'
//             }
//         });
//         if (response.ok) {
//             window.location.href = 'home.html';
//         } else {
//             console.error('Login error: ', response.statusText);
//         }
//     } catch (error) {
//         console.error('Login error: ', error);
//     }

//     return false;
// }
