import { ref, computed } from 'vue';
import { defineStore, storeToRefs } from 'pinia';
import router from '@/router';
import axios from 'axios';

export const useArticleStore = defineStore('article', () => {
	// State
	const error = ref(false);
	const message = ref(null);
	const article = ref('null');
	const article_image = ref(null);
	const categories = ref(null);
	let current_page = ref(1);
	let last_page = ref(1);
	let perpage = ref(5);
	let list = ref([]);
	let links = ref([]);

	let meta_seo = [
		{ attribute: 'name', value: 'keywords', content: 'blog' },
		{ attribute: 'name', value: 'geo.position', content: '52.017850;21.904640' },
		{ attribute: 'name', value: 'geo.placename', content: 'Warsaw' },
		{ attribute: 'property', value: 'og:url', content: 'https://example.com' },
		{ attribute: 'property', value: 'og:locale', content: 'pl_PL' },
		{ attribute: 'property', value: 'og:type', content: 'website' },
		{ attribute: 'property', value: 'og:site_name', content: 'Example' },
		{ attribute: 'property', value: 'og:title', content: 'Web pages with ...' },
		{ attribute: 'property', value: 'og:description', content: 'About page ...' },
		{ attribute: 'property', value: 'og:image', content: 'https://example.com/img.webp' },
		{ attribute: 'property', value: 'og:width', content: '700' },
		{ attribute: 'property', value: 'og:height', content: '700' },
	];

	let schema_seo = [
		{
			'@context': 'https://schema.org',
			'@type': 'WebPage',
			name: 'Example Corp',
			url: 'https://example.com',
		},
		{
			'@context': 'https://schema.org',
			'@type': 'Article',
			mainEntityOfPage: {
				'@type': 'WebPage',
				'@id': 'https://example.com/knowledge/deployment/',
			},
			headline: 'What is Deployment?',
			description: 'Software and web development with <p>tags probably</p> ...',
			image: 'https://example.com/media/knowledge/deployment.png',
			author: {
				'@type': 'Person',
				name: 'Jane Doe',
				url: 'https://example.com/author/janedoe69',
			},
			publisher: {
				'@type': 'Organization',
				name: 'Example',
				logo: {
					'@type': 'ImageObject',
					url: 'https://example.com/media/social/social_og.png',
				},
			},
			datePublished: '2023-01-01',
			dateModified: '2025-01-21',
		},
	];

	// Getters
	const getArticle = computed(() => article);
	const getArticleImage = computed(() => article_image);
	// With value
	const getError = computed(() => error.value);
	const getMessage = computed(() => message.value);

	// Actions
	async function loadList() {
		let res = await axios.get('/web/api/admin/articles?page=' + current_page.value + '&perpage=' + perpage.value);
		list.value = res?.data?.data ?? [];
		links.value = res?.data?.links ?? [];
		last_page.value = res?.data.meta.last_page ?? 1;
		current_page.value = res?.data.meta.current_page ?? 1;
		router.push({ query: { page: current_page.value } });
	}

	async function deleteItem(id) {
		try {
			if (confirm('Delete ?')) {
				let res = await axios.delete('/web/api/admin/articles/' + id);
				setMessage(res);
				const row = document.querySelector('.panel_list_row_' + id);
				row.remove();
				await loadList();
			}
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

	async function createItem(e) {
		try {
			let res = await axios.post('/web/api/admin/articles', new FormData(e.target));
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
			let res = await axios.post('/web/api/admin/articles/' + id, data);
			setMessage(res);
		} catch (err) {
			setError(err);
		}
		await loadItem(id);
		scrollTop();
	}

	async function loadItem(id) {
		try {
			let res = await axios.get('/web/api/admin/articles/' + id);
			article.value = res?.data.data;
		} catch (err) {
			setError(err);
		}
	}

	async function removeImage(id) {
		try {
			let res = await axios.get('/web/api/admin/articles/remove/' + id);
			setMessage(res);
			await loadItem(id);
			article_image.value = article.image;
		} catch (err) {
			setError(err);
		}
	}

	function getImagePath(e) {
		article_image.value = URL.createObjectURL(e.target.files[0]);
		const el = document.querySelector('#img');
		if (el) {
			el.src = article_image.value;
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

	async function loadCategories() {
		try {
			let res = await axios.get('/web/api/admin/categories/get/all');
			categories.value = res?.data;
		} catch (err) {
			setError(err);
		}
	}

	return {
		loadCategories,
		categories,
		message,
		error,
		article,
		article_image,
		current_page,
		last_page,
		perpage,
		list,
		links,
		getError,
		getMessage,
		getArticleImage,
		getArticle,
		meta_seo,
		schema_seo,
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
