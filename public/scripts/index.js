import { routes } from './routes.js';
import { ScriptLoader } from './utils/ScriptLoader.js';

document.addEventListener('DOMContentLoaded', () => {
	const currentPath = window.location.pathname;
	let matched = false;

	for (const route in routes) {
		const scripts = routes[route];
		for (const script of scripts) {
			if (
				route === currentPath ||
				(currentPath.includes(route) && route !== '/')
			) {
				const { scriptName, scriptPath, initFunction } = script;
				ScriptLoader.loadScript(scriptName, scriptPath, initFunction);
				matched = true;
			}
		}
	}

	// Si no hay coincidencias exactas, cargar los scripts para /error
	if (!matched) {
		const errorScripts = routes['/error'];
		for (const script of errorScripts) {
			const { scriptName, scriptPath, initFunction } = script;
			ScriptLoader.loadScript(scriptName, scriptPath, initFunction);
		}
	}
});
