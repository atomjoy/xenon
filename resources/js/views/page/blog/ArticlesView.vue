<script setup>
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import BlogLayout from '@/layouts/page/BlogLayout.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
import { ref, onMounted, watch, reactive } from 'vue';
import { RouterLink, useRoute, useRouter } from 'vue-router';
import Page from '@/utils/page.js';
import schema from '@/settings/seo/articles_schema.js';
import meta from '@/settings/seo/articles_meta.js';

const router = useRouter();
const route = useRoute();
let paginate = reactive({});
let item = ref({});

onMounted(async () => {
	await loadItem(route.params.slug ?? null);
	// console.log('Item', item);
});

async function loadItem(id) {
	try {
		let res = await axios.get('/web/api/blog/articles/?page=' + route.query.page ?? 1);
		item.value = res?.data;
		paginate = item.value.paginate;
	} catch (err) {
		console.log('Load error', err);
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
	<BlogLayout title="Blog" description="Our latest blog articles.">
		<div class="blog_list">
			<div class="empty_list">
				<p v-if="item?.data?.length == 0">{{ $t('The list is empty.') }}</p>
			</div>

			<div class="blog_article_small" v-for="article in item.data">
				<RouterLink :to="'/article/' + article.slug" :title="article.title">
					<img :src="'/img/show?path=' + article.image ?? ''" :alt="article.title" />
				</RouterLink>
				<div class="blog_article_small_category" v-for="cat in article.categories">
					<a :href="'/category/' + cat.slug" :title="cat.name">#{{ cat.name }}</a>
				</div>
				<h2>
					<span class="blog_article_small_hash">#</span>
					<RouterLink :to="'/article/' + article.slug" :title="article.title">{{ article.title }}</RouterLink>
				</h2>
				<p>{{ article.excerpt }}</p>
			</div>
			<div class="blog_article_small_hidden">Required</div>
		</div>

		<div class="blog_paginator">
			<div class="blog_prev_page blog_page_btn" @click="prev()" v-if="paginate.current_page > 1">{{ $t('Prev') }}</div>
			<div class="blog_next_page blog_page_btn" @click="next()" v-if="paginate.current_page < paginate.total_pages">{{ $t('Next') }}</div>
		</div>
	</BlogLayout>

	<!-- Seo header meta -->
	<AddMeta :json="JSON.stringify(meta)" />
	<AddSchema :json="JSON.stringify(schema)" />

	<ChangeTitle title="Blog" />
	<ChangeDescription description="You can read the latest articles on our blog here." />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
