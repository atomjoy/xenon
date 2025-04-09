<script setup>
import IconWidget from '@/assets/icons/IconWidget.vue';
import IconUser from '@/assets/icons/IconUser.vue';
import IconReply from '@/assets/icons/IconReply.vue';
import NavbarLayout from './NavbarLayout.vue';
import NavbarLink from './NavbarLink.vue';
</script>

<template>
	<NavbarLayout>
		<div class="panel_navbar_links">
			<!-- Left navbar links goes here -->

			<NavbarLink to="/panel/dashboard" text="Dashboard">
				<IconWidget />
			</NavbarLink>

			<NavbarLink to="/panel/comments" text="Comments">
				<IconReply />
			</NavbarLink>
		</div>
	</NavbarLayout>
</template>
