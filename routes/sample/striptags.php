<?php

use Illuminate\Support\Facades\Route;

Route::get('test/striptags', function () {

	$code = '<h1>Article title goes here</h1>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate iste blanditiis ratione possimus in eum. Dolore assumenda eos, qui quia illo cumque ab recusandae dolor itaque nemo, tenetur minima doloribus?</p>
<style>pre {background: #fafafa; color: #010101;font-family:consolas;font-size:16px}</style>
<pre>
<code wow="error">
<span style="color: red;">Hello</span>
<?php
    echo "hello from js";
    function hello() {
        echo "Boo";
    }
?>
</code>
</pre>
<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cum consequuntur harum possimus quidem doloribus numquam ipsum ratione architecto! Enim alias nemo quis repellendus cumque hic officia delectus sint saepe possimus.</p>
<div style="color: green;" onclick="alert(\'Click alert\')">Click Me!</div>
<div style="color: green;" onclick="alert(\'Click alert\')">Click Me!</div>
<p>Lorem <a href="/">ipsum dolor</a> <code>.active {color: #f96;}</code>, adipisicing elit.
<img src="https://assets2.razerzone.com/images/phoenix/razer-ths-logo.svg" width="50px"> Laborum impedit obcaecati labore facilis beatae odio consequuntur cumque laudantium, maxime cupiditate architecto, eligendi autem. Error ipsa, eum molestiae distinctio incidunt eos?</p>
<h2>Hello from article 	&#128515;	&#128515;	&#128515;</h2>
<script>alert("Wooow");</script>
<p style="background: #ffff00; color: #010101; padding: 5px;font-family:consolas;font-size:16px;">Lorem ipsum dolor <strong>sit amet consectetur</strong>, adipisicing elit. Laborum impedit obcaecati labore facilis beatae odio consequuntur cumque laudantium, maxime cupiditate architecto, eligendi autem. Error ipsa, eum molestiae distinctio incidunt eos?</p>
<pre>
<code>
<span style="color: green;">Bye!</span>
<?php
    echo "hello from js";

    function hello() {
        echo "Woo";
    }
?>
</code>
</pre>

<script src="main.js">alert("boom")</script>
<h3>Easy Learning with HTML "Try it Yourself"</h3>
echo "Bruh from js";
<?php
echo "Bruh from js";

function hello() {
	echo "WooW";
    }
?>

<h4>HTML References</h4>
<p>The <abbr title="World Health Organization">WHO</abbr> was founded in 1948.</p>
<p>Lorem ipsum dolor sit amet <small>This is some smaller text.</small> consectetur adipisicing elit. <q>Build a future where people live in harmony with nature.</q> Voluptates amet doloribus mollitia enim ab? Vero aspernatur at provident officia voluptates soluta assumenda nam dolorum aperiam, dolor debitis voluptatum sequi in.</p>
<p>This text contains <sub>subscript</sub> text <sub>subscript</sub>.</p>
<h4>The ol element</h4>
<ol>
  <li>Coffee</li>
  <li>Tea</li>
  <li>Milk</li>
</ol>

<ol start="50">
  <li>Coffee</li>
  <li>Tea</li>
  <li>Milk</li>
</ol>

<script type="text/javascript">alert(document.cookie)</script>

<iframe width="560" height="315" src="https://www.youtube.com/embed/zIjPoj8a4Ko?si=yysAQlys2osASdy_" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

<!--  Html 5 elements -->
<video width="400" controls>
  <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
  <source src="https://www.w3schools.com/html/mov_bbb.ogg" type="video/ogg">
  Your browser does not support HTML video.
</video>

<audio controls>
  <source src="https://www.w3schools.com/html/horse.ogg" type="audio/ogg">
  <source src="https://www.w3schools.com/html/horse.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>

<picture>
  <source media="(min-width:650px)" srcset="https://www.w3schools.com/tags/img_pink_flowers.jpg">
  <source media="(min-width:465px)" srcset="https://www.w3schools.com/tags/img_white_flower.jpg">
  <img src="https://www.w3schools.com/tags/img_orange_flowers.jpg" alt="Flowers" style="width:auto;">
</picture>

<table>
  <caption>
    Front-end web developer course 2021
  </caption>
  <thead>
    <tr>
      <th scope="col">Person</th>
      <th scope="col">Most interest in</th>
      <th scope="col">Age</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Chris</th>
      <td>HTML tables</td>
      <td>22</td>
    </tr>
    <tr>
      <th scope="row">Dennis</th>
      <td>Web accessibility</td>
      <td>45</td>
    </tr>
    <tr>
      <th scope="row">Sarah</th>
      <td>JavaScript frameworks</td>
      <td>29</td>
    </tr>
    <tr>
      <th scope="row">Karen</th>
      <td>Web performance</td>
      <td>36</td>
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <th scope="row" colspan="2">Average age</th>
      <td>33</td>
    </tr>
  </tfoot>
</table>
<style>
table {
  width: 100%;
  border-collapse: collapse;
  border: 1px solid #000;
  font-family: sans-serif;
  font-size: 0.8rem;
  letter-spacing: 1px;
}

caption {
  caption-side: bottom;
  padding: 10px;
  font-weight: bold;
}

thead,
tfoot {
  background-color: #f3f3f3;
}

th,
td {
  border: 1px solid #999;
  padding: 8px 10px;
}

td:last-of-type {
  text-align: center;
}

tbody > tr:nth-of-type(even) {
  background-color: #fafafa;
}

tfoot th {
  text-align: right;
}

tfoot td {
  font-weight: bold;
}
</style>
';

	// Validate html
	$dom = new DOMDocument;
	// Validate but without HTML5 tags
	// $dom->loadHTML($code); // Errors with html5 tags
	// HTML5 is not supported by libxml2, therefore any HTML5 tag will fail (picture, article), but in any way when you disable error reporting or suppress it, you will not receive errors for malformatted content.
	$dom->loadHTML($code, LIBXML_NOERROR); // Not recomended
	// Code htmlentities
	$html = preg_replace_callback('#<code(.*?)>(.*?)</code>#is', function ($matches) {
		return '<code>' . htmlentities($matches[2], ENT_QUOTES, 'UTF-8') . '</code>';
	}, $code);
	$html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);
	$html = preg_replace('# on(.*?)=(.*?)>#is', ">", $html);
	$html = strip_tags($html, [
		'style',
		'code',
		'pre',
		'iframe',
		'picture',
		'video',
		'audio',
		'source',
		'img',
		'h1',
		'h2',
		'h3',
		'h4',
		'h5',
		'h6',
		'p',
		'a',
		'span',
		'strong',
		'small',
		'li',
		'ul',
		'ol',
		'div',
		'label',
		'abbr',
		'sub',
		'sup',
		'q',
		'table',
		'caption',
		'tr',
		'th',
		'td',
		'thead',
		'tbody',
		'tfoot',
		'col',
		'colgroup'
	]);

	return $html;

	// List of tags to be replaced and their replacement
	$replace_tags = [
		'i' => 'em',
		'b' => 'strong'
	];

	// List of tags to be stripped. Text and children tags will be preserved.
	$remove_tags = [
		'meta',
		'link',
		'script',
		'acronym',
		'applet',
		'b',
		'body',
		'basefont',
		'big',
		'bgsound',
		'blink',
		'center',
		'del',
		'dir',
		'font',
		'frame',
		'frameset',
		'iframe',
		'hgroup',
		'head',
		'html',
		'i',
		'ins',
		'kbd',
		'marquee',
		'nobr',
		'noframes',
		'plaintext',
		'samp',
		'small',
		'span',
		'strike',
		'tt',
		'u',
		'var'
	];

	// List of attributes to remove. Applied to all tags.
	$remove_attribs = [
		'class',
		'style',
		'lang',
		'width',
		'height',
		'align',
		'hspace',
		'vspace',
		'dir'
	];

	function replaceTags($html, $tags)
	{
		// Clean the HTML
		$html = '<div>' . $html . '</div>'; // Workaround to get the HTML back from DOMDocument without the <html><head> and <body> tags
		$dom = new DOMDocument;
		$dom->loadHTML($html);
		$html = substr($dom->saveHTML($dom->getElementsByTagName('div')->item(0)), 5, -6);
		// Use simple string replace to replace tags
		foreach ($tags as $search => $replace) {
			$html = str_replace('<' . $search . '>', '<' . $replace . '>', $html);
			$html = str_replace('<' . $search . ' ', '<' . $replace . ' ', $html);
			$html = str_replace('</' . $search . '>', '</' . $replace . '>', $html);
		}
		return $html;
	}

	function stripTags($html, $tags)
	{
		// Remove all attributes from tags to be removed
		$html = '<div>' . $html . '</div>';
		$dom = new DOMDocument;
		$dom->loadHTML($html);
		foreach ($tags as $tag) {
			$nodes = $dom->getElementsByTagName($tag);
			foreach ($nodes as $node) {
				// Remove attributes
				while ($node->attributes->length) {
					$node->removeAttribute($node->attributes->item(0)->name ?? '');
				}
			}
		}
		$html = substr($dom->saveHTML($dom->getElementsByTagName('div')->item(0)), 5, -6);

		// Strip tags using string replace
		foreach ($tags as $tag) {
			$html = str_replace('<' . $tag . '>', '', $html);
			$html = str_replace('</' . $tag . '>', '', $html);
		}

		return $html;
	}

	function stripAttributes($html, $attribs)
	{
		// Find all nodes that contain the attribute and remove it
		$html = '<div>' . $html . '</div>';
		$dom = new DOMDocument;
		$dom->loadHTML($html);
		$xPath = new DOMXPath($dom);
		foreach ($attribs as $attrib) {
			$nodes = $xPath->query('//*[@' . $attrib . ']');
			foreach ($nodes as $node) $node->removeAttribute($attrib);
		}
		return substr($dom->saveHTML($dom->getElementsByTagName('div')->item(0)), 5, -6);
	}

	// Your HTML code
	$html = '<p class="large-font" style="color: red"><b>Hello</b> <span style="margin-left: 1em">world!</span><br>How are you doing?</p>';
	$html .= '<h1>Hello</h1><p>clear tags in html</p><span onclick="alert(\'WOW\')">alerto</span><script>alert("error")</script> <p>ajksdhaskjdhkasj</p>';
	$html .= '<script src="main.js">alert("boom")</script> <span onclick="alert(\'WOW\')">alerto</span> <script type="text/javascript">alert("boom")</script>';
	$html .= '<span onclick="alert(\'WOW\')">alerto</span><span onclick="alert(\'WOW\')">alerto</span>';

	$html = replaceTags($html, $replace_tags);
	$html = stripTags($html, $remove_tags);
	$html = stripAttributes($html, $remove_attribs);

	// Html entities between <code></code> tags
	$html = preg_replace_callback('#<code>(.*?)</code>#is', function ($matches) {
		return '<pre><code>' . htmlentities($matches[1], ENT_QUOTES) . '</code></pre>';
	}, $html);

	// Events
	$html = preg_replace('# on(.*?)=(.*?)>#is', ">", $html);

	// Scripts
	$html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);

	// Allow only tags
	// $html = strip_tags($html, ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'a', 'span', 'code', 'pre', 'strong', 'li', 'ul', 'div']);

	return $html;
});
