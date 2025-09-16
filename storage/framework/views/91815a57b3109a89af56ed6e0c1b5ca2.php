<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'user',
    'size' => 'md',
    'class' => ''
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'user',
    'size' => 'md',
    'class' => ''
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $sizeClasses = [
        'xs' => 'h-6 w-6',
        'sm' => 'h-8 w-8',
        'md' => 'h-10 w-10',
        'lg' => 'h-12 w-12',
        'xl' => 'h-16 w-16',
        '2xl' => 'h-20 w-20',
        '3xl' => 'h-24 w-24'
    ];
    
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
?>

<div class="inline-block <?php echo e($sizeClass); ?> <?php echo e($class); ?>">
    <?php if($user->profile_image && Storage::disk('public')->exists($user->profile_image)): ?>
        <img class="<?php echo e($sizeClass); ?> rounded-full object-cover border-2 border-gray-200" 
             src="<?php echo e(Storage::url($user->profile_image)); ?>" 
             alt="<?php echo e($user->name); ?>'s profile picture">
    <?php else: ?>
        <!-- Default avatar with initials -->
        <?php
            $initials = collect(explode(' ', $user->name))
                ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                ->take(2)
                ->implode('');
            
            $colors = [
                'bg-red-500', 'bg-blue-500', 'bg-green-500', 'bg-yellow-500', 
                'bg-purple-500', 'bg-pink-500', 'bg-indigo-500', 'bg-gray-500'
            ];
            $colorIndex = $user->id % count($colors);
            $bgColor = $colors[$colorIndex];
        ?>
        
        <div class="<?php echo e($sizeClass); ?> <?php echo e($bgColor); ?> rounded-full flex items-center justify-center border-2 border-gray-200">
            <span class="text-white font-semibold text-<?php echo e($size === 'xs' ? 'xs' : ($size === 'sm' ? 'sm' : ($size === 'md' ? 'base' : ($size === 'lg' ? 'lg' : ($size === 'xl' ? 'xl' : ($size === '2xl' ? '2xl' : '3xl')))))); ?>">
                <?php echo e($initials); ?>

            </span>
        </div>
    <?php endif; ?>
</div><?php /**PATH E:\Final_Project\resources\views/components/user-avatar.blade.php ENDPATH**/ ?>