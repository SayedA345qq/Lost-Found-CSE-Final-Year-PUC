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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"><?php echo e(__('Community Feedback')); ?></h2>
            <a href="<?php echo e(route('home')); ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back to Home</a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Filters: Modern Toolbar -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 text-gray-900">
                    <form method="GET" action="<?php echo e(route('feedback.index')); ?>" class="flex flex-col gap-3">
                        <div class="flex flex-col lg:flex-row items-stretch gap-3">
                            <div class="flex-1">
                                <div class="relative">
                                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search feedback, names, emails..."
                                           class="w-full rounded-full border border-gray-300 pl-10 pr-4 py-2.5 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <select name="rating" class="rounded-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">All ratings</option>
                                    <?php for($i=5;$i>=1;$i--): ?>
                                        <option value="<?php echo e($i); ?>" <?php if(request('rating')==$i): echo 'selected'; endif; ?>><?php echo e($i); ?> ★</option>
                                    <?php endfor; ?>
                                    <option value="no_rating" <?php if(request('rating')==='no_rating'): echo 'selected'; endif; ?>>No rating</option>
                                </select>
                                <select name="sort" class="rounded-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="newest" <?php if(request('sort')==='newest'): echo 'selected'; endif; ?>>Newest</option>
                                    <option value="oldest" <?php if(request('sort')==='oldest'): echo 'selected'; endif; ?>>Oldest</option>
                                    <option value="rating_highest" <?php if(request('sort')==='rating_highest'): echo 'selected'; endif; ?>>Rating: High → Low</option>
                                    <option value="rating_lowest" <?php if(request('sort')==='rating_lowest'): echo 'selected'; endif; ?>>Rating: Low → High</option>
                                </select>
                                <button type="submit" class="inline-flex items-center rounded-full bg-indigo-600 px-4 py-2 text-white font-medium shadow hover:bg-indigo-700">Apply</button>
                                <a href="<?php echo e(route('feedback.index')); ?>" class="inline-flex items-center rounded-full bg-gray-100 px-4 py-2 text-gray-700 font-medium shadow hover:bg-gray-200">Reset</a>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
                            <label class="text-sm text-gray-600">From
                                <input id="date_from" type="date" name="date_from" value="<?php echo e(request('date_from')); ?>" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            </label>
                            <label class="text-sm text-gray-600">To
                                <input id="date_to" type="date" name="date_to" value="<?php echo e(request('date_to')); ?>" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            </label>
                        </div>
                        <?php if(request()->hasAny(['search','rating','date_from','date_to','sort'])): ?>
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="text-sm text-gray-600">Active:</span>
                                <?php if(request('search')): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700">Search: <?php echo e(request('search')); ?></span>
                                <?php endif; ?>
                                <?php if(request('rating')): ?>
                                    <a href="<?php echo e(request()->fullUrlWithQuery(['rating'=>null])); ?>" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700">
                                        Rating: <?php echo e(request('rating') === 'no_rating' ? 'No rating' : request('rating') . ' ★'); ?> ×
                                    </a>
                                <?php endif; ?>
                                <?php if(request('date_from') || request('date_to')): ?>
                                    <a href="<?php echo e(request()->fullUrlWithQuery(['date_from'=>null,'date_to'=>null])); ?>" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700">Date Range ×</a>
                                <?php endif; ?>
                                <?php if(request('sort') && request('sort')!=='newest'): ?>
                                    <a href="<?php echo e(request()->fullUrlWithQuery(['sort'=>null])); ?>" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700">Sort: <?php echo e(str_replace('_',' ',request('sort'))); ?> ×</a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-4">
                    <?php $__empty_1 = true; $__currentLoopData = $feedback; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="font-semibold text-gray-900"><?php echo e($item->name ?? ($item->user->name ?? 'Anonymous')); ?></p>
                                        <p class="text-sm text-gray-500"><?php echo e($item->created_at->diffForHumans()); ?></p>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <?php if(!is_null($item->rating)): ?>
                                            <div class="text-yellow-500" aria-label="Rating: <?php echo e($item->rating); ?> out of 5">
                                                <?php for($i=1;$i<=5;$i++): ?>
                                                    <span class="<?php echo e($i <= $item->rating ? 'opacity-100' : 'opacity-30'); ?>">★</span>
                                                <?php endfor; ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(auth()->guard()->check()): ?>
                                            <?php if($item->user_id === auth()->id()): ?>
                                                <a href="<?php echo e(route('feedback.edit', $item)); ?>"
                                                   class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md bg-white text-gray-700 ring-1 ring-gray-300 hover:bg-gray-50">
                                                    Edit
                                                </a>
                                                <form method="POST" action="<?php echo e(route('feedback.destroy', $item)); ?>" onsubmit="return false;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="button" onclick="confirmDeleteComment(this.form)"
                                                            class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md bg-red-600 text-white hover:bg-red-700">
                                                        Delete
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <p class="mt-3 text-gray-700"><?php echo e($item->message); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-center text-gray-500">No feedback yet.</div>
                        </div>
                    <?php endif; ?>

                    <div>
                        <?php echo e($feedback->withQueryString()->links()); ?>

                    </div>
                </div>
                <div>
                    <?php echo $__env->make('feedback.partials.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
<?php /**PATH E:\Final_Project\resources\views/feedback/index.blade.php ENDPATH**/ ?>