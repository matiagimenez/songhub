export class ElementBuilder {
	static createElement(tag, content = '', attributes = {}) {
		const element = document.createElement(tag);
		for (const attribute in attributes) {
			element.setAttribute(attribute, attributes[attribute]);
		}

		if (content.tagName) {
			element.appendChild(content);
		} else {
			element.appendChild(document.createTextNode(content));
		}

		return element;
	}
}
