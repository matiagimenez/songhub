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

// Variables de configuración
const totalPages = 100;
const visiblePages = 7;
const halfVisiblePages = Math.floor(visiblePages / 2);

// Función para crear los botones de paginación
function createPaginationButtons(currentPage) {
  paginationContainer.innerHTML = '';

  const createPageButton = (pageNumber) => {
    const button = ElementBuilder.createElement('button', '', {
      class: 'pagination-button',
    });
    button.innerHTML = pageNumber;
    button.disabled = pageNumber === currentPage;
    pageNumber === currentPage && button.classList.add('selected-button');
    addButtonsListeners(button, pageNumber);
    return button;
  };

  const createLeftArrow = () => {
    const button = ElementBuilder.createElement('button', '', {
      class: 'pagination-button',
    });
    button.innerHTML = '<';
    addButtonsListeners(button, currentPage - 1);
    paginationContainer.appendChild(button);
  };
  
  const createRightArrow = () => {
    const button = ElementBuilder.createElement('button', '', {
      class: 'pagination-button',
    });
    button.innerHTML = '>';
    addButtonsListeners(button, currentPage + 1);
    paginationContainer.appendChild(button);
  };

  // Calculo el start y el end de la paginación
  let startPage = Math.max(1, currentPage - halfVisiblePages);
  let endPage = Math.min(totalPages, currentPage + halfVisiblePages);

  // Ajusto si están fuera de rango
  if (currentPage - halfVisiblePages <= 0) {
    endPage = Math.min(totalPages, endPage + (halfVisiblePages - currentPage + 1));
  }
  if (currentPage + halfVisiblePages > totalPages) {
    startPage = Math.max(1, startPage - (currentPage + halfVisiblePages - totalPages));
  }

  // Creo la primera página y los ... si hace falta
  currentPage > 1 && createLeftArrow();
  if (startPage > 1) {
    paginationContainer.appendChild(createPageButton(1));
    if (startPage > 2) {
      paginationContainer.appendChild(ElementBuilder.createElement('span', '...', { class: 'pagination-dots' }));
    }
  }

  // Crea botones
  for (let i = startPage; i <= endPage; i++) {
    paginationContainer.appendChild(createPageButton(i));
  }
  
  // Creo última página y los ... si hace falta
  if (endPage < totalPages) {
    if (endPage < totalPages - 1) {
      paginationContainer.appendChild(ElementBuilder.createElement('span', '...', { class: 'pagination-dots' }));
    }
    paginationContainer.appendChild(createPageButton(totalPages));
  }
  currentPage < totalPages && createRightArrow();
}

// Cuando se clickea un botón, cambia el offset de la consulta y llama a la API
function addButtonsListeners(button, pageNumber) {
  button.addEventListener('click', () => {
    window.fetchContent((pageNumber - 1) * 10);
    createPaginationButtons(pageNumber);
  });
}

function clearButtons() {
  paginationContainer.innerHTML = '';
}

// Agrega Contenedor de Paginacion al Main
const main = document.querySelector('main');
main.appendChild(paginationContainer);
window.createPaginationButtons = createPaginationButtons;
window.clearButtons = clearButtons;