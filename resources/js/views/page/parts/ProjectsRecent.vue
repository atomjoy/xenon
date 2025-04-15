<script setup>
import { onMounted, ref } from 'vue';
import Project from './items/Project.vue';
import ButtonLink from './items/ButtonLinkRight.vue';

let list = ref([]);

onMounted(async () => {
	await load();
});

async function load() {
	let res = await axios.get('/web/api/blog/projects?page=1&perpage=2');
	list.value = res?.data?.data ?? [];
}
</script>

<template>
	<div class="page_box" id="projects">
		<p class="page_box_subtitle"><i class="fa-solid fa-circle-chevron-right"></i> {{ $t('Our projects') }}</p>
		<h1>
			{{ $t('Our Recent') }} <br />
			{{ $t('Work Portfolio') }}
		</h1>

		<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rerum dolores, excepturi pariatur, perferendis consequuntur architecto nemo labore quae minus ea eum velit fugit exercitationem assumenda impedit natus reiciendis quidem!</p>

		<div class="page_box_list">
			<div class="page_items_flex">
				<Project :obj="i" v-for="i in list" />
				<!-- <div class="page_project" style="visibility: hidden" v-if="list.length % 2 == 0">Required</div> -->
			</div>
		</div>

		<div class="page_box_padding_block">
			<ButtonLink name="More Projects" href="/projects" />
		</div>
	</div>
</template>

<style>
@import url('@/assets/css/page.css');
</style>
