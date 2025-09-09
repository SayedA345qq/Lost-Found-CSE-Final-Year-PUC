<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        
        <!-- Session Messages for JavaScript -->
        <?php if(session('success')): ?>
            <meta name="success-message" content="<?php echo e(session('success')); ?>">
        <?php endif; ?>
        <?php if(session('error')): ?>
            <meta name="error-message" content="<?php echo e(session('error')); ?>">
        <?php endif; ?>

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="<?php echo e(asset('favicon.svg')); ?>">
        <link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        
        <!-- Confirmation System -->
        <script src="<?php echo e(asset('js/confirmations.js')); ?>"></script>
        
        <!-- Real-time notification script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const badge = document.getElementById('unread-badge');
                if (badge) {
                    const updateUrl = badge.dataset.url;
                    
                    function updateNotificationCount() {
                        fetch(updateUrl)
                            .then(response => response.json())
                            .then(data => {
                                badge.textContent = data.count;
                                badge.style.display = data.count > 0 ? 'inline-flex' : 'none';
                            })
                            .catch(error => console.error('Error updating notification count:', error));
                    }
                    
                    // Update every 30 seconds
                    setInterval(updateNotificationCount, 30000);
                    
                    // Initial update
                    updateNotificationCount();
                }

                // Flash message toast system
                function showToast(message, type = 'success') {
                    const toast = document.createElement('div');
                    toast.className = `fixed top-4 right-4 z-50 max-w-sm w-full bg-white border-l-4 ${type === 'success' ? 'border-green-400' : 'border-red-400'} rounded-lg shadow-lg transform transition-all duration-300 translate-x-full`;
                    
                    toast.innerHTML = `
                        <div class="flex items-center p-4">
                            <div class="flex-shrink-0">
                                ${type === 'success' ? 
                                    '<svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>' :
                                    '<svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>'
                                }
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-medium text-gray-900">${message}</p>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <button class="inline-flex text-gray-400 hover:text-gray-600 focus:outline-none" onclick="this.parentElement.parentElement.parentElement.remove()">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    `;
                    
                    document.body.appendChild(toast);
                    
                    // Slide in
                    setTimeout(() => {
                        toast.classList.remove('translate-x-full');
                    }, 100);
                    
                    // Auto remove after 5 seconds
                    setTimeout(() => {
                        toast.classList.add('translate-x-full');
                        setTimeout(() => {
                            if (toast.parentNode) {
                                toast.parentNode.removeChild(toast);
                            }
                        }, 300);
                    }, 5000);
                }

                // Check for flash messages in meta tags
                const successMessage = document.querySelector('meta[name="success-message"]');
                const errorMessage = document.querySelector('meta[name="error-message"]');
                
                if (successMessage) {
                    showToast(successMessage.getAttribute('content'), 'success');
                }
                
                if (errorMessage) {
                    showToast(errorMessage.getAttribute('content'), 'error');
                }
            });
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Page Heading -->
            <?php if(isset($header)): ?>
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <?php echo e($header); ?>

                    </div>
                </header>
            <?php endif; ?>

            <!-- Page Content -->
            <main>
                <?php echo e($slot); ?>

            </main>
            
            <!-- Global Confirmation Modal -->
            <?php if (isset($component)) { $__componentOriginal5b8b2d0f151a30be878e1a760ec3900c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5b8b2d0f151a30be878e1a760ec3900c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.confirmation-modal','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('confirmation-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5b8b2d0f151a30be878e1a760ec3900c)): ?>
<?php $attributes = $__attributesOriginal5b8b2d0f151a30be878e1a760ec3900c; ?>
<?php unset($__attributesOriginal5b8b2d0f151a30be878e1a760ec3900c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5b8b2d0f151a30be878e1a760ec3900c)): ?>
<?php $component = $__componentOriginal5b8b2d0f151a30be878e1a760ec3900c; ?>
<?php unset($__componentOriginal5b8b2d0f151a30be878e1a760ec3900c); ?>
<?php endif; ?>
        </div>
    </body>
</html><?php /**PATH E:\Final_Project\resources\views/layouts/app.blade.php ENDPATH**/ ?>