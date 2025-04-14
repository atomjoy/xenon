<script setup>
const props = defineProps({
	obj: { type: Object, default: {} },
});
</script>
<template>
	<div class="page_employee">
		<img class="image" :src="'/img/show?path=' + props.obj.image" />
		<div class="name">
			<a :href="'/team/' + props.obj.slug" class="employee_link">{{ props.obj.name }}</a>
		</div>
		<div class="position">{{ props.obj.position }}</div>
		<div class="socials">
			<a :href="props.obj.facebook" class="link" v-if="props.obj.facebook" target="_blank">
				<i class="fa-brands fa-facebook"></i>
			</a>
			<a :href="props.obj.twitter" class="link" v-if="props.obj.twitter" target="_blank">
				<i class="fa-brands fa-twitter"></i>
			</a>
			<a :href="props.obj.instagram" class="link" v-if="props.obj.instagram" target="_blank">
				<i class="fa-brands fa-instagram"></i>
			</a>
			<a :href="props.obj.youtube" class="link" v-if="props.obj.youtube" target="_blank">
				<i class="fa-brands fa-youtube"></i>
			</a>
			<a :href="props.obj.linkedin" class="link" v-if="props.obj.linkedin" target="_blank">
				<i class="fa-brands fa-linkedin"></i>
			</a>
			<a :href="props.obj.pinterest" class="link" v-if="props.obj.pinterest" target="_blank">
				<i class="fa-brands fa-pinterest"></i>
			</a>
			<a :href="props.obj.dribbble" class="link" v-if="props.obj.dribbble" target="_blank">
				<i class="fa-brands fa-dribbble"></i>
			</a>
			<a :href="props.obj.behance" class="link" v-if="props.obj.behance" target="_blank">
				<i class="fa-brands fa-behance"></i>
			</a>
		</div>
	</div>
</template>

<style>
.page_employee {
	position: relative;
	float: left;
	width: 30%;
	height: auto;
	margin-bottom: 30px;
	box-sizing: border-box;
	transition: all 0.6s;
}

.page_employee .employee_link {
	color: var(--text-1);
	font-weight: 700;
	font-size: 18px;
}

.page_employee .employee_link:hover {
	color: var(--accent);
}

.page_employee .image {
	float: left;
	width: 100%;
	height: auto;
	border-radius: var(--border-radius);
	transition: all 0.6s;
}

.page_employee .image:hover {
	filter: grayscale() blur(3px);
}

.page_employee .name {
	float: left;
	width: 100%;
	height: auto;
	font-weight: 700;
	padding-top: 20px;
	text-align: center;
}

.page_employee .position {
	float: left;
	width: 100%;
	height: auto;
	padding-top: 10px;
	text-align: center;
}

.page_employee .socials {
	position: absolute;
	top: 0px;
	left: 0px;
	width: 100%;
	height: auto;
	padding: 10px;
	opacity: 0;
	transition: all 0.6s;
	text-align: center;
}

.page_employee .socials .link {
	display: inline-flex;
	width: 45px;
	height: 45px;
	max-width: 45px;
	max-height: 45px;
}

.page_employee .socials .link i {
	float: left;
	width: 35px;
	height: 35px;
	padding: 10px;
	margin: 5px;
	color: #fff;
	background: var(--accent);
	border-radius: 50%;
	text-align: center;
}

.page_employee:hover .socials {
	opacity: 1;
}

@media all and (max-width: 1024px) {
	.page_employee {
		width: 47%;
		margin-right: 1%;
	}
}

@media all and (max-width: 640px) {
	.page_employee {
		width: 100%;
	}
}
</style>
