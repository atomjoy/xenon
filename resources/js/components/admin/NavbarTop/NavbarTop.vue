<script setup>
import Notifications from '@/components/admin/Notifications/Notifications.vue';
import OpenNavbar from '@/components/admin/NavbarLeft/OpenNavbar.vue';
import UserInfo from '@/components/admin/UserInfo/UserInfo.vue';
import Title from './Title.vue';

const props = defineProps({
	title: { type: String, default: 'Dashboard' },
});
</script>

<template>
	<OpenNavbar />
	<Title :title="props.title" />
	<UserInfo />
	<Notifications />
</template>
