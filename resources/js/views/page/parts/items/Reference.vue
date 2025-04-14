<script setup>
import IconRibon from '@/assets/icons/IconRibon.vue';
import IconStar from '@/assets/icons/IconStar.vue';

const props = defineProps({
	image: { type: String, default: '/default/woman.jpg' },
	message: { type: String, default: 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Suscipit veniam perferendis itaque quo ab perspiciatis quia. Maiores dolores ipsum accusantium incidunt harum, nulla expedita eos totam? Omnis modi incidunt neque?' },
	vote: { type: Number, default: 5.0 },
	name: { type: String, default: 'Alex Star' },
	company: { type: String, default: 'Owner, Star Company' },
});

if (props.vote > 5) {
	props.vote = Number(5).toFixed(1);
}

const percent = 20 * props.vote + '%';
</script>
<template>
	<div class="page_reference">
		<div class="page_reference_foto">
			<img :src="props.image" :alt="$t('Client image')" />
			<IconRibon />
		</div>
		<div class="page_reference_content">
			<div class="page_reference_vote">
				<div class="vote_stars">
					<div class="box"><IconStar /><IconStar /><IconStar /><IconStar /><IconStar /></div>
					<div class="box_up"><IconStar /><IconStar /><IconStar /><IconStar /><IconStar /></div>
				</div>
				<span>{{ props.vote }}</span>
			</div>
			<div class="page_reference_msg">{{ props.message }}</div>
			<div class="page_reference_name">{{ props.name }}</div>
			<div class="page_reference_company">{{ props.company }}</div>
		</div>
	</div>
</template>

<style scoped>
.page_reference {
	float: left;
	width: 100%;
	height: auto;
	padding: 50px;
	margin-bottom: 40px;
	background: var(--bg-2);
	border-radius: var(--border-radius);
	display: flex;
	align-items: center;
	gap: 50px;
}

.page_reference_foto {
	position: relative;
	float: left;
	width: 250px;
	height: 250px;
	min-width: 250px;
	border: 1px solid #000;
	border-radius: 50%;
}

.page_reference_foto img {
	float: left;
	width: 250px;
	height: 250px;
	object-fit: cover;
	border-radius: 50%;
	overflow: hidden;
}

.page_reference_foto svg {
	position: absolute;
	top: 20px;
	left: 200px;
	width: 60px;
	height: 60px;
	padding: 5px;
	background: var(--accent);
	border: 5px solid var(--bg-2);
	border-radius: 50%;
	z-index: 1;
}

.page_reference_foto svg * {
	stroke: #fff;
}

.page_reference_content {
	float: left;
}

.page_reference_vote {
	display: flex;
	align-items: center;
	font-weight: 700;
	margin-bottom: 10px;
}

.page_reference_vote span {
	float: left;
}

.page_reference_vote svg {
	width: 25px;
	height: 25px;
	padding: 5px;
}

.page_reference_vote svg * {
	stroke: #f90;
}

.page_reference_msg {
	margin-bottom: 20px;
	color: var(--text-2);
}

.page_reference_name {
	font-weight: 600;
}

.page_reference_company {
	color: var(--text-2);
}

.page_reference_vote .vote_stars {
	position: relative;
	float: left;
	width: 125px;
	height: 25px;
	overflow: hidden;
}

.page_reference_vote .vote_stars .box,
.page_reference_vote .vote_stars .box_up {
	position: absolute;
	top: 0px;
	left: 0px;
	width: 125px;
	overflow: hidden;
	white-space: nowrap;
}

.page_reference_vote .vote_stars .box {
	z-index: 1;
}

.page_reference_vote .vote_stars .box_up {
	z-index: 2;
	width: v-bind(percent);
}

.page_reference_vote .vote_stars .box svg * {
	stroke: var(--text-2);
}

.page_reference_vote .vote_stars .box_up svg * {
	fill: #f90;
}

@media all and (max-width: 768px) {
	.page_reference {
		display: block;
	}

	.page_reference_content {
		float: left;
		width: 100%;
		margin-top: 20px;
	}
}
</style>
