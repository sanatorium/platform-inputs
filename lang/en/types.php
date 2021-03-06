<?php

return [

    'option' => [
        'file'      => 'File',
        'switchery' => 'Switchery',
        'dropzone'  => 'Dropzone',
        'truefalse' => 'True/False',
        'repeater'  => 'Repeater',
        'wysiwyg'   => 'WYSIWYG',
        'media'     => 'Media',
        'image'     => 'Image',
        'video'     => 'Video',
        'gallery'   => 'Gallery',
        'category'  => 'Category',
        'date'      => 'Date',
        'scale'     => 'Scale',
        'relation'  => 'Relation',
        'phone'     => 'Phone',
        'url'       => 'URL',
        'email'     => 'E-mail',
        'country'   => 'Country',
        'avatar'    => 'Avatar',
        'tags'      => 'Tags',
    ],

    'image' => [
        'select' => 'Select image',
    ],

    'video' => [
        'select' => 'Select video',
    ],

    'media' => [
        'media_entity'  => 'Upload Files',
        'media_library' => 'Media Library',
        'media_details' => 'Media details',
        'search'        => 'Search',
        'select'        => 'Select files',

        'upload' => [
            'select'  => 'Select Files',
            'allowed' => 'Allowed file types',
            'or'      => 'or',
            'drop'    => 'Drop files anywhere to upload',
        ],

        'sort' => [
            'oldest'              => 'From oldest',
            'newest'              => 'From newest',
            'smallest'            => 'From smallest',
            'largest'             => 'From largest',
            'alphabetically_asc'  => 'From A-Z',
            'alphabetically_desc' => 'From Z-A',
            // old values
            'created_at'          => 'From oldest',
            'size'                => 'Size',
            'name'                => 'Name',
        ],

        'filter' => [
            'all'       => 'Show all',
            'images'    => 'Images',
            'audio'     => 'Audio',
            'video'     => 'Video',
            'documents' => 'Documents',
        ],

        'fields' => [
            'name'   => 'Name',
            'status' => 'Status',
        ],

        'actions' => [
            'delete'            => 'Delete',
            'share'             => 'Share',
            'download'          => 'Download',
            'email'             => 'Email',
            'copy_to_clipboard' => 'Copy to clipboard',
        ],
    ],

    'settings' => [

        'min' => 'Minimum',
        'max' => 'Maximum',

    ],

    'tags' => [

      'create_value' => 'Allow value creation'

    ],

    'country' => [

        'placeholder' => 'Select country',

    ],

    // Legacy values, delete when getting rid of dropzone
    'file' => [
        'select' => 'Select files',
        'allowed' => 'Allowed file types',
        'click_upload' => 'Click to upload',
    ],

];