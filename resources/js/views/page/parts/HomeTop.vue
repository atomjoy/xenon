<script setup>
import IconStar from '@/assets/icons/IconStar.vue';
</script>

<template>
	<div class="page_box" id="teams" style="min-height: auto">
		<p class="page_box_subtitle"><i class="fa-solid fa-circle-chevron-right"></i> {{ $t('Award Wining Agency') }}</p>
		<h1>
			{{ $t('Where Innovations Meets') }}<br />
			{{ $t('Digital Excellence') }}
		</h1>

		<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam sit tempora unde totam eligendi fugit officiis dolores minima impedit minus suscipit distinctio ut harum asperiores ea porro, officia eum animi?</p>

		<div class="page_home_top">
			<div class="details">
				<div class="image">
					<img src="/default/home-top.webp" alt="Home page image" />
					<div class="rating_wrapp">
						<div class="rating">
							<IconStar />
							<div>
								<span>4.5 Stars</span>
								<span>Reviews</span>
							</div>
						</div>
					</div>
				</div>
				<div class="tips">
					<div class="title">100+ Projects</div>
					<span class="desc">Completed Projects</span>
					<div class="title">10+</div>
					<span class="desc">Years of Experience</span>
					<div class="title">200+</div>
					<span class="desc">Happy Customers</span>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
@import url('@/assets/css/page.css');

.page_home_top {
	float: left;
	width: 100%;
	padding-block: 20px;
}

.page_home_top .details {
	display: flex;
	align-items: stretch;
	justify-content: space-between;
	gap: 20px;
}

.page_home_top .details .image {
	position: relative;
	float: left;
	width: 100%;
	height: 400px;
	border-radius: var(--border-radius);
}

.page_home_top .details .image img {
	float: left;
	width: 100%;
	height: 100%;
	object-fit: cover;
	border: 5px solid var(--text-1);
	border-radius: var(--border-radius);
}

.page_home_top .details .image .rating_wrapp {
	position: absolute;
	left: 5%;
	bottom: 0;
	padding: 5px;
	transform: translateY(calc(50% - 5px));
	background: var(--text-1);
	border-radius: var(--border-radius);
}

.page_home_top .details .image .rating {
	float: left;
	display: flex;
	align-items: center;
	padding: 10px;
	font-size: 14px;
	color: var(--text-1);
	background: var(--bg-1);
	border-radius: var(--border-radius);
}

.page_home_top .details .image .rating svg {
	width: 40px;
	height: 40px;
	margin-right: 20px;
}

.page_home_top .details .image .rating svg * {
	stroke: var(--text-1);
}

.page_home_top .details .image .rating span {
	float: left;
	width: 100%;
}

.page_home_top .details .image .rating span:first-child {
	font-weight: 700;
	font-size: 16px;
}

.page_home_top .details .tips {
	float: left;
	width: 400px;
	padding: 30px;
	color: var(--bg-1);
	background: var(--text-1);
	border-radius: var(--border-radius);
}

.page_home_top .details .tips .title {
	float: left;
	width: 100%;
	font-weight: 700;
	font-size: 21px;
}

.page_home_top .details .tips .desc {
	float: left;
	width: 100%;
	margin-bottom: 80px;
	font-weight: 500;
	font-size: 18px;
}

.page_home_top .details .tips .desc:last-child {
	margin-bottom: 0px;
}

@media all and (max-width: 768px) {
	.page_home_top .details {
		display: block;
	}
	.page_home_top .details .tips {
		float: left;
		width: 100%;
		margin-top: 60px;
	}
}
</style>
