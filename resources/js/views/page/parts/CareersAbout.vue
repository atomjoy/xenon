<script setup>
import Button from './items/ButtonScroll.vue';
</script>

<template>
	<div class="page_box" id="career_about">
		<p class="page_box_subtitle"><i class="fa-solid fa-circle-chevron-right"></i> {{ $t('Join Our Team') }}</p>
		<h1>
			{{ $t('Join Our Team') }} <br />
			{{ $t('for a Digital Inovaions') }}
		</h1>

		<div class="page_box_list">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro, in veniam? Ab quaerat esse, quidem quo recusandae, rem laborum blanditiis amet accusantium saepe ipsam facere optio necessitatibus sint autem? Reprehenderit?</p>
			<img class="page_box_image" src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Our team" />

			<div class="page_box_padding_block">
				<center>
					<Button />
				</center>
			</div>
		</div>
	</div>
</template>

<style>
@import url('@/assets/css/page.css');
</style>
