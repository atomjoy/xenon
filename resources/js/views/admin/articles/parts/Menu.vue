<script setup>
import { RouterLink } from 'vue-router';
const props = defineProps({
	edit: { default: false },
});
</script>

<template>
	<RouterLink to="/admin/articles" class="panel_settings_link">
		{{ $t('List') }}
	</RouterLink>

	<RouterLink to="/admin/articles/create" class="panel_settings_link">
		{{ $t('Create') }}
	</RouterLink>

	<RouterLink to="/admin/articles/edit" class="panel_settings_link" :class="{ 'router-link-active': props.edit }">
		{{ $t('Edit') }}
	</RouterLink>
</template>
