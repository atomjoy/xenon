<script setup>
import SettingsGroup from '../SettingsGroup.vue';
import SettingsLayout from '../SettingsLayout.vue';
import { onBeforeMount } from 'vue';
import { useAuthStore } from '@/stores/auth.js';
import Label from '@/components/auth/Label.vue';
import Password from '@/components/auth/Password.vue';
import Button from '@/components/auth/Button.vue';

const auth = useAuthStore();

onBeforeMount(() => {
	auth.clearError();
});

function onSubmit(e) {
	auth.scrollTop();
	auth.deleteUserAccount(new FormData(e.target));
}
</script>

<template>
	<SettingsLayout>
		<!-- page content goes here -->

		<SettingsGroup
			title="Delete Account"
			desc="You can delete your account here."
		>
			<form action="post" @submit.prevent="onSubmit">
				<Label text="Current password" />
				<Password name="current_password" />
				<Button
					text="Delete Account Now!"
					class="settings_button settings_button_red"
				/>
			</form>
		</SettingsGroup>

		<!-- page content goes here -->
	</SettingsLayout>
</template>
