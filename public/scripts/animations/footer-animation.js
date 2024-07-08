const footer = document.querySelector('.main-footer');

let lastScrollTop = 0;

if (window.scrollY === 0) {
	if (footer) {
		footer.classList.add('fixed-footer');
	}
}

window.addEventListener('scroll', function () {
	if (!footer) return;

	let currentScrollTop = window.scrollY;
	let windowHeight = window.innerHeight;
	let documentHeight = document.documentElement.scrollHeight;

	if (
		currentScrollTop < lastScrollTop ||
		currentScrollTop + windowHeight >= documentHeight
	) {
		footer.classList.remove('invisible-footer');
		footer.classList.add('fixed-footer');
	} else {
		footer.classList.remove('fixed-footer');
		footer.classList.add('invisible-footer');
	}

	lastScrollTop = currentScrollTop;
});
