<script setup>
import IconHamburger from '@/assets/icons/IconHamburger.vue';
import IconClose from '@/assets/icons/IconClose.vue';
import { ref } from 'vue';

const open = ref(false);

function toggle() {
	open.value == true ? (open.value = false) : (open.value = true);
}
</script>
<template>
	<div class="page_top_menu_wrapper" @click="toggle">
		<div class="page_header_menu_btn">
			<IconHamburger />
		</div>
		<div class="page_top_menu" :class="{ page_top_menu_open: open }">
			<nav>
				<div class="page_top_menu_btn_close" @click.stop="toggle">
					<IconClose />
				</div>

				<RouterLink to="/blog">{{ $t('Blog') }}</RouterLink>
				<RouterLink to="/projects">{{ $t('Projects') }}</RouterLink>
				<RouterLink to="/services">{{ $t('Services') }}</RouterLink>
				<RouterLink to="/contact">{{ $t('Contact') }}</RouterLink>
				<RouterLink to="/login">{{ $t('Login') }}</RouterLink>
			</nav>
		</div>
	</div>
</template>
