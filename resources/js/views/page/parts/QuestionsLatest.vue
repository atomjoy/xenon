<script setup>
import { onMounted, ref } from 'vue';
import Question from './items/Question.vue';
import ButtonLink from './items/ButtonLinkRight.vue';

let list = ref([]);

onMounted(async () => {
	await load();
});

async function load() {
	let res = await axios.get('/web/api/blog/questions?page=1&perpage=5');
	list.value = res?.data?.data ?? [];
}
</script>

<template>
	<div class="page_box">
		<p class="page_box_subtitle"><i class="fa-solid fa-circle-chevron-right"></i> {{ $t('Questions and Answers') }}</p>
		<h1>
			{{ $t('Question?') }} <br />
			{{ $t('Look here') }}
		</h1>

		<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rerum dolores, excepturi pariatur, perferendis consequuntur architecto nemo labore quae minus ea eum velit fugit exercitationem assumenda impedit natus reiciendis quidem!</p>

		<div class="page_box_list">
			<Question :message="i.message" :answer="i.answer" v-for="i in list" />
		</div>

		<div class="page_box_padding_block">
			<ButtonLink name="See Our FAQs" href="/faq" />
		</div>
	</div>
</template>

<style>
@import url('@/assets/css/page.css');
</style>
