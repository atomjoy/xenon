<script setup>
import IconArrowDown from '@/assets/icons/IconArrowDown.vue';
import scrollTo from '@/utils/scrollTo.js';

const props = defineProps({
	obj: { type: Object, default: {} },
});

function toggle(e) {
	let all = document.querySelectorAll('.top_open');
	all.forEach((i) => i.classList.remove('top_open'));
	e.currentTarget.classList.add('top_open');
	scrollTo('#job_' + props.obj.id);
}

function apply() {
	const subject = document.querySelector('#apply_subject');
	const location = props.obj.location ?? 'On Place';
	subject.value = 'JOB ID-' + props.obj.id + ' | ' + props.obj.title + ' | ' + location;
	scrollTo('#contacts');
}
</script>
<template>
	<div class="page_job" @click="toggle" :id="'job_' + props.obj.id">
		<div class="top">
			<h2 class="job_title">
				<span class="page_job_title">{{ props.obj.title }}</span> <span class="page_job_location" v-if="props.obj.location">({{ props.obj.location }})</span>
				<span class="page_job_apply" @click.stop="apply">{{ $t('Apply') }}</span>
			</h2>
			<div class="job_header">
				<span v-if="props.obj.id">{{ 'ID-' + props.obj.id }}</span>
				<span v-if="props.obj.experience">{{ $t('Experience') }}: {{ props.obj.experience }}</span>
				<span v-if="props.obj.time">{{ $t('Hours') }}: {{ props.obj.time }}</span>
				<span v-if="props.obj.remote">{{ $t('Remote') }}: {{ props.obj.remote }}</span>
				<span v-if="props.obj.salary">{{ $t('Salary') }}: {{ props.obj.salary }}</span>
				<span v-if="props.obj.published_at">{{ $t('Posted') }}: {{ props.obj.published_at }}</span>
				<span v-if="props.obj.expired_at">{{ $t('Valid Through') }}: {{ props.obj.expired_at }}</span>
			</div>
			<IconArrowDown class="arrow_open" />
		</div>
		<div class="job_details" v-html="props.obj.content_cleaned" @click.stop="null"></div>
	</div>
</template>

<style scoped>
.page_job_apply {
	float: left;
	padding: 5px 10px;
	color: var(--text-1);
	background: var(--bg-1);
	border: 1px solid var(--text-1);
	border-radius: var(--border-radius);
	font-size: 14px;
	font-weight: 500;
}

.page_job_location,
.page_job_title {
	float: left;
	margin-right: 10px;
}

.page_job {
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

.page_job .top {
	position: relative;
	float: left;
	width: 100%;
	height: auto;
}

.page_job svg {
	position: absolute;
	top: 20px;
	right: 20px;
	float: right;
	width: 25px;
	height: 25px;
	transition: all 0.6s;
}

.page_job svg * {
	stroke: var(--text-1);
}

.page_job .job_title {
	float: left;
	width: 96%;
	height: auto;
	padding: 20px;
	margin-block: 0px;
	padding-bottom: 10px;
	font-weight: 600;
	font-size: 21px;
}

.page_job .job_header {
	float: left;
	width: 96%;
	height: auto;
	padding: 20px;
	padding-top: 0px;
	font-weight: 400;
}

.page_job .job_header span {
	float: left;
	width: auto;
	height: auto;
	padding: 0px 10px;
	border-left: 1px solid var(--text-1);
}

.page_job .job_details {
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

.top_open .job_details {
	color: var(--text-1);
	display: inherit;
	padding-block: 20px;
	height: auto;
	opacity: 1;
}

.top_open .job_header span {
	border-left: 1px solid #fff;
}

.top_open .arrow_open {
	transform: rotate(180deg);
}

@media all and (max-width: 768px) {
}
</style>
