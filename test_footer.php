<?php
$content = file_get_contents('index.php');
$newContent = preg_replace_callback(
    '/<div[^>]*class="[^"]*gform_footer[^"]*"[^>]*>.*?<button([^>]*)>(.*?)<\/button>.*?<\/div>/is',
    function($matches) {
        $buttonAttrs = preg_replace('/onclick="[^"]*"/i', '', $matches[1]);
        // Also remove excessive whitespace
        $buttonAttrs = preg_replace('/\s+/', ' ', trim($buttonAttrs));
        $buttonText = trim($matches[2]);
        return '<div class="gform-footer gform_footer top_label">
    <button ' . $buttonAttrs . '>' . $buttonText . '</button>
</div>';
    },
    $content
);
file_put_contents('index_test.php', $newContent);
echo "Written to index_test.php\n";
