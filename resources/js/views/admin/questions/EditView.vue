<script setup>
import meta_seo from '@/utils/seo/seo_meta.js';
import schema_seo from '@/utils/seo/seo_schema.js';
import Layout from './parts/Layout.vue';
import Group from './parts/Group.vue';
import Label from '@/components/auth/Label.vue';
import Input from '@/components/auth/Input.vue';
import Textarea from '@/components/auth/Textarea.vue';
import Button from '@/components/auth/Button.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import { useItemStore } from '@/stores/question.js';

const store = useItemStore();
const route = useRoute();
const id = route.params.id;

onMounted(async () => {
	store.clearError();
	await store.loadItem(id);
	// console.log('Edit', store.item);
});

async function onSubmit(e) {
	await store.updateItem(id, new FormData(e.target));
}

function setMetaSeo() {
	const el = document.querySelector('.meta_seo');
	el.value = JSON.stringify(meta_seo, null, 4);
}

function setSchemaSeo() {
	const el = document.querySelector('.schema_seo');
	el.value = JSON.stringify(schema_seo, null, 4);
}
</script>

<template>
	<Layout :message="store.getMessage" :error="store.getError" :edit="true">
		<Group title="Update question" desc="Here you can edit the question.">
			<form action="post" @submit.prevent="onSubmit" enctype="multipart/form-data">
				<Label text="Message" />
				<Input name="message" v-model="store.item.message" />

				<Label text="Answer" />
				<Textarea name="answer" v-model="store.item.answer" />

				<Label text="Meta tags (Array with json or empty array)" />
				<Textarea class="meta_seo" name="meta_seo" v-model="store.item.meta_seo" :placeholder="'[]'" />
				<div class="panel_load_seo" @click="setMetaSeo">{{ $t('Load sample') }}</div>

				<Label text="Schema tags (Array with json or empty array)" @click="setSchemaSeo" />
				<Textarea class="schema_seo" name="schema_seo" v-model="store.item.schema_seo" :placeholder="'[]'" />
				<div class="panel_load_seo" @click="setSchemaSeo">{{ $t('Load sample') }}</div>

				<Label text="Publish at" />
				<Input name="published_at" v-model="store.item.published_at" placeholder="YYYY-MM-DD HH:MM:SS" />

				<Button text="Update" class="settings_button" />
			</form>

			<!-- Seo header meta -->
			<AddSchema :json="store.item.schema_seo" />
			<AddMeta :json="store.item.meta_seo" />
		</Group>
	</Layout>
</template>
