<template></template>
<script setup>
import { watch } from 'vue';
import { useI18n } from 'vue-i18n';

const { t, locale } = useI18n({ useScope: 'global' });

const props = defineProps({
	json: {
		type: [Array, Object],
		default: [],
	},
});

const head = document.querySelector('head');

watch(
	() => props.json,
	function (n, o) {
		try {
			let arr = JSON.parse(props.json);

			arr.forEach((i) => {
				const meta = document.createElement('meta');
				meta.setAttribute(i.attribute, i.value);
				meta.setAttribute('content', t(i.content));
				head.appendChild(meta);
			});
		} catch (err) {}
	}
);
</script>

<!--
// Required in main.js createI18n(options)
allowComposition: true,
globalInjection: true,
legacy: false,
-->
