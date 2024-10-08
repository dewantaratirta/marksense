import forms from '@tailwindcss/forms';
import { join } from 'path';
import {myCustomTheme} from './tailwind_custom_themes';

// 1. Import the Skeleton plugin
import { skeleton } from '@skeletonlabs/tw-plugin';


/** @type {import('tailwindcss').Config} */
const config = {
	darkMode: ["class"],
	content: [
		"./src/**/*.{html,js,svelte,ts}",
		"./resources/**/*.{html,js,svelte,ts}",
		join(require.resolve(
			'@skeletonlabs/skeleton'),
			'../**/*.{html,js,svelte,ts}'
		)
	],
	safelist: ["dark"],
	theme: {
		extend: {},
	},
	plugins: [
		// 4. Append the Skeleton plugin (after other plugins)
		skeleton({
			themes: { preset: [ "wintry" ],
				custom: [
					myCustomTheme
				]
			 }
		}),
		forms
	]
};

export default config;
