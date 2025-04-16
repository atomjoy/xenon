<script setup>
const props = defineProps({
	obj: { type: Object, default: {} },
});
</script>

<template>
	<div class="page_box" id="project">
		<p class="page_box_subtitle"><i class="fa-solid fa-circle-chevron-right"></i> {{ $t('Project') }}</p>
		<h1>
			{{ $t(props.obj.title ?? '') }}
		</h1>

		<img class="page_project_image" :src="'/img/show?path=' + props.obj.image" :alt="$t('Project Image')" />

		<div class="page_project_about">
			<div class="item">
				<div class="title">{{ $t('Project Category:') }}</div>
				<div class="desc">{{ $t(props.obj.category ?? '') }}</div>
			</div>
			<div class="item">
				<div class="title">{{ $t('Client:') }}</div>
				<div class="desc">{{ $t(props.obj.client ?? '') }}</div>
			</div>
			<div class="item">
				<div class="title">{{ $t('Duration:') }}</div>
				<div class="desc">{{ $t(props.obj.duration ?? '') }}</div>
			</div>
		</div>

		<p class="page_project_excerpt">{{ $t(props.obj.excerpt ?? '') }}</p>

		<div class="page_project_details" v-html="props.obj.content_cleaned"></div>
	</div>
</template>

<style>
@import url('@/assets/css/page.css');

.page_project_image {
	float: left;
	width: 100%;
	height: auto;
	aspect-ratio: 16/9;
	margin-bottom: 20px;
	object-fit: cover;
	border-radius: var(--border-radius);
}

.page_project_excerpt {
	float: left;
	width: 100%;
	height: auto;
}

.page_project_about {
	float: left;
	width: 100%;
	padding: 20px;
	margin-block: 20px;
	display: flex;
	align-items: stretch;
	justify-content: space-between;
	gap: 20px;
	color: #fff;
	background: var(--accent);
	border-radius: var(--border-radius);
}

.page_project_about .item .desc {
	font-weight: 700;
	margin-top: 10px;
}
</style>
