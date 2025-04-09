<template></template>
<script setup>
import { watch } from 'vue';

const props = defineProps({
	json: {
		type: [Array, Object],
		default: [],
	},
});

const head = document.querySelector('head');
const el = document.createElement('script');

watch(
	() => props.json,
	function (n, o) {
		try {
			if (props.json) {
				el.setAttribute('type', 'application/ld+json');
				el.setAttribute('id', 'structured-data');
				el.innerText = JSON.stringify(JSON.parse(props.json));
				head.appendChild(el);
			}
		} catch (err) {}
	}
);

function getSchemaObject(id = '#structured-data') {
	let el = document.querySelector(id);
	let obj = JSON.parse(el.innerText);
	return obj;
}
</script>
