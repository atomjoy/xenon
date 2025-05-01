<script setup>
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
import Layout from '@/layouts/page/MapLayout.vue';
import Contact from './parts/Contact.vue';
import schema from '@/settings/seo/contact_schema.js';
import meta from '@/settings/seo/contact_meta.js';
</script>

<template>
	<Layout title="Contact" description="Our contact info.">
		<Contact />
	</Layout>

	<!-- Seo header meta -->
	<AddMeta :json="JSON.stringify(meta)" />
	<AddSchema :json="JSON.stringify(schema)" />

	<ChangeTitle :title="'Contact'" />
	<ChangeDescription :description="'Contact description'" />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
