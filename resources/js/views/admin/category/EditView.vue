<script setup>
import Layout from './parts/Layout.vue';
import Group from './parts/Group.vue';
import Label from '@/components/auth/Label.vue';
import Input from '@/components/auth/Input.vue';
import Select from '@/components/auth/Select.vue';
import Textarea from '@/components/auth/Textarea.vue';
import Button from '@/components/auth/Button.vue';
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { useCategoryStore } from '@/stores/category.js';

const store = useCategoryStore();
const route = useRoute();
const id = route.params.id;

onMounted(async () => {
	store.clearError();
	await store.loadMainCategories();
	await store.loadItem(id);
	// console.log('Update', id, store.category);
});

function onSubmit(e) {
	store.updateItem(id, new FormData(e.target));
}
</script>

<template>
	<Layout :message="store.getMessage" :error="store.getError" :edit="true">
		<Group title="Update category" desc="Here you can edit the article category.">
			<form action="post" @submit.prevent="onSubmit" enctype="multipart/form-data">
				<Label text="Category name" />
				<Input name="name" v-model="store.category.name" />
				<Label text="Slug" />
				<Input name="slug" v-model="store.category.slug" />
				<Label text="Description" />
				<Textarea name="about" v-model="store.category.about" />
				<Label text="Image" />
				<Input name="image" type="file" id="panel_item_input" @change="store.getImagePath" />

				<div class="panel_item_image" v-if="store.category.image">
					<div class="panel_item_remove" @click="store.removeImage(store.category.id)">
						{{ $t('Delete') }}
					</div>
					<img id="img" :src="'/img/show?path=' + store.category.image" onerror="this.remove()" />
				</div>

				<Label text="Subcategory for" />
				<Select name="category_id" v-model="store.category.category_id" :options="store.category_main" />
				<Button text="Update" class="settings_button" />
			</form>
		</Group>
	</Layout>
</template>
