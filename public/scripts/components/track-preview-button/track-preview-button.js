const button = document.querySelector('.track-preview-button');
const audio = document.querySelector('.track-preview');

function togglePlayPause() {
	if (audio.paused) {
		audio.play();
		audio.volume = 0.1;
		button.innerHTML = `
            <i class="ph ph-pause-circle icon-lg pause-icon"></i>
            <span class="visually-hidden">
                Pausar pre-escucha de la canción
            </span>
        `;
	} else {
		audio.pause();
		button.innerHTML = `
            <i class="ph ph-play-circle icon-lg play-icon"></i>
            <span class="visually-hidden">
                Reproducir pre-escucha de la canción
            </span>
        `;
	}
}

if (button) {
	button.addEventListener('click', () => {
		togglePlayPause();
	});
}
