import { ElementBuilder } from '../../utils/ElementBuilder.js';
const posts = document.querySelectorAll('.post');

const darkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
let comment_icon = './../assets/icons/post-icons/comment.svg';
darkMode && (comment_icon = './../assets/icons/post-icons/dark_mode_comment.svg');

posts.forEach((post) => {
  const comment_button = post.querySelector('.comment-container button');
  const comment_img = ElementBuilder.createElement('img', '', {
    src: comment_icon,
    alt: "comment",
    width: "20px",
  });
  comment_button.appendChild(comment_img);
});