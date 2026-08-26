<?php
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('.'));
$count = 0;
foreach($files as $f) {
    if($f->getExtension() == 'php') {
        $content = file_get_contents($f->getPathname());
        
        // Skip files that don't have gravity forms
        if (strpos($content, 'id="field_') === false) continue;
        
        $chunks = explode('id="field_', $content);
        $modified = false;
        
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
                            $modified = true;
                        }
                        $chunks[$i] = $chunk;
                    }
                }
            }
        }
        
        if ($modified) {
            $newContent = implode('id="field_', $chunks);
            file_put_contents($f->getPathname(), $newContent);
            $count++;
        }
    }
}
echo "Successfully updated form input names in $count PHP files.\n";
