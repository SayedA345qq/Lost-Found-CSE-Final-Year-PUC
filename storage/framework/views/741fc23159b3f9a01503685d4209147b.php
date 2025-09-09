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
    <!-- Hero Section -->
    <section class="relative isolate overflow-hidden bg-gradient-to-br from-green-500 via-emerald-500 to-teal-600">
        <div class="absolute inset-0 -z-10 bg-gradient-to-br from-green-600 via-emerald-600 to-teal-700"></div>
        <svg aria-hidden="true" class="absolute -top-10 -left-10 -z-10 h-[40rem] w-[60rem] blur-3xl opacity-20" viewBox="0 0 1155 678" fill="none">
            <path fill="url(#gradient-success)" fill-opacity=".3" d="M317.219 518.975L203.852 678 0 438.341l317.219 80.634L512.138 0 694.33 289.157 1155 357.019 839.931 678 632.607 408.219 317.219 518.975z"></path>
            <defs>
                <linearGradient id="gradient-success" x1="1155" x2="0" y1="0" y2="678" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#10b981"></stop>
                    <stop offset="1" stop-color="#059669"></stop>
                </linearGradient>
            </defs>
        </svg>
        <div class="px-6 pt-12 pb-16 sm:pt-16 sm:pb-20 lg:px-8">
            <div class="mx-auto max-w-7xl">
                <div class="mx-auto max-w-3xl text-center">
                    <div class="inline-flex items-center rounded-full bg-white/20 px-4 py-2 text-sm font-medium text-white mb-4">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Success Stories
                    </div>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-white">
                        Celebrating reunions and the power of community
                    </h1>
                    <p class="mt-4 text-base sm:text-lg leading-7 text-green-50">
                        Every successful reunion tells a story of hope, kindness, and the incredible impact of community support.
                    </p>

                    <!-- Stats -->
                    <dl class="mt-8 grid grid-cols-2 gap-3 sm:grid-cols-4 text-center">
                        <div class="flex flex-col rounded-lg bg-white/10 p-3 ring-1 ring-white/20">
                            <dt class="text-xs text-green-100">Items Reunited</dt>
                            <dd class="mt-1 text-xl font-bold text-white"><?php echo e(number_format($stats['resolved_posts'])); ?></dd>
                        </div>
                        <div class="flex flex-col rounded-lg bg-white/10 p-3 ring-1 ring-white/20">
                            <dt class="text-xs text-green-100">Success Rate</dt>
                            <dd class="mt-1 text-xl font-bold text-white"><?php echo e($stats['success_rate']); ?>%</dd>
                        </div>
                        <div class="flex flex-col rounded-lg bg-white/10 p-3 ring-1 ring-white/20">
                            <dt class="text-xs text-green-100">Lost Items Found</dt>
                            <dd class="mt-1 text-xl font-bold text-white"><?php echo e(number_format($stats['lost_items_resolved'])); ?></dd>
                        </div>
                        <div class="flex flex-col rounded-lg bg-white/10 p-3 ring-1 ring-white/20">
                            <dt class="text-xs text-green-100">Found Items Claimed</dt>
                            <dd class="mt-1 text-xl font-bold text-white"><?php echo e(number_format($stats['found_items_resolved'])); ?></dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </section>

    <!-- Filters Section -->
    <section class="py-6 bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-4">
                <!-- Search Bar -->
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search stories, locations..."
                               class="w-full rounded-lg border border-gray-300 pl-10 pr-4 py-2 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm"
                               onchange="this.form.submit()" form="filter-form">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Dropdown Filters -->
                <div class="flex items-center gap-3">
                    <!-- Filter Toggle Button -->
                    <button type="button" id="filter-toggle" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filters
                        <svg class="w-4 h-4 ml-2 transition-transform" id="filter-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- View Toggle -->
                    <div class="flex rounded-lg border border-gray-300 p-1">
                        <button type="button" id="grid-view" class="px-2 py-1 text-xs font-medium rounded text-green-600 bg-green-50">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                        </button>
                        <button type="button" id="list-view" class="px-2 py-1 text-xs font-medium rounded text-gray-500 hover:text-gray-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Dropdown Filter Panel -->
            <div id="filter-panel" class="hidden mt-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <form method="GET" action="<?php echo e(route('success-stories.index')); ?>" id="filter-form" class="flex flex-col gap-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                        <select name="type" class="rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm" onchange="this.form.submit()">
                            <option value="">All Types</option>
                            <option value="lost" <?php if(request('type')==='lost'): echo 'selected'; endif; ?>>Lost Items</option>
                            <option value="found" <?php if(request('type')==='found'): echo 'selected'; endif; ?>>Found Items</option>
                        </select>
                        <select name="category" class="rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm" onchange="this.form.submit()">
                            <option value="">All Categories</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category); ?>" <?php if(request('category')===$category): echo 'selected'; endif; ?>><?php echo e(ucfirst($category)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <input type="text" name="location" value="<?php echo e(request('location')); ?>" placeholder="Location"
                               class="rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm" />
                        <select name="sort" class="rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm" onchange="this.form.submit()">
                            <option value="newest" <?php if(request('sort')==='newest'): echo 'selected'; endif; ?>>Newest First</option>
                            <option value="oldest" <?php if(request('sort')==='oldest'): echo 'selected'; endif; ?>>Oldest First</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <input type="date" name="date_from" value="<?php echo e(request('date_from')); ?>" placeholder="From Date"
                               class="rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm" />
                        <input type="date" name="date_to" value="<?php echo e(request('date_to')); ?>" placeholder="To Date"
                               class="rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm" />
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex flex-wrap items-center gap-2">
                            <?php if(request()->hasAny(['type', 'category', 'location', 'date_from', 'date_to', 'sort', 'search'])): ?>
                                <span class="text-xs text-gray-600">Active:</span>
                                <?php if(request('search')): ?>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700"><?php echo e(request('search')); ?></span>
                                <?php endif; ?>
                                <?php if(request('type')): ?>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700"><?php echo e(ucfirst(request('type'))); ?></span>
                                <?php endif; ?>
                                <?php if(request('category')): ?>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-700"><?php echo e(ucfirst(request('category'))); ?></span>
                                <?php endif; ?>
                                <?php if(request('location')): ?>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-700"><?php echo e(request('location')); ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo e(route('success-stories.index')); ?>" class="text-xs text-gray-500 hover:text-gray-700">Clear All</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Success Stories Grid -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <?php if($successStories->count() > 0): ?>
                <div id="stories-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                    <?php $__currentLoopData = $successStories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $acceptedClaim = $story->claims->where('status', 'accepted')->first();
                            $acceptedFoundNotification = $story->foundNotifications->where('status', 'accepted')->first();
                        ?>
                        <article class="group bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden border border-gray-100">
                            <div class="relative">
                                <?php if($story->images): ?>
                                    <img src="<?php echo e(asset('storage/' . $story->images)); ?>" 
                                         alt="<?php echo e($story->title); ?>" 
                                         class="w-full h-32 object-cover bg-gray-50 group-hover:scale-105 transition-transform duration-200">
                                <?php else: ?>
                                    <div class="w-full h-32 bg-gradient-to-br from-green-100 via-emerald-100 to-teal-100 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Success Badge -->
                                <div class="absolute top-2 right-2">
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-green-500 text-white shadow-sm">
                                        <svg class="w-2.5 h-2.5 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        ✓
                                    </span>
                                </div>

                                <!-- Type Badge -->
                                <div class="absolute top-2 left-2">
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium 
                                               <?php echo e($story->type === 'lost' ? 'bg-red-500 text-white' : 'bg-green-500 text-white'); ?>">
                                        <?php echo e($story->type === 'lost' ? 'L' : 'F'); ?>

                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-3">
                                <h3 class="text-sm font-semibold text-gray-900 mb-1 line-clamp-2 group-hover:text-green-600 transition-colors leading-tight"><?php echo e($story->title); ?></h3>
                                <p class="text-gray-600 text-xs mb-2 line-clamp-2 leading-relaxed"><?php echo e(Str::limit($story->description, 60)); ?></p>
                                
                                <div class="flex items-center justify-between text-xs text-gray-500 mb-2">
                                    <span class="truncate"><?php echo e(Str::limit($story->user->name, 12)); ?></span>
                                    <span class="text-xs"><?php echo e($story->updated_at->format('M j')); ?></span>
                                </div>

                                <div class="flex items-center justify-between">
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-700">
                                        <?php echo e(Str::limit(ucfirst($story->category), 8)); ?>

                                    </span>
                                    <a href="<?php echo e(route('success-stories.show', $story)); ?>" 
                                       class="inline-flex items-center text-xs font-medium text-green-600 hover:text-green-700">
                                        View
                                        <svg class="w-3 h-3 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>

                                <?php if(($story->type === 'found' && $acceptedClaim) || ($story->type === 'lost' && $acceptedFoundNotification)): ?>
                                    <div class="mt-2 pt-2 border-t border-gray-100">
                                        <div class="flex items-center justify-between text-xs">
                                            <?php if($story->type === 'found' && $acceptedClaim): ?>
                                                <span class="text-green-600 font-medium">Claimed by</span>
                                                <span class="text-gray-700 truncate max-w-16"><?php echo e(Str::limit($acceptedClaim->user->name, 10)); ?></span>
                                            <?php elseif($story->type === 'lost' && $acceptedFoundNotification): ?>
                                                <span class="text-orange-600 font-medium">Found by</span>
                                                <span class="text-gray-700 truncate max-w-16"><?php echo e(Str::limit($acceptedFoundNotification->finder->name, 10)); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- List View (Hidden by default) -->
                <div id="stories-list" class="hidden space-y-3">
                    <?php $__currentLoopData = $successStories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $acceptedClaim = $story->claims->where('status', 'accepted')->first();
                            $acceptedFoundNotification = $story->foundNotifications->where('status', 'accepted')->first();
                        ?>
                        <article class="group bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden border border-gray-100">
                            <div class="flex">
                                <div class="relative flex-shrink-0">
                                    <?php if($story->images): ?>
                                        <img src="<?php echo e(asset('storage/' . $story->images)); ?>" 
                                             alt="<?php echo e($story->title); ?>" 
                                             class="w-24 h-24 object-cover bg-gray-50">
                                    <?php else: ?>
                                        <div class="w-24 h-24 bg-gradient-to-br from-green-100 via-emerald-100 to-teal-100 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- Success Badge -->
                                    <div class="absolute top-1 right-1">
                                        <span class="inline-flex items-center px-1 py-0.5 rounded text-xs font-medium bg-green-500 text-white">
                                            ✓
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="flex-1 p-4">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                                           <?php echo e($story->type === 'lost' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'); ?>">
                                                    <?php echo e(ucfirst($story->type)); ?>

                                                </span>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-700">
                                                    <?php echo e(ucfirst($story->category)); ?>

                                                </span>
                                            </div>
                                            
                                            <h3 class="text-base font-semibold text-gray-900 mb-1 group-hover:text-green-600 transition-colors"><?php echo e($story->title); ?></h3>
                                            <p class="text-gray-600 text-sm mb-2 line-clamp-2"><?php echo e(Str::limit($story->description, 120)); ?></p>
                                            
                                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                                <span class="font-medium text-gray-900"><?php echo e($story->user->name); ?></span>
                                                <span><?php echo e($story->location); ?></span>
                                                <span><?php echo e($story->updated_at->diffForHumans()); ?></span>
                                            </div>
                                        </div>
                                        
                                        <div class="flex flex-col items-end gap-2 ml-4">
                                            <a href="<?php echo e(route('success-stories.show', $story)); ?>" 
                                               class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-green-600 hover:text-green-700 hover:bg-green-50 rounded-lg transition-colors">
                                                Read Story
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                            
                                            <?php if(($story->type === 'found' && $acceptedClaim) || ($story->type === 'lost' && $acceptedFoundNotification)): ?>
                                                <div class="text-right text-xs">
                                                    <?php if($story->type === 'found' && $acceptedClaim): ?>
                                                        <p class="text-green-600 font-medium">Claimed by</p>
                                                        <p class="text-gray-700"><?php echo e($acceptedClaim->user->name); ?></p>
                                                    <?php elseif($story->type === 'lost' && $acceptedFoundNotification): ?>
                                                        <p class="text-orange-600 font-medium">Found by</p>
                                                        <p class="text-gray-700"><?php echo e($acceptedFoundNotification->finder->name); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Pagination -->
                <div class="mt-10 flex justify-center">
                    <?php echo e($successStories->withQueryString()->links()); ?>

                </div>
            <?php else: ?>
                <div class="text-center py-16">
                    <div class="mx-auto w-24 h-24 bg-gradient-to-br from-green-100 to-emerald-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No success stories yet</h3>
                    <p class="text-gray-600 mb-6 max-w-md mx-auto">Be the first to create a success story by helping someone find their lost item!</p>
                    <a href="<?php echo e(route('posts.index')); ?>" class="inline-flex items-center rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Browse Items
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-8 bg-gradient-to-r from-green-600 to-emerald-600">
        <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-lg sm:text-xl font-bold text-white mb-2">
                Ready to create your own success story?
            </h2>
            <p class="text-green-100 mb-4 text-sm">
                Join our community and help reunite more items with their owners.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="<?php echo e(route('posts.index')); ?>" class="inline-flex items-center rounded-lg bg-white px-4 py-2 text-sm font-semibold text-green-600 shadow-sm hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Browse Items
                </a>
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('posts.create')); ?>" class="inline-flex items-center rounded-lg bg-green-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-800 transition-colors">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Post an Item
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('register')); ?>" class="inline-flex items-center rounded-lg bg-green-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-800 transition-colors">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Join Community
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter toggle functionality
            const filterToggle = document.getElementById('filter-toggle');
            const filterPanel = document.getElementById('filter-panel');
            const filterChevron = document.getElementById('filter-chevron');

            filterToggle.addEventListener('click', function() {
                if (filterPanel.classList.contains('hidden')) {
                    filterPanel.classList.remove('hidden');
                    filterChevron.style.transform = 'rotate(180deg)';
                } else {
                    filterPanel.classList.add('hidden');
                    filterChevron.style.transform = 'rotate(0deg)';
                }
            });

            // View toggle functionality
            const gridView = document.getElementById('grid-view');
            const listView = document.getElementById('list-view');
            const storiesGrid = document.getElementById('stories-grid');
            const storiesList = document.getElementById('stories-list');

            gridView.addEventListener('click', function() {
                // Show grid view
                storiesGrid.classList.remove('hidden');
                storiesList.classList.add('hidden');
                
                // Update button states
                gridView.classList.add('text-green-600', 'bg-green-50');
                gridView.classList.remove('text-gray-500');
                listView.classList.add('text-gray-500');
                listView.classList.remove('text-green-600', 'bg-green-50');
            });

            listView.addEventListener('click', function() {
                // Show list view
                storiesGrid.classList.add('hidden');
                storiesList.classList.remove('hidden');
                
                // Update button states
                listView.classList.add('text-green-600', 'bg-green-50');
                listView.classList.remove('text-gray-500');
                gridView.classList.add('text-gray-500');
                gridView.classList.remove('text-green-600', 'bg-green-50');
            });

            // Auto-expand filters if any are active
            <?php if(request()->hasAny(['type', 'category', 'location', 'date_from', 'date_to', 'sort', 'search'])): ?>
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
<?php endif; ?><?php /**PATH E:\Final_Project\resources\views/success-stories/index.blade.php ENDPATH**/ ?>