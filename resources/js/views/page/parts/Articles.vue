<script setup>
import { onMounted, ref } from 'vue';
import Article from './items/Article.vue';
import ButtonLink from './items/ButtonLinkRight.vue';

let list = ref([]);

onMounted(async () => {
	await load();
});

async function load() {
	let res = await axios.get('/web/api/blog/articles?page=1&perpage=3');
	list.value = res?.data?.data ?? [];
}
</script>

<template>
	<div class="page_box" id="articles">
		<p class="page_box_subtitle"><i class="fa-solid fa-circle-chevron-right"></i> {{ $t('Our articles') }}</p>
		<h1>
			{{ $t('Our Latest') }} <br />
			{{ $t('News & Blogs') }}
		</h1>

		<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rerum dolores, excepturi pariatur, perferendis consequuntur architecto nemo labore quae minus ea eum velit fugit exercitationem assumenda impedit natus reiciendis quidem!</p>

		<div class="page_box_list">
			<div class="page_items_flex">
				<Article :obj="i" v-for="i in list" />
			</div>
		</div>

		<div class="page_box_padding_block">
			<ButtonLink name="All Artciles" href="/articles" />
		</div>
	</div>
</template>

<style>
@import url('@/assets/css/page.css');
</style>
