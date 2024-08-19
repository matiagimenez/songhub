const images = document.querySelectorAll(".blur");

function addLoader(imgs) {
  imgs.forEach(image => {
    image.addEventListener("load", () => {
      image.classList.remove("blur");
    });
  
    // Esto asegura que las imágenes que ya estén en caché se marquen como cargadas.
    if (image.complete) {
      image.classList.remove("blur");
    }
  });
}

addLoader(images)

window.addLoader = addLoader