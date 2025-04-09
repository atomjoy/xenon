const routes = [
	{
		path: '/article/:slug',
		name: 'blog.article',
		component: () => import('@/views/page/blog/ArticleView.vue'),
	},
	{
		path: '/blog',
		name: 'blog.articles',
		component: () => import('@/views/page/blog/ArticlesView.vue'),
	},
	{
		path: '/category/:slug',
		name: 'blog.category',
		component: () => import('@/views/page/blog/CategoryView.vue'),
	},
	{
		path: '/categories',
		name: 'blog.categories',
		component: () => import('@/views/page/blog/CategoriesView.vue'),
	},
	{
		path: '/tag/:slug',
		name: 'blog.tag',
		component: () => import('@/views/page/blog/TagView.vue'),
	},
];

export default routes;
