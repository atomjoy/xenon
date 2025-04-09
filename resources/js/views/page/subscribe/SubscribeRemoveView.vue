<script setup>
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import BlogLayout from '@/layouts/page/BlogLayout.vue';
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import { useI18n } from 'vue-i18n';

const { t, locale } = useI18n({ useScope: 'global' });
const route = useRoute();
const email = route.params.email ?? 'invalid@email';
const error = ref('false');
const message = ref('');

onMounted(async () => {
	message.value = '';
	try {
		if (email) {
			let res = await axios.get('/web/api/subscribe/remove/' + email);
			message.value = t(res.data.message);
			error.value = false;
		} else {
			error.value = true;
			message.value = t('Invalid email address.');
		}
	} catch (err) {
		error.value = true;
		message.value = t(err.response.data.message) ?? t('Email has not been removed.');
	}
});
</script>

<template>
	<BlogLayout title="Unsubscribe" description="Unsubscribe from newsletter.">
		<div class="page_subscribe">
			<h1>{{ $t('Unsubscribe') }}</h1>
			<div class="page_message" :class="{ page_error: error }" v-if="message">{{ message }}</div>
		</div>
	</BlogLayout>

	<ChangeTitle :title="$t('Unsubscribe')" />
	<ChangeDescription :description="$t('Unsubscribe from newsletter.')" />
</template>

<style>
@import url('@/assets/css/blog.css');
@import url('@/assets/css/subscribe.css');
</style>
