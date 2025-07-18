<?php

use App\Exceptions\StorageUploadFileException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection as FractalCollection;
use League\Fractal\Resource\Item as FractalItem;

if (! function_exists('routeAdmin')) {
    /**
     * Get route for admin
     *
     * @param  string  $name
     * @param  array  $options
     * @return string|null
     */
    function routeAdmin($name, $options = [])
    {
        return route(ADMIN_MODULE_AS.$name, $options);
    }
}

if (! function_exists('auth')) {
    /**
     * Get auth guard for admin
     *
     * @param  string  $guard
     * @return Illuminate\Auth\SessionGuard|null
     */
    function auth($guard = ''): Illuminate\Auth\SessionGuard
    {
        $guard = empty($guard) ? USER_GUARD : $guard;

        return Auth::guard($guard);
    }
}

if (! function_exists('assetAdmin')) {
    /**
     * Get asset link for admin
     *
     * @param  string  $url url path.
     * @param  bool  $http flag for return http(s) or none http(s)
     */
    function assetAdmin($url, $http = true): string
    {
        // remove '/' at first character when have
        if (strpos($url, '/') == 0) {
            $url = substr($url, 1);
        }

        $assetPath = ADMIN_ASSET_PATH.$url;

        return $http ? mix($assetPath) : $assetPath;
    }
}

