<?php

/**
 * Service for managing image uploads, processing, and deletions.
 */

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

/**
 * Handles image operations such as saving, deleting, and bulk actions.
 */
class ImageService
{
    /**
     * $image: Current Image saving/uploading
     * $current: The current image that was already uploading, Used to delete an existing image
     * $folder: The high level folder where the image needs to be in.
     * $base: The base name for the image: Example: user_1234, blog_1234, book_1234, etc
     */
    public function saveImage($image, $current, $folder, $base = 'img')
    {
        if ($image) {
            // Read the uploaded image file
            $img = Image::read($image->getRealPath());
            // Resize the image to 300x300
            $img->cover(300, 300, 'center');

            $extension = $image->getClientOriginalExtension() ?: 'jpg';

            $year = date('Y');
            $month = date('m');
            $day = date('d');
            $pathPrefix = "{$folder}/{$year}/{$month}/{$day}";

            // Create the directory if it doesn't exist
            Storage::disk('public')->makeDirectory($pathPrefix);

            // Generate a unique filename
            do {
                $filename = $base.'_'.rand(1000, 9999).'.'.$extension;
                $fullPath = "{$pathPrefix}/{$filename}";
            } while (Storage::disk('public')->exists($fullPath));

            // Delete the old image if it exists
            if (! empty($current)) {
                $currentPath = "{$folder}/{$current}";
                if (Storage::disk('public')->exists($currentPath)) {
                    Storage::disk('public')->delete($currentPath);
                }
            }

            // Save the image
            $img->save(Storage::disk('public')->path($fullPath));

            // Return the new filename with date path
            return "{$year}/{$month}/{$day}/{$filename}";
        }

        return null;
    }

    /**
     * $image: Current Image saving/uploading
     * $folder: The high level folder where the image needs to be in.
     * $subfolder: The folder that will group all the bulk images, can use blog name, book name, etc.
     * $base: The base name for the image: Example: user_1234, blog_1234, book_1234, etc
     */
    public function saveBulkImages($images, $folder, $subfolder, $base = 'img')
    {
        $filenames = [];
        if (! empty($images)) {
            $pathPrefix = "{$folder}/{$subfolder}";

            // Create the directory if it doesn't exist
            Storage::disk('public')->makeDirectory($pathPrefix);

            foreach ($images as $image) {
                // Read the uploaded image file
                $img = Image::read($image->getRealPath());
                // Resize the image to 300x300
                $img->cover(300, 300, 'center');

                $extension = $image->getClientOriginalExtension() ?: 'jpg';
                $filename = $base.'_'.rand(1000, 9999).'.'.$extension;
                $fullPath = "{$pathPrefix}/{$filename}";

                // Save the image
                $img->save(Storage::disk('public')->path($fullPath));

                // Add the filename to the array
                $filenames[] = "{$subfolder}/{$filename}";
            }

            // Return the array of filenames
            return $filenames;
        }

        return null;
    }

    public function deleteImage($image, $folder = null)
    {
        $path = $folder ? "{$folder}/{$image}" : $image;

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        } else {
            Log::warning("File not found or invalid path: {$path}");
        }
    }

    public function deleteBulkImages($images, $folder)
    {
        if (empty($images)) {
            return;
        }

        // Decode the images if it's a JSON string
        if (is_string($images)) {
            $decoded = json_decode($images, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $images = $decoded;
            } else {
                Log::warning('Invalid JSON passed to deleteBulkImages');

                return;
            }
        }

        if (! is_array($images) || empty($images)) {
            return;
        }

        // flatten the array
        if ($this->isArrayOfArrays($images)) {
            $images = array_reduce($images, 'array_merge', []);
        }

        // Filter out null or non-string values
        $images = array_filter($images, 'is_string');

        if (! empty($images)) {
            // Get the subfolder
            $firstImageParts = explode('/', array_values($images)[0]);
            $subfolder = count($firstImageParts) > 1 ? $firstImageParts[0] : null;
            $disk = Storage::disk('public');

            foreach ($images as $image) {
                $fullPath = "{$folder}/{$image}";
                if ($disk->exists($fullPath)) {
                    $disk->delete($fullPath);
                }
            }

            // Check if the subfolder exists and is empty
            if ($subfolder) {
                $subfolderPath = "{$folder}/{$subfolder}";
                if ($disk->exists($subfolderPath)) {
                    $files = $disk->files($subfolderPath);
                    $directories = $disk->directories($subfolderPath);

                    if (empty($files) && empty($directories)) {
                        $disk->deleteDirectory($subfolderPath);
                    }
                }
            }
        }
    }

    public function isArrayOfArrays(array $array): bool
    {
        if (empty($array)) {
            return false;
        }

        foreach ($array as $element) {
            if (! is_array($element)) {
                return false;
            }
        }

        return true;
    }
}
