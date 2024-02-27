<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileManager
{
    const VIDEO_FILE_MIME = ['video/mp4','video/mpeg'];
    protected static function createFilename(UploadedFile $file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = str_replace("." . $extension, "", $file->getClientOriginalName()); // Filename without extension

        // Add timestamp hash to name of the file
        $filename .= "_" . md5(time()) . "." . $extension;

        return $filename;
    }

    public static function saveFile(UploadedFile $file, $parent)
    {
        $fileName = self::createFilename($file);

        // Group files by mime type
        $mime = str_replace('/', '-', $file->getMimeType());

        // Group files by the date (week
        $dateFolder = date("Y-m-W");

        // Build the file path
        $filePath = "{$parent}/{$mime}/{$dateFolder}";
        $finalPath = storage_path("app/public/" . $filePath);

        // move the file name
        $file->move($finalPath, $fileName);

        return [
            'path' => $filePath,
            'name' => $fileName,
            'mime_type' => $mime
        ];
    }

    // protected function saveFileToS3($file)
    // {
    //     $fileName = $this->createFilename($file);
    //     $disk = Storage::disk('s3');

    //     // It's better to use streaming (laravel 5.4+)
    //     $disk->putFileAs('photos', $file, $fileName);

    //     // for older laravel
    //     // $disk->put($fileName, file_get_contents($file), 'public');

    //     $mime = str_replace('/', '-', $file->getMimeType());

    //     // We need to delete the file when uploaded to s3
    //     unlink($file->getPathname());

    //     return response()->json([
    //         'path' => $disk->url($fileName),
    //         'name' => $fileName,
    //         'mime_type' => $mime
    //     ]);
    // }
}
