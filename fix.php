<?php
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('.'));
$count = 0;
foreach($files as $f) {
    if($f->getExtension() == 'php' || $f->getExtension() == 'html') {
        $content = file_get_contents($f->getPathname());
        $newContent = str_replace('', '', $content);
        $newContent = preg_replace('/ size="[0-9]+"/i', '', $newContent);
        
        if ($newContent !== $content) {
            file_put_contents($f->getPathname(), $newContent);
            $count++;
        }
    }
}
echo "Removed multiple attribute from $count files.\n";
