<script setup>
import { RouterLink } from 'vue-router';
import PanelLayout from '@/layouts/panel/PanelLayout.vue';
</script>

<template>
	<PanelLayout title="Dashboard">
		<!-- page content goes here -->
		Panel content goes here.
		<RouterLink to="/panel"> {{ $t('Page Title') }}</RouterLink>
		<!-- page content goes here -->
	</PanelLayout>
</template>

<style>
@import url('@/assets/css/panel/panel.css');
</style>
