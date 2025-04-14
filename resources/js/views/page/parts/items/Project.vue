<script setup>
const props = defineProps({
	obj: { type: Object, default: {} },
});
</script>
<template>
	<div class="page_project">
		<a :href="'/projects/' + props.obj.slug" class="project_link">
			<img class="image" :src="'/img/show?path=' + props.obj.image" />
		</a>

		<div class="tags">
			<div class="box">
				<div class="cat" v-for="i in props.obj.tags.split(',')">{{ i }}</div>
			</div>
		</div>

		<div class="name">
			<a :href="'/projects/' + props.obj.slug" class="project_title">{{ props.obj.title }} </a>
			<a :href="'/projects/' + props.obj.slug" class="project_icon">
				<i class="fa-solid fa-arrow-right"></i>
			</a>
		</div>
	</div>
</template>

<style>
.page_project {
	position: relative;
	float: left;
	width: 47%;
	height: auto;
	padding: 20px;
	margin-bottom: 30px;
	box-sizing: border-box;
	transition: all 0.6s;
	overflow: hidden;
	border: 1px solid var(--bg-1);
	border-radius: var(--border-radius);
	display: flex;
	flex-direction: column;
}

.page_project:hover {
	/* border: 1px solid var(--border); */
	box-shadow: 0px 0px 10px #0001;
}

.page_project .project_link {
	color: var(--text-1);
	font-weight: 700;
	font-size: 18px;
}

.page_project .project_link:hover {
	color: var(--accent);
}

.page_project .image {
	float: left;
	width: 100%;
	aspect-ratio: 16/9;
	object-fit: cover;
	border-radius: var(--border-radius);
	transition: all 0.6s;
}

.page_project .name {
	float: left;
	width: 100%;
	height: auto;
	display: flex;
}

.page_project .description {
	float: left;
	width: 100%;
	height: 100%;
	padding: 20px;
	padding-top: 0px;
}

.page_project .tags {
	float: left;
	width: auto;
	height: auto;
	padding-top: 0px;
	margin-bottom: 20px;
	transition: all 0.6s;
}

.page_project .tags .box {
	padding-top: 10px;
}

.page_project .tags .cat {
	float: left;
	width: auto;
	height: auto;
	padding: 6px 16px;
	margin-right: 10px;
	margin-top: 10px;
	font-size: 14px;
	color: #fff;
	text-transform: uppercase;
	background: var(--accent);
	border-radius: 50px;
}

.project_title {
	float: left;
	width: 100%;
	height: auto;
	padding-right: 10px;
	font-weight: 500;
	font-size: 26px;
	transition: all 0.6s;
	color: var(--text-1);
}

.project_title:hover {
	color: var(--accent);
}

.project_icon i {
	float: right;
	height: auto;
	width: 56px;
	height: 56px;
	color: var(--accent);
	background: var(--text-1);
	margin: 5px;
	padding: 20px;
	font-size: 16px;
	border-radius: 50%;
	transition: all 0.6s;
	transform: rotate(45deg);
}

.project_icon:hover i {
	color: #fff;
	background: var(--accent);
	transform: rotate(-45deg);
}

@media all and (max-width: 1024px) {
	.page_project {
		width: 47%;
		margin-right: 1%;
	}

	.project_title {
		font-size: 21px;
	}
}

@media all and (max-width: 640px) {
	.page_project {
		width: 100%;
	}
}
</style>
