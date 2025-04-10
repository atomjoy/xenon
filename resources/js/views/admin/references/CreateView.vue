<script setup>
import Layout from './parts/Layout.vue';
import Group from './parts/Group.vue';
import Label from '@/components/auth/Label.vue';
import Input from '@/components/auth/Input.vue';
import Select from '@/components/auth/Select.vue';
import Textarea from '@/components/auth/Textarea.vue';
import Button from '@/components/auth/Button.vue';
import { onMounted, ref } from 'vue';
import { useItemStore } from '@/stores/reference.js';

const store = useItemStore();
const vote = ref(5.0);
onMounted(async () => {
	store.clearError();
	store.item_image = null;
});
</script>

<template>
	<Layout :message="store.getMessage" :error="store.getError">
		<Group title="Create reference" desc="Here you can create the reference.">
			<form action="post" @submit.prevent="store.createItem" enctype="multipart/form-data">
				<Label text="Client Name" />
				<Input name="name" />

				<Label text="Company" />
				<Input name="company" />

				<Label text="Message" />
				<Textarea name="message" />

				<Label text="Website" />
				<Input name="website" />

				<Label text="Vote" />
				<Select
					name="vote"
					v-model="vote"
					:options="[
						{ id: 5.0, name: '5.0' },
						{ id: 4.5, name: '4.5' },
						{ id: 4.0, name: '4.0' },
						{ id: 3.5, name: '3.5' },
						{ id: 3.0, name: '3.0' },
						{ id: 2.5, name: '2.5' },
						{ id: 2.0, name: '2.0' },
						{ id: 1.5, name: '1.5' },
						{ id: 1.0, name: '1.0' },
					]"
				/>

				<Label text="Project ID" />
				<Input name="project_id" />

				<Label text="Image" />
				<Input type="file" name="image" @change="store.getImagePath" />
				<div class="panel_item_image" v-if="store.item_image">
					<img id="img" :src="store.item_image" onerror="this.remove()" />
				</div>

				<Label text="Publish at" />
				<Input name="published_at" placeholder="YYYY-MM-DD HH:MM:SS" />

				<Button text="Create" class="settings_button" />
			</form>
		</Group>
	</Layout>
</template>
