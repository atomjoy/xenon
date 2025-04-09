<script setup>
import BlogHeader from './parts/BlogHeader.vue';
import BlogCategories from './parts/BlogCategories.vue';
import Footer from '@/views/page/parts/Footer.vue';
import { RouterLink } from 'vue-router';

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
						<RouterLink to="/blog" class="page_header_blog_link" :title="$t(props.title)">{{ $t(props.title.toUpperCase()) }} </RouterLink>
					</div>
					<p v-if="props.description">{{ $t(props.description.toUpperCase()) }}</p>
					<BlogCategories />
				</div>
			</slot>
		</div>
	</div>

	<div class="page_content">
		<div class="page_content_wrapper">
			<slot />
		</div>
	</div>

	<div class="page_footer">
		<Footer />
	</div>
</template>
