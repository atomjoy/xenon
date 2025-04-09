<script setup>
import { ref } from 'vue';

function htmlEntities(str) {
	return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

let code = ref(`
<span style="color: red;">Hello</span>
<?php
    echo "hello from js";

    function hello() {
        echo "Boo";
    }
?>
`);

let code1 = ref(`
<span style="color: red;">Hello</span>
<?php
    echo "hello from js";

    function hello() {
        echo "Woo";
    }
?>
`);

// let htmlCode = '<h1 style="color: red">Hello</h1><pre><code>' + htmlEntities(code.value) + '</code></pre><p>Works .....</p>';

let htmlDb = '<h1 style="color: red">Hello</h1><pre><code>' + code.value + '</code></pre><p>Works .....</p><pre><code>' + code.value + '</code></pre><p>Works .....</p>';

let htmlCode = htmlDb.replaceAll(/<code>([\s\S]*?)<\/code>/g, function (match, $1, offset, string, groups) {
	return match.replace($1, htmlEntities($1));
});
</script>

<template>
	<div v-html="htmlCode"></div>
</template>
