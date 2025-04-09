<script setup>
import { ref, onMounted } from 'vue';
import { useI18n } from 'vue-i18n';
import { useAuthStore } from '@/stores/auth.js';
import Title from '@/components/auth/Title.vue';
import Label from '@/components/auth/Label.vue';
import Email from '@/components/auth/Email.vue';
import Button from '@/components/auth/Button.vue';
import Password from '@/components/auth/Password.vue';
import RememberMe from '@/components/auth/RememberMe.vue';
import ErrorMessage from '@/components/auth/ErrorMessage.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import AuthLayout from '@/layouts/auth/AdminAuthLayout.vue';
import LoginForm from '@/components/auth/LoginForm.vue';

const { t, locale } = useI18n({ useScope: 'global' });
const store = useAuthStore();
let email = ref('');
let password = ref('');
let remember_me = ref(false);

onMounted(() => {
	store.clearError();
});

function onSubmit(e) {
	store.clearError();
	store.scrollTop();
	store.loginUserAdmin(new FormData(e.target));
}
</script>
<template>
	<AuthLayout>
		<ChangeTitle title="login.Login_admin" />
		<LoginForm @submit.prevent="onSubmit">
			<Title title="login.Login_admin" text="login.Welcome_text_admin" />
			<ErrorMessage :message="store.getMessage" :error="store.getError" />
			<Label text="login.Email_address" />
			<Email name="email" v-model="email" />
			<Label text="login.Password" />
			<Password name="password" type="password" v-model="password" />
			<RememberMe
				name="remember_me"
				value="1"
				v-model="remember_me"
				label="login.Remember_me"
				link="login.Forgot_password"
				link_url="/admin/password"
			/>
			<Button text="login.Login" class="button__admin" />
		</LoginForm>
	</AuthLayout>
</template>
