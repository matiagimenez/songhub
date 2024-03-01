import { routes } from './routes.js';
import { ScriptLoader } from './utils/ScriptLoader.js';

document.addEventListener('DOMContentLoaded', () => {
	const currentPath = window.location.pathname;
	for (const route in routes) {
		const scripts = routes[route];
		for (const script of scripts) {
			if (
				route === currentPath ||
				(currentPath.includes(route) && route !== '/')
			) {
				const { scriptName, scriptPath, initFunction } = script;
				ScriptLoader.loadScript(scriptName, scriptPath, initFunction);
			}
		}
	}
});
