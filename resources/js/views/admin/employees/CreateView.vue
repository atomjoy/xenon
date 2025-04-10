<script setup>
import Layout from './parts/Layout.vue';
import Group from './parts/Group.vue';
import Label from '@/components/auth/Label.vue';
import Input from '@/components/auth/Input.vue';
import Textarea from '@/components/auth/Textarea.vue';
import Button from '@/components/auth/Button.vue';
import { onMounted } from 'vue';
import { useItemStore } from '@/stores/employee.js';

const store = useItemStore();

onMounted(async () => {
	store.clearError();
	store.item_image = null;
});
</script>

<template>
	<Layout :message="store.getMessage" :error="store.getError">
		<Group title="Create employee" desc="Here you can create the employee.">
			<form action="post" @submit.prevent="store.createItem" enctype="multipart/form-data">
				<Label text="Employee Name" />
				<Input name="name" />

				<Label text="Position" />
				<Input name="position" />

				<Label text="Slug" />
				<Input name="slug" />

				<Label text="Experience" />
				<Input name="experience" />

				<Label text="Email" />
				<Input name="email" />

				<Label text="Mobile" />
				<Input name="mobile" />

				<Label text="Excerpt (Text)" />
				<Textarea name="excerpt" />

				<Label text="Content (Html)" />
				<Textarea name="content_html" />

				<Label text="Image" />
				<Input type="file" name="image" @change="store.getImagePath" />
				<div class="panel_item_image" v-if="store.item_image">
					<img id="img" :src="store.item_image" onerror="this.remove()" />
				</div>

				<Label text="Facebook" />
				<Input name="facebook" :placeholder="$t('Website url')" />

				<Label text="Twitter" />
				<Input name="twitter" :placeholder="$t('Website url')" />

				<Label text="Youtube" />
				<Input name="youtube" :placeholder="$t('Website url')" />

				<Label text="Instagram" />
				<Input name="instagram" :placeholder="$t('Website url')" />

				<Label text="Linkedin" />
				<Input name="linkedin" :placeholder="$t('Website url')" />

				<Label text="Pinterest" />
				<Input name="pinterest" :placeholder="$t('Website url')" />

				<Label text="Dribbble" />
				<Input name="dribbble" :placeholder="$t('Website url')" />

				<Label text="Behance" />
				<Input name="behance" :placeholder="$t('Website url')" />

				<Label text="Publish at" />
				<Input name="published_at" placeholder="YYYY-MM-DD HH:MM:SS" />

				<Button text="Create" class="settings_button" />
			</form>
		</Group>
	</Layout>
</template>
