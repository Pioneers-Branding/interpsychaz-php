<?php
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('.'));
$count = 0;
foreach($files as $f) {
    if($f->isFile() && ($f->getExtension() == 'php' || $f->getExtension() == 'html')) {
        $path = $f->getPathname();
        $name = strtolower($f->getFilename());
        
        // Exclude newsletter and refer-a-patient
        if (strpos($name, 'newsletter') !== false || strpos($name, 'refer') !== false) {
            continue;
        }
        
        // Exclude script
        if (strpos($name, 'update_action.php') !== false) {
            continue;
        }

        $content = file_get_contents($path);
        
        // Regex to match <form ... action="..."> or <form action="..." ...>
        $newContent = preg_replace('/(<form\b[^>]*?)\baction=[\'"][^\'"]*[\'"]([^>]*>)/is', '$1action="https://app.formester.com/forms/YZQjRMoVv/submissions"$2', $content);
        
        if ($newContent !== $content) {
            file_put_contents($path, $newContent);
            $count++;
        }
    }
}
echo "Updated form actions in $count files.\n";
