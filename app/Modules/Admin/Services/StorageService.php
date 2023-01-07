<?php

namespace App\Modules\Admin\Services;

/**
 * StorageService
 */
class StorageService
{
    /**
     * Upload multiples images to storage
     *
     * @param $request
     * @return array
     */
    public function uploadMultipleImagesToStorage($request)
    {
        $path = $request->path;
        $files = $request->file;

        // upload files and return array names
        return collect($files)->map(function ($file) use ($path) {
            $hashName = $path.$file->hashName();

            switch ($path) {
                case STORAGE_PATH_TO_PRODUCT_SLIDES:
                    $width = RESIZE_PRODUCT_SLIDE_WIDTH;
                    $height = RESIZE_PRODUCT_SLIDE_HEIGHT;
                    break;
            }

            // upload and resize image
            uploadImageToStorage($file, $hashName, $width, $height);

            return [
                'original_name' => $file->getClientOriginalName(),
                'file_name' => $hashName,
            ];
        });
    }
}
