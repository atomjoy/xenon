<script setup>
import Page from '@/utils/page.js';

const props = defineProps(['current_page', 'last_page', 'list', 'href']);
</script>

<template>
	<div class="page_links" v-if="props.list.length > 0">
		<a class="page_paginate_link" :href="props.href + '?page=' + Page.prev(props.current_page)" v-if="props.current_page > 1"><</a>
		<div class="page_paginate_link page_paginate_link_active" v-if="props.last_page != 1">
			{{ props.current_page }}
		</div>
		<a class="page_paginate_link" :href="props.href + '?page=' + Page.next(props.current_page, props.last_page)" v-if="props.current_page < props.last_page">></a>
	</div>
</template>

<style scoped>
.page_links {
	float: left;
	width: 100%;
}

.page_links .page_paginate_link {
	float: left;
	height: auto;
	min-width: 50px;
	margin-right: 10px;
	text-align: center;
	line-height: 40px;
	color: var(--accent);
	background: var(--bg-2);
	border-radius: var(--border-radius);
	font-weight: 600;
}

.page_paginate_link_active {
	border: 1px solid var(--accent);
}
</style>
