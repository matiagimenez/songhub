const contentButton = document.getElementById('content-button');
const profilesButton = document.getElementById('profiles-button');

let isActiveContent = true;

function setContentFilter() {
  contentButton.classList.remove('inactive');
  contentButton.classList.add('active');
  profilesButton.classList.remove('active');
  profilesButton.classList.add('inactive');
  window.isActiveContent = true;
  window.searchManagement();
}

function setProfileFilter() {
  contentButton.classList.remove('active');
  contentButton.classList.add('inactive');
  profilesButton.classList.remove('inactive');
  profilesButton.classList.add('active');
  window.isActiveContent = false;
  window.searchManagement();
}

contentButton.addEventListener('click', setContentFilter);
profilesButton.addEventListener('click', setProfileFilter);

window.isActiveContent = isActiveContent;