<script setup>
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
import Layout from '@/layouts/page/ContactScrollBarLayout.vue';
import Questions from './parts/Questions.vue';
</script>

<template>
	<Layout title="FAQs" description="Question? Look here.">
		<Questions />
	</Layout>

	<!-- Seo header meta -->
	<!-- <AddSchema :json="item.schema_seo" />
	<AddMeta :json="item.meta_seo" /> -->

	<ChangeTitle :title="'FAQs'" />
	<ChangeDescription :description="'Have a question?'" />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
