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
import { useItemStore } from '@/stores/employee.js';

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
		<Group title="Update employee" desc="Here you can edit the employee.">
			<form action="post" @submit.prevent="onSubmit" enctype="multipart/form-data">
				<Label text="Employee Name" />
				<Input name="name" v-model="store.item.name" />

				<Label text="Position" />
				<Input name="position" v-model="store.item.position" />

				<Label text="Slug" />
				<Input name="slug" v-model="store.item.slug" />

				<Label text="Experience" />
				<Input name="experience" v-model="store.item.experience" />

				<Label text="Email" />
				<Input name="email" v-model="store.item.email" />

				<Label text="Mobile" />
				<Input name="mobile" v-model="store.item.mobile" />

				<Label text="Excerpt (Text)" />
				<Textarea name="excerpt" v-model="store.item.excerpt" />

				<Label text="Content (Html)" />
				<Textarea name="content_html" v-model="store.item.content_html" />

				<Label text="Image" />
				<Input name="image" type="file" id="panel_item_input" @change="store.getImagePath" />
				<div class="panel_item_image" v-if="store.item.image">
					<div class="panel_item_remove" @click="store.removeImage(store.item.id)">
						{{ $t('Delete') }}
					</div>
					<img id="img" :src="'/img/show?path=' + store.item.image" onerror="this.remove()" />
				</div>

				<Label text="Facebook" />
				<Input name="facebook" v-model="store.item.facebook" />

				<Label text="Twitter" />
				<Input name="twitter" v-model="store.item.twitter" />

				<Label text="Youtube" />
				<Input name="youtube" v-model="store.item.youtube" />

				<Label text="Instagram" />
				<Input name="instagram" v-model="store.item.instagram" />

				<Label text="Linkedin" />
				<Input name="linkedin" v-model="store.item.linkedin" />

				<Label text="Pinterest" />
				<Input name="pinterest" v-model="store.item.pinterest" />

				<Label text="Dribbble" />
				<Input name="dribbble" v-model="store.item.dribbble" />

				<Label text="Behance" />
				<Input name="behance" v-model="store.item.behance" />

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
