<?php

/**
 * Local CLIP Image Embedding API
 * 
 * This uses a local Python CLIP model instead of calling external APIs
 * Much more reliable and faster than remote APIs
 */

class LocalClipEmbeddingClient
{
    private $pythonScript;
    private $pythonCommand;

    public function __construct($pythonCommand = 'python')
    {
        $this->pythonScript = __DIR__ . '/local_clip.py';
        $this->pythonCommand = $pythonCommand;
    }

    /**
     * Generate embedding for an image file
     * 
     * @param string $imagePath Path to the image file
     * @return array API response
     */
    public function generateEmbeddingFromFile($imagePath)
    {
        if (!file_exists($imagePath)) {
            return [
                'success' => false,
                'error' => 'Image file not found: ' . $imagePath
            ];
        }

        // Call local Python CLIP script with --quiet flag for clean JSON output
        $command = "\"{$this->pythonCommand}\" \"{$this->pythonScript}\" --quiet \"$imagePath\"";
        $output = shell_exec($command . ' 2>&1');
        
        if ($output === null) {
            return [
                'success' => false,
                'error' => 'Failed to execute Python CLIP script'
            ];
        }
        
        // Parse JSON response
        $result = json_decode(trim($output), true);
        
        if ($result === null) {
            return [
                'success' => false,
                'error' => 'Failed to parse Python response',
                'raw_output' => $output
            ];
        }
        
        return $result;
    }

    /**
     * Generate embedding from base64 encoded image
     * 
     * @param string $base64Image Base64 encoded image
     * @return array API response
     */
    public function generateEmbeddingFromBase64($base64Image)
    {
        // Call local Python CLIP script with base64 data and --quiet flag
        $command = "\"{$this->pythonCommand}\" \"{$this->pythonScript}\" --quiet --base64 \"$base64Image\"";
        $output = shell_exec($command . ' 2>&1');
        
        if ($output === null) {
            return [
                'success' => false,
                'error' => 'Failed to execute Python CLIP script'
            ];
        }
        
        // Parse JSON response
        $result = json_decode(trim($output), true);
        
        if ($result === null) {
            return [
                'success' => false,
                'error' => 'Failed to parse Python response',
                'raw_output' => $output
            ];
        }
        
        return $result;
    }

    /**
     * Generate embedding from Laravel uploaded file
     * 
     * @param \Illuminate\Http\UploadedFile $uploadedFile Laravel uploaded file
     * @return array API response
     */
    public function generateEmbeddingFromUploadedFile($uploadedFile)
    {
        if (!$uploadedFile->isValid()) {
            return [
                'success' => false,
                'error' => 'Invalid uploaded file'
            ];
        }

        // Use the temporary file path
        return $this->generateEmbeddingFromFile($uploadedFile->getPathname());
    }

    /**
     * Check if the local CLIP setup is working
     */
    public function checkSetup()
    {
        echo "Checking local CLIP setup...\n";
        
        // Check Python
        $pythonCheck = shell_exec("\"{$this->pythonCommand}\" --version 2>&1");
        echo "Python version: " . trim($pythonCheck) . "\n";
        
        // Check required packages
        $packages = ['torch', 'clip', 'PIL', 'numpy'];
        $allInstalled = true;
        
        foreach ($packages as $package) {
            $checkCmd = "\"{$this->pythonCommand}\" -c \"import $package; print('$package: OK')\" 2>&1";
            $result = shell_exec($checkCmd);
            echo trim($result) . "\n";
            
            if (strpos($result, 'OK') === false) {
                $allInstalled = false;
            }
        }
        
        if (!$allInstalled) {
            echo "\nSome packages are missing!\n";
            echo "Install them with: pip install -r requirements_local.txt\n";
            return false;
        }
        
        echo "\nAll packages are installed!\n";
        return true;
    }
}

/**
 * Test the local CLIP embedding
 */
function testLocalClipEmbedding()
{
    $imagePath = 'E:\Final_Project\storage\app\public\posts\qX6IaBeaUkJfPUH0XUxKAXY2l7m8wNey1p1yfVSt.jpg';
    
    echo "=== Local CLIP Image Embedding Test ===\n";
    echo "Image Path: $imagePath\n\n";
    
    $client = new LocalClipEmbeddingClient();
    
    // Check setup first
    if (!$client->checkSetup()) {
        echo "Setup check failed. Please install required packages.\n";
        return;
    }
    
    echo "\n" . str_repeat("-", 50) . "\n";
    echo "Generating embedding...\n";
    echo str_repeat("-", 50) . "\n";
    
    $result = $client->generateEmbeddingFromFile($imagePath);
    
    echo "\n" . str_repeat("=", 60) . "\n";
    echo "FINAL RESULT:\n";
    echo str_repeat("=", 60) . "\n";
    
    if ($result['success']) {
        echo "SUCCESS!\n\n";
        echo "Embedding Dimension: " . $result['embedding_dim'] . "\n";
        echo "Model: " . $result['model'] . "\n";
        echo "Device: " . $result['device'] . "\n";
        echo "Message: " . $result['message'] . "\n";
        
        echo "\nFirst 10 embedding values:\n";
        $firstTen = array_slice($result['embedding'], 0, 10);
        echo json_encode($firstTen, JSON_PRETTY_PRINT) . "\n";
        
        echo "\nEmbedding statistics:\n";
        $embedding = $result['embedding'];
        echo "Min value: " . min($embedding) . "\n";
        echo "Max value: " . max($embedding) . "\n";
        echo "Mean value: " . (array_sum($embedding) / count($embedding)) . "\n";
        
        // Save embedding to file for later use
        $embeddingFile = 'embedding_' . time() . '.json';
        file_put_contents($embeddingFile, json_encode($result, JSON_PRETTY_PRINT));
        echo "\nEmbedding saved to: $embeddingFile\n";
        
    } else {
        echo "FAILED!\n\n";
        echo "Error: " . $result['error'] . "\n";
        if (isset($result['raw_output'])) {
            echo "\nRaw output:\n" . $result['raw_output'] . "\n";
        }
    }
}

// Only run the test if this file is executed directly from command line
if (php_sapi_name() === 'cli' && isset($argv) && basename($argv[0]) === 'local_clip_api.php') {
    testLocalClipEmbedding();
}

?>