/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { Button, Placeholder } from '@wordpress/components';
import { Icon } from '@wordpress/icons';

/**
 * Internal dependencies
 */
import { defaultIcon, iconInterests } from '../../icons/default';
import Inserter from '../inserter';

export default function Opener(props) {
	const {
		isInserterOpen,
		setInserterOpen,
	} = props;

	const instructions = () => {
		const messages = {
			default: __(
				'Choose an icon from the library.',
				'block-icons-google'
			),
			noCustom: __(
				'Choose an icon from the library.',
				'block-icons-google'
			),
			noMediaLibrary: __(
				'Select an icon from the Google Font Icons library.',
				'block-icons-google'
			),
			noCustomNoMediaLibrary: __(
				'Explore the icon library and choose one.',
				'block-icons-google'
			),
		};

		return messages.default;
	};

    const openInserter = () => {
        // Add your class to the body element
        document.body.classList.add('blockIconsInserterOpen');
        document.body.classList.add('blockIcons');

        // Open the Inserter
        setInserterOpen(true);

        // Remove the class after 3 seconds
        setTimeout(() => {
            document.body.classList.remove('blockIconsInserterOpen');
        }, 1500);
    };

	return (
		<Placeholder
			className="has-illustration"
			icon={defaultIcon}
			label={__('Icon', 'block-icons-google')}
			instructions={instructions()}
		>
			<Icon
				className="wp-block-icons__opener"
				icon={iconInterests}
			/>
			 <Button isPrimary onClick={openInserter}>
				{__('Icon Library', 'block-icons-google')}
			</Button>
			<Inserter
				setInserterOpen={setInserterOpen}
				isInserterOpen={isInserterOpen}
			/>
		</Placeholder>
	);
}
