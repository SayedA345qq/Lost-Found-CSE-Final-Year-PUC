<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <?php echo e(__('Success Story')); ?>

            </h2>
            <a href="<?php echo e(route('success-stories.index')); ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Success Stories
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Success Banner -->
            <div class="bg-gradient-to-r from-green-400 to-blue-500 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-white text-center">
                    <div class="text-6xl mb-4">🎉</div>
                    <h1 class="text-3xl font-bold mb-2">Success Story</h1>
                    <p class="text-xl"><?php echo e($post->title); ?> has been reunited!</p>
                </div>
            </div>

            <!-- Story Details -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Post Header -->
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex space-x-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                       <?php echo e($post->type === 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'); ?>">
                                <?php echo e(ucfirst($post->type)); ?>

                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                <?php echo e(ucfirst($post->category)); ?>

                            </span>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            ✅ Resolved
                        </span>
                    </div>

                    <!-- Images -->
                    <?php if($post->images): ?>
                        <div class="mb-6">
                            <div class="relative">
                                <img src="<?php echo e(asset('storage/' . $post->images)); ?>" 
                                     alt="<?php echo e($post->title); ?>" 
                                     class="w-full max-h-96 object-contain rounded-lg bg-gray-50">
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Description -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Original Post</h3>
                        <p class="text-gray-700 whitespace-pre-line"><?php echo e($post->description); ?></p>
                    </div>

                    <!-- Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Location</h4>
                            <p class="text-gray-700 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <?php echo e($post->location); ?>

                            </p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Date <?php echo e($post->type === 'lost' ? 'Lost' : 'Found'); ?></h4>
                            <p class="text-gray-700 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v8a1 1 0 01-1 1H5a1 1 0 01-1-1V8a1 1 0 011-1h3z"></path>
                                </svg>
                                <?php echo e($post->date_lost_found->format('F d, Y')); ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Story Details -->
            <?php if($acceptedClaim || $acceptedFoundNotification): ?>
                <div class="bg-green-50 border border-green-200 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-green-900 mb-4">🎯 How It Was Resolved</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="bg-white p-4 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-2">Original Poster</h4>
                                <p class="text-gray-700"><?php echo e($post->user->name); ?></p>
                                <p class="text-sm text-gray-500">Posted <?php echo e($post->created_at->format('F d, Y')); ?></p>
                            </div>
                            <div class="bg-white p-4 rounded-lg">
                                <?php if($acceptedClaim): ?>
                                    <!-- Found item that was claimed -->
                                    <h4 class="font-semibold text-gray-900 mb-2">Claimer</h4>
                                    <p class="text-gray-700"><?php echo e($acceptedClaim->user->name); ?></p>
                                    <p class="text-sm text-gray-500">Claimed <?php echo e($acceptedClaim->created_at->format('F d, Y')); ?></p>
                                <?php elseif($acceptedFoundNotification): ?>
                                    <!-- Lost item that was found -->
                                    <h4 class="font-semibold text-gray-900 mb-2">Finder</h4>
                                    <p class="text-gray-700"><?php echo e($acceptedFoundNotification->finder->name); ?></p>
                                    <p class="text-sm text-gray-500">Found <?php echo e($acceptedFoundNotification->created_at->format('F d, Y')); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-900 mb-2">Resolution Details</h4>
                            <p class="text-gray-700">For privacy, message contents and contact information are not displayed.</p>
                        </div>

                        <div class="mt-6 p-4 bg-green-100 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="font-semibold text-green-900">Successfully Reunited!</p>
                                    <p class="text-green-700 text-sm">Resolved on <?php echo e($post->updated_at->format('F d, Y \a\t g:i A')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Timeline -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">📅 Timeline</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 text-sm font-bold">1</span>
                            </div>
                            <div class="ml-4">
                                <p class="font-medium text-gray-900">Item <?php echo e($post->type === 'lost' ? 'Lost' : 'Found'); ?></p>
                                <p class="text-sm text-gray-500"><?php echo e($post->date_lost_found->format('F d, Y')); ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                <span class="text-yellow-600 text-sm font-bold">2</span>
                            </div>
                            <div class="ml-4">
                                <p class="font-medium text-gray-900">Posted on <?php echo e(config('app.name')); ?></p>
                                <p class="text-sm text-gray-500"><?php echo e($post->created_at->format('F d, Y \a\t g:i A')); ?></p>
                            </div>
                        </div>

                        <?php if($acceptedClaim): ?>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                    <span class="text-purple-600 text-sm font-bold">3</span>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium text-gray-900">Claim Submitted</p>
                                    <p class="text-sm text-gray-500"><?php echo e($acceptedClaim->created_at->format('F d, Y \a\t g:i A')); ?></p>
                                </div>
                            </div>
                        <?php elseif($acceptedFoundNotification): ?>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                    <span class="text-orange-600 text-sm font-bold">3</span>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium text-gray-900">Found Notification Submitted</p>
                                    <p class="text-sm text-gray-500"><?php echo e($acceptedFoundNotification->created_at->format('F d, Y \a\t g:i A')); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <span class="text-green-600 text-sm font-bold">✓</span>
                            </div>
                            <div class="ml-4">
                                <p class="font-medium text-gray-900">Successfully Reunited!</p>
                                <p class="text-sm text-gray-500"><?php echo e($post->updated_at->format('F d, Y \a\t g:i A')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <?php if($post->comments->count() > 0): ?>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">💬 Community Comments</h3>
                        <div class="space-y-4">
                            <?php $__currentLoopData = $post->comments->where('is_flagged', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="border-l-4 border-gray-200 pl-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-medium"><?php echo e($comment->user->name); ?></p>
                                            <p class="text-sm text-gray-500"><?php echo e($comment->created_at->diffForHumans()); ?></p>
                                        </div>
                                    </div>
                                    <p class="text-gray-700 mt-2"><?php echo e($comment->message); ?></p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Call to Action -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
                <h3 class="text-lg font-semibold text-blue-900 mb-2">Inspired by this success story?</h3>
                <p class="text-blue-700 mb-4">Help create more happy endings by joining our community of helpers!</p>
                <div class="space-x-4">
                    <a href="<?php echo e(route('posts.index')); ?>" 
                       class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Browse Items
                    </a>
                    <a href="<?php echo e(route('success-stories.index')); ?>" 
                       class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        More Success Stories
                    </a>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH E:\Final_Project\resources\views/success-stories/show.blade.php ENDPATH**/ ?>