<script setup>
import Comment from './Comment.vue';

const props = defineProps({
	comments: { type: Object },
});
</script>

<template>
	<ul class="comment_replies">
		<Comment :comments="props?.comments" />
	</ul>
</template>
