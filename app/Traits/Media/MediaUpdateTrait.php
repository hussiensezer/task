<?php
namespace App\Traits\Media;

use Illuminate\Http\Request;
trait MediaUpdateTrait
{
    use MediaDestroyTrait, MediaUploadingTrait;

    public function UpdateMedia($media,$configDisk,$directory,$columnInDB,Request $request): string
    {
        if($request->hasFile($media)) {

            $this->deleteMedia($configDisk,$directory, $columnInDB);
            return $this->storeMedia($request->$media, $configDisk,$directory);
        }

        return $columnInDB;
    }
}
