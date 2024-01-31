import { ElementBuilder } from '../../utils/ElementBuilder.js';
const posts = document.querySelectorAll('.post');

const darkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
let share_icon = './../assets/icons/post-icons/share.svg';
darkMode && (share_icon = './../assets/icons/post-icons/dark_mode_share.svg');

posts.forEach((post) => {
  const share_button = post.querySelector('.share-container button');
  const share_img = ElementBuilder.createElement('img', '', {
    src: share_icon,
    alt: "share",
    width: "16px",
  });
  share_button.appendChild(share_img);
});