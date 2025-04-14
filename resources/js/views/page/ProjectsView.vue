<script setup>
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import Layout from '@/layouts/page/DefaultLayout.vue';
import Projects from './parts/Projects.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
</script>

<template>
	<Layout title="Projects" description="Our projects.">
		<Projects />
	</Layout>

	<!-- Seo header meta -->
	<!-- <AddSchema :json="item.schema_seo" />
	<AddMeta :json="item.meta_seo" /> -->

	<ChangeTitle :title="$t('Projects')" />
	<ChangeDescription :description="$t('Our projects.')" />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
