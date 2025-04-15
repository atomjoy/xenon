<script setup>
import WorkProcess from './items/WorkProcess.vue';
import work from '@/settings/work-process.json';
</script>

<template>
	<div class="page_box" id="teams" style="min-height: auto">
		<p class="page_box_subtitle"><i class="fa-solid fa-circle-chevron-right"></i> {{ $t('Work Process') }}</p>
		<h1>
			{{ $t('Our Working Process') }}
		</h1>

		<div class="page_box_list">
			<div class="page_items_flex">
				<WorkProcess :obj="i" v-for="i in work.list" />
			</div>
		</div>
	</div>
</template>

<style>
@import url('@/assets/css/page.css');
</style>
