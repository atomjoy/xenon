<script setup>
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import TagLayout from '@/layouts/admin/TagLayout.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
import { ref, watch, reactive, onBeforeMount } from 'vue';
import { RouterLink, useRoute, useRouter } from 'vue-router';
import Page from '@/utils/page.js';

const router = useRouter();
const route = useRoute();
let paginate = reactive({});
let item = ref({});

onBeforeMount(async () => {
	await loadItem(route.params.slug ?? null);
});

watch(
	() => route.params.slug,
	async function () {
		await loadItem(route.params.slug ?? null);
	}
);

async function loadItem(id) {
	try {
		let res = await axios.get('/web/api/blog/tags/' + id + '?page=' + route.query.page ?? 1);
		item.value = res?.data.data;
		paginate = item.value.articles?.paginate;
		item.value.about = 'Tag ' + item.value.slug + ' articles';
	} catch (err) {
		console.log('Load error', err);
		item.value = {
			name: 'error404',
			about: 'Invalid tag name.',
		};
	}
}

watch(
	() => route.query.page,
	function () {
		loadItem(route.params.slug ?? null);
	}
);

function prev() {
	router.push({ query: { page: Page.prev(paginate.current_page, paginate.total_pages) } });
}

function next() {
	router.push({ query: { page: Page.next(paginate.current_page, paginate.total_pages) } });
}
</script>

<template>
	<TagLayout :title="item.name ?? item.slug" :description="item.about">
		<div class="blog_list">
			<div class="empty_list">
				<h2 v-if="!item.slug">{{ $t('Invalid tag name.') }}</h2>
				<p v-if="!item.slug">{{ $t('No records found.') }}</p>
			</div>

			<div class="blog_article_small" v-for="article in item.articles?.data">
				<RouterLink :to="'/admin/article/' + article.slug">
					<img :src="'/img/show?path=' + article.image ?? ''" :alt="article.title" loading="lazy" />
				</RouterLink>
				<div class="blog_article_small_category" v-for="cat in article.categories">
					<a :href="'/admin/category/' + cat.slug">#{{ cat.name }}</a>
				</div>
				<h2>
					<span class="blog_article_small_hash">#</span>
					<RouterLink :to="'/admin/article/' + article.slug">{{ article.title }}</RouterLink>
				</h2>
				<p>{{ article.excerpt }}</p>
			</div>
			<div class="blog_article_small_hidden">Required</div>
		</div>

		<div class="blog_paginator">
			<div class="blog_prev_page blog_page_btn" @click="prev()" v-if="paginate.current_page > 1">{{ $t('Prev') }}</div>
			<div class="blog_next_page blog_page_btn" @click="next()" v-if="paginate.current_page < paginate.total_pages">{{ $t('Next') }}</div>
		</div>
	</TagLayout>

	<!-- Seo header meta -->
	<!-- <AddSchema :json="item.schema_seo" />
	<AddMeta :json="item.meta_seo" /> -->

	<ChangeTitle :title="item.name ?? item.slug" />
	<ChangeDescription :description="item.about" />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
