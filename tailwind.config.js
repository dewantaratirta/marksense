import forms from '@tailwindcss/forms';
import { join } from 'path';
import {myCustomTheme} from './tailwind_custom_themes';
import flattenColorPalette from 'tailwindcss/lib/util/flattenColorPalette'

// 1. Import the Skeleton plugin
import { skeleton } from '@skeletonlabs/tw-plugin';

function addVariablesForColors({ addBase, theme }) {
	let allColors = flattenColorPalette(theme("colors"));
	let newVars = Object.fromEntries(
	  Object.entries(allColors).map(([key, val]) => [`--${key}`, val])
	);
  
	addBase({
	  ":root": newVars,
	});
  }


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
		extend: {
			keyframes: {
			  "shine-pulse": {
				"0%": {
				  "background-position": "0% 0%",
				},
				"50%": {
				  "background-position": "100% 100%",
				},
				to: {
				  "background-position": "0% 0%",
				},
			  },
			},
			animation: {
				// ripple: "ripple 3400ms ease infinite",
				ripple:'ripple var(--duration,2s) ease calc(var(--i, 0)*.2s) infinite',
			  },
			  keyframes: {
				ripple: {
				  "0%, 100%": {
					transform: "translate(-50%, -50%) scale(1)",
				  },
				  "50%": {
					transform: "translate(-50%, -50%) scale(0.9)",
				  },
				},
			  },
		  },
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
		forms,
		addVariablesForColors,  // below is the function 
		function ({ matchUtilities, theme }) {
		  matchUtilities(
			{
			  "bg-grid": (value) => ({
				backgroundImage: `url("${svgToDataUri(
				  `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="${value}"><path d="M0 .5H31.5V32"/></svg>`
				)}")`,
			  }),
			  "bg-grid-small": (value) => ({
				backgroundImage: `url("${svgToDataUri(
				  `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="8" height="8" fill="none" stroke="${value}"><path d="M0 .5H31.5V32"/></svg>`
				)}")`,
			  }),
			  "bg-dot": (value) => ({
				backgroundImage: `url("${svgToDataUri(
				  `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="16" height="16" fill="none"><circle fill="${value}" id="pattern-circle" cx="10" cy="10" r="1.6257413380501518"></circle></svg>`
				)}")`,
			  }),
			},
			{ values: flattenColorPalette(theme("backgroundColor")), type: "color" }
		  );
		},
	]
};


export default config;
