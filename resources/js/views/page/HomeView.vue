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
	<!-- <AddSchema :json="item.schema_seo" />
	<AddMeta :json="item.meta_seo" /> -->

	<ChangeTitle :title="$t('Home')" />
	<ChangeDescription :description="$t('Home description')" />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
