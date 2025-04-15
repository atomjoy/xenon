<script setup>
const props = defineProps({
	obj: { type: Object, default: {} },
	number: { type: Number, default: 1 },
});
</script>
<template>
	<div class="page_service_home">
		<div class="left">
			<div class="count">{{ props.number }}</div>
		</div>
		<div class="right">
			<div class="title">
				<a :href="'/services/' + props.obj.slug" class="link" :title="props.obj.title"> {{ props.obj.title }} </a>
				<i class="icon" :class="props.obj.icon"></i>
			</div>
			<div class="description">{{ props.obj.excerpt }}</div>
			<div class="tags">
				<div class="cat" v-for="i in props.obj.tags.split(',')">{{ i }}</div>
			</div>
		</div>
	</div>
</template>

<style>
.page_service_home {
	float: left;
	width: 48%;
	margin-bottom: 20px;
	display: flex;
	align-items: stretch;
	border: 1px solid var(--text-1);
	border-radius: var(--border-radius);
}

.page_service_home .left {
	position: relative;
	float: left;
	width: 100px;
	border-right: 1px solid var(--text-1);
}

.page_service_home .right {
	position: relative;
	float: left;
	width: 100%;
	padding: 20px;
}

.page_service_home .left .count {
	position: absolute;
	left: 20px;
	bottom: 10px;
	font-size: 33px;
	font-weight: 400;
}

.page_service_home .right .title,
.page_service_home .right .description,
.page_service_home .right .tags {
	float: left;
	width: 100%;
}

.page_service_home .right .title {
	float: left;
	padding-left: 20px;
	font-size: 21px;
	font-weight: 700;
	margin-bottom: 20px;
}

.page_service_home .right .description {
	margin-bottom: 20px;
}

.page_service_home .right .title .icon {
	position: absolute;
	left: -25px;
	top: 12px;
	width: 50px;
	height: 50px;
	padding: 13px;
	border-radius: 50px;
	text-align: center;
	background: var(--bg-1);
	border: 1px solid var(--text-1);
}

.page_service_home .right .title .link {
	color: var(--text-1);
	transition: all 0.6s;
}

.page_service_home .right .title .link:hover {
	color: var(--accent);
}

.page_service_home .right .tags .cat {
	float: left;
	padding: 5px 15px;
	margin-right: 10px;
	margin-bottom: 10px;
	color: var(--text-1);
	border: 1px solid var(--text-1);
	border-radius: 50px;
}

@media all and (max-width: 1024px) {
	.page_service_home {
		width: 100%;
	}
}
</style>
