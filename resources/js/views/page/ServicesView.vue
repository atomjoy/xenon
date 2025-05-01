<script setup>
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
import Layout from '@/layouts/page/ContactLayout.vue';
import Services from './parts/Services.vue';
import ReferencesSlider from './parts/ReferencesSlider.vue';
import schema from '@/settings/seo/services_schema.js';
import meta from '@/settings/seo/services_meta.js';
</script>

<template>
	<Layout title="Services" description="Our services.">
		<Services />
		<ReferencesSlider />
	</Layout>

	<!-- Seo header meta -->
	<AddMeta :json="JSON.stringify(meta)" />
	<AddSchema :json="JSON.stringify(schema)" />

	<ChangeTitle :title="'Services'" />
	<ChangeDescription :description="'Our services.'" />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
