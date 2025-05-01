<script setup>
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
import Layout from '@/layouts/page/ContactLayout.vue';
import Teams from './parts/Teams.vue';
import ReferencesSlider from './parts/ReferencesSlider.vue';
import schema from '@/settings/seo/team_schema.js';
import meta from '@/settings/seo/team_meta.js';
</script>

<template>
	<Layout title="Team" description="Our team employees.">
		<Teams />
		<ReferencesSlider />
	</Layout>

	<!-- Seo header meta -->
	<AddMeta :json="JSON.stringify(meta)" />
	<AddSchema :json="JSON.stringify(schema)" />

	<ChangeTitle :title="'Team'" />
	<ChangeDescription :description="'Our latest team.'" />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
