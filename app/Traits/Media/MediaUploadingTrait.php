<?php

namespace App\Traits\Media;

use Illuminate\Support\Facades\Storage;

trait MediaUploadingTrait
{

    public function storeMedia($media, $configDisk, $directory): string
    {
        $input_file = $media->getClientOriginalName();

        $file_Extensions = $media->getClientOriginalExtension();

        // Why We Add Number Random To Hash Because if the client upload the same image in same time it's will be Duplicate
        $hashPath = $this->hashFileName($input_file, $file_Extensions);

         Storage::disk($configDisk)->putFileAs($directory, $media, $hashPath);

         return $hashPath;
    }// End ImageStore


    public function hashFileName($file, $extensions): string
    {
        $randomNumber = rand(999, 9999999);
        return md5($file . $randomNumber . now()) . "." . $extensions;
    }// End HashFileName

}
