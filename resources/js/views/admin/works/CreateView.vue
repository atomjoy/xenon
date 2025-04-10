<script setup>
import Layout from './parts/Layout.vue';
import Group from './parts/Group.vue';
import Label from '@/components/auth/Label.vue';
import Input from '@/components/auth/Input.vue';
import Select from '@/components/auth/SelectMulti.vue';
import Textarea from '@/components/auth/Textarea.vue';
import Button from '@/components/auth/Button.vue';
import { onMounted, ref } from 'vue';
import { useItemStore } from '@/stores/work.js';

const store = useItemStore();

onMounted(async () => {
	store.clearError();
});
</script>

<template>
	<Layout :message="store.getMessage" :error="store.getError">
		<Group title="Create work" desc="Here you can create the work.">
			<form action="post" @submit.prevent="store.createItem" enctype="multipart/form-data">
				<Label text="Title" />
				<Input name="title" />

				<Label text="Slug" />
				<Input name="slug" />

				<Label text="Experience" />
				<Input name="experience" />

				<Label text="Job Time" />
				<Input name="time" />

				<Label text="Remote" />
				<Input name="remote" />

				<Label text="Salary" />
				<Input name="salary" />

				<Label text="Content (Html)" />
				<Textarea name="content_html" />

				<Label text="Publish at" />
				<Input name="published_at" placeholder="YYYY-MM-DD HH:MM:SS" />

				<Button text="Create" class="settings_button" />
			</form>
		</Group>
	</Layout>
</template>
