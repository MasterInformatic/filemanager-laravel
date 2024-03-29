<?php

return [ 
 
    'dir' => public_path("storage"),

    'directory' => "storage",

    'folderConfig' => [
        'showInView' => true,//Show the folders together with the files
    ],

    'imagesConfig' => [
        'maxSize'           => 0,
        'allowedExtensions' => ['gif','jpeg','jpg','png'],
        'deniedExtensions'  => ['svg'],
    ],

    'filesConfig' => [
        'maxSize'           => 0,
        'allowedExtensions' => ['txt'],
        'deniedExtensions'  => [''],
        'showImagesOnly'  => false,
    ],
 
    'accessControl' => [
        'FOLDER_CREATE'       => true,
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
        'txt'  => 'Archivo de texto',
    ],

    //used to list view
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
        'txt'  => 'fa-file-txt',
    ],

    //used to grid view
    //you can modify this for your custom icons
    //the files are in the project in the public pat
    //example:  FileManager/imgs/custom-icon.png
    'file_urls_array' => [
        'txt' => "FileManager/imgs/file-txt.png",
    ],

    'folder_settings' => [
        [
            'name'              => 'packs',
            'directory'         => 'packs',
            'maxSize'           => 0,
            'allowedExtensions' => 'bmp,gif,jpeg,jpg,png',
            'deniedExtensions'  => ''
        ],
        [
            'name'              => 'packs',
            'directory'         => 'packs',
            'maxSize'           => 0,
            'allowedExtensions' => 'bmp,gif,jpeg,jpg,png',
            'deniedExtensions'  => ''
        ],
        
    ]

];
 