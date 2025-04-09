import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '@/stores/auth.js';
import adminRoutes from './admin';
import userRoutes from './user';
import pageRoutes from './page';
import docsRoutes from './docs';
import subscribeRoutes from './subscribe';

const router = createRouter({
	linkActiveClass: 'router-link-active',
	linkExactActiveClass: 'router-link-exact-active',
	history: createWebHistory('/'),
	routes: [
		...userRoutes,
		...adminRoutes,
		...pageRoutes,
		...docsRoutes,
		...subscribeRoutes,
		{
			path: '/:catchAll(.*)',
			name: 'error.page',
			component: () => import('@/views/errors/404.vue'),
		},
	],
	scrollBehavior(to, from, savedPosition) {
		return { top: 1, behavior: 'smooth' };
	},
});

router.beforeEach(async (to, from, next) => {
	// ✅ This will work make sure the correct store is used for the current running app
	const auth = useAuthStore();
	// Admin or User
	if (to.meta.requiresAdmin) {
		// ✅ Login with remember me token and/or check is user authenticated
		await auth.isAuthenticatedAdmin();
		// ✅ Redirect to admin panel if logged
		if (to.name == 'admin.login' && auth.isLoggedIn.value) {
			// Panel route name here: panel or client.panel
			next({ name: 'admin.panel' });
		} else if (to.meta.requiresAdmin && !auth.isLoggedIn.value) {
			// ✅ Redirect to login if not logged
			next({
				name: 'admin.login',
				query: { redirected_from: to.fullPath },
			});
		} else {
			// ✅ Continue
			next();
		}
	} else {
		// ✅ Login with remember me token and/or check is user authenticated
		await auth.isAuthenticated();
		// ✅ Redirect to panel if logged
		if (to.name == 'login' && auth.isLoggedIn.value) {
			// Panel route name here: panel or client.panel
			next({ name: 'panel' });
		} else if (to.meta.requiresAuth && !auth.isLoggedIn.value) {
			// ✅ Redirect to login if not logged
			next({
				name: 'login',
				query: { redirected_from: to.fullPath },
			});
		} else {
			// ✅ Continue
			next();
		}
	}
});

export default router;
