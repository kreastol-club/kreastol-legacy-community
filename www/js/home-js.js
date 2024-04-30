const hamburgerIcon = document.querySelector(".hamburger-icon");
const mobileNav = document.querySelector(".header");
const container = document.querySelector(".container");
const dropdown = document.querySelector(".dropdown");

let navOpen = true;
const showNav = () => {
	if (navOpen) {
		mobileNav.style.left = "0";
		container.style.display = "none";
		dropdown.style.display = "none";
		navOpen = false;
	} else {
		mobileNav.style.left = "-900px";
		container.style.display = "unset";
		dropdown.style.display = "unset";
		navOpen = true;
	}
}
hamburgerIcon.addEventListener('click', showNav);


