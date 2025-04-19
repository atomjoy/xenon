<script setup>
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
import Layout from '@/layouts/page/ContactLayout.vue';
import ReferencesSlider from './parts/ReferencesSlider.vue';
import Item from './parts/ProjectSingle.vue';
import { onBeforeMount, ref } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
let item = ref({});

onBeforeMount(async () => {
	await load();
});

async function load() {
	let res = await axios.get('/web/api/blog/projects/' + route.params.slug ?? 'error');
	item.value = res?.data;
}
</script>

<template>
	<Layout title="Project" :description="item?.title">
		<Item :obj="item" />
		<ReferencesSlider />
	</Layout>

	<!-- Seo header meta -->
	<AddSchema :json="item.schema_seo" />
	<AddMeta :json="item.meta_seo" />

	<ChangeTitle :title="item.title" />
	<ChangeDescription :description="item.excerpt" />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
