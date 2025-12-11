<?php
require_once "includes/auth.php";
requireRole('admin'); 

// Fetch and validate input
$link = filter_input(INPUT_POST, 'domain', FILTER_SANITIZE_STRING);
if (!$link || stripos($link, 'https://') !== 0) {
    die("Error: The domain must start with 'https://'.");
}

// Remove https:// for internal use
$domain = rtrim(substr($link, 8), '/');

// Fetch the page
$html = @file_get_contents($link);
if ($html === false) {
    die("Error: Unable to fetch the page.");
}

// Load HTML into DOMDocument
libxml_use_internal_errors(true);
$dom = new DOMDocument();
$dom->loadHTML($html);
libxml_clear_errors();

// Collect links
$links = [];

// href links (anchors, CSS, etc)
foreach ($dom->getElementsByTagName('a') as $a) {
    $href = $a->getAttribute('href');
    if ($href) $links[] = $href;
}

// src links (images, scripts)
foreach ($dom->getElementsByTagName('img') as $img) {
    $src = $img->getAttribute('src');
    if ($src) $links[] = $src;
}
foreach ($dom->getElementsByTagName('script') as $script) {
    $src = $script->getAttribute('src');
    if ($src) $links[] = $src;
}
foreach ($dom->getElementsByTagName('link') as $linkTag) {
    $href = $linkTag->getAttribute('href');
    if ($href) $links[] = $href;
}

// Normalize links to full URL
$fullLinks = [];
foreach ($links as $l) {
    if (stripos($l, 'http') === 0) {
        $fullLinks[] = $l;
    } elseif (strpos($l, '/') === 0) {
        $fullLinks[] = $link . $l;
    } else {
        $fullLinks[] = $link . '/' . $l;
    }
}

// Immediate output
foreach ($fullLinks as $url) {
    $headers = @get_headers($url);
    $code = $headers ? substr($headers[0], 9, 3) : 'N/A';
    echo htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . " => $code<br>";

    // Flush output immediately
    flush();
    ob_flush();
}
?>
