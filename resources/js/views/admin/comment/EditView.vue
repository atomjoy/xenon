<script setup>
import Layout from './parts/Layout.vue';
import Group from './parts/Group.vue';
import Label from '@/components/auth/Label.vue';
import Select from '@/components/auth/Select.vue';
import Textarea from '@/components/auth/Textarea.vue';
import Button from '@/components/auth/Button.vue';
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { useCommentStore } from '@/stores/comment.js';

const store = useCommentStore();
const route = useRoute();
const id = route.params.id;

onMounted(async () => {
	store.clearError();
	await store.loadItem(id);
	// console.log('Update', id, store.comment);
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
				<Label text="Accept comment" />
				<Select
					name="is_approved"
					v-model="store.comment.is_approved"
					:options="[
						{ id: 1, name: $t('Yes') },
						{ id: 0, name: $t('No') },
					]"
				/>
				<Button text="Update" class="settings_button" />
			</form>
		</Group>
	</Layout>
</template>
