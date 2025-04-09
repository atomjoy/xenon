<template>
	<div class="input-wrapper__icon" v-html="svg"></div>
</template>

<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
	name: {
		type: String,
		required: true,
		default: 'edit-svgrepo-com',
	},
});

let svg = ref('');

onMounted(async () => {
	try {
		// Only from puclic directory
		const res = await fetch(`/svg/${props.name}.svg?raw`);
		svg.value = await res.text();
	} catch (err) {
		console.log('Icon error', err);
	}
});
</script>
