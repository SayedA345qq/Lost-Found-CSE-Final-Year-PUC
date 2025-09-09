<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Claims on My Posts') }}
            </h2>
            <a href="{{ route('claims.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                My Claims
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Advanced Filter Dropdown -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <!-- Main Search Bar -->
                    <div class="flex flex-col lg:flex-row gap-4 items-start lg:items-center justify-between mb-4">
                        <form method="GET" action="{{ route('claims.received') }}" class="flex-1 flex gap-2">
                            <div class="flex-1">
                                <input type="text" name="search" id="search" value="{{ $search }}" 
                                       placeholder="Search by claimer name, message, or post title..." 
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
                        <form method="GET" action="{{ route('claims.received') }}" class="space-y-4">
                            <!-- Preserve search term -->
                            <input type="hidden" name="search" value="{{ $search }}">
                            
                            <!-- Filter Dropdowns Row -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <!-- Status Filter -->
                                <div class="relative">
                                    <select name="filter" id="filter" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-white">
                                        <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>📋 All Claims</option>
                                        <option value="pending" {{ $filter === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                        <option value="accepted" {{ $filter === 'accepted' ? 'selected' : '' }}>✅ Accepted</option>
                                        <option value="rejected" {{ $filter === 'rejected' ? 'selected' : '' }}>❌ Rejected</option>
                                    </select>
                                </div>

                                <!-- Sort -->
                                <div class="relative">
                                    <select name="sort" id="sort" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-white">
                                        <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>⏰ Latest First</option>
                                        <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>📅 Oldest First</option>
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
                                <a href="{{ route('claims.received') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
                                    Clear All
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Active Filters Display -->
                    @if($search || $filter !== 'all' || $sort !== 'latest')
                        <div class="mt-4 pt-4 border-t">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="text-sm text-gray-600">Active filters:</span>
                                
                                @if($filter !== 'all')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Status: {{ ucfirst($filter) }}
                                        <a href="{{ request()->fullUrlWithQuery(['filter' => 'all']) }}" class="ml-1 text-blue-600 hover:text-blue-800">×</a>
                                    </span>
                                @endif

                                @if($sort !== 'latest')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Sort: {{ ucfirst($sort) }}
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" class="ml-1 text-green-600 hover:text-green-800">×</a>
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if($claims->count() > 0)
                <div class="space-y-6">
                    @foreach($claims as $claim)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                            <a href="{{ route('posts.show', $claim->post) }}" class="hover:text-blue-600">
                                                {{ $claim->post->title }}
                                            </a>
                                        </h3>
                                        <div class="flex items-center space-x-4 text-sm text-gray-500 mb-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                       {{ $claim->post->type === 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                                {{ ucfirst($claim->post->type) }}
                                            </span>
                                            <span>{{ ucfirst($claim->post->category) }}</span>
                                            <span>{{ $claim->post->location }}</span>
                                        </div>
                                        <div class="bg-gray-50 rounded-lg p-4 mb-3">
                                            <p class="font-medium text-gray-900 mb-1">Claim from {{ $claim->user->name }}</p>
                                            <p class="text-gray-700 mb-2">{{ $claim->message }}</p>
                                            @if($claim->contact_info)
                                                <p class="text-sm text-gray-600">Contact: {{ $claim->contact_info }}</p>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-500">Submitted {{ $claim->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="ml-4 flex flex-col items-end space-y-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                                   {{ $claim->status === 'accepted' ? 'bg-green-100 text-green-800' : 
                                                      ($claim->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($claim->status) }}
                                        </span>
                                        
                                        @if($claim->status === 'pending')
                                            <div class="flex space-x-2">
                                                <form method="POST" action="{{ route('claims.accept', $claim) }}" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" 
                                                            onclick="return confirm('Are you sure you want to accept this claim? This will mark your post as resolved and reject all other pending claims.')"
                                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                        Accept
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('claims.reject', $claim) }}" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" 
                                                            onclick="return confirm('Are you sure you want to reject this claim?')"
                                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                        Reject
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                @if($claim->status === 'accepted')
                                    <div class="bg-green-50 border border-green-200 rounded-md p-4">
                                        <div class="flex">
                                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div class="ml-3">
                                                <p class="text-sm text-green-800">
                                                    You have accepted this claim. Your post has been marked as resolved. You can contact {{ $claim->user->name }} to arrange the return.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($claim->status === 'rejected')
                                    <div class="bg-red-50 border border-red-200 rounded-md p-4">
                                        <div class="flex">
                                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div class="ml-3">
                                                <p class="text-sm text-red-800">
                                                    You have rejected this claim.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $claims->links() }}
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No claims received</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            @if($search || $filter !== 'all' || $sort !== 'latest')
                                Try adjusting your filters or <a href="{{ route('claims.received') }}" class="text-blue-600 hover:text-blue-900">clear all filters</a>.
                            @else
                                No one has claimed any of your found items yet.
                            @endif
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('posts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Post Found Item
                            </a>
                        </div>
                    </div>
                </div>
            @endif
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
            @if($search || $filter !== 'all' || $sort !== 'latest')
                filterPanel.classList.remove('hidden');
                filterChevron.style.transform = 'rotate(180deg)';
            @endif
        });
    </script>
</x-app-layout>