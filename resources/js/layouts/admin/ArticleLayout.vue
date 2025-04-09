<script setup>
import ChangeTheme from '@/components/utils/ChangeTheme/ChangeThemeStorage.vue';
import ChangeLocale from '@/components/utils/ChangeLocale/ChangeLocaleStorage.vue';
import TopMenu from '@/views/page/parts/PageTopMenu.vue';
import BlogCategories from './parts/BlogCategories.vue';
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
				<div class="page_header_menu">
					<RouterLink to="/" class="blog_header_link">
						<img src="/default/logo/logo-light.png" class="blog_header_logo" alt="Logo" />
					</RouterLink>
					<TopMenu />
					<ChangeTheme />
					<ChangeLocale />
				</div>

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
		<div class="page_footer_content">{{ $t('2025r. All rights reserved.') }}</div>
	</div>
</template>
