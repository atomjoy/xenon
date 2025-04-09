import { ref, computed } from 'vue';
import { defineStore, storeToRefs } from 'pinia';
import router from '@/router';
import axios from 'axios';

export const useCategoryStore = defineStore('category', () => {
	// State
	const error = ref(false);
	const message = ref(null);
	const category = ref('null');
	const category_main = ref([]);
	const category_image = ref(null);
	let current_page = ref(1);
	let last_page = ref(1);
	let perpage = ref(5);
	let list = ref([]);

	// Getters
	const getCategory = computed(() => category);
	const getCategoryMain = computed(() => category_main);
	const getCategoryImage = computed(() => category_image);
	// With value
	const getError = computed(() => error.value);
	const getMessage = computed(() => message.value);

	// Actions
	async function loadList() {
		let res = await axios.get('/web/api/admin/categories?page=' + current_page.value + '&perpage=' + perpage.value);
		list.value = res?.data?.data ?? [];
		last_page.value = res?.data.last_page ?? 1;
		current_page.value = res?.data.current_page ?? 1;
		router.push({ query: { page: current_page.value } });
	}

	async function deleteItem(id) {
		try {
			if (confirm('Delete ?')) {
				let res = await axios.delete('/web/api/admin/categories/' + id);
				setMessage(res);
				const row = document.querySelector('.panel_list_row_' + id);
				row.remove();
			}
		} catch (err) {
			setError(err);
		}
	}

	async function loadMainCategories() {
		try {
			let res = await axios.get('/web/api/admin/categories/get/main');
			category_main.value = res?.data;
		} catch (err) {
			setError(err);
		}
	}

	async function createItem(e) {
		try {
			let res = await axios.post('/web/api/admin/categories', new FormData(e.target));
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
			let res = await axios.post('/web/api/admin/categories/' + id, data);
			setMessage(res);
		} catch (err) {
			setError(err);
		}
		loadItem(id);
		scrollTop();
	}

	async function loadItem(id) {
		try {
			let res = await axios.get('/web/api/admin/categories/' + id);
			category.value = res?.data;
		} catch (err) {
			setError(err);
		}
	}

	async function removeImage(id) {
		try {
			let res = await axios.get('/web/api/admin/categories/remove/' + id);
			setMessage(res);
			loadItem(id);
		} catch (err) {
			setError(err);
		}
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

	function getImagePath(e) {
		category_image.value = URL.createObjectURL(e.target.files[0]);
		const el = document.querySelector('#img');
		if (el) {
			el.src = category_image.value;
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
		// Need html tag with overflow-y: scroll
		window.scrollTo({ top: 1, behavior: 'smooth' });
		// document.querySelector(id).scrollIntoView({behavior: 'smooth' });
	}

	return {
		message,
		error,
		category,
		category_main,
		category_image,
		current_page,
		last_page,
		perpage,
		list,
		getError,
		getMessage,
		getCategoryImage,
		getCategoryMain,
		getCategory,
		resetForm,
		clearError,
		scrollTop,
		updateMessage,
		updateError,
		getImagePath,
		loadMainCategories,
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
