<script setup>
import meta_seo from '@/utils/seo/seo_meta.js';
import schema_seo from '@/utils/seo/seo_schema.js';
import Layout from './parts/Layout.vue';
import Group from './parts/Group.vue';
import Label from '@/components/auth/Label.vue';
import Input from '@/components/auth/Input.vue';
import Select from '@/components/auth/Select.vue';
import Textarea from '@/components/auth/Textarea.vue';
import Button from '@/components/auth/Button.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import { useItemStore } from '@/stores/reference.js';

const store = useItemStore();
const route = useRoute();
const id = route.params.id;

onMounted(async () => {
	store.clearError();
	await store.loadItem(id);
	// console.log('Item', store.item);
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
		<Group title="Update reference" desc="Here you can edit the reference.">
			<form action="post" @submit.prevent="onSubmit" enctype="multipart/form-data">
				<Label text="Name" />
				<Input name="name" v-model="store.item.name" />

				<Label text="Company" />
				<Input name="company" v-model="store.item.company" />

				<Label text="Message" />
				<Textarea name="message" v-model="store.item.message" />

				<Label text="Image" />
				<Input name="image" type="file" id="panel_item_input" @change="store.getImagePath" />
				<div class="panel_item_image" v-if="store.item.image">
					<div class="panel_item_remove" @click="store.removeImage(store.item.id)">
						{{ $t('Delete') }}
					</div>
					<img id="img" :src="'/img/show?path=' + store.item.image" onerror="this.remove()" />
				</div>

				<Label text="Website" />
				<Input name="website" v-model="store.item.website" />

				<Label text="Vote" />
				<Select
					name="vote"
					v-model="store.item.vote"
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
					:fixed="1"
				/>

				<Label text="Project ID" />
				<Input name="project_id" v-model="store.item.project_id" />

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
