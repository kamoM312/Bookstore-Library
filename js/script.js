// make user button work
let userBox = document.querySelector('.header .header-2 .flex .user-box');

document.querySelector('#user-btn').onclick = () =>{
	userBox.classList.toggle('active');
}

// make nav button work
let navbar = document.querySelector('.header .header-2  .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
	navbar.classList.toggle('active');
}