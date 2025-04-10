<script setup>
import IconEdit from '@/assets/icons/IconEdit.vue';
import IconTrash from '@/assets/icons/IconTrash.vue';
import { useCategoryStore } from '@/stores/category.js';

const store = useCategoryStore();
const props = defineProps({
	item: { default: null },
});
</script>

<template>
	<td class="panel_list_title">
		<span class="panel_list_col_id">{{ item.id }}</span>
	</td>
	<td>
		<a :href="'/admin/category/' + item.slug" class="panel_list_item_link" target="_blank">
			<img class="panel_list_image" :src="'/img/show?path=' + item.image" onerror="this.remove()" />
		</a>
	</td>
	<td>
		<a :href="'/admin/category/' + item.slug" class="panel_list_item_link" target="_blank">
			{{ item.name }}
		</a>
	</td>
	<td>
		<a :href="'/admin/category/' + item.slug" class="panel_list_article_category_link" target="_blank">
			{{ item.slug }}
		</a>
	</td>
	<td>
		{{ item?.parent?.name ?? $t('Yes') }}
		<span v-if="item?.parent?.id">({{ item?.parent?.id }})</span>
	</td>
	<td>
		<span v-if="item.visible" class="span_btn span_btn_green">{{ $t('visible') }}</span>
		<span v-if="!item.visible" class="span_btn span_btn_red">{{ $t('hidden') }}</span>
	</td>
	<td>
		<RouterLink class="panel_list_action_link" :to="'/admin/category/edit/' + item.id" :title="$t('Edit')">
			<IconEdit />
		</RouterLink>

		<div @click="store.deleteItem(item.id)" class="panel_list_action_link" :title="$t('Delete')">
			<IconTrash />
		</div>
	</td>
</template>
