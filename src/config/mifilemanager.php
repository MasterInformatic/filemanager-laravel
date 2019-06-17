<?php

return [

    'dir' => public_path()."/",

    'directory' => "/storage/",

    'imagesConfig' => [
    	'maxSize'           => 0,
    	'allowedExtensions' => 'bmp,gif,jpeg,jpg,png',
	    'deniedExtensions'  => '',
	    'directory'         => 'images',
    ],
 
    'accessControl' => [
    	'role'                => '*',
	    'resourceType'        => '*',
	    'folder'              => '/',

	    'FOLDER_VIEW'         => true,
	    'FOLDER_CREATE'       => true,
	    'FOLDER_RENAME'       => true,
	    'FOLDER_DELETE'       => true,

	    'FILE_VIEW'           => true,
	    'FILE_UPLOAD'         => true,
	    'FILE_RENAME'         => true,
	    'FILE_DELETE'         => true,

	    'IMAGE_RESIZE'        => true,
	    'IMAGE_RESIZE_CUSTOM' => true
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
        'pdf'  => 'fa-file-pdf-o',
        'doc'  => 'fa-file-word-o',
        'docx' => 'fa-file-word-o',
        'xls'  => 'fa-file-excel-o',
        'xlsx' => 'fa-file-excel-o',
        'zip'  => 'fa-file-archive-o',
        'gif'  => 'fa-file-image-o',
        'jpg'  => 'fa-file-image-o',
        'jpeg' => 'fa-file-image-o',
        'png'  => 'fa-file-image-o',
        'ppt'  => 'fa-file-powerpoint-o',
        'pptx' => 'fa-file-powerpoint-o',
    ],

    'valid_image_mimetypes' => [
        'image/jpeg',
        'image/pjpeg',
        'image/png',
        'image/gif',
        'image/svg+xml',
    ],
 
    'valid_file_mimetypes' => [
        'image/jpeg',
        'image/pjpeg',
        'image/png',
        'image/gif',
        'image/svg+xml',
        'application/pdf',
        'text/plain',
    ],



];
 