<script setup>
import scrollTo from '@/utils/scrollTo.js';

const props = defineProps({
	id: { default: '#careers' },
	name: { default: 'View All Jobs' },
});
</script>
<template>
	<div class="page_cool_btn" @click.stop="scrollTo(props.id)">
		<div class="page_cool_btn_text">{{ $t(props.name) }}</div>
		<i class="fa-solid fa-arrow-right"></i>
	</div>
</template>

<style scoped>
.page_cool_btn {
	width: 230px;
	font-size: 16px;
	font-weight: 600;
	color: var(--text-1);
	background: var(--bg-3);
	border: 1px solid var(--bg-3);
	border-radius: 50px;
	cursor: pointer;
	overflow: hidden;
}

.page_cool_btn_text {
	float: left;
	height: auto;
	margin: 5px;
	color: #fff;
	background: var(--accent);
	padding: 15px 25px;
	margin-block: 5px;
	border-radius: 50px;
	font-size: 16px;
}

.page_cool_btn i {
	float: right;
	height: auto;
	color: var(--accent);
	background: var(--bg-1);
	margin: 5px;
	padding: 18px;
	border-radius: 50%;
	font-size: 16px;
}

.page_cool_btn span:hover {
	background: var(--accent-hover);
}
</style>
