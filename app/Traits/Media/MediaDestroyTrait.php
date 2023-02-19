<?php
namespace App\Traits\Media;

use Illuminate\Support\Facades\Storage;

trait MediaDestroyTrait
{


    public function deleteMedia($configDisk,$directory,$mediaFile): bool
    {
       return Storage::disk($configDisk)->delete($directory . '/' . $mediaFile);
    }

}
