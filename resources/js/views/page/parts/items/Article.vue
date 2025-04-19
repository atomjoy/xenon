<script setup>
const props = defineProps({
	obj: { type: Object, default: {} },
});
</script>
<template>
	<div class="page_article">
		<a :href="'/article/' + props.obj.slug" class="article_link" :title="props.obj.title">
			<img class="image" :src="'/img/show?path=' + props.obj.image" />
		</a>

		<div class="name">
			<a :href="'/article/' + props.obj.slug" class="article_link" :title="props.obj.title">{{ props.obj.title }}</a>
		</div>
		<div class="description">{{ props.obj.excerpt }}</div>
		<div class="categories">
			<a class="category" :href="'/category/' + cat.slug" :title="cat.name" v-for="cat in props.obj.categories">#{{ cat.name }}</a>
		</div>
	</div>
</template>

<style>
.page_article {
	position: relative;
	float: left;
	width: 32%;
	height: auto;
	margin-bottom: 30px;
	box-sizing: border-box;
	transition: all 0.6s;
	overflow: hidden;
	background: var(--bg-2);
	border: 1px solid var(--bg-1);
	border-radius: var(--border-radius);
	display: flex;
	flex-direction: column;
}

.page_article:hover {
	/* border: 1px solid var(--border); */
	box-shadow: 0px 0px 10px #0001;
}

.page_article .article_link {
	color: var(--text-1);
	font-weight: 700;
	font-size: 18px;
}

.page_article .article_link:hover {
	color: var(--accent);
}

.page_article .image {
	float: left;
	width: 100%;
	aspect-ratio: 16/9;
	object-fit: cover;
	border-radius: var(--border-radius);
	transition: all 0.6s;
}

.page_article .name {
	float: left;
	width: 100%;
	height: auto;
	font-weight: 700;
	padding: 20px;
}

.page_article .description {
	float: left;
	width: 100%;
	height: 100%;
	padding: 20px;
	padding-top: 0px;
}

.page_article .categories {
	float: left;
	width: 100%;
	padding: 20px;
}

.page_article .categories a {
	display: inline;
	padding: 5px 10px;
	margin-right: 5px;
	font-weight: 500;
	color: var(--text-1);
	background: var(--bg-3);
	border-radius: 50px;
}

.page_article .tags {
	float: left;
	width: auto;
	height: auto;
	padding: 20px;
	padding-top: 0px;
	transition: all 0.6s;
}

.page_article .tags .box {
	padding-top: 10px;
	border-top: 1px solid var(--border);
}

.page_article .tags .cat {
	float: left;
	width: auto;
	height: auto;
	padding: 5px 10px;
	margin-right: 10px;
	margin-top: 5px;
	font-size: 14px;
	background: var(--bg-2);
	border-radius: var(--border-radius);
}

.page_article .article_link {
	display: flex;
	align-items: center;
}

.page_article_icon {
	float: left;
	width: 50px;
	height: 50px;
	margin-top: 5px;
	margin-right: 10px;
	padding: 16px;
	border-radius: 50%;
	text-align: center;
	color: var(--bg-1);
	background: var(--text-1);
}

.page_article .article_link:hover .page_article_icon {
	color: var(--accent);
	background: var(--text-1);
}

@media all and (max-width: 1024px) {
	.page_article {
		width: 47%;
		margin-right: 1%;
	}
}

@media all and (max-width: 768px) {
	.page_article {
		width: 100%;
	}
}
</style>
