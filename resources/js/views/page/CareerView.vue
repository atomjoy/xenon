<script setup>
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
import Layout from '@/layouts/page/DefaultLayout.vue';
import ContactCareer from './parts/ContactCareer.vue';
import { RouterLink } from 'vue-router';
import { onMounted } from 'vue';

onMounted(async () => {});
</script>

<template>
	<Layout title="Career" description="Career Inquiries.">
		<ContactCareer />
	</Layout>

	<!-- Seo header meta -->
	<!-- <AddSchema :json="item.schema_seo" />
	<AddMeta :json="item.meta_seo" /> -->

	<ChangeTitle :title="$t('Career')" />
	<ChangeDescription :description="$t('Career Inquiries.')" />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
