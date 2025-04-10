<script setup>
import ChangeTheme from '@/components/utils/ChangeTheme/ChangeThemeStorage.vue';
import ChangeLocale from '@/components/utils/ChangeLocale/ChangeLocaleStorage.vue';
import ChangeBg from '@/components/utils/ChangeCss/ChangeBg.vue';
import TopMenu from '@/views/page/parts/PageTopMenu.vue';
import BlogCategories from './parts/BlogCategories.vue';
import Footer from '@/views/page/parts/Footer.vue';
import { RouterLink } from 'vue-router';

const props = defineProps({
	title: { default: '' },
	description: { default: '' },
	image: { default: '/default/bg.webp' },
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
					<h1 class="page_header_title">{{ $t(props.title.toUpperCase()) }}</h1>
					<p>{{ $t(props.description.toUpperCase()) }}</p>
					<BlogCategories />
				</div>
			</slot>
		</div>
	</div>

	<ChangeBg :image="props.image" v-if="props.image">
		<div class="page_header_wrapper">
			<div class="page_header_banner_title">
				{{ $t('Tag') }}
			</div>
		</div>
	</ChangeBg>

	<div class="page_content">
		<div class="page_content_wrapper">
			<slot />
		</div>
	</div>

	<div class="page_footer">
		<Footer />
	</div>
</template>
