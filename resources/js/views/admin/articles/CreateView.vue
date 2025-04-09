<script setup>
import Layout from './parts/Layout.vue';
import Group from './parts/Group.vue';
import Label from '@/components/auth/Label.vue';
import Input from '@/components/auth/Input.vue';
import Select from '@/components/auth/SelectMulti.vue';
import Textarea from '@/components/auth/Textarea.vue';
import Button from '@/components/auth/Button.vue';
import { onMounted, ref } from 'vue';
import { useArticleStore } from '@/stores/article.js';

const store = useArticleStore();
const category = ref([]);

onMounted(async () => {
	store.clearError();
	store.category = 'null';
	store.article_image = null;
	await store.loadCategories();
	// console.log('Categories', store.categories);
});
</script>

<template>
	<Layout :message="store.getMessage" :error="store.getError">
		<Group title="Create article" desc="Here you can create the article.">
			<form action="post" @submit.prevent="store.createItem" enctype="multipart/form-data">
				<Label text="Title" />
				<Input name="title" />
				<Label text="Slug" />
				<Input name="slug" />
				<Label text="Excerpt (Text)" />
				<Textarea name="excerpt" />
				<Label text="Content (Html)" />
				<Textarea name="content_html" />
				<Label text="Image" />
				<Input type="file" name="image" @change="store.getImagePath" />
				<div class="panel_item_image" v-if="store.article_image">
					<img id="img" :src="store.article_image" onerror="this.remove()" />
				</div>
				<Label text="Category" />
				<Select name="category_id[]" v-model="category" :options="store.categories" />

				<Label text="Publish at" />
				<Input name="published_at" placeholder="YYYY-MM-DD HH:MM:SS" />

				<Button text="Create" class="settings_button" />
			</form>
		</Group>
	</Layout>
</template>
