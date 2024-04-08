/**
 * External dependencies
 */
import { isEmpty } from 'lodash';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';

import {
	PanelBody,
	ToggleControl,
	RangeControl,
	RadioControl,
	ColorPalette,
} from '@wordpress/components';

import {
	useBlockProps,
	BlockControls,
	InspectorControls,
	JustifyContentControl,
} from '@wordpress/block-editor';

import { useState } from '@wordpress/element';

import {
	Opener,
	Inserter,
} from './components';

import {
	flattenIconsArray,
} from './utils';

import { defaultIcon } from './icons/default';
import getIcons from './icons';

/**
 * The edit function for the Icon Block.
 *
 * @param {Object} props All props passed to this function.
 * @return {WPElement}   Element to render.
 */
export function Edit(props) {
	const {
		attributes,
		setAttributes,
	} = props;
	const {
		icon,
		iconName,
		justification,
		fill,
		weight,
		grade,
		opsz,
		fontSize,
		color,
		hoverColor,
	} = attributes;

	// State to control whether the Inserter component (icon inserter) is open or closed.
	const [isInserterOpen, setInserterOpen] = useState(false);

	// Fetch all icons and flatten the array
	const iconsAll = flattenIconsArray(getIcons());

	// Filter named icon from the array
	const namedIcon = iconsAll.filter((i) => i.name === iconName);
	let customIcon = defaultIcon;

	if (icon && isEmpty(namedIcon)) {
		// Parse custom icons if provided
		customIcon = icon;

		// If parsed icon has no valid props, fallback to default
		if (isEmpty(customIcon?.props)) {
			customIcon = defaultIcon;
		}
	}

	// Default to an empty string for printedIcon
	let printedIcon = !isEmpty(namedIcon) ? namedIcon[0].icon : customIcon;

	// Block controls for alignment
	const blockControls = (
		<BlockControls group="block">
			<JustifyContentControl
				value={justification}
				onChange={(value) => {
					setAttributes({ justification: value });
				}}
			/>
		</BlockControls>
	);

	// Inspector controls for block settings
	const inspectorControls = (icon || iconName) && (
		<InspectorControls>
			<PanelBody title={__('Settings', 'block-icons-google')}>
				<label style={{ marginBottom: '8px', display: 'block' }}>
					{__('Color', 'block-icons-google')}
				</label>
				<ColorPalette
					className='block-icons-color'
					value={color}
					onChange={(value) =>
						setAttributes({ color: value })
					}									
				/>
				<label style={{ marginBottom: '8px', display: 'block' }}>
					{__('Hover color', 'block-icons-google')}
				</label>
				<ColorPalette
					className='block-icons-color'
					value={hoverColor}
					onChange={(value) =>
						setAttributes({ hoverColor: value })
					}									
				/>
				<RangeControl
					label={__('Font Size', 'block-icons-google')}
					value={fontSize}
					onChange={(value) =>
						setAttributes({ fontSize: value })
					}
					min={15}
					step={1}
					max={250}
				/>
				<ToggleControl
					label={__('Icon Fill')}
					checked={fill}
					onChange={(value) =>
						setAttributes({ fill: value })
					}
				/>
				<RangeControl
					label={__('Weight', 'block-icons-google')}
					value={weight}
					onChange={(value) =>
						setAttributes({ weight: value })
					}
					min={100}
					step={100}
					max={700}
				/>
				<RadioControl
					label={__('Grade', 'block-icons-google')}
					selected={grade}
					options={[
						{ label: '-25', value: '-25' },
						{ label: '0', value: '0' },
						{ label: '200', value: '200' },
					]}
					onChange={(value) =>
						setAttributes({ grade: value })
					}
				/>		
				<RadioControl
					label={__('Optical Size', 'block-icons-google')}
					selected={opsz}
					options={[
						{ label: '20', value: '20' },
						{ label: '24', value: '24' },
						{ label: '40', value: '40' },
						{ label: '48', value: '48' },
					]}
					onChange={(value) =>
						setAttributes({ opsz: value })
					}
				/>							
			</PanelBody>
		</InspectorControls>
	);

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

	// Handle classes with classnames library
	const blockIconClasses = 'box-icon';

	// Markup for the icon
	const iconMarkup = (
		<div className={blockIconClasses}>
			{printedIcon}
		</div>
	);

	return (
		<>
			{blockControls}
			{inspectorControls}
			<div
				{...useBlockProps({
					className: 'myclass',
				})}
			>
				{/* Conditional rendering of Opener */}
				{!icon && !iconName ? (
					<Opener
						setInserterOpen={setInserterOpen}
						attributes={attributes}
						setAttributes={setAttributes}
					/>
				) : (
					iconMarkup
				)}
			</div>
			<Inserter
				isInserterOpen={isInserterOpen}
				setInserterOpen={setInserterOpen}
				attributes={attributes}
				setAttributes={setAttributes}
			/>
		</>
	);
}

export default Edit;
