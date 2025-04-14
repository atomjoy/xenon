<script setup>
import IconArrowDown from '@/assets/icons/IconArrowDown.vue';

const props = defineProps({
	message: { type: String, default: 'Lorem, ipsum dolor sit amet consectetur adipisicing elit?' },
	answer: { type: String, default: 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Suscipit veniam perferendis itaque quo ab perspiciatis quia. Maiores dolores ipsum accusantium incidunt harum, nulla expedita eos totam? Omnis modi incidunt neque?' },
});

function toggle(e) {
	let all = document.querySelectorAll('.top_open');
	all.forEach((i) => i.classList.remove('top_open'));
	e.currentTarget.classList.add('top_open');
}
</script>
<template>
	<div class="page_question" @click="toggle">
		<div class="top">
			<div class="message">{{ props.message }}</div>
			<IconArrowDown class="arrow_open" />
		</div>
		<div class="answer">{{ props.answer }}</div>
	</div>
</template>

<style scoped>
.page_question {
	float: left;
	width: 100%;
	height: auto;
	padding: 0px;
	margin-bottom: 20px;
	background: var(--bg-2);
	border: 1px solid var(--bg-2);
	border-radius: var(--border-radius);
	transition: all 0.6s;
	cursor: pointer;
}

.page_question .top {
	position: relative;
	float: left;
	width: 100%;
	height: auto;
}

.page_question svg {
	position: absolute;
	top: 20px;
	right: 20px;
	float: right;
	width: 25px;
	height: 25px;
	transition: all 0.6s;
}

.page_question svg * {
	stroke: var(--text-1);
}

.page_question .message {
	float: left;
	width: 96%;
	height: auto;
	padding: 20px;
	font-weight: 600;
}

.page_question .answer {
	float: left;
	width: 100%;
	padding-inline: 20px;
	transition: all 0.6s;
	background: var(--bg-1);
	border-radius: var(--border-radius);
	cursor: crosshair;
	overflow: hidden;
	height: 0px;
	opacity: 0;
}

.top_open {
	color: #fff;
	background: var(--accent);
	border: 1px solid var(--accent);
}

.top_open svg * {
	stroke: #fff;
}

.top_open .answer {
	color: var(--text-1);
	display: inherit;
	padding-block: 20px;
	height: auto;
	opacity: 1;
}

.top_open .arrow_open {
	transform: rotate(180deg);
}

@media all and (max-width: 768px) {
}
</style>
