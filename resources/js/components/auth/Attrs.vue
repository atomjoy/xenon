<!-- https://vuejs.org/guide/components/attrs -->

<script setup>
import { useAttrs, ref } from 'vue';

const emits = defineEmits(['update:modelValue', 'valid', 'invalid']);

const props = defineProps({
	modelValue: [String, Number],
	name: { type: String },
	label: { type: String },
	placeholder: { type: String },
	type: { type: String, default: 'text' },
	focus: false,
});

// Disable attrs inherit
// Catch class in defineProps({ class: { type: String } })
// or use
defineOptions({
	// Disable attrs inherit for first element
	// then use :class="$attrs.class"
	// or v-bind="$attrs" in inner element
	inheritAttrs: false,
});

const attrs = useAttrs();

let open = ref(false);

console.log('Attr', attrs);

function onFocus(event) {
	open.value = true;
	validatePass(event);
}

function onBlur(event) {
	open.value = false;
}

function validatePass(event) {
	let str = event?.target?.value ?? '';

	if (str.replace(' ', '').length >= 3) {
		emits('valid', str);
	} else {
		emits('invalid', str);
	}
}
</script>

<template>
	<div class="form_group">
		<label class="form_label">{{ props.label }}</label>
		<input
			v-model="props.modelValue"
			class="form_input"
			:class="$attrs.class"
			:type="props.type"
			:name="props.name"
			:placeholder="props.placeholder"
			@input="emits('update:modelValue', $event.target.value)"
			@keyup="validatePass"
			@focus="onFocus"
			@blur="onBlur"
		/>
	</div>
</template>
