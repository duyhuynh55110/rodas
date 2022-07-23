<?php

use App\Exceptions\StorageUploadFileException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

if (!function_exists('routeAdmin')) {
    /**
     * Get route for admin
     *
     * @param string $name
     * @param array $options
     * @return string|null
     */
    function routeAdmin($name, $options = [])
    {
        return route(ADMIN_MODULE_AS . $name, $options);
    }
}

if (!function_exists('authAdmin')) {
    /**
     * Get auth guard for admin
     *
     * @param string $guard
     * @return Illuminate\Auth\SessionGuard|null
     */
    function authAdmin($guard = '') : Illuminate\Auth\SessionGuard
    {
        $guard = empty($guard) ? ADMIN_GUARD : $guard;
        return Auth::guard($guard);
    }
}

if (!function_exists('assetAdmin')) {
    /**
     * Get asset link for admin
     *
     * @param string $url url path.
     * @param boolean $http flag for return http(s) or none http(s)
     * @return string
     */
    function assetAdmin($url, $http = true): string
    {
        // remove '/' at first character when have
        if (strpos($url, '/') == 0) {
            $url = substr($url, 1);
        }

        $assetPath = ADMIN_ASSET_PATH . $url;

        return ($http ? mix($assetPath) : $assetPath);
    }
}

if (!function_exists('uploadImageToStorage')) {
    /**
     * Resize and upload image to storage
     *
     * @param Request $file
     * @param string $fileName
     * @param int $pWidth width you want to resize
     * @param int $pHeight height you want to resize
     * @param string|null $fileExtension
     * @param bool $saveOriginalImage save original image if true
     * @return void
     */
    function uploadImageToStorage(
        $file,
        string $fileName,
        int $pWidth,
        int $pHeight,
        $fileExtension = null,
        bool $saveOriginalImage = true
    )
    {
        // check filename is invalid or not
        if (!empty($fileName) && !preg_match(STORAGE_IMAGE_ALLOW_EXTENSION, $fileName)) {
            throw new StorageUploadFileException('File type is not allow, please change STORAGE_IMAGE_ALLOW_EXTENSION if you want to upload');
        }

        // image extension
        $fileExtension = $fileExtension ?? $file->getClientFileExtension();

        // init image
        $image = Image::make($file);

        // save original image
        if ($saveOriginalImage) {
            // upload original image to storage
            $originalName = getFilenameSuffixOriginal($fileName);

            // original image
            $originalImage = $image->stream($fileExtension, STORAGE_IMAGE_QUANTITY)->detach();

            // upload original image to storage
            Storage::disk()->put($originalName, $originalImage);

        }

        // calculate width & height
        $width = $image->width();
        $height = $image->height();

        if ($width > $height) {
            if ($width > $pWidth) {
                $height *= $pWidth / $width;
                $width = $pWidth;
            }
        } else {
            if ($height > $pHeight) {
                $width *= $pHeight / $height;
                $height = $pHeight;
            }
        }

        // resize image
        $resizeImage = $image->resize($width, $height)->stream($fileExtension, STORAGE_IMAGE_QUANTITY)->detach();

        // upload resize image to storage
        Storage::disk()->put($fileName, $resizeImage);
    }
}

if (!function_exists('getFilenameSuffixOriginal')) {
    /**
     * Get file name with suffix original
     *
     * @param string $filename
     * @return string
     */
    function getFilenameSuffixOriginal($filename)
    {
        return preg_replace(STORAGE_IMAGE_ALLOW_EXTENSION, STORAGE_SUFFIX_ORIGINAL_RESIZE, $filename);
    }
}
