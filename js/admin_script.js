// Update form cancel button action
document.querySelector('#close-update').onclick = () =>{
	document.querySelector('.edit-product-form').style.display = 'none';
	window.location.href = 'admin_products.php';
}

let navbar = document.querySelector('.header .navbar');
let accountBox = document.querySelector('.header .account-box');

document.querySelector('#menu-btn').onclick = () => {
	navbar.classList.toggle('active');
}

document.querySelector('#user-btn').onclick = () => {
	accountBox.classList.toggle('active');
}