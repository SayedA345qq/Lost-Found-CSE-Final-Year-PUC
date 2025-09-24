<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

// Include the existing LocalClipEmbeddingClient
require_once base_path('local_clip_api.php');

class ClipEmbeddingService
{
    private $clipClient;

    public function __construct()
    {
        $this->clipClient = new \LocalClipEmbeddingClient();
    }

    /**
     * Generate embedding for an uploaded file
     * 
     * @param UploadedFile $file
     * @return array|null
     */
    public function generateEmbedding(UploadedFile $file): ?array
    {
        if (!$file->isValid()) {
            Log::error('Invalid uploaded file for embedding generation');
            return null;
        }

        try {
            $result = $this->clipClient->generateEmbeddingFromUploadedFile($file);
            
            if ($result && $result['success'] && isset($result['embedding'])) {
                Log::info('Successfully generated embedding', [
                    'embedding_dim' => count($result['embedding']),
                    'model' => $result['model'] ?? 'unknown',
                    'device' => $result['device'] ?? 'unknown'
                ]);
                return $result['embedding'];
            }
            
            Log::error('Failed to generate embedding', ['result' => $result]);
            return null;
        } catch (\Exception $e) {
            Log::error('Exception during embedding generation', ['error' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Generate embedding for an image file path
     * 
     * @param string $imagePath
     * @return array
     */
    public function generateEmbeddingFromFile(string $imagePath): array
    {
        return $this->clipClient->generateEmbeddingFromFile($imagePath);
    }

    /**
     * Generate embedding from stored image path
     * 
     * @param string $storagePath
     * @return array|null
     */
    public function generateEmbeddingFromStoragePath(string $storagePath): ?array
    {
        $fullPath = storage_path('app/public/' . $storagePath);
        
        if (!file_exists($fullPath)) {
            Log::error('Stored image file not found', ['path' => $fullPath]);
            return null;
        }

        try {
            $result = $this->clipClient->generateEmbeddingFromFile($fullPath);
            
            if ($result && $result['success'] && isset($result['embedding'])) {
                Log::info('Successfully generated embedding from storage', [
                    'path' => $storagePath,
                    'embedding_dim' => count($result['embedding']),
                    'model' => $result['model'] ?? 'unknown',
                    'device' => $result['device'] ?? 'unknown'
                ]);
                return $result['embedding'];
            }
            
            Log::error('Failed to generate embedding from storage path', ['result' => $result]);
            return null;
        } catch (\Exception $e) {
            Log::error('Exception during embedding generation from storage', ['error' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Calculate cosine similarity between two embeddings
     * 
     * @param array $embedding1
     * @param array $embedding2
     * @return float
     */
    public function cosineSimilarity(array $embedding1, array $embedding2): float
    {
        if (count($embedding1) !== count($embedding2)) {
            throw new \InvalidArgumentException('Embeddings must have the same dimension');
        }

        $dotProduct = 0;
        $norm1 = 0;
        $norm2 = 0;

        for ($i = 0; $i < count($embedding1); $i++) {
            $dotProduct += $embedding1[$i] * $embedding2[$i];
            $norm1 += $embedding1[$i] * $embedding1[$i];
            $norm2 += $embedding2[$i] * $embedding2[$i];
        }

        $norm1 = sqrt($norm1);
        $norm2 = sqrt($norm2);

        if ($norm1 == 0 || $norm2 == 0) {
            return 0;
        }

        return $dotProduct / ($norm1 * $norm2);
    }

    
    /**
     * Find similar posts with pagination
     * 
     * @param array $queryEmbedding
     * @param float $threshold
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findSimilarPostsPaginated(array $queryEmbedding, float $threshold = 0.8, $request = null)
    {
        $posts = \App\Models\Post::whereNotNull('embeddings')
            ->where('images', '!=', null)
            ->with('user')
            ->get();

        $similarities = [];

        foreach ($posts as $post) {
            if ($post->embeddings) {
                $similarity = $this->cosineSimilarity($queryEmbedding, $post->embeddings);
                
                if ($similarity >= $threshold) {
                    $similarities[] = [
                        'post' => $post,
                        'similarity' => $similarity
                    ];
                }
            }
        }

        // Sort by similarity (highest first)
        usort($similarities, function ($a, $b) {
            return $b['similarity'] <=> $a['similarity'];
        });

        // Convert to collection
        $collection = collect($similarities);

        // Paginate results (15 per page like normal posts)
        $perPage = 15;
        $currentPage = $request ? $request->get('page', 1) : 1;
        $currentItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentItems,
            $collection->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request ? $request->url() : '',
                'pageName' => 'page',
            ]
        );

        // Append query parameters to pagination links
        if ($request) {
            $paginator->appends($request->query());
        }

        return $paginator;
    }
}