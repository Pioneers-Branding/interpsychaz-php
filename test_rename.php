<?php
$content = file_get_contents('index.php');
$chunks = explode('id="field_', $content);

for ($i = 1; $i < count($chunks); $i++) {
    $chunk = $chunks[$i];
    if (preg_match('/^([0-9]+)_([0-9]+)"/', $chunk, $m)) {
        $formId = $m[1];
        $fieldId = $m[2];
        
        if (preg_match('/<(label|legend)[^>]*>(.*?)<\/\1>/is', $chunk, $labelMatch)) {
            $labelText = strip_tags($labelMatch[2]);
            $labelText = trim(str_replace('*', '', $labelText));
            
            $cleanLabel = preg_replace('/[^a-zA-Z0-9]+/', '_', $labelText);
            $cleanLabel = trim($cleanLabel, '_');
            
            if (!empty($cleanLabel)) {
                $oldChunk = $chunk;
                $chunk = preg_replace('/name=([\'"])input_' . $fieldId . '(\[\])?\1/', 'name=$1' . $cleanLabel . '$2$1', $chunk);
                if ($oldChunk !== $chunk) {
                    echo "Replaced input_$fieldId with $cleanLabel\n";
                }
                $chunks[$i] = $chunk;
            }
        }
    }
}
$newContent = implode('id="field_', $chunks);
file_put_contents('index_test.php', $newContent);
echo "Written to index_test.php\n";
