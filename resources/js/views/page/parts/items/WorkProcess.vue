<script setup>
const props = defineProps({
	obj: { type: Object, default: {} },
});
</script>
<template>
	<div class="page_work_process">
		<div class="page_work_process_icon"><i :class="props.obj.icon"></i></div>
		<div class="page_work_process_step">
			<span>{{ props.obj.step }}</span>
		</div>
		<div class="page_work_process_title">{{ props.obj.title }}</div>
		<div class="page_work_process_text">{{ props.obj.text }}</div>
	</div>
</template>

<style>
.page_work_process {
	float: left;
	width: 32%;
	height: auto;
	padding: 30px;
	text-align: center;
}

.page_work_process_icon,
.page_work_process_step,
.page_work_process_title,
.page_work_process_text {
	float: left;
	width: 100%;
	text-align: center;
}

.page_work_process_icon i {
	width: 50px;
	height: 50px;
	padding: 10px;
	font-size: 22px;
	line-height: 30px;
	color: #fff;
	background: var(--accent);
	border-radius: 20px 20px 0px 0px;
	text-align: center;
}

.page_work_process_step span {
	width: 200px;
	height: auto;
	padding: 5px 25px;
	color: var(--bg-1);
	background: var(--text-1);
	border: 3px solid var(--bg-1);
	border-radius: 50px;
	text-align: center;
}

.page_work_process_title {
	margin-block: 20px;
	font-size: 20px;
	font-weight: 700;
}

/* @media all and (max-width: 1024px) {
	.page_work_process {
		width: 47%;
		margin-right: 1%;
	}
} */

@media all and (max-width: 1024px) {
	.page_work_process {
		width: 100%;
	}
}
</style>
