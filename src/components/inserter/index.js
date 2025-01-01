/**
 * External dependencies
 */
import classnames from 'classnames';
import { isEmpty } from 'lodash';

/**
 * WordPress dependencies
 */
import { __, _n, sprintf } from '@wordpress/i18n';
import {
	Button,
	MenuGroup,
	MenuItem,
	Modal,
	SearchControl,
} from '@wordpress/components';
import { useState } from '@wordpress/element';

/**
 * Internal dependencies
 */
import getIcons from './../../icons';
import {
	flattenIconsArray,
	getIconTypes,
	simplifyCategories,
} from './../../utils';

export default function Inserter(props) {
	const { isInserterOpen, setInserterOpen, attributes, setAttributes } =
		props;
	const iconsByType = getIcons();
	const iconTypes = getIconTypes(iconsByType);

	// Get the default type, and if there is none, get the first type.
	let defaultType = iconTypes.filter((type) => type.isDefault);
	defaultType = defaultType.length !== 0 ? defaultType : [iconTypes[0]];

	const [searchInput, setSearchInput] = useState('');
	const [currentCategory, setCurrentCategory] = useState(
		'all__' + defaultType[0]?.type
	);

	if (!isInserterOpen) {
		return null;
	}

	const iconsAll = flattenIconsArray(iconsByType);
	let shownIcons = [];

	// Filter by search input.
	if (searchInput) {
		shownIcons = iconsAll.filter((icon) => {
			const input = searchInput.toLowerCase();
			const iconName = icon.title.toLowerCase();

			// First check if the name matches.
			if (iconName.includes(input)) {
				return true;
			}

			// Then check if any keywords match.
			if (icon?.keywords && !isEmpty(icon?.keywords)) {
				const keywordMatches = icon.keywords.filter((keyword) =>
					keyword.includes(input)
				);

				return !isEmpty(keywordMatches);
			}

			return false;
		});
	}

	// Filter by category if we are not searching.
	if (!searchInput) {
		// If an "all" category, fetch all icons of the correct type.
		if (currentCategory.startsWith('all__')) {
			const categoryType = currentCategory.replace('all__', '');
			const allIconsOfType =
				iconsByType.filter(
					(type) => type.type === categoryType
				)[0]?.icons ?? [];
			shownIcons = allIconsOfType;
		} else {
			shownIcons = iconsAll.filter((icon) => {
				const iconCategories = icon?.categories ?? [];

				// First check if the category matches.
				if (iconCategories.includes(currentCategory)) {
					return true;
				}

				return false;
			});
		}
	}

	const preparedTypes = [];

	iconsByType.forEach((type) => {
		const title = type?.title ?? type.type;
		const categoriesFull = type?.categories ?? [];
		const categories = simplifyCategories(categoriesFull);
		const allCategory = 'all__' + type.type;
		const iconsOfType = type?.icons ?? [];

		// Sort alphabetically and then add the "all" category.
		if (!categories.includes(allCategory)) {
			categories.sort().unshift(allCategory);
			categoriesFull.unshift({
				name: allCategory,
				title: __('All', 'block-icons-google'),
			});
		}

		preparedTypes.push({
			type: type.type,
			title,
			categoriesFull,
			categories,
			count: iconsOfType.length,
		});
	});

	function updateIconAtts(name) {
		setAttributes({
			icon: '',
			iconName: name,
		});
		setInserterOpen(false);
	}

	function onClickCategory(category) {
		setCurrentCategory(category);
	}

	function renderIconTypeCategories(type) {
		return (
			<MenuGroup key="menuGroup" className="inserter__sidebar__category-type">
				{type.categories.map((category) => {
					const isActive = currentCategory
						? category === currentCategory
						: category === 'all__' + type.type;

					const categoryIcons = iconsAll.filter((icon) => {
						const iconCats = icon?.categories ?? [];
						return (
							icon.type === type.type &&
							iconCats.includes(category)
						);
					});

					const categoryTitle =
						type.categoriesFull.filter(
							(c) => c.name === category
						)[0]?.title ?? category;

					return (
						<MenuItem
							key={`category-${category}`}
							className={classnames({
								'is-active': isActive,
							})}
							onClick={() => onClickCategory(category)}
							isPressed={isActive}
						>
							{categoryTitle.includes("New") ? (
								<>
								{categoryTitle.replace("New", "")}
								<span className="new">{__('New', 'block-icons-google')}</span>
								</>
							) : (
								<>{categoryTitle}</>
							)}
							<span>
								{category === 'all__' + type.type
									? type.count
									: categoryIcons.length}
							</span>
						</MenuItem>
					);
				})}
			</MenuGroup>
		);
	}

	const searchResults = (
		<div key="iconsList" className="icons-list">
			{shownIcons.map((icon) => {
				return (
					<Button
						key={`icon-${icon.name}`}
						className={classnames('icons-list__item', {
							'is-active': icon.name === attributes?.iconName,
							'has-no-icon-fill': icon?.hasNoIconFill,
						})}
						onClick={() =>
							updateIconAtts(icon.name)
						}
					>
						{icon.icon}
						<span className="icons-list__item-title">
							{icon?.title ?? icon.name}
						</span>
					</Button>
				);
			})}
		</div>
	);

	const noResults = (
		<div className="block-editor-inserter__no-results">
			<p>{__('No results found.', 'block-icons-google')}</p>
		</div>
	);

	return (
		<Modal
			className="wp-block-icons__modal"
			title={__('Icon Library', 'block-icons-google')}
			onRequestClose={() => setInserterOpen(false)}
			isFullScreen
		>
			<div
				className={classnames('box-icons', {
					'is-searching': searchInput,
				})}
			>
				<div className="inserter__aside">
					<div className="inserter-aside__search">
						<SearchControl
							value={searchInput}
							onChange={setSearchInput}
						/>
					</div>
					{preparedTypes.map((type) =>
						renderIconTypeCategories(type)
					)}
				</div>
				<div className="inserter__content">
					<div className="inserter__content-header">
						<div className="search-results">
							{searchInput &&
								sprintf(
									// translators: %1$s: Number of icons retruned from search, %2$s: the search input
									_n(
										'%1$s search result for "%2$s"',
										'%1$s search results for "%2$s"',
										shownIcons.length,
										'block-icons-google'
									),
									shownIcons.length,
									searchInput
								)}
						</div>
					</div>
					<div className="inserter__content-grid">
						{[
							isEmpty(shownIcons) && noResults,
							!isEmpty(shownIcons) && searchResults,
						]}
					</div>
				</div>
			</div>
		</Modal>
	);
}
