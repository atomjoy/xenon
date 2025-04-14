<script setup>
import { onMounted, ref } from 'vue';
import Reference from './items/Reference.vue';

let list = ref([]);

onMounted(async () => {
	await load();

	var el = document.querySelector('.splide-references');

	new Splide(el, {
		type: 'loop',
		classes: {
			prev: 'splide__arrow--prev slider-prev',
			next: 'splide__arrow--next slider-next',
		},
	}).mount();
});

async function load() {
	let res = await axios.get('/web/api/blog/references?page=1&perpage=5');
	list.value = res?.data?.data ?? [];
}
</script>

<template>
	<div class="page_box">
		<p class="page_box_subtitle"><i class="fa-solid fa-circle-chevron-right"></i> {{ $t('Client Testimonials') }}</p>
		<h1>
			{{ $t('Testimonials that') }} <br />
			{{ $t('Speak to My results') }}
		</h1>

		<div class="page_box_list">
			<section class="splide splide-references" :aria-label="$t('References')">
				<div class="splide__track">
					<ul class="splide__list">
						<li class="splide__slide" v-for="i in list">
							<Reference :vote="i.vote" :name="i.name" :company="i.company" :message="i.message" :image="'/img/avatar?path=' + i.image" />
						</li>
					</ul>
				</div>
			</section>
		</div>
	</div>
</template>

<style>
@import url('@/assets/css/page.css');

.splide-references {
	float: left;
	width: 100%;
	height: auto;
}

.splide-references .splide__slide {
	float: left;
	width: 100%;
	height: auto;
}

.splide-references .splide__slide > div {
	float: left;
	width: 100%;
	height: auto;
	margin-bottom: 0px;
}

.splide-references button.slider-prev {
	background-color: var(--accent) !important;
	height: 4em;
	width: 4em;
	stroke: #fff;
	fill: #fff;
}

.splide-references button.slider-next {
	background-color: var(--accent) !important;
	height: 4em;
	width: 4em;
}

.splide-references button.slider-prev svg path,
.splide-references button.slider-next svg path {
	stroke: #fff;
	fill: #fff;
}
</style>
