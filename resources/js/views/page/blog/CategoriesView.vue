<script setup>
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTheme from '@/components/utils/ChangeTheme/ChangeThemeStorage.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
import { codeToHtml } from 'https://esm.sh/shiki@3.2.1';
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
let article = ref({});

onMounted(async () => {
	await loadItem(route.params.slug ?? null);
	await highlightCode();
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
		let res = await axios.get('/web/api/blog/categories');
		article.value = res?.data.data;
	} catch (err) {
		console.log('Load error', err);
	}
}
</script>
<template>
	<div class="page_header">
		<ChangeTheme />
		<div class="page_header_content">
			<a href="/blog" class="blog_link">{{ $t('BLOG') }}</a>
		</div>
	</div>
	<div class="page_content">
		<div class="blog_article">Categories</div>
	</div>
	<div class="page_footer">
		<div class="page_footer_content">2025r. All rights reserved.</div>
	</div>

	<!-- Seo header meta -->
	<AddSchema :json="article.schema_seo" />
	<AddMeta :json="article.meta_seo" />
	<ChangeTitle :title="article.title ?? '404 Page not found'" />
	<ChangeDescription :description="article.excerpt ?? 'Page does not exists.'" />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