if (! function_exists('uploadImageToStorage')) {
    /**
     * Resize and upload image to storage
     *
     * @param Illuminate\Http\UploadedFile || Illuminate\Http\File $file
     * @param  int  $pWidth width you want to resize
     * @param  int  $pHeight height you want to resize
     * @param  string|null  $fileExtension
     * @param  bool  $saveOriginalImage save original image if true
     * @return void
     */
    function uploadImageToStorage(
        $file,
        string $fileName,
        int $pWidth,
        int $pHeight,
        $fileExtension = null,
        bool $saveOriginalImage = true
    ) {
        // check filename is invalid or not
        if (! empty($fileName) && ! preg_match(STORAGE_IMAGE_ALLOW_EXTENSION, $fileName)) {
            throw new StorageUploadFileException('File type is not allow, please change STORAGE_IMAGE_ALLOW_EXTENSION if you want to upload');
        }

        // image extension
        if (! $fileExtension) {
            if ($file instanceof Illuminate\Http\UploadedFile) {
                $fileExtension = $file->extension();
            } else {
                $fileExtension = $file->getClientOriginalExtension();
            }
        }

        // init image
        $image = Image::make($file);

        // save original image
        if ($saveOriginalImage) {
            // upload original image to storage
            $originalName = getFilenameSuffixOriginal($fileName);

            // original image
            $originalImage = $image->stream($fileExtension, STORAGE_IMAGE_QUANTITY)->detach();

            // upload original image to storage
            Storage::disk()->put($originalName, $originalImage, [
                'visibility' => 'public'
            ]);
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
        Storage::disk()->put($fileName, $resizeImage, [
            'visibility' => 'public'
        ]);
    }
}

if (! function_exists('deleteImageFromStorage')) {
    /**
     * Delete image from storage
     *
     * @return void
     */
    function deleteImageFromStorage(string $fileName)
    {
        $storage = Storage::disk();

        if ($storage->exists($fileName)) {
            $storage->delete($fileName);
        }

        // try to delete original file
        $fileOriginalName = getFilenameSuffixOriginal($fileName);
        if ($storage->exists($fileOriginalName)) {
            $storage->delete($fileOriginalName);
        }
    }
}

if (! function_exists('getFilenameSuffixOriginal')) {
    /**
     * Get file name with suffix original
     *
     * @param  string  $filename
     * @return string
     */
    function getFilenameSuffixOriginal($filename)
    {
        return preg_replace(STORAGE_IMAGE_ALLOW_EXTENSION, STORAGE_SUFFIX_ORIGINAL_RESIZE, $filename);
    }
}

if (! function_exists('checkActiveSidebarItem')) {
    /**
     * Get Active of side
     *
     * @param  array  $side @app/Modules/Management/Config/sidebar.yml
     */
    function checkActiveSidebarItem(array $side): array
    {
        $isActive = false;
        $itemKeyActive = null;
        $itemsFlg = (isset($side['items']) && ! empty($side['items']));

        if ($itemsFlg) {
            foreach ($side['items'] as $k => $item) {
                $url = isset($item['route']) ? routeAdmin($item['route']) : false;

                if (url()->current() === $url) {
                    $itemKeyActive = $k;
                    $isActive = true;
                    break;
                }
            }
        }

        if ($isActive === false) {
            $url = isset($side['route']) ? routeAdmin($side['route']) : false;
            if (url()->current() === $url) {
                $isActive = true;
            }
        }

        return [
            'status' => $isActive,
            'itemKey' => $itemKeyActive,
        ];
    }
}

if (! function_exists('getCurrentBreadcrumbs')) {
    /**
     * [Admin] Get current breadcrumbs
     *
     * @return mixed
     */
    function getCurrentBreadcrumbs()
    {
        return collect(config('admin.breadcrumbs'))->filter(
            function ($breadcrumb) {
                return (ADMIN_MODULE_AS.$breadcrumb['for']) === Route::currentRouteName();
            }
        )->first();
    }
}

if (! function_exists('writeLogHandleException')) {
    /**
     * Write log when exception appear
     *
     * @return mixed
     */
    function writeLogHandleException(Throwable $e)
    {
        Log::error('====== '.get_class($e).' ======');
        Log::error('Appear at: '.Carbon::now());
        Log::error('Header: '.json_encode(request()->header()));
        Log::error('Requests: '.json_encode(request()->all()));

        // write bearer token if use
        if (request()->bearerToken()) {
            Log::error('Bearer Token: '.request()->bearerToken());
        }

        // Write exception message
        Log::error($e);
    }
}

if (! function_exists('createFractalItem')) {
    /**
     * Create a fractal item format
     *
     * @return \League\Fractal\Resource\Item
     */
    function createFractalItem($data, $transformer)
    {
        $item = new FractalItem($data, $transformer);

        return $item;
    }
}

if (! function_exists('createFractalCollection')) {
    /**
     * Create a fractal collection format
     *
     * @return \League\Fractal\Resource\Collection
     */
    function createFractalCollection($data, $transformer, $resourceKey = 'data')
    {
        if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            $collection = $data->getCollection();
            $collection = new FractalCollection($collection, $transformer, $resourceKey);
            $collection->setPaginator(new IlluminatePaginatorAdapter($data));
        } else {
            $collection = new FractalCollection($data, $transformer, $resourceKey);
        }

        return $collection;
    }
}

if (! function_exists('getRequestListByName')) {
    /**
     * [API] Get list ids from request param
     *
     * @return array
     */
    function getListByRequestName($requestName)
    {
        try {
            $listIds = request()->$requestName ? explode(',', request()->$requestName) : [];

            // remove invalid data
            $listIds = array_filter(
                $listIds,
                function ($id) {
                    return ! empty($id);
                }
            );

            return $listIds;
        } catch (Exception $e) {
            return [];
        }
    }
}

if (! function_exists('validatePaginationRequestParams')) {
    /**
     * [API] Validation paginate params valid
     *
     * @return array
     */
    function validatePaginationRequestParams()
    {
        return [
            'page' => ['integer', 'min:1', 'max:'.MAX_INTEGER_VALUE],
            'per_page' => ['integer', 'min:1', 'max:'.MAX_INTEGER_VALUE],
        ];
    }
}

if (! function_exists('getPerPage')) {
    /**
     * [API] Limit record in  per page
     *
     * @return int
     */
    function getPerPage()
    {
        return request()->per_page ?? 6;
    }
}

if (! function_exists('getClass')) {
    /**
     * Get a class constructor
     *
     * @return mixed
     */
    function getClass($name)
    {
        return app()->make($name);
    }
}
