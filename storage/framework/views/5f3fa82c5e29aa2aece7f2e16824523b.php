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
                <?php echo e(__('Manage My Posts')); ?>

            </h2>
            <a href="<?php echo e(route('posts.create')); ?>" 
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create New Post
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
                        <form method="GET" action="<?php echo e(route('posts.my-posts')); ?>" class="flex-1 flex gap-2">
                            <div class="flex-1">
                                <input type="text" name="search" id="search" value="<?php echo e(request('search')); ?>" 
                                       placeholder="Search title, description, location..." 
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
                        <form method="GET" action="<?php echo e(route('posts.my-posts')); ?>" class="space-y-4">
                            <!-- Preserve search term -->
                            <input type="hidden" name="search" value="<?php echo e(request('search')); ?>">
                            
                            <!-- Filter Dropdowns Row -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                                <!-- Status Filter -->
                                <div class="relative">
                                    <select name="status" id="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-white">
                                        <option value="">All Status</option>
                                        <option value="active" <?php echo e(request('status') === 'active' ? 'selected' : ''); ?>>🟢 Active</option>
                                        <option value="resolved" <?php echo e(request('status') === 'resolved' ? 'selected' : ''); ?>>✅ Resolved</option>
                                    </select>
                                </div>

                                <!-- Type Filter -->
                                <div class="relative">
                                    <select name="type" id="type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-white">
                                        <option value="">All Types</option>
                                        <option value="lost" <?php echo e(request('type') === 'lost' ? 'selected' : ''); ?>>🔍 Lost</option>
                                        <option value="found" <?php echo e(request('type') === 'found' ? 'selected' : ''); ?>>✅ Found</option>
                                    </select>
                                </div>

                                <!-- Category Filter -->
                                <div class="relative">
                                    <select name="category" id="category" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-white">
                                        <option value="">All Categories</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category); ?>" <?php echo e(request('category') === $category ? 'selected' : ''); ?>>
                                                <?php switch($category):
                                                    case ('pet'): ?> 🐕 <?php break; ?>
                                                    <?php case ('person'): ?> 👤 <?php break; ?>
                                                    <?php case ('vehicle'): ?> 🚗 <?php break; ?>
                                                    <?php case ('electronics'): ?> 📱 <?php break; ?>
                                                    <?php case ('documents'): ?> 📄 <?php break; ?>
                                                    <?php case ('jewelry'): ?> 💍 <?php break; ?>
                                                    <?php case ('personal belongings'): ?> 🎒 <?php break; ?>
                                                    <?php default: ?> 📦 <?php break; ?>
                                                <?php endswitch; ?>
                                                <?php echo e(ucfirst($category)); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <!-- Sort -->
                                <div class="relative">
                                    <select name="sort" id="sort" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-white">
                                        <option value="latest" <?php echo e(request('sort') === 'latest' ? 'selected' : ''); ?>>⏰ Latest</option>
                                        <option value="oldest" <?php echo e(request('sort') === 'oldest' ? 'selected' : ''); ?>>📅 Oldest</option>
                                        <option value="title" <?php echo e(request('sort') === 'title' ? 'selected' : ''); ?>>🔤 Title</option>
                                        <option value="status" <?php echo e(request('sort') === 'status' ? 'selected' : ''); ?>>📊 Status</option>
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
                                <a href="<?php echo e(route('posts.my-posts')); ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
                                    Clear All
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Active Filters Display -->
                    <?php if(request()->hasAny(['status', 'type', 'category', 'sort'])): ?>
                        <div class="mt-4 pt-4 border-t">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="text-sm text-gray-600">Active filters:</span>
                                
                                <?php if(request('status')): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Status: <?php echo e(ucfirst(request('status'))); ?>

                                        <a href="<?php echo e(request()->fullUrlWithQuery(['status' => null])); ?>" class="ml-1 text-blue-600 hover:text-blue-800">×</a>
                                    </span>
                                <?php endif; ?>

                                <?php if(request('type')): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Type: <?php echo e(ucfirst(request('type'))); ?>

                                        <a href="<?php echo e(request()->fullUrlWithQuery(['type' => null])); ?>" class="ml-1 text-green-600 hover:text-green-800">×</a>
                                    </span>
                                <?php endif; ?>

                                <?php if(request('category')): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        Category: <?php echo e(ucfirst(request('category'))); ?>

                                        <a href="<?php echo e(request()->fullUrlWithQuery(['category' => null])); ?>" class="ml-1 text-purple-600 hover:text-purple-800">×</a>
                                    </span>
                                <?php endif; ?>

                                <?php if(request('sort') && request('sort') !== 'latest'): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Sort: <?php echo e(ucfirst(request('sort'))); ?>

                                        <a href="<?php echo e(request()->fullUrlWithQuery(['sort' => 'latest'])); ?>" class="ml-1 text-yellow-600 hover:text-yellow-800">×</a>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Posts Management -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <?php if($posts->count() > 0): ?>
                        <!-- Bulk Actions -->
                        <div class="mb-6 flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                <label class="flex items-center">
                                    <input type="checkbox" id="select-all" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-700">Select All</span>
                                </label>
                                <button type="button" 
                                        id="bulk-delete-btn" 
                                        onclick="handleBulkDelete()"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded disabled:opacity-50 disabled:cursor-not-allowed"
                                        disabled>
                                    Delete Selected
                                </button>
                                <span id="selected-count" class="text-sm text-gray-600">0 selected</span>
                            </div>
                            <div class="text-sm text-gray-600">
                                Total: <?php echo e($posts->total()); ?> posts
                            </div>
                        </div>

                        <!-- Posts List -->
                        <form id="bulk-delete-form" method="POST" action="<?php echo e(route('posts.bulk-delete')); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            
                            <div class="space-y-4">
                                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="border rounded-lg p-4 hover:bg-gray-50">
                                        <div class="flex items-start space-x-4">
                                            <!-- Checkbox -->
                                            <div class="flex-shrink-0 pt-1">
                                                <input type="checkbox" 
                                                       name="post_ids[]" 
                                                       value="<?php echo e($post->id); ?>" 
                                                       class="post-checkbox rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>

                                            <!-- Post Content -->
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center space-x-2 mb-2">
                                                    <h4 class="font-medium text-gray-900 truncate">
                                                        <a href="<?php echo e(route('posts.show', $post)); ?>" class="hover:text-blue-600">
                                                            <?php echo e($post->title); ?>

                                                        </a>
                                                    </h4>
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                                               <?php echo e($post->type === 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'); ?>">
                                                        <?php echo e(ucfirst($post->type)); ?>

                                                    </span>
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                                               <?php echo e($post->status === 'resolved' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'); ?>">
                                                        <?php echo e(ucfirst(str_replace('_', ' ', $post->status))); ?>

                                                    </span>
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                        <?php echo e(ucfirst($post->category)); ?>

                                                    </span>
                                                </div>
                                                
                                                <p class="text-sm text-gray-600 mb-2"><?php echo e(Str::limit($post->description, 150)); ?></p>
                                                
                                                <div class="flex items-center text-xs text-gray-500 space-x-4">
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        </svg>
                                                        <?php echo e($post->location); ?>

                                                    </span>
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        <?php echo e($post->created_at->diffForHumans()); ?>

                                                    </span>
                                                    <?php if($post->type === 'found'): ?>
                                                        <span class="flex items-center">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                                            </svg>
                                                            <?php echo e($post->claims->count()); ?> claims
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="flex items-center">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.828 7l6.586 6.586a2 2 0 002.828 0l6.586-6.586A2 2 0 0019.414 5H4.828a2 2 0 00-1.414 2z"></path>
                                                            </svg>
                                                            <?php echo e($post->foundNotifications ? $post->foundNotifications->count() : 0); ?> found notifications
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <!-- Actions -->
                                            <div class="flex-shrink-0 flex space-x-2">
                                                <a href="<?php echo e(route('posts.show', $post)); ?>" 
                                                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                    View
                                                </a>
                                                <a href="<?php echo e(route('posts.edit', $post)); ?>" 
                                                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                    Edit
                                                </a>
                                                <button type="button" 
                                                        onclick="confirmDeletePost(<?php echo e($post->id); ?>, '<?php echo e(addslashes($post->title)); ?>')"
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </form>

                        <!-- Pagination -->
                        <div class="mt-6">
                            <?php echo e($posts->appends(request()->query())->links()); ?>

                        </div>
                    <?php else: ?>
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.5-.816-6.207-2.175.168-.288.336-.576.504-.864C7.798 10.64 9.798 10 12 10s4.202.64 5.703 1.961c.168.288.336.576.504.864A7.962 7.962 0 0112 15z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No posts found</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                <?php if(request()->hasAny(['search', 'status', 'type', 'category'])): ?>
                                    Try adjusting your filters or <a href="<?php echo e(route('posts.my-posts')); ?>" class="text-blue-600 hover:text-blue-900">clear all filters</a>.
                                <?php else: ?>
                                    Get started by creating your first post.
                                <?php endif; ?>
                            </p>
                            <div class="mt-6">
                                <a href="<?php echo e(route('posts.create')); ?>" 
                                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Create Post
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
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
            <?php if(request()->hasAny(['status', 'type', 'category', 'sort'])): ?>
                filterPanel.classList.remove('hidden');
                filterChevron.style.transform = 'rotate(180deg)';
            <?php endif; ?>
        });

        // Select All functionality
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.post-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateBulkActions();
        });

        // Individual checkbox functionality
        document.querySelectorAll('.post-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateBulkActions);
        });

        function updateBulkActions() {
            const checkboxes = document.querySelectorAll('.post-checkbox');
            const checkedBoxes = document.querySelectorAll('.post-checkbox:checked');
            const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
            const selectedCount = document.getElementById('selected-count');
            const selectAll = document.getElementById('select-all');

            // Update selected count
            selectedCount.textContent = `${checkedBoxes.length} selected`;

            // Enable/disable bulk delete button
            bulkDeleteBtn.disabled = checkedBoxes.length === 0;

            // Update select all checkbox state
            if (checkedBoxes.length === 0) {
                selectAll.indeterminate = false;
                selectAll.checked = false;
            } else if (checkedBoxes.length === checkboxes.length) {
                selectAll.indeterminate = false;
                selectAll.checked = true;
            } else {
                selectAll.indeterminate = true;
                selectAll.checked = false;
            }
        }

        // Bulk delete functionality
        function handleBulkDelete() {
            const checkedBoxes = document.querySelectorAll('.post-checkbox:checked');
            if (checkedBoxes.length === 0) return;
            
            confirmBulkDelete(checkedBoxes.length);
        }
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
<?php endif; ?><?php /**PATH E:\Final_Project\resources\views/posts/my-posts.blade.php ENDPATH**/ ?>