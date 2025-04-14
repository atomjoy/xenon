<script setup>
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
import Layout from '@/layouts/page/ContactScrollBarLayout.vue';
import References from './parts/References.vue';
</script>

<template>
	<Layout title="References" description="Our references.">
		<References />
	</Layout>

	<!-- Seo header meta -->
	<!-- <AddSchema :json="item.schema_seo" />
	<AddMeta :json="item.meta_seo" /> -->

	<ChangeTitle :title="$t('Testimonials')" />
	<ChangeDescription :description="$t('Our testimonials')" />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
