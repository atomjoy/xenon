<script setup>
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
import Layout from '@/layouts/page/ContactLayout.vue';
import ReferencesSlider from './parts/ReferencesSlider.vue';
import Item from './parts/ServiceSingle.vue';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
let item = ref({});

onMounted(async () => {
	await load();
});

async function load() {
	let res = await axios.get('/web/api/blog/services/' + route.params.slug ?? 'error');
	item.value = res?.data;
	console.log(item);
}
</script>

<template>
	<Layout title="Service" :description="item.title">
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
