<script setup>
import Comment from './Comment.vue';
import { ref, defineProps, watch } from 'vue';
import { useAuthStore } from '@/stores/auth.js';
import { RouterLink } from 'vue-router';
import { useI18n } from 'vue-i18n';

const { t } = useI18n({ useScope: 'global' });
const store = useAuthStore();
const logged = store.isLoggedIn.value;
const error = ref(null);
let reply = ref('null');
let comment = ref('');
let total_pages = ref(0);
let current_page = ref(0);
let next_page = ref(0);
let prev_page = ref(0);

const props = defineProps({
	article: { type: Object, default: {} },
	paginate: { type: Object, default: {} },
});

watch(
	() => props.article,
	(x, y) => {
		total_pages.value = props.paginate.total_pages;
		current_page.value = props.paginate.current_page;
		next_page.value = current_page.value >= total_pages.value ? (next_page.value = current_page.value) : (next_page.value = current_page.value + 1);
		prev_page.value = current_page.value > 1 ? (prev_page.value = current_page.value - 1) : (prev_page.value = 1);
	}
);

async function addComment(article_id) {
	try {
		let data = new FormData();
		data.append('content', comment.value);
		data.append('reply_id', reply.value);
		let res = await axios.post('/web/api/blog/comments/' + article_id, data);
		error.value = t('Comment sent for approval.');
		comment.value = '';
	} catch (err) {
		console.log('Error', err);
	}
}
</script>
<template>
	<div class="blog_comment_form" v-if="logged">
		<div class="blog_comment_title">{{ $t('Add comment') }}</div>
		<div class="blog_comment_error" v-if="error">{{ error }}</div>
		<textarea v-model="comment"></textarea>
		<div class="blog_comment_btn" @click="addComment(props.article.id)">{{ $t('Add') }}</div>
	</div>

	<div class="blog_comments">
		<h2 class="blog_comment_title">
			<i class="blog_hash">#</i> {{ $t('Comments') }} ({{ props.article.comments_count }})
			<RouterLink to="/login" class="login_to_comment" v-if="!logged">{{ $t('Login to comment') }}</RouterLink>
		</h2>
		<p class="comment_empty_list" v-if="props.article.comments_count == 0">{{ $t('This article has no comments yet.') }}</p>
		<ul class="comments_list">
			<Comment :comments="a" v-for="a in props.article?.comments?.data" />
		</ul>
	</div>

	<div class="blog_comments_paginate">
		<a :href="'?page=' + prev_page" v-if="current_page > 1">{{ $t('Prev') }}</a>
		<span v-if="total_pages > 1">{{ current_page }} / {{ total_pages }}</span>
		<a :href="'?page=' + next_page" v-if="current_page < total_pages">{{ $t('Next') }}</a>
	</div>
</template>

<style>
.blog_comment_error {
	float: left;
	width: 100%;
	padding: 10px;
	margin-block: 10px;
	color: var(--accent);
}
.comment_empty_list {
	float: left;
	width: 100%;
	padding: 20px;
	color: var(--text-2);
	border: 1px solid var(--border);
	border-radius: var(--border-radius);
}
.login_to_comment {
	float: right;
	color: var(--accent);
	font-size: 14px;
}

.blog_comments {
	float: left;
	width: 100%;
	height: auto;
}
.blog_comment_title {
	float: left;
	width: 100%;
}
.comment_thread {
	float: left;
	width: 100%;
	height: auto;
	margin-block: 10px;
	box-sizing: border-box;
	border-left: 1px solid transparent;
	transition: all 0.6s;
}
.comment_thread:hover {
	border-left: 1px solid var(--border);
	border-radius: var(--border-radius);
}
.comment_wrapper {
	float: left;
	width: 100%;
	height: auto;
	padding: 15px;
	margin-left: -1px;
	border-radius: var(--border-radius);
	border: 1px solid var(--border);
}
.comment_author {
	float: left;
	width: 100%;
	display: flex;
	align-items: center;
}
.comment_author_image {
	display: block;
}
.comment_author_image img {
	display: block;
	width: 50px;
	height: 50px;
	margin-right: 20px;
	border-radius: 50%;
}

.comments_list {
	float: left;
	width: 100%;
	height: auto;
	margin-top: 0px;
	padding-left: 0px;
}
.comments_list > .comment_thread {
	background: var(--bg-1);
}

.comments_list ul,
.comments_list li {
	list-style: none;
}

.comment_content {
	float: left;
	width: 100%;
	font-size: 14px;
	color: var(--text-2);
	margin-top: 10px;
}

.comment_author_details {
	float: left;
	width: 100%;
	font-size: 14px;
}
.comment_author_top {
	float: left;
	width: 100%;
	height: auto;
}
.comment_author_name {
	display: inline;
	height: auto;
	font-weight: 700;
}

.comment_author_role {
	display: inline;
	height: auto;
	padding: 2px 5px;
	margin-inline: 10px;
	font-weight: 300;
	color: #fff;
	background: var(--accent);
	font-size: 12px !important;
	border-radius: var(--border-radius);
}

.comment_author_time {
	float: left;
	width: 100%;
	height: auto;
	margin-top: 5px;
	font-size: 12px;
	font-weight: 500;
	color: var(--text-2);
}

.blog_comment_form textarea {
	resize: vertical;
	float: left;
	width: 100%;
	padding: 15px;
	color: var(--text-1);
	background: var(--bg-2);
	border-radius: var(--border-radius);
	font-family: var(--font-family);
	font-size: 14px;
	border: none;
	height: 200px;
	min-height: 200px;
	max-height: 300px;
	margin-bottom: 20px;
}

.blog_comment_btn {
	float: right;
	padding: 6px 15px;
	font-size: 14px;
	color: #fff;
	background: var(--accent);
	border-radius: var(--border-radius);
	margin-left: 10px;
	cursor: pointer;
}

.blog_comment_btn:hover {
	background: var(--accent-hover);
}

.comment_replies {
	float: left;
	width: 100%;
	height: auto;
}

.comment_reply_form {
	display: none;
	float: left;
	width: 100%;
	height: auto;
	margin-top: 10px;
}

.comment_reply_form .title {
	float: left;
	width: 100%;
	margin-bottom: 10px;
	font-weight: 700;
}

.comment_reply_form textarea {
	resize: vertical;
	float: left;
	width: 100%;
	padding: 15px;
	margin-bottom: 10px;
	color: var(--text-1);
	background: var(--bg-2);
	border: 1px solid var(--border);
	border-radius: var(--border-radius);
	font-family: var(--font-family);
	font-size: 14px;
	height: 150px;
	min-height: 150px;
	max-height: 300px;
}

.comment_reply_btn {
	float: left;
	width: auto;
	font-size: 14px;
	margin-top: 10px;
	color: var(--text-2);
	cursor: pointer;
}

.comment_reply_btn svg {
	float: left;
	width: 20px;
	height: 20px;
	margin-right: 5px;
}

.comment_reply_btn svg * {
	stroke: var(--text-2);
}

.comment_reply_btn:hover svg * {
	stroke: var(--accent);
}

.comment_reply_btn_open {
	display: none;
}

.comment_reply_btn_open + .comment_reply_form {
	display: inherit;
}

.blog_comments_paginate {
	float: left;
	width: 100%;
	margin-block: 10px;
}

.blog_comments_paginate * {
	float: left;
	width: auto;
	margin-right: 20px;
}
</style>
