<?php


function find_file_type_img($fileName)
{
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $name="";
    switch (strtolower($ext)) {
        case 'css':
            $name = 'css.svg';
            break;
        case 'csv':
            $name = 'csv.svg';
            break;
        case 'doc':
        case 'docx':
            $name = 'doc.svg';
            break;
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
            $name = 'jpg.svg';
            break;
        case 'json':
            $name = 'json.svg';
            break;
        case 'html':
            $name = 'html.svg';
            break;
        case 'js':
            $name = 'javascript.svg';
            break;
        case 'pdf':
            $name = 'pdf.svg';
            break;
        case 'txt':
            $name = 'txt.svg';
            break;
        case 'xml':
            $name = 'xml.svg';
            break;
        case 'zip':
            $name = 'zip.svg';
            break;
        default:
            $name = 'file.svg';
    }
    return $name;
}

function isImageMime($type)
{
    $fileType = array('image/jpeg',
        'image/jpg',
        'image/png',
        'image/gif',
        'image/svg',
    );
    return in_array($type, $fileType);
}