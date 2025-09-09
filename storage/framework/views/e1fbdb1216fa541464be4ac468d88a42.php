<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'id' => 'confirmationModal',
    'title' => 'Confirm Action',
    'message' => 'Are you sure you want to proceed?',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'confirmClass' => 'bg-red-500 hover:bg-red-700',
    'icon' => 'warning'
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
    'id' => 'confirmationModal',
    'title' => 'Confirm Action',
    'message' => 'Are you sure you want to proceed?',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'confirmClass' => 'bg-red-500 hover:bg-red-700',
    'icon' => 'warning'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<!-- Confirmation Modal -->
<div id="<?php echo e($id); ?>" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Icon -->
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full mb-4
                        <?php echo e($icon === 'warning' ? 'bg-red-100' : ($icon === 'info' ? 'bg-blue-100' : 'bg-yellow-100')); ?>">
                <?php if($icon === 'warning'): ?>
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                <?php elseif($icon === 'info'): ?>
                    <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                <?php else: ?>
                    <svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                <?php endif; ?>
            </div>
            
            <!-- Title -->
            <h3 class="text-lg font-medium text-gray-900 text-center mb-2" id="<?php echo e($id); ?>Title"><?php echo e($title); ?></h3>
            
            <!-- Message -->
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500 text-center" id="<?php echo e($id); ?>Message"><?php echo e($message); ?></p>
            </div>
            
            <!-- Buttons -->
            <div class="items-center px-4 py-3 flex justify-center space-x-4">
                <button type="button" 
                        onclick="closeModal('<?php echo e($id); ?>')" 
                        class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    <?php echo e($cancelText); ?>

                </button>
                <button type="button" 
                        id="<?php echo e($id); ?>Confirm"
                        class="px-4 py-2 <?php echo e($confirmClass); ?> text-white text-base font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2">
                    <?php echo e($confirmText); ?>

                </button>
            </div>
        </div>
    </div>
</div><?php /**PATH E:\Final_Project\resources\views/components/confirmation-modal.blade.php ENDPATH**/ ?>