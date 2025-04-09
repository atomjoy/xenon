<?php

use App\Models\Article;
use Illuminate\Support\Facades\Route;

Route::get('test/article/{id}', function ($id) {

	echo '
<script type="module">
import { codeToHtml } from "https://esm.sh/shiki@3.2.1"
const all = document.querySelectorAll("code")
all.forEach(async (f) => {
	const theme = [
		"github-light", "slack-ochin", "vitesse-light", "everforest-light",
		"everforest-dark",  "vitesse-dark", "one-dark-pro", "synthwave-84",
		"gruvbox-dark-medium", "gruvbox-dark-soft", "gruvbox-light-soft",
		"rose-pine", "rose-pine-moon", "rose-pine-dawn", "plastic", "laserwave",
		"kanagawa-dragon", "kanagawa-wave", "material-theme", "material-theme-darker",
	]
	let code = f.innerText
	f.innerHTML = await codeToHtml(code, {lang: "php",theme: theme[0]})
})
  </script>
<style>
pre {float: left; width: 100%; background: #fafafa; font-family: "JetBrains Mono"; font-size: 16px; padding: 5px; border-radius: 3px;}
.shiki {margin: 0px; display: inline; box-sizing: border-box; font-family: "JetBrains Mono"; font-size: 16px; padding-inline: 25px; overflow-x: auto; scrollbar-width: thin; border: 1px solid #f1f1f1}
.code {font-family: "JetBrains Mono"; background: #fafafa; color: #6F42C1; padding: 3px; border-radius: 3px}
</style>
';

	return '
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<div class="article_html_wrapper" style="font-family: Poppins, Merriweather; margin:20px auto; width: 90%; max-width:710px; padding-inline: 20px;">' . Article::find((int) $id)->content_cleaned . '</div>';
});
