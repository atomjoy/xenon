<script setup>
const props = defineProps({
	icon: { type: String, default: 'fa-solid fa-users' },
	title: { type: String, default: 'Profesional Team' },
	text: { type: String, default: 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Suscipit veniam perferendis itaque quo ab perspiciatis quia.' },
});
</script>
<template>
	<div class="page_perk" @click="toggle">
		<div class="icon">
			<i :class="props.icon"></i>
		</div>
		<div class="title">{{ props.title }}</div>
		<div class="text">{{ props.text }}</div>
	</div>
</template>

<style scoped>
.page_perk {
	float: left;
	width: 25%;
	height: auto;
	padding: 20px;
	margin-bottom: 20px;
	background: var(--accent);
	border-radius: var(--border-radius);
	transition: all 0.6s;
}

.page_perk .title {
	float: left;
	width: 100%;
	height: auto;
	font-weight: 600;
	padding-top: 20px;
	color: #000;
}

.page_perk .text {
	float: left;
	width: 100%;
	height: auto;
	padding-top: 10px;
	color: #000;
}

.page_perk .icon {
	float: left;
	width: 100%;
	height: auto;
	margin-bottom: 20px;
}

.page_perk .icon i {
	float: left;
	padding: 20px;
	color: #fff;
	background: #000;
	border-radius: 50%;
	text-align: center;
}

@media all and (max-width: 1024px) {
	.page_perk {
		width: 48%;
		margin-right: 2%;
	}
}

@media all and (max-width: 640px) {
	.page_perk {
		width: 100%;
	}
}
</style>
