<script setup>
import { onMounted, ref } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import Pagination from './items/Pagination.vue';
import Benefit from './items/Benefit.vue';
import Perk from './items/Perk.vue';

const router = useRouter();
const route = useRoute();
let current_page = ref(1);
let last_page = ref(1);
let perpage = ref(6);
let list = ref([]);

onMounted(async () => {
	// current_page.value = route.query.page ?? 1;
	// await load();
});

async function load() {
	let res = await axios.get('/web/api/blog/benefits?page=' + current_page.value + '&perpage=' + perpage.value);
	list.value = res?.data?.data ?? [];
	current_page.value = res?.data?.paginate.current_page ?? 1;
	last_page.value = res?.data?.paginate.total_pages ?? 1;
	router.push({ query: { page: current_page.value } });
}
</script>

<template>
	<div class="page_box" id="benefits">
		<p class="page_box_subtitle"><i class="fa-solid fa-circle-chevron-right"></i> {{ $t('Benefits') }}</p>
		<h1>
			{{ $t('Our Perks & Benefits') }}
		</h1>

		<div class="page_box_list">
			<div class="page_box_flex">
				<Benefit icon="fa-solid fa-users" :title="$t('Profesional Team')" />
				<Perk icon="fa-solid fa-gift" :title="$t('Bonuses')" />
				<Benefit icon="fa-solid fa-shield-heart" :title="$t('Health Insurance')" />
				<Perk icon="fa-solid fa-map-location-dot" :title="$t('Tours')" />
			</div>

			<div class="page_box_flex">
				<Perk icon="fa-solid fa-cubes" :title="$t('Problem Solving')" />
				<Benefit icon="fa-solid fa-sack-dollar" :title="$t('Competitive Salary')" />
				<Perk icon="fa-solid fa-car" :title="$t('Transportation')" />
				<Benefit icon="fa-solid fa-mug-hot" :title="$t('Free Snacks & Drinks')" />
			</div>
		</div>

		<!-- <Pagination href="/benefit" :current_page="current_page" :last_page="last_page" :list="list" /> -->
	</div>
</template>

<style>
@import url('@/assets/css/page.css');
</style>
