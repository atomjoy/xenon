<script setup>
import SettingsGroup from '../SettingsGroup.vue';
import SettingsLayout from '../SettingsLayout.vue';
import { onBeforeMount, ref } from 'vue';
import { useAuthStore } from '@/stores/auth.js';
import Label from '@/components/auth/Label.vue';
import Email from '@/components/auth/Email.vue';
import Password from '@/components/auth/Password.vue';
import Button from '@/components/auth/Button.vue';
import Name from '@/components/auth/Name.vue';
import Input from '@/components/auth/Input.vue';
import IconEdit from '@/assets/icons/IconEdit.vue';

const auth = useAuthStore();
let user = auth.getUser;

onBeforeMount(() => {
	auth.clearError();
});

function onSubmitEmail(e) {
	auth.scrollTop();
	auth.changeUserEmail(new FormData(e.target));
}

function onSubmitF2a(e) {
	auth.scrollTop();

	if (user.value.f2a == 1) {
		auth.disableF2a(new FormData(e.target));
	} else {
		auth.enableF2a(new FormData(e.target));
	}
}
</script>

<template>
	<SettingsLayout>
		<!-- page content goes here -->

		<SettingsGroup
			title="Change account email"
			desc="Update your account email here."
		>
			<form action="post" @submit.prevent="onSubmitEmail">
				<Label text="Email address" />
				<Email v-model="user.email" />
				<Button text="Update" class="settings_button" />
			</form>
		</SettingsGroup>

		<SettingsGroup
			title="Two factor authentication"
			desc="Update your two-factor authentication details here."
		>
			<form action="post" @submit.prevent="onSubmitF2a">
				<div
					v-if="user.f2a == 1"
					class="panel_settings_group_f2a_enabled"
				>
					{{ $t('Enabled') }}
				</div>

				<div
					v-if="user.f2a == 0"
					class="panel_settings_group_f2a_disabled"
				>
					{{ $t('Disabled') }}
				</div>

				<Label text="Current password" />
				<Password name="password_current" />
				<Button text="Update" class="settings_button" />
			</form>
		</SettingsGroup>

		<!-- page content goes here -->
	</SettingsLayout>
</template>
