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
		{
			scriptName: 'spotify-sign-up',
			scriptPath: '/scripts/plugins/spotify-sign-up.js',
		},
	],
	'/explore': [
		{
			scriptName: 'menu-animation',
			scriptPath: '/scripts/animations/menu-animation.js',
		},

		{
			scriptName: 'modal-form',
			scriptPath: '/scripts/components/modal-form/modal-form.js',
		},
		{
			scriptName: 'search-content',
			scriptPath: '/scripts/components/search-content/search-content.js',
		},
		{
			scriptName: 'pagination',
			scriptPath: '/scripts/components/pagination/pagination.js',
		},
		{
			scriptName: 'logout-button',
			scriptPath: '/scripts/components/logout-button/logout-button.js',
		},
		{
			scriptName: 'favorite-button',
			scriptPath:
				'/scripts/components/favorite-button/favorite-button.js',
		},
		{
			scriptName: 'footer-animation',
			scriptPath: '/scripts/animations/footer-animation.js',
		},
		{
			scriptName: 'search-filters',
			scriptPath: '/scripts/components/explore-search/search-filters.js',
		},
	],
	'/followers': [
		{
			scriptName: 'menu-animation',
			scriptPath: '/scripts/animations/menu-animation.js',
		},
		{
			scriptName: 'action-button-animation',
			scriptPath: '/scripts/animations/action-button-animation.js',
		},
		{
			scriptName: 'logout-button',
			scriptPath: '/scripts/components/logout-button/logout-button.js',
		},
		{
			scriptName: 'follow-handler',
			scriptPath: '/scripts/components/follow-handler/follow-handler.js',
		},
	],
	'/following': [
		{
			scriptName: 'menu-animation',
			scriptPath: '/scripts/animations/menu-animation.js',
		},
		{
			scriptName: 'action-button-animation',
			scriptPath: '/scripts/animations/action-button-animation.js',
		},
		{
			scriptName: 'logout-button',
			scriptPath: '/scripts/components/logout-button/logout-button.js',
		},
		{
			scriptName: 'follow-handler',
			scriptPath: '/scripts/components/follow-handler/follow-handler.js',
		},
	],

	'/post': [
		{
			scriptName: 'menu-animation',
			scriptPath: '/scripts/animations/menu-animation.js',
		},
		{
			scriptName: 'likes-counter-animation',
			scriptPath: '/scripts/animations/likes-counter-animation.js',
		},
		{
			scriptName: 'logout-button',
			scriptPath: '/scripts/components/logout-button/logout-button.js',
		},
		{
			scriptName: 'footer-animation',
			scriptPath: '/scripts/animations/footer-animation.js',
		},
	],

	'/user': [
		{
			scriptName: 'menu-animation',
			scriptPath: '/scripts/animations/menu-animation.js',
		},
		{
			scriptName: 'likes-counter-animation',
			scriptPath: '/scripts/animations/likes-counter-animation.js',
		},
		{
			scriptName: 'logout-button',
			scriptPath: '/scripts/components/logout-button/logout-button.js',
		},
		{
			scriptName: 'follow-handler',
			scriptPath: '/scripts/components/follow-handler/follow-handler.js',
		},
		{
			scriptName: 'action-button-animation',
			scriptPath: '/scripts/animations/action-button-animation.js',
		},
		{
			scriptName: 'feed',
			scriptPath: '/scripts/components/feed/feed.js',
		},
	],
	'/search': [
		{
			scriptName: 'menu-animation',
			scriptPath: '/scripts/animations/menu-animation.js',
		},
		{
			scriptName: 'modal-form',
			scriptPath: '/scripts/components/modal-form/modal-form.js',
		},
		{
			scriptName: 'logout-button',
			scriptPath: '/scripts/components/logout-button/logout-button.js',
		},
		{
			scriptName: 'search-content',
			scriptPath: '/scripts/components/search-content/search-content.js',
		},
		{
			scriptName: 'pagination',
			scriptPath: '/scripts/components/pagination/pagination.js',
		},
	],
	'/content': [
		{
			scriptName: 'menu-animation',
			scriptPath: '/scripts/animations/menu-animation.js',
		},
		{
			scriptName: 'modal-form',
			scriptPath: '/scripts/components/modal-form/modal-form.js',
		},
		{
			scriptName: 'favorite-button',
			scriptPath:
				'/scripts/components/favorite-button/favorite-button.js',
		},
		{
			scriptName: 'likes-counter-animation',
			scriptPath: '/scripts/animations/likes-counter-animation.js',
		},
		{
			scriptName: 'logout-button',
			scriptPath: '/scripts/components/logout-button/logout-button.js',
		},
		{
			scriptName: 'track-preview-button',
			scriptPath:
				'/scripts/components/track-preview-button/track-preview-button.js',
		},
		{
			scriptName: 'footer-animation',
			scriptPath: '/scripts/animations/footer-animation.js',
		},
	],
	'/user/profile': [
		{
			scriptName: 'menu-animation',
			scriptPath: '/scripts/animations/menu-animation.js',
		},
		{
			scriptName: 'logout-button',
			scriptPath: '/scripts/components/logout-button/logout-button.js',
		},
		{
			scriptName: 'favorite-button',
			scriptPath:
				'/scripts/components/favorite-button/remove-favorite-button.js',
		},
		// {
		// 	scriptName: 'follow-handler',
		// 	scriptPath: '/scripts/components/follow-handler/follow-handler.js',
		// }
	],
	'/terms-conditions': [
		{
			scriptName: 'menu-animation',
			scriptPath: '/scripts/animations/menu-animation.js',
		},
		{
			scriptName: 'logout-button',
			scriptPath: '/scripts/components/logout-button/logout-button.js',
		},
		{
			scriptName: 'footer-animation',
			scriptPath: '/scripts/animations/footer-animation.js',
		},
	],
	'/error': [
		{
			scriptName: 'menu-animation',
			scriptPath: '/scripts/animations/menu-animation.js',
		},
		{
			scriptName: 'logout-button',
			scriptPath: '/scripts/components/logout-button/logout-button.js',
		},
		{
			scriptName: 'footer-animation',
			scriptPath: '/scripts/animations/footer-animation.js',
		},
		{
			scriptName: 'password-animation',
			scriptPath: '/scripts/animations/password-animation.js',
		},
	],
	'/user/password-recovery': [
		{
			scriptName: 'menu-animation',
			scriptPath: '/scripts/animations/menu-animation.js',
		},
		{
			scriptName: 'footer-animation',
			scriptPath: '/scripts/animations/footer-animation.js',
		},
		{
			scriptName: 'password-animation',
			scriptPath: '/scripts/animations/password-animation.js',
		},
	],
	'/edit-password': [
		{
			scriptName: 'menu-animation',
			scriptPath: '/scripts/animations/menu-animation.js',
		},
		{
			scriptName: 'footer-animation',
			scriptPath: '/scripts/animations/footer-animation.js',
		},
		{
			scriptName: 'password-animation',
			scriptPath: '/scripts/animations/password-animation.js',
		},
	],
	'/': [
		{
			scriptName: 'menu-animation',
			scriptPath: '/scripts/animations/menu-animation.js',
		},
		{
			scriptName: 'expanding-cards',
			scriptPath: '/scripts/components/carousel/carousel.js',
		},
		// {
		// 	scriptName: 'post-comment',
		// 	scriptPath: '../scripts/components/post/post-comment.js',
		// },
		// {
		// 	scriptName: 'post-share',
		// 	scriptPath: '../scripts/components/post/post-share.js',
		// },
		{
			scriptName: 'feed',
			scriptPath: '/scripts/components/feed/feed.js',
		},
		{
			scriptName: 'likes-counter-animation',
			scriptPath: '/scripts/animations/likes-counter-animation.js',
		},
		{
			scriptName: 'logout-button',
			scriptPath: '/scripts/components/logout-button/logout-button.js',
		},
	],
};
