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
                <?php echo e(__('My Claims')); ?>

            </h2>
            <a href="<?php echo e(route('claims.received')); ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Claims on My Posts
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Advanced Filter Dropdown -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <!-- Main Search Bar -->
                    <div class="flex flex-col lg:flex-row gap-4 items-start lg:items-center justify-between mb-4">
                        <form method="GET" action="<?php echo e(route('claims.index')); ?>" class="flex-1 flex gap-2">
                            <div class="flex-1">
                                <input type="text" name="search" id="search" value="<?php echo e($search); ?>" 
                                       placeholder="Search by post title or description..." 
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded whitespace-nowrap">
                                Search
                            </button>
                        </form>
                        
                        <!-- Filter Toggle Button -->
                        <button type="button" id="filterToggle" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-md border border-gray-300 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                            </svg>
                            Filters
                            <svg id="filterChevron" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Collapsible Filter Panel -->
                    <div id="filterPanel" class="hidden border-t pt-4">
                        <form method="GET" action="<?php echo e(route('claims.index')); ?>" class="space-y-4">
                            <!-- Preserve search term -->
                            <input type="hidden" name="search" value="<?php echo e($search); ?>">
                            
                            <!-- Filter Dropdowns Row -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <!-- Status Filter -->
                                <div class="relative">
                                    <select name="filter" id="filter" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-white">
                                        <option value="all" <?php echo e($filter === 'all' ? 'selected' : ''); ?>>📋 All Claims</option>
                                        <option value="pending" <?php echo e($filter === 'pending' ? 'selected' : ''); ?>>⏳ Pending</option>
                                        <option value="accepted" <?php echo e($filter === 'accepted' ? 'selected' : ''); ?>>✅ Accepted</option>
                                        <option value="rejected" <?php echo e($filter === 'rejected' ? 'selected' : ''); ?>>❌ Rejected</option>
                                    </select>
                                </div>

                                <!-- Sort -->
                                <div class="relative">
                                    <select name="sort" id="sort" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-white">
                                        <option value="latest" <?php echo e($sort === 'latest' ? 'selected' : ''); ?>>⏰ Latest First</option>
                                        <option value="oldest" <?php echo e($sort === 'oldest' ? 'selected' : ''); ?>>📅 Oldest First</option>
                                    </select>
                                </div>

                                <!-- Placeholder for alignment -->
                                <div></div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
                                    Apply Filters
                                </button>
                                <a href="<?php echo e(route('claims.index')); ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
                                    Clear All
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Active Filters Display -->
                    <?php if($search || $filter !== 'all' || $sort !== 'latest'): ?>
                        <div class="mt-4 pt-4 border-t">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="text-sm text-gray-600">Active filters:</span>
                                
                                <?php if($filter !== 'all'): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Status: <?php echo e(ucfirst($filter)); ?>

                                        <a href="<?php echo e(request()->fullUrlWithQuery(['filter' => 'all'])); ?>" class="ml-1 text-blue-600 hover:text-blue-800">×</a>
                                    </span>
                                <?php endif; ?>

                                <?php if($sort !== 'latest'): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Sort: <?php echo e(ucfirst($sort)); ?>

                                        <a href="<?php echo e(request()->fullUrlWithQuery(['sort' => 'latest'])); ?>" class="ml-1 text-green-600 hover:text-green-800">×</a>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if($claims->count() > 0): ?>
                <div class="space-y-6">
                    <?php $__currentLoopData = $claims; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $claim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                            <a href="<?php echo e(route('posts.show', $claim->post)); ?>" class="hover:text-blue-600">
                                                <?php echo e($claim->post->title); ?>

                                            </a>
                                        </h3>
                                        <div class="flex items-center space-x-4 text-sm text-gray-500 mb-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                       <?php echo e($claim->post->type === 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'); ?>">
                                                <?php echo e(ucfirst($claim->post->type)); ?>

                                            </span>
                                            <span><?php echo e(ucfirst($claim->post->category)); ?></span>
                                            <span><?php echo e($claim->post->location); ?></span>
                                        </div>
                                        <p class="text-gray-600 mb-3"><?php echo e(Str::limit($claim->message, 200)); ?></p>
                                        <?php if($claim->contact_info): ?>
                                            <p class="text-sm text-gray-500 mb-2">Contact: <?php echo e($claim->contact_info); ?></p>
                                        <?php endif; ?>
                                        <p class="text-sm text-gray-500">Submitted <?php echo e($claim->created_at->diffForHumans()); ?></p>
                                    </div>
                                    <div class="ml-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                                   <?php echo e($claim->status === 'accepted' ? 'bg-green-100 text-green-800' : 
                                                      ($claim->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')); ?>">
                                            <?php echo e(ucfirst($claim->status)); ?>

                                        </span>
                                    </div>
                                </div>

                                <?php if($claim->status === 'accepted'): ?>
                                    <div class="bg-green-50 border border-green-200 rounded-md p-4">
                                        <div class="flex">
                                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div class="ml-3">
                                                <p class="text-sm text-green-800">
                                                    Your claim has been accepted! You can now contact the post owner to arrange pickup/return.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php elseif($claim->status === 'rejected'): ?>
                                    <div class="bg-red-50 border border-red-200 rounded-md p-4">
                                        <div class="flex">
                                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div class="ml-3">
                                                <p class="text-sm text-red-800">
                                                    Your claim has been rejected by the post owner.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4">
                                        <div class="flex">
                                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div class="ml-3">
                                                <p class="text-sm text-yellow-800">
                                                    Your claim is pending review by the post owner.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    <?php echo e($claims->links()); ?>

                </div>
            <?php else: ?>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.5-.816-6.207-2.175.168-.288.336-.576.504-.864C7.798 10.64 9.798 10 12 10s4.202.64 5.703 1.961c.168.288.336.576.504.864A7.962 7.962 0 0112 15z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No claims yet</h3>
                        <p class="mt-1 text-sm text-gray-500">You haven't made any claims on found items yet.</p>
                        <div class="mt-6">
                            <a href="<?php echo e(route('posts.index', ['type' => 'found'])); ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Browse Found Items
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- JavaScript for Filter Toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterToggle = document.getElementById('filterToggle');
            const filterPanel = document.getElementById('filterPanel');
            const filterChevron = document.getElementById('filterChevron');

            filterToggle.addEventListener('click', function() {
                if (filterPanel.classList.contains('hidden')) {
                    filterPanel.classList.remove('hidden');
                    filterChevron.style.transform = 'rotate(180deg)';
                } else {
                    filterPanel.classList.add('hidden');
                    filterChevron.style.transform = 'rotate(0deg)';
                }
            });

            // Auto-expand if filters are active
            <?php if($search || $filter !== 'all' || $sort !== 'latest'): ?>
                filterPanel.classList.remove('hidden');
                filterChevron.style.transform = 'rotate(180deg)';
            <?php endif; ?>
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH E:\Final_Project\resources\views/claims/index.blade.php ENDPATH**/ ?>