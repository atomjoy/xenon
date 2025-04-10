<script setup>
import Layout from './parts/Layout.vue';
import Group from './parts/Group.vue';
import Label from '@/components/auth/Label.vue';
import Input from '@/components/auth/Input.vue';
import Select from '@/components/auth/Select.vue';
import Textarea from '@/components/auth/Textarea.vue';
import Button from '@/components/auth/Button.vue';
import { onMounted, ref } from 'vue';
import { useCategoryStore } from '@/stores/category.js';

const store = useCategoryStore();
const visible = ref(1);

onMounted(async () => {
	store.clearError();
	store.category = 'null';
	store.category_image = null;
	await store.loadMainCategories();
});
</script>

<template>
	<Layout :message="store.getMessage" :error="store.getError">
		<Group title="Create category" desc="Here you can create the article category.">
			<form action="post" @submit.prevent="store.createItem" enctype="multipart/form-data">
				<Label text="Category name" />
				<Input name="name" />
				<Label text="Slug" />
				<Input name="slug" />
				<Label text="Description" />
				<Textarea name="about" />
				<Label text="Image" />
				<Input type="file" name="image" @change="store.getImagePath" />
				<div class="panel_item_image" v-if="store.category_image">
					<img id="img" :src="store.category_image" onerror="this.remove()" />
				</div>
				<Label text="Subcategory for" />
				<Select name="category_id" v-model="store.category" :options="store.category_main" />
				<Label text="Visibility" />
				<Select
					name="visible"
					v-model="visible"
					:options="[
						{ id: 1, name: $t('Yes') },
						{ id: 0, name: $t('No') },
					]"
				/>
				<Button text="Create" class="settings_button" />
			</form>
		</Group>
	</Layout>
</template>
