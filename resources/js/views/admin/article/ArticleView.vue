<script setup>
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ArticleLayout from '@/layouts/admin/ArticleLayout.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
import IconEye from '@/assets/icons/IconEye.vue';
import { codeToHtml } from 'https://esm.sh/shiki@3.2.1';
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import Comments from './parts/comments/Comments.vue';

const route = useRoute();
let article = ref({});

onMounted(async () => {
	await loadItem(route.params.slug ?? null);
	await highlightCode();

	var elms = document.querySelectorAll('.splide');
	for (var i = 0; i < elms.length; i++) {
		new Splide(elms[i]).mount();
	}
});

async function highlightCode() {
	const all = document.querySelectorAll('code');
	all.forEach(async (f) => {
		const theme = ['github-light', 'slack-ochin', 'vitesse-light', 'everforest-light', 'everforest-dark', 'vitesse-dark', 'one-dark-pro', 'synthwave-84', 'gruvbox-dark-medium', 'gruvbox-dark-soft', 'gruvbox-light-soft', 'rose-pine', 'rose-pine-moon', 'rose-pine-dawn', 'plastic', 'laserwave', 'kanagawa-dragon', 'kanagawa-wave', 'material-theme', 'material-theme-darker'];
		let code = f.innerText;
		f.innerHTML = await codeToHtml(code, {
			lang: 'php',
			themes: {
				light: theme[0], // 0, 1, 2, 13,
				dark: theme[19], // 19, 16, 10, 8, 9, 5, 15, 18, 17, 6, 14,
			},
			defaultColor: 'light',
		});
	});
}

async function loadItem(id) {
	try {
		let res = await axios.get('/web/api/blog/articles/' + id + '?page=' + route.query.page + '&page_reply=' + route.query.page_reply);
		article.value = res?.data.data;
	} catch (err) {
		console.log('Load error', err);
	}
}
</script>
<template>
	<ArticleLayout :title="$t('Blog')" :description="article.title">
		<div class="blog_article">
			<div class="blog_article_big_image" v-if="article.image">
				<img :src="'/img/show?path=' + article.image ?? ''" />
			</div>

			<h1 class="blog_article_title"><i class="blog_hash">#</i> {{ article.title }}</h1>

			<div class="blog_article_date">
				{{ article.created_at }}

				<span class="blog_article_category" v-for="c in article.categories">
					<a :href="'/admin/category/' + c.slug" target="_blank">#{{ c.name.toLowerCase() }}</a>
				</span>

				<div class="blog_article_small_views">
					<IconEye /> <span> {{ article.views }}</span>
				</div>
			</div>

			<p class="blog_article_excerpt">{{ article.excerpt }}</p>

			<div class="blog_article_html" v-html="article.content_cleaned"></div>

			<div class="blog_article_tags">
				<span class="blog_article_tag" v-for="c in article.tags">
					<a :href="'/admin/tag/' + c.slug" target="_blank">{{ c.slug.toLowerCase() }}</a>
				</span>
			</div>

			<div class="blog_article_author">
				<img :src="'/img/avatar?path=' + article?.author?.avatar ?? ''" class="blog_article_author_avatar" />
				<div class="blog_article_author_details">
					<div class="blog_article_author_details_name">{{ article?.author?.name ?? $t('#Unknown404') }}</div>
					<div class="blog_article_author_details_bio">{{ article?.author?.bio ?? '' }}</div>
				</div>
			</div>

			<div class="author_articles" v-if="article?.author?.articles.length > 0">
				<h2><i class="blog_hash">#</i> {{ $t('More author articles') }}</h2>
				<div class="author_article_small" v-for="a in article?.author?.articles">
					<a :href="'/admin/article/' + a.slug" :title="a.title">
						<h3 class="author_article_small_title">{{ a.title }}</h3>
					</a>
					<div class="author_article_small_details">
						<a :href="'/admin/article/' + a.slug" :title="a.title">
							<img :src="'/img/show?path=' + a.image" />
						</a>
						<p class="author_article_small_desc">{{ a.excerpt }}</p>
					</div>
				</div>
			</div>

			<Comments :article="article" />
		</div>
	</ArticleLayout>

	<!-- Seo header meta -->
	<AddSchema :json="article.schema_seo" />
	<AddMeta :json="article.meta_seo" />
	<ChangeTitle :title="article.title ?? ''" />
	<ChangeDescription :description="article.excerpt ?? ''" />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
