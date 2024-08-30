// make user button work
let userBox = document.querySelector('.header .header-2 .flex .user-box');

document.querySelector('#user-btn').onclick = () =>{
	userBox.classList.toggle('active');
	navbar.classList.remove('active');
}

// make nav button work
let navbar = document.querySelector('.header .header-2  .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
	navbar.classList.toggle('active');
	userBox.classList.remove('active');

}

// make navbar and userBox dissapear on scroll
window.onscroll = () => {
	userBox.classList.remove('active');
	navbar.classList.remove('active');

	if(window.scrollY > 60){
		document.querySelector('.header .header-2').classList.add('active');
	} else {
		document.querySelector('.header .header-2').classList.remove('active');
	}
}

