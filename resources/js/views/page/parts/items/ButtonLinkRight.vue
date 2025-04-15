<script setup>
const props = defineProps({
	name: { default: 'Send Message' },
	href: { default: '/' },
});
</script>
<template>
	<a :href="props.href" class="page_cool_btn" :title="props.name">
		<span>{{ $t(props.name) }}</span>
		<i class="fa-solid fa-arrow-right"></i>
	</a>
</template>

<style scoped>
.page_cool_btn {
	float: right;
	display: inline;
	font-size: 16px;
	font-weight: 600;
	color: var(--text-1);
	background: var(--bg-3);
	border: 1px solid var(--bg-3);
	border-radius: 50px;
	cursor: pointer;
	overflow: hidden;
}

.page_cool_btn span {
	float: left;
	height: auto;
	margin-left: 5px;
	margin-right: 10px;
	color: #fff;
	background: var(--accent);
	padding: 15px 25px;
	margin-block: 5px;
	border-radius: 50px;
	font-size: 16px;
}

.page_cool_btn i {
	float: left;
	height: auto;
	color: var(--accent);
	background: var(--bg-1);
	margin: 5px;
	padding: 18px;
	font-size: 16px;
	border-radius: 50%;
}

.page_cool_btn span:hover {
	background: var(--accent-hover);
}
</style>
