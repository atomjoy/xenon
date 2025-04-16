<template></template>
<script setup>
import { watch } from 'vue';

const props = defineProps({
	json: {
		type: Array,
		default: null,
	},
});

watch(
	() => props.json,
	(lang) => {
		if (props.json) {
			console.log('Adding Schema', props.json);

			const head = document.querySelector('head');
			const el = document.createElement('script');

			el.setAttribute('type', 'application/ld+json');
			el.setAttribute('id', 'structured-data');
			el.innerText = JSON.stringify(JSON.parse(props.json));
			head.appendChild(el);
		}
	}
);

function getSchemaObject(id = '#structured-data') {
	let el = document.querySelector(id);
	let obj = JSON.parse(el.innerText);
	return obj;
}
</script>
