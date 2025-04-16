<script setup>
const props = defineProps({
	obj: { type: Object, default: {} },
});
</script>

<template>
	<div class="page_box" id="service">
		<p class="page_box_subtitle"><i class="fa-solid fa-circle-chevron-right"></i> {{ $t('Service') }}</p>
		<h1>
			{{ $t(props.obj.title ?? '') }}
		</h1>

		<img class="page_service_image" :src="'/img/show?path=' + props.obj.image" :alt="$t('Service Image')" />

		<p class="page_service_excerpt">{{ $t(props.obj.excerpt ?? '') }}</p>

		<div class="page_service_details" v-html="props.obj.content_cleaned"></div>
	</div>
</template>

<style>
@import url('@/assets/css/page.css');

.page_service_image {
	float: left;
	width: 100%;
	height: auto;
	aspect-ratio: 16/9;
	margin-bottom: 20px;
	object-fit: cover;
	border-radius: var(--border-radius);
}

.page_service_excerpt {
	float: left;
	width: 100%;
	height: auto;
}
</style>
