<script setup>
import { codeToHtml } from 'https://esm.sh/shiki@3.2.1';
import { onMounted } from 'vue';

onMounted(() => {
	const all = document.querySelectorAll('code');

	all.forEach(async (f) => {
		const theme = ['github-light', 'slack-ochin', 'vitesse-light', 'everforest-light', 'everforest-dark', 'vitesse-dark', 'one-dark-pro', 'synthwave-84', 'gruvbox-dark-medium', 'gruvbox-dark-soft', 'gruvbox-light-soft', 'rose-pine', 'rose-pine-moon', 'rose-pine-dawn', 'plastic', 'laserwave', 'kanagawa-dragon', 'kanagawa-wave', 'material-theme', 'material-theme-darker'];
		let code = f.innerText;
		f.innerHTML = await codeToHtml(code, { lang: 'php', theme: theme[0] });
	});
});

let code = `
<h1>Hello from Vue</h1>
<pre><code>
<?php
echo "Hello";
?>
</code></pre>
<p>Ale krótki tekst.</p>`;
</script>

<template>
	<div v-html="code" />
</template>
