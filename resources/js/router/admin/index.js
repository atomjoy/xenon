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
	// References
	{
		path: '/admin/references/edit',
		name: 'admin.references.edit',
		redirect: { name: 'admin.references' },
	},
	{
		path: '/admin/references',
		name: 'admin.references',
		component: () => import('@/views/admin/references/ListView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/references/create',
		name: 'admin.references.create',
		component: () => import('@/views/admin/references/CreateView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/references/edit/:id',
		name: 'admin.references.edit.id',
		component: () => import('@/views/admin/references/EditView.vue'),
		meta: { requiresAdmin: true },
	},
	// Employees
	{
		path: '/admin/employees/edit',
		name: 'admin.employees.edit',
		redirect: { name: 'admin.employees' },
	},
	{
		path: '/admin/employees',
		name: 'admin.employees',
		component: () => import('@/views/admin/employees/ListView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/employees/create',
		name: 'admin.employees.create',
		component: () => import('@/views/admin/employees/CreateView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/employees/edit/:id',
		name: 'admin.employees.edit.id',
		component: () => import('@/views/admin/employees/EditView.vue'),
		meta: { requiresAdmin: true },
	},
	// Works
	{
		path: '/admin/works/edit',
		name: 'admin.works.edit',
		redirect: { name: 'admin.works' },
	},
	{
		path: '/admin/works',
		name: 'admin.works',
		component: () => import('@/views/admin/works/ListView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/works/create',
		name: 'admin.works.create',
		component: () => import('@/views/admin/works/CreateView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/works/edit/:id',
		name: 'admin.works.edit.id',
		component: () => import('@/views/admin/works/EditView.vue'),
		meta: { requiresAdmin: true },
	},
	// Questions
	{
		path: '/admin/questions/edit',
		name: 'admin.questions.edit',
		redirect: { name: 'admin.questions' },
	},
	{
		path: '/admin/questions',
		name: 'admin.questions',
		component: () => import('@/views/admin/questions/ListView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/questions/create',
		name: 'admin.questions.create',
		component: () => import('@/views/admin/questions/CreateView.vue'),
		meta: { requiresAdmin: true },
	},
	{
		path: '/admin/questions/edit/:id',
		name: 'admin.questions.edit.id',
		component: () => import('@/views/admin/questions/EditView.vue'),
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
