<template></template>
<script setup>
import { useI18n } from 'vue-i18n';
import { onMounted, watch } from 'vue';

const { t, locale } = useI18n({ useScope: 'global' });

const props = defineProps({
	json: {
		type: String,
		default: null,
	},
});

onMounted(() => {
	load();
});

watch(
	() => props.json,
	(lang) => {
		load();
	}
);

function load() {
	removeMeta();

	const head = document.querySelector('head');

	try {
		if (props.json) {
			console.log('Adding Meta', props.json);

			let arr = JSON.parse(props.json);

			arr.forEach((i) => {
				const meta = document.createElement('meta');
				meta.setAttribute(i.attribute, i.value);
				meta.setAttribute('content', t(i.content));
				meta.setAttribute('class', 'meta-data');
				head.appendChild(meta);
			});
		}
	} catch (err) {
		console.log('Add Meta error', err);
	}
}

function removeMeta(id = '.meta-data') {
	let all = document.querySelectorAll(id);
	all.forEach((i) => i.remove());
}
</script>

<!--
// Required in main.js createI18n(options)
allowComposition: true,
globalInjection: true,
legacy: false,
-->
