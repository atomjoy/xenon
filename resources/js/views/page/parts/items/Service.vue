<script setup>
const props = defineProps({
	obj: { type: Object, default: {} },
});
</script>
<template>
	<div class="page_service">
		<a :href="'/services/' + props.obj.slug" class="service_link">
			<img class="image" :src="'/img/show?path=' + props.obj.image" />
		</a>

		<div class="name">
			<a :href="'/services/' + props.obj.slug" class="service_link"> <i class="page_service_icon" :class="props.obj.icon"></i> {{ props.obj.title }} </a>
		</div>
		<div class="description">{{ props.obj.excerpt }}</div>
		<div class="tags">
			<div class="box">
				<div class="cat" v-for="i in props.obj.tags.split(',')">{{ i }}</div>
			</div>
		</div>
	</div>
</template>

<style>
.page_service {
	position: relative;
	float: left;
	width: 32%;
	height: auto;
	margin-bottom: 30px;
	box-sizing: border-box;
	transition: all 0.6s;
	overflow: hidden;
	border: 1px solid var(--bg-1);
	border-radius: var(--border-radius);
	display: flex;
	flex-direction: column;
}

.page_service:hover {
	/* border: 1px solid var(--border); */
	box-shadow: 0px 0px 10px #0001;
}

.page_service .service_link {
	color: var(--text-1);
	font-weight: 700;
	font-size: 18px;
}

.page_service .service_link:hover {
	color: var(--accent);
}

.page_service .image {
	float: left;
	width: 100%;
	aspect-ratio: 16/9;
	object-fit: cover;
	border-radius: var(--border-radius);
	transition: all 0.6s;
}

.page_service .name {
	float: left;
	width: 100%;
	height: auto;
	font-weight: 700;
	padding: 20px;
}

.page_service .description {
	float: left;
	width: 100%;
	height: 100%;
	padding: 20px;
	padding-top: 0px;
}

.page_service .tags {
	float: left;
	width: auto;
	height: auto;
	padding: 20px;
	padding-top: 0px;
	transition: all 0.6s;
}

.page_service .tags .box {
	padding-top: 10px;
	border-top: 1px solid var(--border);
}

.page_service .tags .cat {
	float: left;
	width: auto;
	height: auto;
	padding: 5px 10px;
	margin-right: 10px;
	margin-top: 5px;
	font-size: 14px;
	background: var(--bg-2);
	border-radius: var(--border-radius);
}

.page_service_icon {
	float: left;
	margin-top: 4px;
	margin-right: 10px;
}

@media all and (max-width: 1024px) {
	.page_service {
		width: 47%;
		margin-right: 1%;
	}
}

@media all and (max-width: 640px) {
	.page_service {
		width: 100%;
	}
}
</style>
