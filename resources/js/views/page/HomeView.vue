<script setup>
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import AddSchema from '@/components/utils/Html/AddSchema.vue';
import AddMeta from '@/components/utils/Html/AddMeta.vue';
import Layout from '@/layouts/page/HomepageLayout.vue';
import ProjectsRecent from './parts/ProjectsRecent.vue';
import TeamMembers from './parts/TeamMembers.vue';
import QuestionsLatest from './parts/QuestionsLatest.vue';
import WorkingProcess from './parts/WorkingProcess.vue';
import ServicesHome from './parts/ServicesHome.vue';
import Articles from './parts/Articles.vue';
import HomeTop from './parts/HomeTop.vue';
import schema from '@/settings/seo/homepage_schema.js';
import meta from '@/settings/seo/homepage_meta.js';
</script>

<template>
	<Layout title="Welcome" description="Our homepage.">
		<HomeTop />
		<ServicesHome />
		<WorkingProcess />
		<ProjectsRecent />
		<TeamMembers />
		<Articles />
		<QuestionsLatest />
	</Layout>

	<!-- Seo header meta -->
	<AddMeta :json="JSON.stringify(meta)" />
	<AddSchema :json="JSON.stringify(schema)" />

	<ChangeTitle :title="'Home'" />
	<ChangeDescription :description="'Home description'" />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
