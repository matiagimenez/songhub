export function FocusLocker(container, itemsClass)
{
  const menuItems = container.querySelectorAll('.'+itemsClass);
  const firstMenuItem = menuItems[0];
  const lastMenuItem = menuItems[menuItems.length - 1];
  console.log(itemsClass)
  
  firstMenuItem.focus();
  
  firstMenuItem.addEventListener('keydown', (event) => {
    if (event.key === 'Tab' && event.shiftKey) {
      lastMenuItem.focus();
      event.preventDefault()
    }
  })
  
  lastMenuItem.addEventListener('keydown', (event) => {
    if (event.key === 'Tab' && !event.shiftKey) {
      firstMenuItem.focus();
      event.preventDefault()
    }
  })
}
