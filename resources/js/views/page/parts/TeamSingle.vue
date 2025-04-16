<script setup>
const props = defineProps({
	obj: { type: Object, default: {} },
});
</script>

<template>
	<div class="page_box" id="team">
		<div class="team_member">
			<img class="page_team_image" :src="'/img/show?path=' + props.obj.image" :alt="$t('Team memeber image')" />

			<div class="page_team_about">
				<h1>{{ $t(props.obj.name ?? '') }}</h1>
				<div class="position">{{ $t(props.obj.position ?? '') }}</div>
				<p>{{ $t(props.obj.excerpt ?? '') }}</p>

				<div class="page_team_title">{{ $t('Feel free to contact') }}</div>
				<div class="page_tem_contact"><i class="fa-solid fa-envelope"></i> {{ $t(props.obj.email ?? '') }}</div>
				<div class="page_tem_contact"><i class="fa-solid fa-phone"></i> {{ $t(props.obj.mobile ?? '') }}</div>
				<div class="page_tem_contact"><i class="fa-solid fa-suitcase"></i> {{ $t(props.obj.experience ?? '') }}</div>

				<div class="socials">
					<div class="page_team_title">{{ $t('Social links') }}</div>
					<a :href="props.obj.facebook" class="link" v-if="props.obj.facebook" target="_blank" :title="$t('Social link')">
						<i class="fa-brands fa-facebook"></i>
					</a>
					<a :href="props.obj.twitter" class="link" v-if="props.obj.twitter" target="_blank" :title="$t('Social link')">
						<i class="fa-brands fa-twitter"></i>
					</a>
					<a :href="props.obj.instagram" class="link" v-if="props.obj.instagram" target="_blank" :title="$t('Social link')">
						<i class="fa-brands fa-instagram"></i>
					</a>
					<a :href="props.obj.youtube" class="link" v-if="props.obj.youtube" target="_blank" :title="$t('Social link')">
						<i class="fa-brands fa-youtube"></i>
					</a>
					<a :href="props.obj.linkedin" class="link" v-if="props.obj.linkedin" target="_blank" :title="$t('Social link')">
						<i class="fa-brands fa-linkedin"></i>
					</a>
					<a :href="props.obj.pinterest" class="link" v-if="props.obj.pinterest" target="_blank" :title="$t('Social link')">
						<i class="fa-brands fa-pinterest"></i>
					</a>
					<a :href="props.obj.dribbble" class="link" v-if="props.obj.dribbble" target="_blank" :title="$t('Social link')">
						<i class="fa-brands fa-dribbble"></i>
					</a>
					<a :href="props.obj.behance" class="link" v-if="props.obj.behance" target="_blank" :title="$t('Social link')">
						<i class="fa-brands fa-behance"></i>
					</a>
				</div>
			</div>
		</div>

		<div class="page_team_details" v-html="props.obj.content_cleaned"></div>
	</div>
</template>

<style>
@import url('@/assets/css/page.css');

.team_member {
	float: left;
	width: 100%;
	display: flex;
	align-items: stretch;
}

.page_team_image {
	float: left;
	width: 40%;
	aspect-ratio: 1/1;
	margin-right: 30px;
	margin-bottom: 20px;
	object-fit: cover;
	border-radius: var(--border-radius);
}

.page_team_about {
	float: left;
	width: 60%;
	height: auto;
}

.page_team_details {
	float: left;
	width: 100%;
	height: auto;
}

.page_tem_contact {
	float: left;
	width: 100%;
	margin-bottom: 20px;
}

.page_tem_contact i {
	width: 48px;
	height: 48px;
	padding: 16px;
	margin-right: 20px;
	border-radius: 50%;
	color: #fff;
	background: var(--accent);
}

.page_team_about .socials .link {
	float: left;
	font-size: 20px;
	margin-right: 20px;
}

.page_team_title {
	float: left;
	width: 100%;
	margin-block: 10px;
	font-weight: 600;
}
</style>
