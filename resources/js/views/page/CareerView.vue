<script setup>
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
import Layout from '@/layouts/page/CareerScrollBarLayout.vue';
import Benefits from './parts/Benefits.vue';
import Careers from './parts/Careers.vue';
import CareersAbout from './parts/CareersAbout.vue';
import schema from '@/settings/seo/career_schema.js';
import meta from '@/settings/seo/career_meta.js';
</script>

<template>
	<Layout title="Career" description="Career Inquiries.">
		<CareersAbout />
		<Benefits />
		<Careers />
	</Layout>

	<!-- Seo header meta -->
	<AddMeta :json="JSON.stringify(meta)" />
	<AddSchema :json="JSON.stringify(schema)" />

	<ChangeTitle :title="'Career'" />
	<ChangeDescription :description="'Career Inquiries.'" />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
