<script setup>
import { RouterLink } from 'vue-router';
import ChangeTheme from '@/components/utils/ChangeTheme/ChangeThemeStorage.vue';
import ChangeLocale from '@/components/utils/ChangeLocale/ChangeLocaleStorage.vue';
import IconSettings from '@/assets/icons/IconSettings.vue';
import IconLogout from '@/assets/icons/IconLogout.vue';
import CloseNavbar from './CloseNavbar.vue';
import PageLogo from './PageLogo.vue';
</script>

<template>
	<div class="panel_navbar">
		<div class="panel_navbar_logo">
			<slot name="header">
				<PageLogo />
				<CloseNavbar />
			</slot>
		</div>

		<div class="panel_navbar_menu scrollbar_navbar">
			<slot></slot>
		</div>

		<div class="panel_navbar_settings">
			<slot name="footer">
				<RouterLink to="/admin/settings" class="panel_navbar_settings_link">
					<IconSettings /> <span>{{ $t('Settings') }}</span>
				</RouterLink>

				<RouterLink to="/admin/logout" class="panel_navbar_settings_link">
					<IconLogout /> <span>{{ $t('Logout') }}</span>
				</RouterLink>

				<ChangeTheme />
				<ChangeLocale />
			</slot>
		</div>
	</div>
</template>
