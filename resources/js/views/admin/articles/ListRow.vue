<script setup>
import IconEdit from '@/assets/icons/IconEdit.vue';
import IconTrash from '@/assets/icons/IconTrash.vue';
import { useArticleStore } from '@/stores/article.js';

const store = useArticleStore();
const props = defineProps({
	item: { default: null },
});
</script>

<template>
	<td class="panel_list_title">
		<span class="panel_list_col_id">{{ item.id }}</span>
	</td>
	<td>
		<a :href="'/admin/article/' + item.slug" class="panel_list_item_link" target="_blank">
			<img class="panel_list_image" :src="'/img/show?path=' + item.image" onerror="this.remove()" />
		</a>
	</td>
	<td>
		<a :href="'/admin/article/' + item.slug" class="panel_list_item_link" target="_blank">
			{{ item.title }}
		</a>
	</td>
	<td>
		<a v-for="cat in item.categories" :href="'/admin/category/' + cat.slug" class="panel_list_article_category_link" target="_blank">
			<span class="panel_list_col_category">
				{{ cat.name }}
			</span>
		</a>
	</td>
	<td>
		<span class="panel_list_col_author">
			{{ item.author.name }}
		</span>
	</td>
	<td>
		<RouterLink class="panel_list_action_link" :to="'/admin/articles/edit/' + item.id" :title="$t('Edit')">
			<IconEdit />
		</RouterLink>

		<div @click="store.deleteItem(item.id)" class="panel_list_action_link" :title="$t('Delete')">
			<IconTrash />
		</div>
	</td>
</template>
