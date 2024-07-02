import { ElementBuilder } from '../../utils/ElementBuilder.js';

// Importa estilos de la Paginacion
const link = ElementBuilder.createElement('link', '', {
	rel: 'stylesheet',
	href: '../scripts/components/pagination/pagination.css',
});
document.head.appendChild(link);

// Crea Contenedor de Paginacion
const paginationContainer = ElementBuilder.createElement('section', '', {
  class: 'pagination-container',
});

// Crea Botones de Paginacion
for (let i=0; i<10; i++) {
  const button = ElementBuilder.createElement('button', '', {
    class: 'pagination-button',
  });
  button.innerHTML = i + 1;
  addButtonsListeners(button);
  paginationContainer.appendChild(button);
}

// Cuando se clickea un botón, cambia el offset de la consulta y llama a la API
function addButtonsListeners(button) {
  button.addEventListener('click', () => {
    window.searchContent((button.innerHTML - 1) * 10);
  });
}

// Agrega Contenedor de Paginacion al Main
const main = document.querySelector('main');
main.appendChild(paginationContainer);