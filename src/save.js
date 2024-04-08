/**
 * External dependencies
 */
import { isEmpty } from 'lodash';

/**
 * WordPress dependencies
 */
import {
	useBlockProps,
} from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import getIcons from './icons';
import { flattenIconsArray } from './utils';

/**
 * The save function for the Icon Block.
 *
 * @param {Object} props All props passed to this function.
 * @return {WPElement}   Element to render.
 */
export default function Save(props) {
	// Extracting attributes from props
	const {
		icon,
		iconName,
		title,
		justification,
		fill,
		weight,
		grade,
		opsz,
		fontSize,
		color,
		hoverColor,
	} = props.attributes;

	// If there is no icon and no iconName, don't save anything.
	if (!icon && !iconName) {
		return null;
	}

	// Fetching all icons and flattening the array
	const iconsAll = flattenIconsArray(getIcons());

	// Filtering named icon from the array
	const namedIcon = iconsAll.filter((i) => i.name === iconName);

	// Default to an empty string for printedIcon
	let printedIcon = '';

	if (icon && isEmpty(namedIcon)) {
		// Parse custom icons if provided
		printedIcon = icon;

		// If parsed icon has no valid props, fallback to empty string
		if (isEmpty(printedIcon?.props)) {
			printedIcon = '';
		}
	} else {
		// Use the icon chosen from the library
		printedIcon = namedIcon[0]?.icon;
	}

	// If there is no valid SVG icon, don't save anything.
	if (!printedIcon) {
		return null;
	}

	// Apply aria-label if namedIcon is not empty
	if (!isEmpty(namedIcon)) {
		printedIcon = {
			...printedIcon,
			props: {
				...printedIcon.props,
				'aria-label': namedIcon[0].title,
				style: {
					...(printedIcon.props.style || {}),
					fontVariationSettings: `"FILL" ${fill ? 1 : 0}, "wght" ${weight}, "GRAD" ${grade}, "opsz" ${opsz}`,
					textAlign: justification,
					fontSize: fontSize,
					color: color,
					"--block-icons-google-hover-color": hoverColor
				},
			},
		};
	}

	// Use Block Props for saving block attributes
	const blockProps = useBlockProps.save();

	// Handle classes with classnames library
	const blockIconClasses = 'box-icon';

	// Markup for the icon
	const iconMarkup = (
		<div className={blockIconClasses}>
			{printedIcon}
		</div>
	);

	return (
		<div
			{...blockProps}
			title={title} // Add title attribute for additional information
		>
			{iconMarkup}
		</div>
	);
}
