const routes = [
	// Subscribe
	{
		path: '/subscribe',
		name: 'subscribe',
		component: () => import('@/views/page/subscribe/SubscribeView.vue'),
	},
	{
		path: '/unsubscribe/:email',
		name: 'unsubscribe.email',
		component: () => import('@/views/page/subscribe/SubscribeRemoveView.vue'),
	},
	{
		path: '/unsubscribe',
		name: 'unsubscribe',
		component: () => import('@/views/page/subscribe/UnsubscribeView.vue'),
	},
];

export default routes;
