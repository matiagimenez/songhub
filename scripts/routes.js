const menuScript = {
	scriptName: 'menu-animation',
	scriptPath: '../scripts/animations/menu-animation.js',
};

export const routes = {
	'/login': [
		{
			scriptName: 'input-animation',
			scriptPath: '../scripts/animations/input-animation.js',
		},
	],
	'/register': [
		{
			scriptName: 'input-animation',
			scriptPath: '../scripts/animations/input-animation.js',
		},
	],
	'/explore': [menuScript],
	'/followers': [
		menuScript,
		{
			scriptName: 'action-button-animation',
			scriptPath: '../scripts/animations/action-button-animation.js',
		},
	],
	'/following': [
		menuScript,
		{
			scriptName: 'action-button-animation',
			scriptPath: '../scripts/animations/action-button-animation.js',
		},
	],
	'/home': [
		menuScript,
		{
			scriptName: 'expanding-cards',
			scriptPath: '../scripts/components/carousel/carousel.js',
		},
		{
			scriptName: 'post-like-container',
			scriptPath: '../scripts/components/post/post_like_container.js',
		},
		{
			scriptName: 'post-comment-container',
			scriptPath: '../scripts/components/post/post_comment_container.js',
		},
		{
			scriptName: 'post-share-container',
			scriptPath: '../scripts/components/post/post_share_container.js',
		},
	],
	'/post': [menuScript],
	'/profile-edit': [menuScript],
	'/profile': [menuScript],
	'/search': [menuScript],
	'/song': [menuScript],
};
