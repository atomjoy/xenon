<script setup>
import { onMounted, ref } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import Service from './items/ServiceHome.vue';

let list = ref([]);

onMounted(async () => {
	await load();
});

async function load() {
	let res = await axios.get('/web/api/blog/services?page=1&perpage=6');
	list.value = res?.data?.data ?? [];
}

function addNumber(nr) {
	if (nr < 10) {
		nr = '0' + nr;
	}
	return nr;
}
</script>

<template>
	<div class="page_box" id="services">
		<p class="page_box_subtitle"><i class="fa-solid fa-circle-chevron-right"></i> {{ $t('Our services') }}</p>
		<h1>
			{{ $t('Discover Our') }}<br />
			{{ $t('Digital Solutions') }}
		</h1>

		<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rerum dolores, excepturi pariatur, perferendis consequuntur architecto nemo labore quae minus ea eum velit fugit exercitationem assumenda impedit natus reiciendis quidem!</p>

		<div class="page_box_list">
			<div class="page_items_flex">
				<Service :obj="i" v-for="(i, index) in list" :number="addNumber(index + 1)" />
			</div>
		</div>
	</div>
</template>

<style>
@import url('@/assets/css/page.css');
</style>
