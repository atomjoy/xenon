<script setup>
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
import Layout from '@/layouts/page/ContactScrollBarLayout.vue';
import Questions from './parts/Questions.vue';
import schema from '@/settings/seo/questions_schema.js';
import meta from '@/settings/seo/questions_meta.js';
</script>

<template>
	<Layout title="FAQs" description="Question? Look here.">
		<Questions />
	</Layout>

	<!-- Seo header meta -->
	<AddMeta :json="JSON.stringify(meta)" />
	<AddSchema :json="JSON.stringify(schema)" />

	<ChangeTitle :title="'FAQs'" />
	<ChangeDescription :description="'Have a question?'" />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
