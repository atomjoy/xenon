<script setup>
import IconEdit from '@/assets/icons/IconEdit.vue';
import IconTrash from '@/assets/icons/IconTrash.vue';
import { useItemStore } from '@/stores/contact.js';

const store = useItemStore();
const props = defineProps({
	item: { default: null },
});
</script>

<template>
	<td>
		<span class="panel_list_col_id">{{ item.id }}</span>
	</td>
	<td>{{ item.firstname }} {{ item.lastname }}</td>
	<td>
		{{ item.email }}
	</td>
	<td>
		{{ item.mobile }}
	</td>
	<td>
		{{ item.subject }}
	</td>
	<td>
		<RouterLink class="panel_list_action_link" :to="'/admin/contacts/edit/' + item.id" :title="$t('Edit')">
			<IconEdit />
		</RouterLink>

		<div @click="store.deleteItem(item.id)" class="panel_list_action_link" :title="$t('Delete')">
			<IconTrash />
		</div>
	</td>
</template>
