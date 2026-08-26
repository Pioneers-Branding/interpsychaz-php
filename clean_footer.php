<?php
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('.'));
$count = 0;
foreach($files as $f) {
    $ext = $f->getExtension();
    if($ext == 'php' || $ext == 'html') {
        $content = file_get_contents($f->getPathname());
        
        // Remove tracking inputs
        $newContent = preg_replace('/<input[^>]*name=[\'"](gform_[^>"\']+|state_[0-9]+|is_submit_[0-9]+)[\'"][^>]*>/is', '', $content);
        
        // Clean up empty display:none divs
        $newContent = preg_replace('/<div style="display:none">\s*<\/div>/is', '', $newContent);
        
        // Remove the onclick handler on submit buttons
        $newContent = preg_replace('/onclick=[\'"]gform\.submission\.handleButtonClick\([^)]+\);?[\'"]/is', '', $newContent);
        
        // Clean up any double spaces in button tag
        $newContent = preg_replace_callback('/<button\s+([^>]+)>/i', function($m) {
            return '<button ' . preg_replace('/\s+/', ' ', $m[1]) . '>';
        }, $newContent);
        
        if ($newContent !== $content) {
            file_put_contents($f->getPathname(), $newContent);
            $count++;
        }
    }
}
echo "Cleaned up tracking inputs and onclicks in $count files.\n";
