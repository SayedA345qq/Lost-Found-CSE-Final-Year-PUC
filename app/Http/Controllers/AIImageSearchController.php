<?php

namespace App\Http\Controllers;

use App\Services\ClipEmbeddingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AIImageSearchController extends Controller
{
    protected $clipService;

    public function __construct(ClipEmbeddingService $clipService)
    {
        $this->clipService = $clipService;
    }

    /**
     * Show the AI image search form
     */
    public function index()
    {
        return view('ai-search.index');
    }

    /**
     * Search for similar posts using uploaded image
     */
    public function search(Request $request)
    {
        $request->validate([
            'search_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'threshold' => 'nullable|numeric|min:0|max:1'
        ]);

        $threshold = $request->get('threshold', 0.8);

        try {
            // Generate embedding for the search image
            $searchEmbedding = $this->clipService->generateEmbedding($request->file('search_image'));
            
            if (!$searchEmbedding) {
                return back()->with('error', 'Failed to process the uploaded image. Please try again.');
            }

            Log::info('Generated search embedding', ['embedding_size' => count($searchEmbedding)]);

            // Find similar posts with pagination
            $similarPosts = $this->clipService->findSimilarPostsPaginated($searchEmbedding, $threshold, $request);

            Log::info('Found similar posts', ['count' => $similarPosts->total()]);

            // Store the search image temporarily for display
            $searchImagePath = $request->file('search_image')->store('temp/search', 'public');

            return view('ai-search.results', [
                'similarPosts' => $similarPosts,
                'searchImagePath' => $searchImagePath,
                'threshold' => $threshold,
                'totalFound' => $similarPosts->total()
            ]);

        } catch (\Exception $e) {
            Log::error('AI Image Search Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'An error occurred while searching. Please try again.');
        }
    }

    }