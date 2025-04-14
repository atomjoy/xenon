<script setup>
const props = defineProps({
	icon: { type: String, default: 'fa-solid fa-users' },
	title: { type: String, default: 'Transportation' },
	text: { type: String, default: 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Suscipit veniam perferendis itaque quo ab perspiciatis quia.' },
});
</script>
<template>
	<div class="page_benefit" @click="toggle">
		<div class="icon">
			<i :class="props.icon"></i>
		</div>
		<div class="title">{{ props.title }}</div>
		<div class="text">{{ props.text }}</div>
	</div>
</template>

<style scoped>
.page_benefit {
	float: left;
	width: 25%;
	height: auto;
	padding: 20px;
	margin-bottom: 20px;
	background: var(--bg-2);
	border-radius: var(--border-radius);
	transition: all 0.6s;
}

.page_benefit .title {
	float: left;
	width: 100%;
	height: auto;
	font-weight: 600;
	padding-top: 20px;
	color: var(--text-1);
}

.page_benefit .text {
	float: left;
	width: 100%;
	height: auto;
	padding-top: 10px;
	color: var(--text-1);
}

.page_benefit .icon {
	float: left;
	width: 100%;
	height: auto;
	margin-bottom: 20px;
}

.page_benefit .icon i {
	float: left;
	padding: 20px;
	color: #fff;
	background: var(--accent);
	border-radius: 50%;
	text-align: center;
}

@media all and (max-width: 1024px) {
	.page_benefit {
		width: 48%;
		margin-right: 2%;
	}
}

@media all and (max-width: 640px) {
	.page_benefit {
		width: 100%;
	}
}
</style>
