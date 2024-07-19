const contentButton = document.getElementById('content-button');
const profilesButton = document.getElementById('profiles-button');

const isActiveContent = contentButton.classList.contains('active');
const isActiveProfiles = profilesButton.classList.contains('active');

function setContentFilter() {
  contentButton.classList.remove('inactive');
  contentButton.classList.add('active');
  profilesButton.classList.remove('active');
  profilesButton.classList.add('inactive');
}

function setProfileFilter() {
  contentButton.classList.remove('active');
  contentButton.classList.add('inactive');
  profilesButton.classList.remove('inactive');
  profilesButton.classList.add('active');
}

contentButton.addEventListener('click', setContentFilter);
profilesButton.addEventListener('click', setProfileFilter);

window.isActiveContent = isActiveContent;
window.isActiveProfiles = isActiveProfiles;