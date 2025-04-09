<script setup>
import Layout from './parts/Layout.vue';
import Group from './parts/Group.vue';
import Label from '@/components/auth/Label.vue';
import Textarea from '@/components/auth/Textarea.vue';
import Button from '@/components/auth/Button.vue';
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { useCommentStore } from '@/stores/panel/comment.js';

const store = useCommentStore();
const route = useRoute();
const id = route.params.id;

onMounted(async () => {
	store.clearError();
	await store.loadItem(id);
});

function onSubmit(e) {
	store.updateItem(id, new FormData(e.target));
}
</script>

<template>
	<Layout :message="store.getMessage" :error="store.getError" :edit="true">
		<Group title="Update comment" desc="Here you can edit the comment.">
			<form action="post" @submit.prevent="onSubmit" enctype="multipart/form-data">
				<Label text="Comment" />
				<Textarea name="content" v-model="store.comment.content" />
				<Button text="Update" class="settings_button" />
			</form>
		</Group>
	</Layout>
</template>
