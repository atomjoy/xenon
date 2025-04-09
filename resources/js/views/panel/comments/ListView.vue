<script setup>
import Group from './parts/GroupList.vue';
import Layout from './parts/Layout.vue';
import ListRow from './ListRow.vue';
import { useRoute } from 'vue-router';
import { onMounted, watch } from 'vue';
import { useCommentStore } from '@/stores/panel/comment.js';

const store = useCommentStore();
const route = useRoute();

onMounted(async () => {
	store.clearError();
	store.current_page = route.query.page ?? 1;
	await store.loadList();
});

watch(
	() => route.query.page,
	(newId, oldId) => {
		store.current_page = route.query.page ?? 1;
		store.loadList();
	}
);
</script>

<template>
	<Layout :message="store.getMessage" :error="store.getError">
		<Group title="Comments" desc="List of article comments.">
			<table class="panel_table_list">
				<tr class="panel_list_header">
					<th scope="col" class="panel_list_title">{{ $t('ID') }}</th>
					<th scope="col" class="panel_list_title" style="min-width: 50%">{{ $t('Content') }}</th>
					<th scope="col" class="panel_list_title">{{ $t('Author') }}</th>
					<th scope="col" class="panel_list_title">{{ $t('Approved') }}</th>
					<th scope="col" class="panel_list_title panel_list_title_last">{{ $t('Action') }}</th>
				</tr>

				<tr v-for="i in store.list" :key="i.id" class="panel_list_row" :class="'panel_list_row_' + i.id">
					<ListRow :item="i" />
				</tr>

				<tr class="panel_list_empty" v-if="store.list.length == 0">
					{{
						$t('There are no records.')
					}}
				</tr>
			</table>

			<div class="panel_list_links" v-if="store.list.length > 0">
				<div class="panel_paginate_link" @click="store.prevPage" v-if="store.current_page > 1"><</div>
				<div class="panel_paginate_link panel_paginate_link_active">
					{{ store.current_page }}
				</div>
				<div class="panel_paginate_link" @click="store.nextPage" v-if="store.current_page < store.last_page">></div>
			</div>
		</Group>
	</Layout>
</template>
