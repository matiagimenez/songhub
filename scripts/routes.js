const menuScript = {
	scriptName: 'menu-animation',
	scriptPath: '/scripts/animations/menu-animation.js',
};

export const routes = {
	'/login': [
		{
			scriptName: 'input-animation',
			scriptPath: '/scripts/animations/input-animation.js',
		},
	],
	'/register': [
		{
			scriptName: 'input-animation',
			scriptPath: '/scripts/animations/input-animation.js',
		},
	],
	'/explore': [menuScript],
	'/followers': [menuScript],
	'/following': [menuScript],
	'/home': [menuScript],
	'/post': [menuScript],
	'/profile-edit': [menuScript],
	'/profile': [menuScript],
	'/search': [menuScript],
	'/song': [menuScript],
};
