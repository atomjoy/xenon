import loginRoutes from './auth';

// Panel routes (guard web)
const routes = [
	// Login user
	...loginRoutes,
	// Redirect
	{
		path: '/panel',
		name: 'panel',
		redirect: { name: 'panel.dashboard' },
	},
	{
		path: '/panel/settings',
		name: 'panel.settings',
		redirect: { name: 'panel.settings.account' },
	},
	{
		path: '/panel/comments/edit',
		name: 'panel.comments.edit',
		redirect: { name: 'panel.comments' },
	},
	// Dashboard
	{
		path: '/panel/dashboard',
		name: 'panel.dashboard',
		component: () => import('@/views/panel/DashboardView.vue'),
		meta: { requiresAuth: true },
	},
	// Comments
	{
		path: '/panel/comments',
		name: 'panel.comments',
		component: () => import('@/views/panel/comments/ListView.vue'),
		meta: { requiresAuth: true },
	},
	{
		path: '/panel/comments/edit/:id',
		name: 'panel.comments.edit.id',
		component: () => import('@/views/panel/comments/EditView.vue'),
		meta: { requiresAuth: true },
	},
	// Settings
	{
		path: '/panel/settings/account',
		name: 'panel.settings.account',
		component: () => import('@/views/panel/settings/Account/AccountView.vue'),
		meta: { requiresAuth: true },
	},
	{
		path: '/panel/settings/details',
		name: 'panel.settings.details',
		component: () => import('@/views/panel/settings/Account/DetailsView.vue'),
		meta: { requiresAuth: true },
	},
	{
		path: '/panel/settings/delete',
		name: 'panel.settings.delete',
		component: () => import('@/views/panel/settings/Account/DeleteView.vue'),
		meta: { requiresAuth: true },
	},
	{
		path: '/panel/settings/password',
		name: 'panel.settings.password',
		component: () => import('@/views/panel/settings/Account/PasswordView.vue'),
		meta: { requiresAuth: true },
	},
];

export default routes;
