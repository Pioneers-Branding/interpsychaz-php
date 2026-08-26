<?php
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('.'));
$count = 0;
foreach($files as $f) {
    if($f->isFile() && ($f->getExtension() == 'php' || $f->getExtension() == 'html')) {
        $path = $f->getPathname();
        $name = strtolower($f->getFilename());
        
        // Only target refer-a-patient files
        if (strpos($path, 'refer-a-patient') !== false) {
            $content = file_get_contents($path);
            
            // Regex to match <form ... action="..."> or <form action="..." ...>
            // Note: The global footer also exists in these pages. We must make sure we only update the form whose action was NOT already updated to YZQjRMoVv?
            // Actually, the global footer has action="https://app.formester.com/forms/YZQjRMoVv/submissions".
            // The refer-a-patient specific form has action="/for-providers/refer-a-patient/" or similar.
            // Let's replace ONLY actions that DO NOT contain app.formester.com
            
            $newContent = preg_replace('/(<form\b[^>]*?)\baction=[\'"](?!(?:https:\/\/app\.formester\.com))[^\'"]*[\'"]([^>]*>)/is', '$1action="https://app.formester.com/forms/SQWCrglza/submissions"$2', $content);
            
            if ($newContent !== $content) {
                file_put_contents($path, $newContent);
                $count++;
            }
        }
    }
}
echo "Updated refer-a-patient form actions in $count files.\n";
