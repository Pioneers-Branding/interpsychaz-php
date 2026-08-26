<?php
$css = <<<CSS
<style>
/* Premium Gravity Forms Overrides */
.gform_wrapper .gform_body .gfield input[type=text],
.gform_wrapper .gform_body .gfield input[type=email],
.gform_wrapper .gform_body .gfield input[type=tel],
.gform_wrapper .gform_body .gfield select,
.gform_wrapper .gform_body .gfield textarea {
    width: 100% !important;
    padding: 12px 15px !important;
    border: 1px solid #d1d5db !important;
    border-radius: 6px !important;
    background-color: #ffffff !important;
    color: #1f2937 !important;
    font-size: 16px !important;
    font-family: inherit !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05) inset !important;
    box-sizing: border-box !important;
    margin-top: 4px !important;
}

.gform_wrapper .gform_body .gfield input:focus,
.gform_wrapper .gform_body .gfield select:focus,
.gform_wrapper .gform_body .gfield textarea:focus {
    outline: none !important;
    border-color: #4b4d97 !important;
    box-shadow: 0 0 0 3px rgba(75, 77, 151, 0.2) !important;
    background-color: #fff !important;
}

.gform_wrapper .gform_body .gfield_label {
    font-weight: 600 !important;
    color: #374151 !important;
    margin-bottom: 5px !important;
    display: inline-block !important;
    font-size: 15px !important;
}

.gform_wrapper .gform_footer button.gform_button,
.gform_wrapper .gform_footer input.gform_button,
.gform_wrapper .gform_footer button[type="submit"] {
    background-color: #ea8529 !important;
    color: #ffffff !important;
    font-weight: 600 !important;
    font-size: 16px !important;
    padding: 14px 28px !important;
    border-radius: 30px !important;
    border: none !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 12px rgba(234, 133, 41, 0.3) !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}

.gform_wrapper .gform_footer button.gform_button:hover,
.gform_wrapper .gform_footer input.gform_button:hover,
.gform_wrapper .gform_footer button[type="submit"]:hover {
    background-color: #d67420 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 15px rgba(234, 133, 41, 0.4) !important;
}

.gform_wrapper .gform_fields {
    display: grid !important;
    grid-gap: 20px !important;
}

.gform_wrapper .gfield_radio .gchoice {
    margin-bottom: 8px !important;
    display: flex !important;
    align-items: center !important;
}

.gform_wrapper .gfield_radio input[type="radio"] {
    margin-right: 10px !important;
    width: 18px !important;
    height: 18px !important;
    accent-color: #4b4d97 !important;
}

.gform_wrapper .gfield_description p {
    font-size: 13px !important;
    color: #6b7280 !important;
    line-height: 1.5 !important;
    margin-top: 8px !important;
}
</style>
CSS;

$head = file_get_contents('includes/head.php');
$head = str_replace('</head>', "\n" . $css . "\n</head>", $head);
file_put_contents('includes/head.php', $head);
echo "Premium form styles injected into includes/head.php\n";
