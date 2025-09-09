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
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Conversation with <?php echo e($user->name); ?>

                </h2>
                <p class="text-sm text-gray-600">
                    About: <a href="<?php echo e(route('posts.show', $post)); ?>" class="text-blue-600 hover:text-blue-900"><?php echo e($post->title); ?></a>
                </p>
            </div>
            <div class="flex space-x-2">
                <form method="POST" action="<?php echo e(route('messages.clear-conversation', [$post, $user])); ?>" class="inline" onsubmit="return false;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="button" 
                            onclick="confirmClearConversation(this.form)"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-sm">
                        Clear Conversation
                    </button>
                </form>
                <a href="<?php echo e(route('messages.index')); ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Messages
                </a>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Post Reference -->
                <div class="p-4 bg-gray-50 border-b">
                    <div class="flex items-center space-x-4">
                        <?php if($post->images): ?>
                            <img src="<?php echo e(asset('storage/' . $post->images)); ?>" 
                                 alt="<?php echo e($post->title); ?>" 
                                 class="w-16 h-16 object-contain rounded-lg bg-gray-50">
                        <?php endif; ?>
                        <div>
                            <h3 class="font-medium text-gray-900"><?php echo e($post->title); ?></h3>
                            <div class="flex items-center space-x-2 text-sm text-gray-500">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                           <?php echo e($post->type === 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'); ?>">
                                    <?php echo e(ucfirst($post->type)); ?>

                                </span>
                                <span><?php echo e($post->location); ?></span>
                                <span><?php echo e($post->date_lost_found->format('M d, Y')); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Messages -->
                <div class="p-6">
                    <?php if($messages->count() > 0): ?>
                        <div class="space-y-4 mb-6" style="max-height: 400px; overflow-y: auto;" id="messagesContainer">
                            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex <?php echo e($message->sender_id === auth()->id() ? 'justify-end' : 'justify-start'); ?>">
                                    <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg <?php echo e($message->sender_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-900'); ?>">
                                        <div class="flex justify-between items-start mb-1">
                                            <span class="text-xs <?php echo e($message->sender_id === auth()->id() ? 'text-blue-100' : 'text-gray-500'); ?>">
                                                <?php echo e($message->sender->name); ?>

                                            </span>
                                            <span class="text-xs <?php echo e($message->sender_id === auth()->id() ? 'text-blue-100' : 'text-gray-500'); ?> ml-2">
                                                <?php echo e($message->created_at->format('M d, g:i A')); ?>

                                            </span>
                                        </div>
                                        <p class="text-sm"><?php echo e($message->message); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-8">
                            <p class="text-gray-500">No messages yet. Start the conversation!</p>
                        </div>
                    <?php endif; ?>

                    <!-- Message Form -->
                    <form method="POST" action="<?php echo e(route('messages.store', [$post, $user])); ?>" class="border-t pt-4">
                        <?php echo csrf_field(); ?>
                        <div class="flex space-x-4">
                            <textarea name="message" rows="3" placeholder="Type your message..." required
                                      class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"></textarea>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Send
                            </button>
                        </div>
                        <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-scroll to bottom of messages
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('messagesContainer');
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
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
<?php endif; ?><?php /**PATH E:\Final_Project\resources\views/messages/show.blade.php ENDPATH**/ ?>