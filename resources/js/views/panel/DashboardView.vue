<script setup>
import IconEvent from '@/assets/icons/IconBallon.vue';
import IconComment from '@/assets/icons/IconComment.vue';
import PanelLayout from '@/layouts/panel/PanelLayout.vue';
import { useAuthStore } from '@/stores/auth.js';
import axios from 'axios';
import { ref } from 'vue';
const auth = useAuthStore();
let user = auth.getUser;
let count = ref(0);

async function countComments() {
	const res = await axios.get('/web/api/comments/count/' + user.value.id);
	count.value = res?.data?.count;
}

countComments();
</script>

<template>
	<PanelLayout title="Dashboard">
		<!-- page content goes here -->
		<div class="dashboard">
			<div class="dashboard_user">
				<div class="dashboard_user_info">
					<div class="dashboard_user_info_text">
						{{ $t('Welcome') }}
					</div>
					<div class="dashboard_user_info_name">{{ user.name }}</div>
					<div class="dashboard_user_info_email">
						{{ user.email }}
					</div>
				</div>

				<div class="dashboard_user_events">
					<div class="dashboard_user_events_icon">
						<IconEvent />
					</div>
					<div class="dashboard_user_events_count">0</div>
					<div class="dashboard_user_events_text">
						{{ $t('Number of orders') }}
					</div>
				</div>

				<div class="dashboard_user_events">
					<div class="dashboard_user_events_icon">
						<IconComment />
					</div>
					<div class="dashboard_user_events_count">{{ count }}</div>
					<div class="dashboard_user_events_text">
						{{ $t('Total number of comments') }}
					</div>
				</div>
			</div>
		</div>
		<!-- page content goes here -->
	</PanelLayout>
</template>

<style>
@import url('@/assets/css/panel/dashboard.css');
</style>
