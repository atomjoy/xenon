<script setup>
import ChangeDescription from '@/components/utils/ChangeDescription/ChangeDescription.vue';
import ChangeTitle from '@/components/utils/ChangeTitle/ChangeTitle.vue';
import Policy from '@/components/utils/Docs/PrivacyPolicy.vue';
import BlogLayout from '@/layouts/page/BlogLayout.vue';
</script>

<template>
	<BlogLayout title="Privacy Policy" description="Our privacy policy.">
		<Policy />
	</BlogLayout>

	<ChangeTitle :title="$t('Privacy Policy')" />
	<ChangeDescription :description="$t('Our privacy policy.')" />
</template>

<style>
@import url('@/assets/css/blog.css');
</style>
