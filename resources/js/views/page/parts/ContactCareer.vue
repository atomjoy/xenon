<script setup>
import { ref } from 'vue';
import company from '@/settings/company.json';
import ErrorMessage from './ErrorMessage.vue';
import scrollTop from '@/utils/scrollTop.js';

const form = ref(null);
const error = ref(false);
const message = ref(null);

async function onSubmit(e) {
	scrollTop();
	error.value = false;
	try {
		const data = new FormData(e.target);
		let res = await axios.post('/web/api/career', data);
		message.value = res.data.message;
		e.target.reset();
	} catch (err) {
		message.value = err.response.data.message ?? '';
		error.value = true;
	}
}
</script>
<template>
	<div class="page_contact">
		<p class="page_contact_subtitle"><i class="fa-solid fa-circle-chevron-right"></i> {{ $t('Career Inquiries') }}</p>
		<h1>
			{{ $t('Feel Free to Contact Us') }}
		</h1>

		<ErrorMessage :error="error" :message="message" />

		<div class="page_contact_form">
			<form method="post" @submit.prevent="onSubmit" ref="form">
				<div class="input_group">
					<input type="text" class="input" name="firstname" :placeholder="$t('First Name')" />
					<input type="text" class="input" name="lastname" :placeholder="$t('Last Name')" />
				</div>

				<div class="input_group">
					<input type="text" class="input" name="email" :placeholder="$t('Email')" />
					<input type="text" class="input" name="mobile" :placeholder="$t('Phone Number')" />
				</div>

				<input type="text" class="input" name="subject" :placeholder="$t('Subject')" />

				<textarea name="message" class="input" :placeholder="$t('Message')"></textarea>

				<label class="contact_label">{{ $t('Cv file, allowed types:') }} pdf, doc, docx.</label>

				<input type="file" class="input" name="file" />

				<button class="page_cool_btn">
					<span>{{ $t('Send Message') }}</span>
					<i class="fa-solid fa-arrow-right"></i>
				</button>
			</form>
		</div>

		<div class="page_contact_right">
			<div class="page_contact_details">
				<h2>{{ $t('Address') }}</h2>
				<p>
					{{ company.country }} <br />
					{{ company.city }} <br />
					{{ company.street }}
				</p>

				<br />
				<h2>{{ $t('Contact') }}</h2>
				<p>{{ $t('Mobile') }}: {{ company.mobile }}</p>
				<p>{{ $t('Email') }}: {{ company.email }}</p>

				<br />
				<h2>{{ $t('Open Time') }}</h2>
				<p>{{ company.open_time }}</p>

				<br />
				<h2>{{ $t('Stay Connected') }}</h2>

				<div class="page_contact_socials">
					<div class="page_contact_social" v-for="i in company.socials">
						<a :href="i.url" :title="i.title">
							<i :class="['fa-brands', 'fa-' + i.icon]"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
@import url('@/assets/css/contact.css');
</style>
