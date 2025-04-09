<script setup>
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import Layout from '@/layouts/page/DefaultLayout.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
import { onMounted } from 'vue';
import { RouterLink } from 'vue-router';

onMounted(async () => {});
</script>

<template>
	<Layout title="Projects" description="Our latest projects."> Projects page </Layout>

	<!-- Seo header meta -->
	<!-- <AddSchema :json="item.schema_seo" />
	<AddMeta :json="item.meta_seo" /> -->

	<ChangeTitle :title="$t('Projects')" />
	<ChangeDescription :description="$t('Our latest projects.')" />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
