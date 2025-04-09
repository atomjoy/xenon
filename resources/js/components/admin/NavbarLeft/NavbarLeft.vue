<script setup>
import IconWidget from '@/assets/icons/IconWidget.vue';
import IconCategories from '@/assets/icons/IconCategories.vue';
import IconEdit from '@/assets/icons/IconEdit.vue';
import IconReply from '@/assets/icons/IconReply.vue';
import IconAlbum from '@/assets/icons/IconAlbum.vue';
import IconProject from '@/assets/icons/IconProject.vue';
import IconContact from '@/assets/icons/IconContact.vue';
import IconSubscriber from '@/assets/icons/IconSubscriber.vue';
import IconService from '@/assets/icons/IconService.vue';
import NavbarLayout from './NavbarLayout.vue';
import NavbarLink from './NavbarLink.vue';

import { useAuthStore } from '@/stores/auth.js';

const store = useAuthStore();
</script>

<template>
	<NavbarLayout>
		<div class="panel_navbar_links">
			<!-- Left navbar links goes here -->

			<NavbarLink to="/admin/dashboard" text="Dashboard">
				<IconWidget />
			</NavbarLink>

			<NavbarLink to="/admin/articles" text="Articles">
				<IconEdit />
			</NavbarLink>

			<NavbarLink to="/admin/category" text="Categories">
				<IconCategories />
			</NavbarLink>

			<NavbarLink to="/admin/comments" text="Comments">
				<IconReply />
			</NavbarLink>

			<NavbarLink to="/admin/articlemedia" text="Images">
				<IconAlbum />
			</NavbarLink>

			<div class="only_admin" v-if="store.hasRole('worker', 'admin') || store.hasRole('admin', 'admin') || store.hasRole('super_admin', 'admin')">
				<NavbarLink to="/admin/services" text="Services">
					<IconService />
				</NavbarLink>

				<NavbarLink to="/admin/projects" text="Projects">
					<IconProject />
				</NavbarLink>

				<NavbarLink to="/admin/contacts" text="Contacts">
					<IconContact />
				</NavbarLink>

				<NavbarLink to="/admin/subscribers" text="Subscribers">
					<IconSubscriber />
				</NavbarLink>
			</div>
		</div>
	</NavbarLayout>
</template>
