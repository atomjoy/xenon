<script setup>
import { onMounted, ref } from 'vue';
import Team from './items/Team.vue';
import ButtonLink from './items/ButtonLinkRight.vue';

let list = ref([]);

onMounted(async () => {
	await load();
});

async function load() {
	let res = await axios.get('/web/api/blog/teams?page=1&perpage=3');
	list.value = res?.data?.data ?? [];
}
</script>

<template>
	<div class="page_box" id="teams">
		<p class="page_box_subtitle"><i class="fa-solid fa-circle-chevron-right"></i> {{ $t('Team members') }}</p>
		<h1>
			{{ $t('Meet Our') }} <br />
			{{ $t('Professional Team') }}
		</h1>

		<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rerum dolores, excepturi pariatur, perferendis consequuntur architecto nemo labore quae minus ea eum velit fugit exercitationem assumenda impedit natus reiciendis quidem!</p>

		<div class="page_box_list">
			<div class="page_items_flex">
				<Team :obj="i" v-for="i in list" />
				<div class="page_employee" style="visibility: hidden" v-if="list.length % 2 == 0">Required</div>
			</div>
		</div>

		<div class="page_box_padding_block">
			<ButtonLink name="See All Members" href="/team" />
		</div>
	</div>
</template>

<style>
@import url('@/assets/css/page.css');
</style>
