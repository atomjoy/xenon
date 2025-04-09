<script setup>
import ChangeTheme from '@/components/utils/ChangeTheme/ChangeThemeStorage.vue';
import ChangeLocale from '@/components/utils/ChangeLocale/ChangeLocaleStorage.vue';
import PageLogo from '@/components/auth/PageLogo.vue';
</script>

<template>
	<PageLogo />
	<ChangeTheme />
	<ChangeLocale />
	<slot></slot>
</template>
