<script setup>
import { RouterLink } from 'vue-router';
import { useAuthStore } from '@/stores/auth.js';

const store = useAuthStore();

const props = defineProps({
	edit: { default: false },
});
</script>

<template>
	<RouterLink to="/admin/subscribers" class="panel_settings_link">
		{{ $t('List') }}
	</RouterLink>

	<RouterLink to="/admin/subscribers/create" class="panel_settings_link">
		{{ $t('Create') }}
	</RouterLink>

	<RouterLink to="/admin/subscribers/edit" class="panel_settings_link" :class="{ 'router-link-active': props.edit }">
		{{ $t('Edit') }}
	</RouterLink>

	<RouterLink to="/web/api/admin/subscribers/export/csv" class="panel_settings_link" target="_blank" v-if="store.hasRole('admin', 'admin') || store.hasRole('super_admin', 'admin')">
		{{ $t('Export') }}
	</RouterLink>
</template>
