<?php

/**
 * Service for managing image uploads, processing, and deletions.
 */

namespace App\Services;

use Illuminate\Support\Facades\Log;
use /**
 * Class Image
 *
 * The Intervention Image facade provides an interface for manipulating images in the Laravel application.
 * This facade allows the use of the Image library functions to edit and adjust images such as resizing,
 * cropping, and applying filters.
 *
 * The Image class integrates with the Laravel ecosystem and can be used across the Enchanted_Quill
 * application leveraging its services, such as queues or jobs.
 *
 * @mixin \Intervention\Image\ImageManager
 *
 * @see \Intervention\Image\ImageManager
 */
Intervention\Image\Laravel\Facades\Image;

/**
 * Handles image operations such as saving, deleting, and bulk actions.
 */
class ImageService
{
    /**
     * Create a new class instance.
     */

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
            // Generate a new filename
            $filename = $base.'_'.rand(1000, 9999).'.'.$image->getClientOriginalExtension();

            // Check if the folder exists and create it if it doesn't
            if (! file_exists(storage_path('app/public/'.$folder))) {
                mkdir(storage_path('app/public/'.$folder), 0755, true);
            }
            // Check if there's a current year subfolder, if not create it
            if (! file_exists(storage_path('app/public/'.$folder.'/'.date('Y')))) {
                mkdir(storage_path('app/public/'.$folder.'/'.date('Y')), 0755, true);
            }

            // Check if there's a current month subfolder, if not create it
            if (! file_exists(storage_path('app/public/'.$folder.'/'.date('Y').'/'.date('m')))) {
                mkdir(storage_path('app/public/'.$folder.'/'.date('Y').'/'.date('m')), 0755, true);
            }

            // Check if there's a current day subfolder, if not create it
            if (! file_exists(storage_path('app/public/'.$folder.'/'.date('Y').'/'.date('m').'/'.date('d')))) {
                mkdir(storage_path('app/public/'.$folder.'/'.date('Y').'/'.date('m').'/'.date('d')), 0755, true);
            }

            // Check if filename exists in the current day folder
            while (file_exists(storage_path('app/public/'.$folder.'/'.date('Y').'/'.date('m').'/'.date('d').'/'.$filename)) == true) {
                $filename = 'img_'.rand(1000, 9999).'.'.$image->getClientOriginalExtension();
            }

            // add current year/month/day to the filename
            $filename = date('Y').'/'.date('m').'/'.date('d').'/'.$filename;

            // Delete the old image if it exists

            // Check if the current image is not empty
            if (! empty($current)) {
                $currentPath = storage_path('app/public/'.$folder.'/'.$current);
                $publicPath = realpath(storage_path('app/public'));
                $resolvedPath = realpath($currentPath);

                if ($resolvedPath && str_starts_with($resolvedPath, $publicPath) && file_exists($resolvedPath)) {
                    unlink($resolvedPath);
                }
            }

            // Save the image to the main folder/year/month/day directory

            $img->save(storage_path('app/public/'.$folder.'/'.$filename));

            // Return the new filename

            return $filename;
        }

        return null;
    }

    /**
     * $image: Current Image saving/uploading
     *  $folder: The high level folder where the image needs to be in.
     *  $subfolder: The folder that will group all the bulk images, can use blog name, book name, etc.
     * $base: The base name for the image: Example: user_1234, blog_1234, book_1234, etc
     */
    public function saveBulkImages($images, $folder, $subfolder, $base = 'img')
    {
        $filenames = [];
        if (! empty($images)) {
            foreach ($images as $image) {
                // Read the uploaded image file
                $img = Image::read($image->getRealPath());
                // Resize the image to 300x300
                $img->cover(300, 300, 'center');
                // Generate a new filename
                $filename = $base.'_'.rand(1000, 9999).'.'.$image->getClientOriginalExtension();

                // Check if the folder exists and create it if it doesn't
                if (! file_exists(storage_path('app/public/'.$folder))) {
                    mkdir(storage_path('app/public/'.$folder), 0755, true);
                }
                // Check if subfolder exists, if not create it
                if (! file_exists(storage_path('app/public/'.$folder.'/'.$subfolder))) {
                    mkdir(storage_path('app/public/'.$folder.'/'.$subfolder), 0755, true);
                }

                // Update the filename with the subfolder
                $filename = $subfolder.'/'.$filename;

                // Save the image to the main folder/subfolder directory
                $img->save(storage_path('app/public/'.$folder.'/'.$filename));

                // Add the filename to the array
                $filenames[] = $filename;
            }

            // Return the array of filenames
            return $filenames;
        }

        return null;
    }

    public function deleteImage($image, $folder = null)
    {
        if ($folder) {
            $fullPath = storage_path('app/public/'.$folder.'/'.$image);
        } else {
            $fullPath = storage_path('app/public/'.$image);
        }

        $publicPath = realpath(storage_path('app/public'));
        $resolvedPath = realpath($fullPath);

        if ($resolvedPath && str_starts_with($resolvedPath, $publicPath) && file_exists($resolvedPath)) {
            unlink($resolvedPath);
        } else {
            Log::warning("File not found or invalid path: $fullPath");
        }
    }

    public function deleteBulkImages($images, $folder)
    {
        // Decode the images
        $images = json_decode($images);
        // flatten the array
        if ($this->isArrayOfArrays($images)) {
            $images = array_reduce($images, 'array_merge', []);
        }

        if (! empty($images)) {
            // Loop through the images and delete the images, delete the subfolder at the end
            // Get the subfolder
            $subfolder = explode('/', $images[0])[0];
            $publicPath = realpath(storage_path('app/public'));

            foreach ($images as $image) {
                $fullPath = storage_path('app/public/'.$folder.'/'.$image);
                $resolvedPath = realpath($fullPath);

                if ($resolvedPath && str_starts_with($resolvedPath, $publicPath) && file_exists($resolvedPath)) {
                    unlink($resolvedPath);
                }
            }

            // Check if the subfolder exists
            $subfolderPath = storage_path('app/public/'.$folder.'/'.$subfolder);
            $resolvedSubfolder = realpath($subfolderPath);

            if ($resolvedSubfolder && str_starts_with($resolvedSubfolder, $publicPath) && file_exists($resolvedSubfolder) && is_dir($resolvedSubfolder)) {
                rmdir($resolvedSubfolder);
            }
        }
    }

    public function isArrayOfArrays(array $array): bool
    {
        foreach ($array as $element) {
            if (! is_array($element)) {
                return false;
            }
        }

        return true;
    }
}
