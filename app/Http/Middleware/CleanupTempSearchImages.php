<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CleanupTempSearchImages
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Clean up temp search images on session regeneration or logout
        if ($this->shouldCleanup($request)) {
            $this->cleanupSessionSearchImages($request);
        }

        return $response;
    }

    /**
     * Determine if cleanup should be performed
     */
    private function shouldCleanup(Request $request): bool
    {
        // Clean up on logout or session regeneration
        return $request->is('logout') || 
               $request->is('login') || 
               $request->session()->isStarted() && $request->session()->regenerated();
    }

    /**
     * Clean up search images for the current session
     */
    private function cleanupSessionSearchImages(Request $request)
    {
        try {
            $sessionId = $request->session()->getId();
            $disk = Storage::disk('public');
            
            // Get current search image from session and delete it
            $currentSearchImage = $request->session()->get('current_search_image');
            if ($currentSearchImage && $disk->exists($currentSearchImage)) {
                $disk->delete($currentSearchImage);
                Log::info('Middleware cleaned up search image', ['file' => $currentSearchImage]);
            }

            // Clean up any files for this session
            $tempSearchPath = 'temp/search';
            if ($disk->exists($tempSearchPath)) {
                $files = $disk->files($tempSearchPath);
                foreach ($files as $file) {
                    $filename = basename($file);
                    if (Str::contains($filename, 'search_' . $sessionId . '_')) {
                        $disk->delete($file);
                        Log::info('Middleware cleaned up session search image', ['file' => $file]);
                    }
                }
            }

            // Clear session variable
            $request->session()->forget('current_search_image');

        } catch (\Exception $e) {
            Log::warning('Error during middleware search image cleanup', [
                'error' => $e->getMessage()
            ]);
        }
    }
}