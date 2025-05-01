<script setup>
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
import Layout from '@/layouts/page/ContactScrollBarLayout.vue';
import References from './parts/References.vue';
import schema from '@/settings/seo/references_schema.js';
import meta from '@/settings/seo/references_meta.js';
</script>

<template>
	<Layout title="References" description="Our references.">
		<References />
	</Layout>

	<!-- Seo header meta -->
	<AddMeta :json="JSON.stringify(meta)" />
	<AddSchema :json="JSON.stringify(schema)" />

	<ChangeTitle :title="'Testimonials'" />
	<ChangeDescription :description="'Our testimonials'" />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
