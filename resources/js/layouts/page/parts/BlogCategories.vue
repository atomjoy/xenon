<script setup>
import { RouterLink } from 'vue-router';
import { ref, onMounted } from 'vue';

let categories = ref({});

onMounted(async () => {
	await loadCategories();
});

async function loadCategories() {
	try {
		let res = await axios.get('/web/api/blog/categories');
		categories.value = res?.data.data;
	} catch (err) {
		console.log('Load error', err);
	}
}
</script>
<template>
	<div class="page_header_blog_categories">
		<div class="blog_category_link" v-for="c in categories">
			<RouterLink :to="'/category/' + c.slug" :title="c.name">
				#<span>{{ c.name ?? '' }}</span>
			</RouterLink>
		</div>
	</div>
</template>
