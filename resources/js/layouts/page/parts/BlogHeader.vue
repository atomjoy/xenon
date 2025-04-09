<script setup>
import ChangeTheme from '@/components/utils/ChangeTheme/ChangeThemeStorage.vue';
import ChangeLocale from '@/components/utils/ChangeLocale/ChangeLocaleStorage.vue';
import TopMenu from '@/views/page/parts/PageTopMenu.vue';
import { RouterLink } from 'vue-router';
</script>

<template>
	<div class="page_header_menu">
		<RouterLink to="/" class="blog_header_link">
			<img src="/default/logo/logo-light.png" class="blog_header_logo" alt="Logo" />
		</RouterLink>
		<TopMenu />
		<ChangeTheme />
		<ChangeLocale />
	</div>
</template>
