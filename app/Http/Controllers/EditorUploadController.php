<?php

namespace App\Http\Controllers;

use App\Services\ImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EditorUploadController extends Controller
{
    public function __construct(protected ImageService $imageService) {}

    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'upload' => 'required|image|max:2048',
        ]);

        // Determine the folder based on the request or default to 'blogs'
        $folder = $request->input('folder', 'blogs');

        if (! in_array($folder, ['blogs', 'chapters', 'books'])) {
            $folder = 'blogs';
        }

        $baseName = match ($folder) {
            'chapters' => 'chapter_image',
            'books' => 'book_image',
            default => 'blog_image',
        };

        $imagePath = $this->imageService->saveImage(
            $request->file('upload'),
            null,
            $folder,
            $baseName
        );

        return response()->json([
            'url' => asset("storage/{$folder}/{$imagePath}"),
        ]);
    }

    public function deleteImage(Request $request): JsonResponse
    {
        $request->validate([
            'imagePath' => 'required|string',
        ]);

        $filePath = $request->input('imagePath');

        // Security check: prevent path traversal and ensure it's in allowed folders
        if (str_contains($filePath, '..') || ! preg_match('/^(blogs|chapters|books)\//', $filePath)) {
            return response()->json(['error' => 'Invalid image path'], 403);
        }

        $this->imageService->deleteImage($filePath);

        return response()->json(['success' => true]);
    }
}
