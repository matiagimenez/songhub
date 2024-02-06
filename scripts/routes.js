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
			scriptName: 'post-like',
			scriptPath: '../scripts/components/post/post-like.js',
		},
		{
			scriptName: 'post-comment',
			scriptPath: '../scripts/components/post/post-comment.js',
		},
		{
			scriptName: 'post-share',
			scriptPath: '../scripts/components/post/post-share.js',
		},
		{
			scriptName: 'post-content',
			scriptPath: '../scripts/components/post/post-content.js',
		},
	],
	'/post': [
		menuScript,
		{
			scriptName: 'post-like',
			scriptPath: '../scripts/components/post/post-like.js',
		},
	],
	'/profile-edit': [menuScript],
	'/profile': [
		menuScript,
		{
			scriptName: 'action-button-animation',
			scriptPath: '../scripts/animations/action-button-animation.js',
		},
		{
			scriptName: 'post-like',
			scriptPath: '../scripts/components/post/post-like.js',
		},
		{
			scriptName: 'post-comment',
			scriptPath: '../scripts/components/post/post-comment.js',
		},
		{
			scriptName: 'post-share',
			scriptPath: '../scripts/components/post/post-share.js',
		},
		{
			scriptName: 'post-content',
			scriptPath: '../scripts/components/post/post-content.js',
		},
	],
	'/search': [menuScript],
	'/song': [menuScript],
};
