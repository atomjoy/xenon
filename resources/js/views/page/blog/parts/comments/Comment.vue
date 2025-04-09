<script setup>
import IconReply from '@/assets/icons/IconReply.vue';
import CommentReply from './CommentReply.vue';
import { ref } from 'vue';
import { useAuthStore } from '@/stores/auth.js';
import { useI18n } from 'vue-i18n';

const { t } = useI18n({ useScope: 'global' });
const store = useAuthStore();
const logged = store.isLoggedIn.value;
const error = ref(null);
const comment = ref('');

const props = defineProps({
	comments: { type: Object },
});

async function addComment(article_id, reply_id) {
	try {
		let data = new FormData();
		data.append('content', comment.value);
		data.append('reply_id', reply_id);
		let res = await axios.post('/web/api/blog/comments/' + article_id, data);
		error.value = t('Comment sent for approval.');
		comment.value = '';
	} catch (err) {
		console.log('Error', err);
	}
}

function openReply(e) {
	let all = document.querySelectorAll('.comment_reply_btn_open');
	all.forEach((i) => {
		i.classList.remove('comment_reply_btn_open');
	});
	e.currentTarget.classList.add('comment_reply_btn_open');
}
</script>

<template>
	<li class="comment_thread">
		<div class="comment_wrapper">
			<div class="comment_author">
				<div class="comment_author_image">
					<img :src="'/img/avatar?path=' + props?.comments?.author?.avatar" />
				</div>
				<div class="comment_author_details">
					<div class="comment_author_top">
						<span class="comment_author_name">{{ props?.comments?.author?.name }}</span>
						<span class="comment_author_role" v-if="props?.comments?.is_article_author">{{ $t('Author') }}</span>
					</div>
					<div class="comment_author_time">
						{{ props?.comments?.created_at }}
					</div>
				</div>
			</div>

			<div class="comment_content" :title="'ID-' + props?.comments.id">{{ props?.comments?.content }}</div>

			<div class="comment_reply_btn" @click="openReply" v-if="logged"><IconReply /> <span>Reply</span></div>

			<div class="comment_reply_form" v-if="logged">
				<div class="title">{{ $t('Reply to comment') }}</div>
				<div class="blog_comment_error" v-if="error">{{ error }}</div>
				<textarea v-model="comment"></textarea>
				<div class="blog_comment_btn" @click="addComment(props?.comments?.article_id, props?.comments?.id)">{{ $t('Reply') }}</div>
			</div>
		</div>

		<CommentReply :comments="c" v-for="c in props?.comments?.replies?.data" />
	</li>
</template>
