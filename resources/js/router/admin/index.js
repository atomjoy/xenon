import loginRoutes from './auth';

// Admin routes (guard admin)
const routes = [
	// Login admin
	...loginRoutes,
	// Redirect
	{
		path: '/admin/panel',
		name: 'admin.panel',
		redirect: { name: 'admin.dashboard' },
	},
	{
		path: '/admin/settings',
		name: 'admin.settings',
		redirect: { name: 'admin.settings.account' },
	},
	// Dashboard
	{
		path: '/admin/dashboard',
		name: 'admin.dashboard',
		component: () => import('@/views/admin/DashboardView.vue'),
		meta: { requiresAdmin: true },
	},
	// Settings
	{
		path: '/admin/settings/account',
		name: 'admin.settings.account',
		component: () => import('@/views/admin/settings/Account/AccountView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/settings/details',
		name: 'admin.settings.details',
		component: () => import('@/views/admin/settings/Account/DetailsView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/settings/password',
		name: 'admin.settings.password',
		component: () => import('@/views/admin/settings/Account/PasswordView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/settings/delete',
		name: 'admin.settings.delete',
		component: () => import('@/views/admin/settings/Account/DeleteView.vue'),
		meta: { requiresAdmin: true },
	},
	// Projects
	{
		path: '/admin/projects/edit',
		name: 'admin.projects.edit',
		redirect: { name: 'admin.projects' },
	},
	{
		path: '/admin/projects',
		name: 'admin.projects',
		component: () => import('@/views/admin/projects/ListView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/projects/create',
		name: 'admin.projects.create',
		component: () => import('@/views/admin/projects/CreateView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/projects/edit/:id',
		name: 'admin.projects.edit.id',
		component: () => import('@/views/admin/projects/EditView.vue'),
		meta: { requiresAdmin: true },
	},
	// Services
	{
		path: '/admin/services/edit',
		name: 'admin.services.edit',
		redirect: { name: 'admin.services' },
	},
	{
		path: '/admin/services',
		name: 'admin.services',
		component: () => import('@/views/admin/services/ListView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/services/create',
		name: 'admin.services.create',
		component: () => import('@/views/admin/services/CreateView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/services/edit/:id',
		name: 'admin.services.edit.id',
		component: () => import('@/views/admin/services/EditView.vue'),
		meta: { requiresAdmin: true },
	},
	// Contacts
	{
		path: '/admin/contacts/edit',
		name: 'admin.contacts.edit',
		redirect: { name: 'admin.contacts' },
	},
	{
		path: '/admin/contacts',
		name: 'admin.contacts',
		component: () => import('@/views/admin/contacts/ListView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/contacts/edit/:id',
		name: 'admin.contacts.edit.id',
		component: () => import('@/views/admin/contacts/EditView.vue'),
		meta: { requiresAdmin: true },
	},
	// Subscribers
	{
		path: '/admin/subscribers/edit',
		name: 'admin.subscribers.edit',
		redirect: { name: 'admin.subscribers' },
	},
	{
		path: '/admin/subscribers',
		name: 'admin.subscribers',
		component: () => import('@/views/admin/subscribers/ListView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/subscribers/create',
		name: 'admin.subscribers.create',
		component: () => import('@/views/admin/subscribers/CreateView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/subscribers/edit/:id',
		name: 'admin.subscribers.edit.id',
		component: () => import('@/views/admin/subscribers/EditView.vue'),
		meta: { requiresAdmin: true },
	},
	// ArticleMedia
	{
		path: '/admin/articlemedia/edit',
		name: 'admin.articlemedia.edit',
		redirect: { name: 'admin.articlemedia' },
	},
	{
		path: '/admin/articlemedia',
		name: 'admin.articlemedia',
		component: () => import('@/views/admin/articlemedia/ListView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/articlemedia/create',
		name: 'admin.articlemedia.create',
		component: () => import('@/views/admin/articlemedia/CreateView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/articlemedia/edit/:id',
		name: 'admin.articlemedia.edit.id',
		component: () => import('@/views/admin/articlemedia/EditView.vue'),
		meta: { requiresAdmin: true },
	},
	// Category
	{
		path: '/admin/category/edit',
		name: 'admin.category.edit',
		redirect: { name: 'admin.category' },
	},
	{
		path: '/admin/category',
		name: 'admin.category',
		component: () => import('@/views/admin/category/ListView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/category/create',
		name: 'admin.category.create',
		component: () => import('@/views/admin/category/CreateView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/category/edit/:id',
		name: 'admin.category.edit.id',
		component: () => import('@/views/admin/category/EditView.vue'),
		meta: { requiresAdmin: true },
	},
	// articles
	{
		path: '/admin/articles/edit',
		name: 'admin.articles.edit',
		redirect: { name: 'admin.articles' },
	},
	{
		path: '/admin/articles',
		name: 'admin.articles',
		component: () => import('@/views/admin/articles/ListView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/articles/create',
		name: 'admin.articles.create',
		component: () => import('@/views/admin/articles/CreateView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/articles/edit/:id',
		name: 'admin.articles.edit.id',
		component: () => import('@/views/admin/articles/EditView.vue'),
		meta: { requiresAdmin: true },
	},
	// Comments
	{
		path: '/admin/comments/edit',
		name: 'admin.comments.edit',
		redirect: { name: 'admin.comments' },
	},
	{
		path: '/admin/comments',
		name: 'admin.comments',
		component: () => import('@/views/admin/comment/ListView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/comments/edit/:id',
		name: 'admin.comments.edit.id',
		component: () => import('@/views/admin/comment/EditView.vue'),
		meta: { requiresAdmin: true },
	},
	// After all
	{
		path: '/admin/article/:slug',
		name: 'admin.article.blog',
		component: () => import('@/views/admin/article/ArticleView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/category/:slug',
		name: 'admin.category.blog',
		component: () => import('@/views/admin/category/CategoryView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/tag/:slug',
		name: 'admin.tag.blog',
		component: () => import('@/views/admin/tag/TagView.vue'),
		meta: { requiresAdmin: true },
	},
];

export default routes;
