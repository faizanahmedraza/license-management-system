<?php


namespace App\Services;


use Illuminate\Support\Facades\Storage;

class ImageService
{
    /**
     * Function for upload image
     *
     * @param string $folder
     * @param string $key
     * @param string $validation
     * @param string $visibility example: public/private
     *
     * @return false|string|null
     */
    public static function upload($folder = 'images', $key = 'avatar', $validation = 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048', $visibility = 'public')
    {
        request()->validate([$key => $validation]);
        $file = null;
        if (request()->hasFile($key)) {
            $file = Storage::disk('public')->putFile($folder, request()->file($key), $visibility);
        }
        return $file;
    }

    /**
     * Function for delete image
     *
     * @param string $path
     * @param string $folder
     **/
    public static function delete($path, $folder = 'images')
    {
        if (Storage::disk($folder)->exists($path)) {
            Storage::disk($folder)->delete($path);
        }
    }
}