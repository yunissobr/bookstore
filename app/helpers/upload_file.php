<?php

function upload_file($file)
{

    // file is an array
    // i.e
    // $file = [
    //     'file' => $_FILES['any'],
    //     'target_folder' => 'book/img/'
    // ];

    $targetDir = ROOT . '/public/' . $file['target_folder'];

    $filename = generate_rand_str(4) . '_' . str_replace(" ", "", basename($file['file']["name"]));

    $targetFilePath = $targetDir . $filename;

    if (move_uploaded_file($file['file']["tmp_name"], $targetFilePath)) {
        return $filename;
    } else {
        return false;
    }
}
