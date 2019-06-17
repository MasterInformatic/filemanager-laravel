<?php

return [
 
    'dir' => public_path("storage"),

    'directory' => "storage",

    'imagesConfig' => [
        'maxSize'           => 0,
        'allowedExtensions' => ['bmp','gif','jpeg','jpg','png'],
        'deniedExtensions'  => [],
    ],

    'filesConfig' => [
        'maxSize'           => 0,
        'allowedExtensions' => ['pdf'],
        'deniedExtensions'  => ['txt'],
    ],
 
    'accessControl' => [
        'FOLDER_CREATE'       => false,
        'FILE_VIEW'           => true,
        'FILE_UPLOAD'         => true,
    ],

    'file_type_array' => [
        'pdf'  => 'Adobe Acrobat',
        'doc'  => 'Microsoft Word',
        'docx' => 'Microsoft Word',
        'xls'  => 'Microsoft Excel',
        'xlsx' => 'Microsoft Excel',
        'zip'  => 'Archive',
        'gif'  => 'GIF Image',
        'jpg'  => 'JPEG Image',
        'jpeg' => 'JPEG Image',
        'png'  => 'PNG Image',
        'ppt'  => 'Microsoft PowerPoint',
        'pptx' => 'Microsoft PowerPoint',
    ],

    'file_icon_array' => [
        'pdf'  => 'fa-file-pdf',
        'doc'  => 'fa-file-word',
        'docx' => 'fa-file-word',
        'xls'  => 'fa-file-excel',
        'xlsx' => 'fa-file-excel',
        'zip'  => 'fa-file-archive',
        'gif'  => 'fa-file-image',
        'jpg'  => 'fa-file-image',
        'jpeg' => 'fa-file-image',
        'png'  => 'fa-file-image',
        'ppt'  => 'fa-file-powerpoint',
        'pptx' => 'fa-file-powerpoint',
    ],

];
 