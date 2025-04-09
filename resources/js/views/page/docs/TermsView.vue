<script setup>
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import Terms from '@/components/utils/Docs/TermsConditions.vue';
import BlogLayout from '@/layouts/page/BlogLayout.vue';
</script>

<template>
	<BlogLayout title="Terms & Conditions" description="Our terms & conditions.">
		<Terms />
	</BlogLayout>

	<ChangeTitle :title="$t('Terms & Conditions')" />
	<ChangeDescription :description="$t('Our terms & conditions.')" />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
