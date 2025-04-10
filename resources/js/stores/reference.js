import { ref, computed } from 'vue';
import { defineStore, storeToRefs } from 'pinia';
import router from '@/router';
import axios from 'axios';

export const useItemStore = defineStore('reference', () => {
	// State
	const error = ref(false);
	const message = ref(null);
	const item = ref({});
	const item_image = ref(null);
	let current_page = ref(1);
	let last_page = ref(1);
	let perpage = ref(5);
	let list = ref([]);
	let links = ref([]);

	// Getters
	const getItem = computed(() => item);
	const getItemImage = computed(() => item_image);
	// With value
	const getError = computed(() => error.value);
	const getMessage = computed(() => message.value);

	// Actions
	async function loadList() {
		let res = await axios.get('/web/api/admin/references?page=' + current_page.value + '&perpage=' + perpage.value);
		list.value = res?.data?.data ?? [];
		links.value = res?.data?.links ?? [];
		last_page.value = res?.data.meta.last_page ?? 1;
		current_page.value = res?.data.meta.current_page ?? 1;
		router.push({ query: { page: current_page.value } });
	}

	async function deleteItem(id) {
		try {
			if (confirm('Delete ?')) {
				let res = await axios.delete('/web/api/admin/references/' + id);
				setMessage(res);
				const row = document.querySelector('.panel_list_row_' + id);
				row.remove();
				await loadList();
			}
		} catch (err) {
			setError(err);
		}
	}

	async function createItem(e) {
		try {
			let res = await axios.post('/web/api/admin/references', new FormData(e.target));
			setMessage(res);
			resetForm(e);
		} catch (err) {
			setError(err);
		}
		scrollTop();
	}

	async function updateItem(id, data) {
		try {
			data.append('_method', 'PATCH');
			let res = await axios.post('/web/api/admin/references/' + id, data);
			setMessage(res);
		} catch (err) {
			setError(err);
		}
		await loadItem(id);
		scrollTop();
	}

	async function loadItem(id) {
		try {
			let res = await axios.get('/web/api/admin/references/' + id);
			item.value = res?.data;
		} catch (err) {
			setError(err);
		}
	}

	async function removeImage(id) {
		try {
			let res = await axios.get('/web/api/admin/references/remove/' + id);
			setMessage(res);
			await loadItem(id);
			item_image.value = item.image;
		} catch (err) {
			setError(err);
		}
	}

	function getImagePath(e) {
		item_image.value = URL.createObjectURL(e.target.files[0]);
		const el = document.querySelector('#img');
		if (el) {
			el.src = item_image.value;
		}
	}

	function resetForm(e) {
		e.target.reset();
	}

	function clearError() {
		message.value = null;
		error.value = false;
	}

	function setMessage(res) {
		message.value = res?.data?.message;
		error.value = false;
	}

	function setError(err) {
		message.value = err?.response?.data?.message ?? err?.message ?? 'Ups! Invalid data.';
		error.value = true;
	}

	function updateMessage(msg) {
		message.value = msg;
	}

	function updateError(err = true) {
		error.value = err;
	}

	function scrollTop() {
		window.scrollTo({ top: 1, behavior: 'smooth' });
	}

	function setPerpage(value) {
		if (value < 5) {
			perpage.value = 5;
		}
		loadList();
	}

	function prevPage() {
		current_page.value--;
		if (current_page.value <= 0) {
			current_page.value = 1;
		}
		loadList();
	}

	function nextPage() {
		current_page.value++;
		if (current_page.value >= last_page.value) {
			current_page.value = last_page.value;
		}
		loadList();
	}

	return {
		message,
		error,
		item,
		item_image,
		current_page,
		last_page,
		perpage,
		list,
		links,
		getError,
		getMessage,
		getItemImage,
		getItem,
		resetForm,
		clearError,
		scrollTop,
		updateMessage,
		updateError,
		getImagePath,
		removeImage,
		createItem,
		loadItem,
		updateItem,
		loadList,
		deleteItem,
		setPerpage,
		prevPage,
		nextPage,
	};
});
