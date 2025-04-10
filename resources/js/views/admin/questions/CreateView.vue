<script setup>
import Layout from './parts/Layout.vue';
import Group from './parts/Group.vue';
import Label from '@/components/auth/Label.vue';
import Input from '@/components/auth/Input.vue';
import Textarea from '@/components/auth/Textarea.vue';
import Button from '@/components/auth/Button.vue';
import { onMounted } from 'vue';
import { useItemStore } from '@/stores/question.js';

const store = useItemStore();

onMounted(async () => {
	store.clearError();
	store.item_image = null;
});
</script>

<template>
	<Layout :message="store.getMessage" :error="store.getError">
		<Group title="Create question" desc="Here you can create the question.">
			<form action="post" @submit.prevent="store.createItem" enctype="multipart/form-data">
				<Label text="Content" />
				<Input name="message" />

				<Label text="Answer" />
				<Textarea name="answer" />

				<Label text="Publish at" />
				<Input name="published_at" placeholder="YYYY-MM-DD HH:MM:SS" />

				<Button text="Create" class="settings_button" />
			</form>
		</Group>
	</Layout>
</template>
