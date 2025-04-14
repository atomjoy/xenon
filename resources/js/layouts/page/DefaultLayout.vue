<script setup>
import BlogCategories from './parts/BlogCategories.vue';
import BlogHeader from './parts/BlogHeader.vue';
import ScrollBar from '@/views/page/parts/ScrollBarTop.vue';
import Footer from '@/views/page/parts/Footer.vue';

const props = defineProps({
	title: String,
	description: String,
});
</script>
<template>
	<div class="page_header">
		<div class="page_header_wrapper">
			<slot name="header">
				<BlogHeader />

				<div class="page_header_details">
					<div class="page_header_blog_title">
						{{ $t(props.title.toUpperCase()) }}
					</div>
					<p v-if="props.description">{{ $t(props.description.toUpperCase()) }}</p>
					<BlogCategories />
				</div>
			</slot>
		</div>
	</div>

	<div class="page_content">
		<!-- <ScrollBar /> -->
		<div class="page_content_wrapper">
			<slot />
		</div>
	</div>

	<div class="page_footer">
		<Footer />
	</div>
</template>
