<template>
	<div>
		<component :is="currentStep" :data="formData" @next="nextStep" @prev="prevStep" />

		<div class="buttons">
			<button v-if="currentStepIndex !== 0" @click="prevStep">Previous</button>
			<button v-if="currentStepIndex !== steps.length - 1" @click="nextStep">Next</button>
			<button v-else @click="submitForm">Submit</button>
		</div>
	</div>
</template>

<script setup>
import { ref, computed, defineAsyncComponent } from 'vue';

const currentStepIndex = ref(0);
const formData = ref({});

const currentStep = computed(() => {
	const stepComponent = [defineAsyncComponent(() => import('./Step1.vue')), defineAsyncComponent(() => import('./Step2.vue')), defineAsyncComponent(() => import('./Step3.vue'))];
	return stepComponent[currentStepIndex.value];
});

const nextStep = (data) => {
	formData.value = { ...formData.value, ...data };
	currentStepIndex.value++;
};

const prevStep = () => {
	currentStepIndex.value--;
};

const submitForm = () => {
	// ...
};
</script>
