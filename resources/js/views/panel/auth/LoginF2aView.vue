<script setup>
import { useRoute } from 'vue-router';
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';
import { useAuthStore } from '@/stores/auth.js';
import Code from '@/components/auth/Code.vue';
import Title from '@/components/auth/Title.vue';
import Label from '@/components/auth/Label.vue';
import Button from '@/components/auth/Button.vue';
import Hidden from '@/components/auth/Hidden.vue';
import RememberMe from '@/components/auth/RememberMe.vue';
import SignInLink from '@/components/auth/SignInLink.vue';
import ErrorMessage from '@/components/auth/ErrorMessage.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import AuthLayout from '@/layouts/auth/AuthLayout.vue';
import LoginForm from '@/components/auth/LoginForm.vue';

const { t, locale } = useI18n({ useScope: 'global' });
const store = useAuthStore();
let code = ref('');
let remember_me = ref(false);

// Route
const route = useRoute();
let hash = ref(route?.params?.hash ?? null);
// console.log('Route', route?.query, route?.params)

function onSubmit(e) {
	store.clearError();
	store.scrollTop();
	store.loginUserF2a(new FormData(e.target));
}
</script>
<template>
	<AuthLayout>
		<ChangeTitle title="message.login_f2a_title" />
		<LoginForm @submit.prevent="onSubmit">
			<Title title="login.F2a_Confirm" text="login.Welcome_text_f2a" />
			<ErrorMessage :message="store.getMessage" :error="store.getError" />
			<Label text="login.F2a_code" />
			<Code name="code" v-model="code" />
			<Hidden name="hash" v-model="hash" />
			<RememberMe
				value="1"
				name="remember_me"
				label="login.Remember_me"
				link="login.Forgot_password"
				v-model="remember_me"
			/>
			<Button text="login.Confirm_btn" />
			<SignInLink />
		</LoginForm>
	</AuthLayout>
</template>
