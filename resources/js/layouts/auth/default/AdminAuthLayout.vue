<script setup>
import ChangeTheme from '@/components/utils/ChangeTheme/ChangeThemeStorage.vue';
import ChangeLocale from '@/components/utils/ChangeLocale/ChangeLocaleStorage.vue';
import PageLogo from '@/components/auth/PageLogo.vue';
</script>

<template>
	<div class="auth-wrapper">
		<div class="login-wrapper">
			<PageLogo />
			<ChangeTheme />
			<ChangeLocale />

			<slot></slot>
		</div>

		<div class="login-image-wrapper">
			<slot name="image">
				<img
					src="/default/login-image-admin.webp"
					class="login-image"
					:alt="$t('Login image')"
				/>
			</slot>
		</div>
	</div>
</template>

<style>
@import url('@/assets/css/auth/login-admin.css');
</style>
