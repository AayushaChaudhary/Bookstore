<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class MediaService
{
    public static function upload(UploadedFile $file, $folder = "uploads")
    {
        $name = $file->getClientOriginalName();
        $type = $file->getMimeType();
        $ext = $file->extension();

        $path = Str::random(10) . "." . $ext;

        $file->storeAs("public/" . $folder, $path);

        $media = Media::create([
            'name' => $name,
            'type' => $type,
            'path' => $folder . "/" . $path,
        ]);

        return $media->id;
    }
}
