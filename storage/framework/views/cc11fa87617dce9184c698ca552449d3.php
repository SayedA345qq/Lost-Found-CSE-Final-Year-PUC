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
                <?php echo e($post->title); ?>

            </h2>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $post)): ?>
                <div class="flex space-x-2">
                    <a href="<?php echo e(route('posts.edit', $post)); ?>" 
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit
                    </a>
                    <button type="button" 
                            onclick="confirmDeletePost(<?php echo e($post->id); ?>, '<?php echo e(addslashes($post->title)); ?>')"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Delete
                    </button>
                </div>
            <?php endif; ?>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Post Details -->
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
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                   <?php echo e($post->status === 'resolved' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'); ?>">
                            <?php echo e(ucfirst(str_replace('_', ' ', $post->status))); ?>

                        </span>
                    </div>

                    <!-- Images -->
                    <?php if($post->images): ?>
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Image</h3>
                            <div class="relative">
                                <img src="<?php echo e(url('storage/' . $post->images)); ?>" 
                                     alt="<?php echo e($post->title); ?>" 
                                     class="w-full max-h-96 object-contain rounded-lg cursor-pointer bg-gray-50"
                                     onclick="openImageModal('<?php echo e(url('storage/' . $post->images)); ?>')"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500" style="display: none;">
                                    <div class="text-center">
                                        <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="text-sm">Image not available</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Description -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
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

                    <!-- Posted By -->
                    <div class="border-t pt-4">
                        <p class="text-sm text-gray-500">
                            Posted by <span class="font-medium"><?php echo e($post->user->name); ?></span> 
                            on <?php echo e($post->created_at->format('F d, Y \a\t g:i A')); ?>

                        </p>
                    </div>
                </div>
            </div>

            <!-- Status Update (for post owner) -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $post)): ?>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Update Status</h3>
                        <form method="POST" action="<?php echo e(route('posts.update-status', $post)); ?>" class="flex items-center space-x-4" onsubmit="return false;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <select name="status" id="statusSelect" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="active" <?php echo e($post->status === 'active' ? 'selected' : ''); ?>>Active</option>
                                <option value="resolved" <?php echo e($post->status === 'resolved' ? 'selected' : ''); ?>>Resolved</option>
                            </select>
                            <button type="button" 
                                    onclick="confirmStatusUpdate(this.form, '<?php echo e(addslashes($post->title)); ?>', document.getElementById('statusSelect').value)"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Status
                            </button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Action Buttons -->
            <?php if(auth()->guard()->check()): ?>
                <?php if($post->user_id !== auth()->id()): ?>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex flex-wrap gap-4">
                                <!-- Claim Button (only for found items) -->
                                <?php if($post->type === 'found' && $post->status === 'active'): ?>
                                    <button onclick="openClaimModal()" 
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        Claim
                                    </button>
                                <?php endif; ?>

                                <!-- Found Notification Button (only for lost items) -->
                                <?php if($post->type === 'lost' && $post->status === 'active'): ?>
                                    <button onclick="openFoundModal()" 
                                            class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                                        Found
                                    </button>
                                <?php endif; ?>

                                <!-- Message Button -->
                                <a href="<?php echo e(route('messages.create', $post)); ?>" 
                                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Send Message
                                </a>

                                <!-- Report Button -->
                                <a href="<?php echo e(route('reports.create', ['type' => 'post', 'id' => $post->id])); ?>" 
                                   class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Report
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Claims (for post owner of found items) -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $post)): ?>
                <?php if($post->type === 'found' && $post->claims->count() > 0): ?>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Claims (<?php echo e($post->claims->count()); ?>)</h3>
                            <div class="space-y-4">
                                <?php $__currentLoopData = $post->claims; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $claim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="border rounded-lg p-4">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <p class="font-medium"><?php echo e($claim->user->name); ?></p>
                                                <p class="text-sm text-gray-500"><?php echo e($claim->created_at->diffForHumans()); ?></p>
                                            </div>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                       <?php echo e($claim->status === 'accepted' ? 'bg-green-100 text-green-800' : 
                                                          ($claim->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')); ?>">
                                                <?php echo e(ucfirst($claim->status)); ?>

                                            </span>
                                        </div>
                                        <p class="text-gray-700 mb-3"><?php echo e($claim->message); ?></p>
                                        <?php if($claim->contact_info): ?>
                                            <p class="text-sm text-gray-600 mb-3">Contact: <?php echo e($claim->contact_info); ?></p>
                                        <?php endif; ?>
                                        <?php if($claim->status === 'pending'): ?>
                                            <div class="flex space-x-2">
                                                <form method="POST" action="<?php echo e(route('claims.accept', $claim)); ?>" onsubmit="return false;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PATCH'); ?>
                                                    <button type="button" 
                                                            onclick="confirmClaimResponse(this.form, 'accept', '<?php echo e(addslashes($claim->user->name)); ?>')"
                                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                        Accept
                                                    </button>
                                                </form>
                                                <form method="POST" action="<?php echo e(route('claims.reject', $claim)); ?>" onsubmit="return false;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PATCH'); ?>
                                                    <button type="button" 
                                                            onclick="confirmClaimResponse(this.form, 'reject', '<?php echo e(addslashes($claim->user->name)); ?>')"
                                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                        Reject
                                                    </button>
                                                </form>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Found Notifications (for post owner of lost items) -->
                <?php if($post->type === 'lost' && $post->foundNotifications && $post->foundNotifications->count() > 0): ?>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Found Notifications (<?php echo e($post->foundNotifications->count()); ?>)</h3>
                            <div class="space-y-4">
                                <?php $__currentLoopData = $post->foundNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foundNotification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="border rounded-lg p-4">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <p class="font-medium"><?php echo e($foundNotification->finder->name); ?></p>
                                                <p class="text-sm text-gray-500"><?php echo e($foundNotification->created_at->diffForHumans()); ?></p>
                                            </div>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                       <?php echo e($foundNotification->status === 'accepted' ? 'bg-green-100 text-green-800' : 
                                                          ($foundNotification->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-orange-100 text-orange-800')); ?>">
                                                <?php echo e(ucfirst($foundNotification->status)); ?>

                                            </span>
                                        </div>
                                        <p class="text-gray-700 mb-3"><?php echo e($foundNotification->message); ?></p>
                                        <p class="text-sm text-gray-600 mb-2"><strong>Found at:</strong> <?php echo e($foundNotification->found_location); ?></p>
                                        <p class="text-sm text-gray-600 mb-3"><strong>Contact:</strong> <?php echo e($foundNotification->contact_info); ?></p>
                                        <?php if($foundNotification->status === 'pending'): ?>
                                            <div class="flex space-x-2">
                                                <form method="POST" action="<?php echo e(route('found-notifications.accept', $foundNotification)); ?>" onsubmit="return false;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PATCH'); ?>
                                                    <button type="button" 
                                                            onclick="confirmClaimResponse(this.form, 'accept', '<?php echo e(addslashes($foundNotification->finder->name)); ?>')"
                                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                        Accept
                                                    </button>
                                                </form>
                                                <form method="POST" action="<?php echo e(route('found-notifications.reject', $foundNotification)); ?>" onsubmit="return false;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PATCH'); ?>
                                                    <button type="button" 
                                                            onclick="confirmClaimResponse(this.form, 'reject', '<?php echo e(addslashes($foundNotification->finder->name)); ?>')"
                                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                        Reject
                                                    </button>
                                                </form>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Comments -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Comments (<?php echo e($post->comments->count()); ?>)</h3>
                    
                    <!-- Add Comment Form -->
                    <?php if(auth()->guard()->check()): ?>
                        <form method="POST" action="<?php echo e(route('comments.store', $post)); ?>" class="mb-6">
                            <?php echo csrf_field(); ?>
                            <div class="flex space-x-4">
                                <textarea name="message" rows="3" placeholder="Add a comment..." required
                                          class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Post
                                </button>
                            </div>
                        </form>
                    <?php endif; ?>

                    <!-- Comments List -->
                    <?php if($post->comments->count() > 0): ?>
                        <div class="space-y-4">
                            <?php $__currentLoopData = $post->comments->where('is_flagged', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="border-l-4 border-gray-200 pl-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-medium"><?php echo e($comment->user->name); ?></p>
                                            <p class="text-sm text-gray-500"><?php echo e($comment->created_at->diffForHumans()); ?></p>
                                        </div>
                                        <?php if(auth()->check() && (auth()->id() === $comment->user_id || auth()->id() === $post->user_id)): ?>
                                            <form method="POST" action="<?php echo e(route('comments.destroy', $comment)); ?>" onsubmit="return false;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="button" 
                                                        onclick="confirmDeleteComment(this.form)"
                                                        class="text-red-600 hover:text-red-900 text-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-gray-700 mt-2"><?php echo e($comment->message); ?></p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-500">No comments yet. Be the first to comment!</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Claim Modal (for found items) -->
    <?php if($post->type === 'found' && $post->status === 'active' && auth()->check() && $post->user_id !== auth()->id()): ?>
        <div id="claimModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Claim</h3>
                    <form method="POST" action="<?php echo e(route('claims.store', $post)); ?>" onsubmit="return false;">
                        <?php echo csrf_field(); ?>
                        <div class="mb-4">
                            <label for="claim_message" class="block text-sm font-medium text-gray-700">Why is this yours?</label>
                            <textarea name="message" id="claim_message" rows="4" required
                                      placeholder="Describe why you believe this item belongs to you..."
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="contact_info" class="block text-sm font-medium text-gray-700">Contact Info *</label>
                            <input type="text" name="contact_info" id="contact_info" required
                                   placeholder="Phone number or email to reach you"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeClaimModal()" 
                                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </button>
                            <button type="button" 
                                    onclick="confirmClaim(this.form, '<?php echo e(addslashes($post->title)); ?>')"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Submit Claim
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Found Modal (for lost items) -->
    <?php if($post->type === 'lost' && $post->status === 'active' && auth()->check() && $post->user_id !== auth()->id()): ?>
        <div id="foundModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Found</h3>
                    <p class="text-sm text-gray-600 mb-4">Let the owner know you found their item. This will send them a notification.</p>
                    <form method="POST" action="<?php echo e(route('found-notifications.store', $post)); ?>" onsubmit="return false;">
                        <?php echo csrf_field(); ?>
                        <div class="mb-4">
                            <label for="found_message" class="block text-sm font-medium text-gray-700">Message to Owner</label>
                            <textarea name="message" id="found_message" rows="4" required
                                      placeholder="Hi! I think I found your item. Let me know if this matches what you lost..."
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="found_location" class="block text-sm font-medium text-gray-700">Where did you find it?</label>
                            <input type="text" name="found_location" id="found_location" required
                                   placeholder="Location where you found the item"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div class="mb-4">
                            <label for="found_contact" class="block text-sm font-medium text-gray-700">Your Contact Info</label>
                            <input type="text" name="contact_info" id="found_contact" required
                                   placeholder="Phone number or email to reach you"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeFoundModal()" 
                                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </button>
                            <button type="button" 
                                    onclick="confirmFoundNotification(this.form, '<?php echo e(addslashes($post->title)); ?>')"
                                    class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                                Notify Owner
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-gray-600 bg-opacity-75 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-auto shadow-lg rounded-md bg-white max-w-4xl">
            <div class="flex justify-end">
                <button onclick="closeImageModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <img id="modalImage" src="" alt="" class="w-full h-auto">
        </div>
    </div>

    <script>
        function openClaimModal() {
            document.getElementById('claimModal').classList.remove('hidden');
        }

        function closeClaimModal() {
            document.getElementById('claimModal').classList.add('hidden');
        }

        function openFoundModal() {
            document.getElementById('foundModal').classList.remove('hidden');
        }

        function closeFoundModal() {
            document.getElementById('foundModal').classList.add('hidden');
        }

        function openImageModal(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
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
<?php endif; ?><?php /**PATH E:\Final_Project\resources\views/posts/show.blade.php ENDPATH**/ ?>