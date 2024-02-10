/**
 * External dependencies
 */
import { isEmpty } from 'lodash';

/**
 * Get all icon types.
 *
 * @param {Array} icons - Array of icon types.
 * @return {Array} - Array of icon types with type, title, and isDefault properties.
 */
export function getIconTypes(icons) {
	const iconTypes = [];

	icons.forEach((type) => {
		const iconType = type?.type;
		const typeTitle = type?.title ?? type?.type;
		const isDefault = type?.isDefault ?? false;

		if (!isEmpty(iconType)) {
			iconTypes.push({
				type: iconType,
				title: typeTitle,
				isDefault,
			});
		}
	});

	return iconTypes;
}

/**
 * Extracts all icons from all types and places them in a single array.
 *
 * @param {Array} icons - Array of icon types with icons property.
 * @return {Array} - Array of flattened icons.
 */
export function flattenIconsArray(icons) {
	let allIcons = [];

	icons.forEach((type) => {
		const iconType = type?.type;
		const iconsOfType = type?.icons;

		if (!isEmpty(iconsOfType)) {
			// Append the type to the icon name and add the type parameter.
			iconsOfType.forEach((icon) => {
				// This temporarily fixes a recursion error.
				if (!icon.name.includes(iconType + '-')) {
					icon.name = iconType + '-' + icon.name;
				}
				icon.type = iconType;
			});

			// Sort the icons alphabetically.
			iconsOfType.sort((a, b) => a.name.localeCompare(b.name));

			allIcons = allIcons.concat(iconsOfType);
		}
	});

	return allIcons;
}

/**
 * Simplify the categories into a single array.
 *
 * @param {Array} categories - Array of category objects with name property.
 * @return {Array} - Array of simplified category names.
 */
export function simplifyCategories(categories) {
	const simplifiedCategories = [];

	categories.forEach((category) => {
		if (category?.name) {
			simplifiedCategories.push(category.name);
		}
	});

	return simplifiedCategories;
}
