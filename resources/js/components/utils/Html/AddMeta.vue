<template></template>
<script setup>
import { useI18n } from 'vue-i18n';
import { watch } from 'vue';

const { t, locale } = useI18n({ useScope: 'global' });

const props = defineProps({
	json: {
		type: Array,
		default: null,
	},
});

watch(
	() => props.json,
	(lang) => {
		const head = document.querySelector('head');

		try {
			console.log('Adding Meta', props.json);

			let arr = JSON.parse(props.json);

			arr.forEach((i) => {
				const meta = document.createElement('meta');
				meta.setAttribute(i.attribute, i.value);
				meta.setAttribute('content', t(i.content));
				head.appendChild(meta);
			});
		} catch (err) {
			console.log('Add Meta error', err);
		}
	}
);
</script>

<!--
// Required in main.js createI18n(options)
allowComposition: true,
globalInjection: true,
legacy: false,
-->
