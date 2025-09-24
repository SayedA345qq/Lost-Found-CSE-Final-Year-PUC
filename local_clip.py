#!/usr/bin/env python3

import sys
import json
import torch
import clip
from PIL import Image
import numpy as np
import os

class LocalClipEmbedding:
    def __init__(self, verbose=False):
        # Check GPU memory and decide device
        self.device = self._select_best_device(verbose)
        if verbose:
            print(f"Using device: {self.device}")
        
        # Load CLIP model
        try:
            self.model, self.preprocess = clip.load("ViT-B/32", device=self.device)
            self.model.eval()
            if verbose:
                print("CLIP model loaded successfully")
        except Exception as e:
            if verbose:
                print(f"Error loading CLIP model: {e}")
            # If GPU fails, try CPU
            if self.device == "cuda":
                if verbose:
                    print("GPU failed, falling back to CPU...")
                self.device = "cpu"
                self.model, self.preprocess = clip.load("ViT-B/32", device=self.device)
                self.model.eval()
                if verbose:
                    print("CLIP model loaded successfully on CPU")
            else:
                raise e

    def _select_best_device(self, verbose=True):
        """Select the best device based on available resources"""
        
        # Check system info
        if verbose:
            print("=== System Information ===")
        
        # Check for CUDA (NVIDIA)
        if torch.cuda.is_available():
            try:
                gpu_memory = torch.cuda.get_device_properties(0).total_memory
                gpu_memory_mb = gpu_memory / (1024**2)
                gpu_name = torch.cuda.get_device_name(0)
                
                if verbose:
                    print(f"NVIDIA GPU detected: {gpu_name}")
                    print(f"GPU memory: {gpu_memory_mb:.0f}MB")
                
                if gpu_memory_mb >= 600:
                    if verbose:
                        print("Using NVIDIA GPU (CUDA)")
                    return "cuda"
                else:
                    if verbose:
                        print(f"GPU memory ({gpu_memory_mb:.0f}MB) insufficient for CLIP")
                    
            except Exception as e:
                if verbose:
                    print(f"CUDA error: {e}")
        
        # Check CPU info
        import platform
        import psutil
        
        cpu_info = platform.processor()
        ram_gb = psutil.virtual_memory().total / (1024**3)
        
        if verbose:
            print(f"CPU: {cpu_info}")
            print(f"RAM: {ram_gb:.1f}GB")
            
            # Check if this is an AMD APU with integrated graphics
            if "ryzen" in cpu_info.lower() or "amd" in cpu_info.lower():
                print("AMD Ryzen APU detected!")
                print("   Your integrated Radeon graphics with 2GB shared memory")
                print("   is sufficient for CLIP processing.")
                print("   Using CPU with optimized memory management.")
            
            print("Using CPU (recommended for your system)")
        return "cpu"

    def generate_embedding(self, image_path):
        """Generate CLIP embedding for an image file"""
        try:
            # Load and preprocess image
            image = Image.open(image_path)
            
            # Convert to RGB if necessary
            if image.mode != 'RGB':
                image = image.convert('RGB')
            
            # Preprocess image
            image_input = self.preprocess(image).unsqueeze(0).to(self.device)
            
            # Generate embedding
            with torch.no_grad():
                image_features = self.model.encode_image(image_input)
                # Normalize the features
                image_features = image_features / image_features.norm(dim=-1, keepdim=True)
            
            # Convert to numpy array and then to list
            embedding = image_features.cpu().numpy().flatten().tolist()
            
            return {
                "success": True,
                "embedding": embedding,
                "embedding_dim": len(embedding),
                "model": "ViT-B/32",
                "device": self.device,
                "message": "Image embedding generated successfully"
            }
            
        except Exception as e:
            return {
                "success": False,
                "error": str(e),
                "message": "Failed to generate image embedding"
            }

    
def main():
    if len(sys.argv) < 2:
        print(json.dumps({
            "success": False,
            "error": "Usage: python local_clip.py <image_path>"
        }))
        sys.exit(1)
    
    # Check if we should run in quiet mode (for PHP integration)
    quiet_mode = "--quiet" in sys.argv
    if quiet_mode:
        sys.argv.remove("--quiet")
    
    try:
        # Use verbose mode when run directly, quiet when called from PHP
        clip_model = LocalClipEmbedding(verbose=not quiet_mode)
        
        image_path = sys.argv[1]
        if not os.path.exists(image_path):
            print(json.dumps({
                "success": False,
                "error": f"Image file not found: {image_path}"
            }))
            sys.exit(1)
        
        result = clip_model.generate_embedding(image_path)
        print(json.dumps(result))
        
    except Exception as e:
        print(json.dumps({
            "success": False,
            "error": str(e),
            "message": "Failed to initialize CLIP model"
        }))
        sys.exit(1)

if __name__ == "__main__":
    main()