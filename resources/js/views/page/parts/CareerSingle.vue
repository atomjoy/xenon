<script setup>
import scrollTo from '@/utils/scrollTo.js';

const props = defineProps({
	obj: { type: Object, default: {} },
});

function apply() {
	const subject = document.querySelector('#apply_subject');
	const location = props.obj.location ?? 'On Place';
	subject.value = 'JOB ID-' + props.obj.id + ' | ' + props.obj.title + ' | ' + location;
	scrollTo('#contacts');
}
</script>

<template>
	<div class="page_box" id="job">
		<p class="page_box_subtitle"><i class="fa-solid fa-circle-chevron-right"></i> {{ $t('Job Details') }}</p>
		<h1>
			{{ $t(props.obj.title ?? '') }}
		</h1>

		<div class="page_job" :id="'job_' + props.obj.id">
			<div class="top">
				<h2 class="job_title">
					<span class="page_job_title">{{ props.obj.title }}</span> <span class="page_job_location" v-if="props.obj.location">({{ props.obj.location }})</span>
					<span class="page_job_apply" @click.stop="apply">{{ $t('Apply') }}</span>
				</h2>
				<div class="job_header">
					<br />
					<span v-if="props.obj.id">
						<strong>{{ $t('ID') }}:</strong> {{ props.obj.id }}
					</span>
					<br />
					<span v-if="props.obj.experience">
						<strong>{{ $t('Experience') }}:</strong> {{ props.obj.experience }}
					</span>
					<br />
					<span v-if="props.obj.time">
						<strong>{{ $t('Hours') }}:</strong> {{ props.obj.time }}
					</span>
					<br />
					<span v-if="props.obj.remote">
						<strong>{{ $t('Remote') }}:</strong> {{ props.obj.remote }}
					</span>
					<br />
					<span v-if="props.obj.salary">
						<strong>{{ $t('Salary') }}:</strong> {{ props.obj.salary }}
					</span>
					<br />
					<span v-if="props.obj.published_at">
						<strong>{{ $t('Posted') }}:</strong> {{ props.obj.published_at }}
					</span>
					<br />
					<span v-if="props.obj.expired_at">
						<strong>{{ $t('Valid Through') }}:</strong> {{ props.obj.expired_at }}
					</span>
					<br />
				</div>
			</div>
			<div class="job_details" v-html="props.obj.content_cleaned"></div>
		</div>
	</div>
</template>

<style scoped>
@import url('@/assets/css/page.css');

.page_job_apply {
	float: left;
	padding: 5px 10px;
	margin-right: 10px;
	color: var(--text-1);
	background: var(--bg-1);
	border: 1px solid var(--text-1);
	border-radius: var(--border-radius);
	font-size: 14px;
	font-weight: 500;
	cursor: pointer;
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
}

.page_job .top {
	position: relative;
	float: left;
	width: 100%;
	height: auto;
	color: #fff;
	border-radius: var(--border-radius);
	background: var(--accent);
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
	color: #fff;
	border-left: 1px solid #fff;
}

.page_job .job_details {
	float: left;
	width: 100%;
	padding-inline: 20px;
	transition: all 0.6s;
	background: var(--bg-1);
	border-radius: var(--border-radius);
	border: 1px solid var(--accent);
	cursor: crosshair;
	overflow: hidden;
}
</style>
