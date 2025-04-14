<script setup>
import { onMounted, ref } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import Project from './items/Project.vue';
import Pagination from './items/Pagination.vue';

const router = useRouter();
const route = useRoute();
let current_page = ref(1);
let last_page = ref(1);
let perpage = ref(6);
let list = ref([]);

onMounted(async () => {
	current_page.value = route.query.page ?? 1;
	await load();
});

async function load() {
	let res = await axios.get('/web/api/blog/projects?page=' + current_page.value + '&perpage=' + perpage.value);
	list.value = res?.data?.data ?? [];
	current_page.value = res?.data?.paginate.current_page ?? 1;
	last_page.value = res?.data?.paginate.total_pages ?? 1;
	router.push({ query: { page: current_page.value } });
}
</script>

<template>
	<div class="page_box" id="projects">
		<p class="page_box_subtitle"><i class="fa-solid fa-circle-chevron-right"></i> {{ $t('Our projects') }}</p>
		<h1>
			{{ $t('Our Recent Work Portfolio') }}
		</h1>

		<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rerum dolores, excepturi pariatur, perferendis consequuntur architecto nemo labore quae minus ea eum velit fugit exercitationem assumenda impedit natus reiciendis quidem!</p>

		<div class="page_box_list">
			<div class="page_items_flex">
				<Project :obj="i" v-for="i in list" />
				<div class="page_project" style="visibility: hidden" v-if="list.length % 2">Required</div>
			</div>
		</div>

		<Pagination href="/projects" :current_page="current_page" :last_page="last_page" :list="list" />
	</div>
</template>

<style>
@import url('@/assets/css/page.css');
</style>
