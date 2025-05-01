<script setup>
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
import Layout from '@/layouts/page/ContactLayout.vue';
import Projects from './parts/Projects.vue';
import ReferencesSlider from './parts/ReferencesSlider.vue';
import schema from '@/settings/seo/projects_schema.js';
import meta from '@/settings/seo/projects_meta.js';
</script>

<template>
	<Layout title="Projects" description="Our projects.">
		<Projects />
		<ReferencesSlider />
	</Layout>

	<!-- Seo header meta -->
	<AddMeta :json="JSON.stringify(meta)" />
	<AddSchema :json="JSON.stringify(schema)" />

	<ChangeTitle :title="'Projects'" />
	<ChangeDescription :description="'Our projects.'" />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
