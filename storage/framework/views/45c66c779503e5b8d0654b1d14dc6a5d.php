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
                <?php echo e(__('Notifications')); ?>

            </h2>
            <div class="flex space-x-2">
                <?php if(auth()->user()->unreadNotifications->count() > 0): ?>
                    <form method="POST" action="<?php echo e(route('notifications.mark-all-read')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                            Mark All as Read
                        </button>
                    </form>
                <?php endif; ?>
                
                <?php if(auth()->user()->notifications->count() > 0): ?>
                    <form method="POST" action="<?php echo e(route('notifications.clear-all')); ?>" onsubmit="return false;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="button" 
                                onclick="confirmClearAllNotifications(this.form)"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-sm">
                            Clear All
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Advanced Filter Dropdown -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <!-- Filter Toggle Button -->
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Filter Notifications</h3>
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
                        <form method="GET" action="<?php echo e(route('notifications.index')); ?>" class="space-y-4">
                            <!-- Filter Dropdowns Row -->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <!-- Filter by Read Status -->
                                <div class="relative">
                                    <select name="filter" id="filter" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-white">
                                        <option value="all" <?php echo e($filter === 'all' ? 'selected' : ''); ?>>📧 All Notifications</option>
                                        <option value="unread" <?php echo e($filter === 'unread' ? 'selected' : ''); ?>>🔴 Unread Only</option>
                                        <option value="read" <?php echo e($filter === 'read' ? 'selected' : ''); ?>>✅ Read Only</option>
                                    </select>
                                </div>

                                <!-- Filter by Type -->
                                <div class="relative">
                                    <select name="type" id="type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-white">
                                        <option value="all" <?php echo e($type === 'all' ? 'selected' : ''); ?>>📋 All Types</option>
                                        <option value="found" <?php echo e($type === 'found' ? 'selected' : ''); ?>>🔍 Found Items</option>
                                        <option value="claim" <?php echo e($type === 'claim' ? 'selected' : ''); ?>>✋ Claims</option>
                                        <option value="missing_person" <?php echo e($type === 'missing_person' ? 'selected' : ''); ?>>🚨 Missing Person Alerts</option>
                                    </select>
                                </div>

                                <!-- Sort -->
                                <div class="relative">
                                    <select name="sort" id="sort" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-white">
                                        <option value="latest" <?php echo e($sort === 'latest' ? 'selected' : ''); ?>>⏰ Latest First</option>
                                        <option value="oldest" <?php echo e($sort === 'oldest' ? 'selected' : ''); ?>>📅 Oldest First</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
                                    Apply Filters
                                </button>
                                <a href="<?php echo e(route('notifications.index')); ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
                                    Clear All
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Active Filters Display -->
                    <?php if($filter !== 'all' || $type !== 'all' || $sort !== 'latest'): ?>
                        <div class="mt-4 pt-4 border-t">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="text-sm text-gray-600">Active filters:</span>
                                
                                <?php if($filter !== 'all'): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Status: <?php echo e(ucfirst($filter)); ?>

                                        <a href="<?php echo e(request()->fullUrlWithQuery(['filter' => 'all'])); ?>" class="ml-1 text-blue-600 hover:text-blue-800">×</a>
                                    </span>
                                <?php endif; ?>

                                <?php if($type !== 'all'): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Type: <?php echo e(str_replace('_', ' ', ucfirst($type))); ?>

                                        <a href="<?php echo e(request()->fullUrlWithQuery(['type' => 'all'])); ?>" class="ml-1 text-green-600 hover:text-green-800">×</a>
                                    </span>
                                <?php endif; ?>

                                <?php if($sort !== 'latest'): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        Sort: <?php echo e(ucfirst($sort)); ?>

                                        <a href="<?php echo e(request()->fullUrlWithQuery(['sort' => 'latest'])); ?>" class="ml-1 text-purple-600 hover:text-purple-800">×</a>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if($notifications->count() > 0): ?>
                <div class="space-y-4">
                    <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg <?php echo e($notification->read_at ? 'opacity-75' : 'border-l-4 border-blue-500'); ?>">
                            <div class="p-6">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <?php if($notification->type === 'App\Notifications\NewFoundNotification'): ?>
                                            <div class="flex items-center mb-2">
                                                <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                                </svg>
                                                <h3 class="text-lg font-semibold text-gray-900">Item Found!</h3>
                                                <?php if(!$notification->read_at): ?>
                                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                        New
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <p class="text-gray-700 mb-2">
                                                Your "<strong><?php echo e($notification->data['post_title']); ?></strong>" was found by 
                                                <strong><?php echo e($notification->data['finder_name']); ?></strong>
                                            </p>
                                            <p class="text-gray-600 text-sm mb-2">
                                                <strong>Found at:</strong> <?php echo e($notification->data['found_location']); ?>

                                            </p>
                                            <p class="text-gray-600 text-sm mb-2">
                                                <strong>Contact:</strong> <?php echo e($notification->data['contact_info']); ?>

                                            </p>
                                            <p class="text-gray-600 text-sm mb-3 italic">
                                                "<?php echo e($notification->data['message_preview']); ?>"
                                            </p>
                                        <?php elseif($notification->type === 'App\Notifications\NewClaimNotification'): ?>
                                            <div class="flex items-center mb-2">
                                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <h3 class="text-lg font-semibold text-gray-900">New Claim</h3>
                                                <?php if(!$notification->read_at): ?>
                                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        New
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <?php if(isset($notification->data['type']) && $notification->data['type'] === 'claim_accepted'): ?>
                                                <p class="text-gray-700 mb-2">
                                                    Great news! Your claim for "<strong><?php echo e($notification->data['post_title']); ?></strong>" has been accepted by 
                                                    <strong><?php echo e($notification->data['poster_name']); ?></strong>
                                                </p>
                                                <p class="text-gray-600 text-sm mb-3">
                                                    You can now coordinate with the owner to retrieve the item.
                                                </p>
                                            <?php elseif(isset($notification->data['type']) && $notification->data['type'] === 'claim_rejected'): ?>
                                                <p class="text-gray-700 mb-2">
                                                    Your claim for "<strong><?php echo e($notification->data['post_title']); ?></strong>" has been rejected by 
                                                    <strong><?php echo e($notification->data['poster_name']); ?></strong>
                                                </p>
                                                <p class="text-gray-600 text-sm mb-3">
                                                    Don't worry! You can continue searching for other items.
                                                </p>
                                            <?php else: ?>
                                                <p class="text-gray-700 mb-2">
                                                    <strong><?php echo e($notification->data['claimer_name'] ?? 'Someone'); ?></strong> claimed your 
                                                    "<strong><?php echo e($notification->data['post_title']); ?></strong>"
                                                </p>
                                                <?php if(isset($notification->data['contact_info']) && $notification->data['contact_info']): ?>
                                                    <p class="text-gray-600 text-sm mb-2">
                                                        <strong>Contact:</strong> <?php echo e($notification->data['contact_info']); ?>

                                                    </p>
                                                <?php endif; ?>
                                                <?php if(isset($notification->data['message_preview'])): ?>
                                                    <p class="text-gray-600 text-sm mb-3 italic">
                                                        "<?php echo e($notification->data['message_preview']); ?>"
                                                    </p>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php elseif($notification->type === 'App\Notifications\MissingPersonNotification'): ?>
                                            <?php if(isset($notification->data['alert_type']) && $notification->data['alert_type'] === 'found'): ?>
                                                <div class="flex items-center mb-2">
                                                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <h3 class="text-lg font-semibold text-gray-900">🎉 Missing Person Found!</h3>
                                                    <?php if(!$notification->read_at): ?>
                                                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            New
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <p class="text-gray-700 mb-2">
                                                    Great news! <strong><?php echo e($notification->data['person_name']); ?></strong> has been found!
                                                </p>
                                                <p class="text-gray-600 text-sm mb-2">
                                                    <strong>Found at:</strong> <?php echo e($notification->data['location']); ?>

                                                </p>
                                                <p class="text-gray-600 text-sm mb-3">
                                                    <strong>Date:</strong> <?php echo e($notification->data['date']); ?>

                                                </p>
                                            <?php else: ?>
                                                <div class="flex items-center mb-2">
                                                    <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                    </svg>
                                                    <h3 class="text-lg font-semibold text-gray-900">🚨 Missing Person Alert</h3>
                                                    <?php if(!$notification->read_at): ?>
                                                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                            URGENT
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <p class="text-gray-700 mb-2">
                                                    <strong><?php echo e($notification->data['person_name']); ?></strong> is missing and needs your help.
                                                </p>
                                                <p class="text-gray-600 text-sm mb-2">
                                                    <strong>Last seen at:</strong> <?php echo e($notification->data['location']); ?>

                                                </p>
                                                <p class="text-gray-600 text-sm mb-3">
                                                    <strong>Date missing:</strong> <?php echo e($notification->data['date']); ?>

                                                </p>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <div class="flex items-center mb-2">
                                                <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM9 7H4l5-5v5zm6 10V7a1 1 0 00-1-1H5a1 1 0 00-1 1v10a1 1 0 001-1z"></path>
                                                </svg>
                                                <h3 class="text-lg font-semibold text-gray-900">Notification</h3>
                                                <?php if(!$notification->read_at): ?>
                                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        New
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <p class="text-gray-700 mb-2">
                                                You have a new notification
                                            </p>
                                        <?php endif; ?>
                                        
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs text-gray-500">
                                                <?php echo e($notification->created_at->diffForHumans()); ?>

                                            </span>
                                            
                                            <?php if(!$notification->read_at && isset($notification->data['action_url'])): ?>
                                                <form method="POST" action="<?php echo e(route('notifications.read', $notification->id)); ?>" class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                        <?php if($notification->type === 'App\Notifications\NewFoundNotification'): ?>
                                                            View Item
                                                        <?php elseif($notification->type === 'App\Notifications\NewClaimNotification'): ?>
                                                            View Claim
                                                        <?php elseif($notification->type === 'App\Notifications\MissingPersonNotification'): ?>
                                                            View Details
                                                        <?php else: ?>
                                                            View
                                                        <?php endif; ?>
                                                    </button>
                                                </form>
                                            <?php elseif(isset($notification->data['action_url'])): ?>
                                                <a href="<?php echo e($notification->data['action_url']); ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                    <?php if($notification->type === 'App\Notifications\NewFoundNotification'): ?>
                                                        View Item
                                                    <?php elseif($notification->type === 'App\Notifications\NewClaimNotification'): ?>
                                                        View Claim
                                                    <?php elseif($notification->type === 'App\Notifications\MissingPersonNotification'): ?>
                                                        View Details
                                                    <?php else: ?>
                                                        View
                                                    <?php endif; ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    <?php echo e($notifications->links()); ?>

                </div>
            <?php else: ?>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                         <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No notifications</h3>
                        <p class="mt-1 text-gray-500">You're all caught up! No new notifications.</p>
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
            <?php if($filter !== 'all' || $type !== 'all' || $sort !== 'latest'): ?>
                filterPanel.classList.remove('hidden');
                filterChevron.style.transform = 'rotate(180deg)';
            <?php endif; ?>
        });

        function confirmClearAllNotifications(form) {
            confirmationSystem.showConfirmation({
                title: 'Clear All Notifications',
                message: 'Are you sure you want to clear all your notifications? This action cannot be undone.',
                confirmText: 'Clear All',
                confirmClass: 'bg-red-500 hover:bg-red-700',
                icon: 'warning',
                onConfirm: () => {
                    form.submit();
                }
            });
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
<?php endif; ?><?php /**PATH E:\Final_Project\resources\views/notifications/index.blade.php ENDPATH**/ ?>