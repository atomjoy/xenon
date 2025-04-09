<script setup>
import Layout from './parts/Layout.vue';
import Group from './parts/Group.vue';
import Label from '@/components/auth/Label.vue';
import Input from '@/components/auth/Input.vue';
import Select from '@/components/auth/SelectMulti.vue';
import Textarea from '@/components/auth/Textarea.vue';
import Button from '@/components/auth/Button.vue';
import Tags from '@/components/auth/Tags.vue';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import { useArticleStore } from '@/stores/article.js';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';

const store = useArticleStore();
const route = useRoute();
const id = route.params.id;
const category = ref([]);
const tags = ref([]);

onMounted(async () => {
	store.clearError();
	await store.loadCategories();
	await store.loadItem(id);
	category.value = store.article.categories.map((i) => i.id) ?? [];
	tags.value = store.article.tags.map((i) => i.slug) ?? [];
	// console.log(tags.value);
});

async function onSubmit(e) {
	await store.updateItem(id, new FormData(e.target));
	category.value = store.article.categories.map((i) => i.id) ?? [];
}

function setMetaSeo() {
	const el = document.querySelector('.meta_seo');
	el.value = JSON.stringify(store.meta_seo, null, 4);
}

function setSchemaSeo() {
	const el = document.querySelector('.schema_seo');
	el.value = JSON.stringify(store.schema_seo, null, 4);
}
</script>

<template>
	<Layout :message="store.getMessage" :error="store.getError" :edit="true">
		<Group title="Update article" desc="Here you can edit the article article.">
			<form action="post" @submit.prevent="onSubmit" enctype="multipart/form-data">
				<Label text="Title" />
				<Input name="title" v-model="store.article.title" />

				<Label text="Slug" />
				<Input name="slug" v-model="store.article.slug" />

				<Label text="Excerpt (Text)" />
				<Textarea name="excerpt" v-model="store.article.excerpt" />

				<Label text="Content (Html)" />
				<Textarea name="content_html" v-model="store.article.content_html" />

				<Label text="Image" />
				<Input name="image" type="file" id="panel_item_input" @change="store.getImagePath" />
				<div class="panel_item_image" v-if="store.article.image">
					<div class="panel_item_remove" @click="store.removeImage(store.article.id)">
						{{ $t('Delete') }}
					</div>
					<img id="img" :src="'/img/show?path=' + store.article.image" onerror="this.remove()" />
				</div>
				<Label text="Category" />
				<Select name="category_id[]" v-model="category" :options="store.categories" />

				<Label text="Tags" />
				<Tags v-model="tags" />

				<Label text="Meta tags (Array with json or empty array)" />
				<Textarea class="meta_seo" name="meta_seo" v-model="store.article.meta_seo" :placeholder="[]" />
				<div class="panel_load_seo" @click="setMetaSeo">{{ $t('Load sample') }}</div>

				<Label text="Schema tags (Array with json or empty array)" @click="setSchemaSeo" />
				<Textarea class="schema_seo" name="schema_seo" v-model="store.article.schema_seo" :placeholder="[]" />
				<div class="panel_load_seo" @click="setSchemaSeo">{{ $t('Load sample') }}</div>

				<Label text="Publish at" />
				<Input name="published_at" v-model="store.article.published_at" placeholder="YYYY-MM-DD HH:MM:SS" />

				<Button text="Update" class="settings_button" />
			</form>

			<!-- Seo header meta -->
			<AddSchema :json="store.article.schema_seo" />
			<AddMeta :json="store.article.meta_seo" />
		</Group>
	</Layout>
</template>
