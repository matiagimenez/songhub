let url = 'https://localhost:5500/views/home.html';

if (
	window.location.href.includes('/post') ||
	window.location.href.includes('/song')
) {
	url = window.location.href;
}

// Establece el valor de og:url con la URL
document.getElementById('og-url').setAttribute('content', url);

console.log(document.getElementById('og-url'));
