<x-slot name="header">
    <x-backoffice-header
        :title="__('blog.title')"
        :subtitle="__('blog.subtitle')"
    />
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Blog Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <x-metric-card 
                :title="__('blog.metrics.total_posts')"
                :value="number_format($totalPosts)"
                icon="ti ti-file-text"
                color="blue"
            />

            <x-metric-card 
                :title="__('blog.metrics.published_posts')"
                :value="number_format($publishedPosts)"
                icon="ti ti-circle-check"
                color="green"
            />

            <x-metric-card 
                :title="__('blog.metrics.draft_posts')"
                :value="number_format($draftPosts)"
                icon="ti ti-edit"
                color="yellow"
            />

            <x-metric-card 
                :title="__('blog.metrics.featured_posts')"
                :value="number_format($featuredPosts)"
                icon="ti ti-star"
                color="purple"
            />
        </div>

        <!-- Header com botão de criar -->
        <div class="mb-6 flex justify-end items-center">
            <button 
                wire:click="createPost"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
                <i class="ti ti-plus w-4 h-4 mr-2"></i>
                {{ __('blog.new_post') }}
            </button>
        </div>

        <!-- Blog Table -->
        <div class="bg-white dark:bg-gray-900 shadow overflow-hidden rounded-lg">
            <!-- Search and Filters Bar -->
            <div class="px-6 py-4 border border-gray-200 dark:border-gray-700 rounded-t-lg">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0 sm:space-x-4">
                    <!-- Search -->
                    <div class="flex-1 max-w-lg">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="ti ti-search text-gray-400"></i>
                            </div>
                            <input 
                                type="text" 
                                wire:model.live.debounce.300ms="search"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md leading-5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                placeholder="{{ __('common.terms.search') }}"
                            >
                        </div>
                    </div>
                    
                    <!-- Filters -->
                    <div class="flex flex-wrap gap-4">
                        <!-- Status Filter -->
                        <div class="min-w-0 flex-1 sm:min-w-32">
                            <select 
                                wire:model.live="filters.status"
                                class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-white"
                            >
                                <option value="">{{ __('blog.filters.all_status') }}</option>
                                <option value="draft">{{ __('enums.post_status.draft') }}</option>
                                <option value="published">{{ __('enums.post_status.published') }}</option>
                                <option value="archived">{{ __('enums.post_status.archived') }}</option>
                            </select>
                        </div>
                        
                        <!-- Category Filter -->
                        <div class="min-w-0 flex-1 sm:min-w-32">
                            <select 
                                wire:model.live="filters.category"
                                class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-white"
                            >
                                <option value="">{{ __('blog.filters.all_categories') }}</option>
                                @foreach(\App\Enums\PostCategory::options() as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Author Filter -->
                        <div class="min-w-0 flex-1 sm:min-w-32">
                            <select 
                                wire:model.live="filters.author"
                                class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-white"
                            >
                                <option value="">{{ __('blog.filters.all_authors') }}</option>
                                @foreach(\App\Models\User::whereHas('roles', function($query) { $query->where('type', 'staff'); })->get() as $author)
                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Clear Filters Button -->
                        <button 
                            wire:click="clearFilters"
                            class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            {{ __('common.buttons.clear') }}
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Table -->
            <div class="overflow-x-auto border border-gray-200 dark:border-gray-700">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700 uppercase">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('blog.table.title') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('blog.table.category') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('blog.table.author') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('blog.table.status') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('blog.table.published_at') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('blog.table.views') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('common.table.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($data as $post)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-900">
                                <!-- Title -->
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $post->title }}
                                </td>
                                
                                <!-- Category -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($post->category)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                            {{ \App\Enums\PostCategory::from($post->category)->label() }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                
                                <!-- Author -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $post->author->name ?? '-' }}
                                </td>
                                
                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        {{ $post->status->label() }}
                                    </span>
                                </td>
                                
                                <!-- Published At -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d/m/Y H:i') : '-' }}
                                </td>
                                
                                <!-- Views -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $post->view_count ?? 0 }}
                                </td>
                                
                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        <x-action-button 
                                            method="editPost"
                                            :id="$post->id"
                                            icon="pencil"
                                            color="green"
                                            size="sm"
                                            :title="__('common.buttons.edit')"
                                        />
                                        <x-action-button 
                                            method="toggleFeatured"
                                            :id="$post->id"
                                            icon="star"
                                            color="yellow"
                                            size="sm"
                                            :title="__('blog.actions.toggle_featured')"
                                        />
                                        <x-action-button 
                                            method="deletePost"
                                            :id="$post->id"
                                            icon="trash"
                                            color="red"
                                            size="sm"
                                            :title="__('common.buttons.delete')"
                                        />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('common.messages.no_data') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-4 py-3 border-r border-l border-b border-gray-200 dark:border-gray-700 rounded-b-lg">
                {{ $data->links() }}
            </div>
        </div>

        <!-- Post Form Modal -->
        @if($showModal)
        <div x-data="{ show: true }" 
             x-show="show" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto">
            
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
                 @click="$wire.closeModal()"></div>

            <!-- Modal Panel -->
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
                    
                    <!-- Modal Header -->
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900 sm:mx-0 sm:h-10 sm:w-10">
                                @if($isEditing)
                                    <i class="ti ti-pencil w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                                @else
                                    <i class="ti ti-plus w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                                @endif
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">
                                    @if($isEditing)
                                        {{ __('common.buttons.edit') }} {{ __('blog.post') }}
                                    @else
                                        {{ __('blog.new_post') }}
                                    @endif
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        @if($isEditing)
                                            {{ __('blog.form.edit_description') }}
                                        @else
                                            {{ __('blog.form.create_description') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Body -->
                    <form wire:submit="savePost" class="px-4 pb-4 sm:px-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Title -->
                            <div class="md:col-span-2">
                                <x-label for="modal_title" :value="__('blog.form.title')" />
                                <input 
                                    id="modal_title" 
                                    type="text" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                    wire:model="modalTitle" 
                                    required 
                                    autofocus 
                                />
                                <x-input-error for="modalTitle" class="mt-2" />
                            </div>

                            <!-- Category -->
                            <div>
                                <x-label for="modal_category" :value="__('blog.form.category')" />
                                <select 
                                    id="modal_category" 
                                    wire:model="modalCategory" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                >
                                    <option value="">{{ __('blog.form.select_category') }}</option>
                                    @foreach(\App\Enums\PostCategory::options() as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="modalCategory" class="mt-2" />
                            </div>

                            <!-- Status -->
                            <div>
                                <x-label for="modal_status" :value="__('blog.form.status')" />
                                <select 
                                    id="modal_status" 
                                    wire:model.live="modalStatus" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required
                                >
                                    <option value="draft">{{ __('enums.post_status.draft') }}</option>
                                    <option value="published">{{ __('enums.post_status.published') }}</option>
                                    <option value="archived">{{ __('enums.post_status.archived') }}</option>
                                </select>
                                <x-input-error for="modalStatus" class="mt-2" />
                            </div>

                            <!-- Published At -->
                            @if($modalStatus === 'published')
                            <div>
                                <x-label for="modal_published_at" :value="__('blog.form.published_at')" />
                                <input 
                                    id="modal_published_at" 
                                    type="datetime-local" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                    wire:model="modalPublishedAt" 
                                />
                                <x-input-error for="modalPublishedAt" class="mt-2" />
                            </div>
                            @endif

                            <!-- Featured -->
                            <div class="flex items-center">
                                <input 
                                    id="modal_is_featured" 
                                    type="checkbox" 
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                                    wire:model="modalIsFeatured" 
                                />
                                <label for="modal_is_featured" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                                    {{ __('blog.form.is_featured') }}
                                </label>
                            </div>
                        </div>

                        <!-- Content -->
                        <div>
                            <x-label for="modal_content" :value="__('blog.form.content')" />
                            <textarea 
                                id="modal_content" 
                                rows="8"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                wire:model="modalContent" 
                                required 
                            ></textarea>
                            <x-input-error for="modalContent" class="mt-2" />
                        </div>

                        <!-- Excerpt -->
                        <div>
                            <x-label for="modal_excerpt" :value="__('blog.form.excerpt')" />
                            <textarea 
                                id="modal_excerpt" 
                                rows="3"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                wire:model="modalExcerpt" 
                                placeholder="{{ __('blog.form.excerpt_placeholder') }}"
                            ></textarea>
                            <x-input-error for="modalExcerpt" class="mt-2" />
                        </div>

                        <!-- SEO Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-label for="modal_meta_title" :value="__('blog.form.meta_title')" />
                                <input 
                                    id="modal_meta_title" 
                                    type="text" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                    wire:model="modalMetaTitle" 
                                />
                                <x-input-error for="modalMetaTitle" class="mt-2" />
                            </div>

                            <div>
                                <x-label for="modal_featured_image" :value="__('blog.form.featured_image')" />
                                <input 
                                    id="modal_featured_image" 
                                    type="url" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                    wire:model="modalFeaturedImage" 
                                    placeholder="https://example.com/image.jpg"
                                />
                                <x-input-error for="modalFeaturedImage" class="mt-2" />
                            </div>
                        </div>

                        <div>
                            <x-label for="modal_meta_description" :value="__('blog.form.meta_description')" />
                            <textarea 
                                id="modal_meta_description" 
                                rows="3"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                wire:model="modalMetaDescription" 
                                placeholder="{{ __('blog.form.meta_description_placeholder') }}"
                            ></textarea>
                            <x-input-error for="modalMetaDescription" class="mt-2" />
                        </div>

                        <!-- Tags -->
                        <div>
                            <x-label for="modal_tags" :value="__('blog.form.tags')" />
                            <div class="mt-2 space-y-2">
                                @foreach(\App\Enums\PostTag::options() as $value => $label)
                                    <label class="inline-flex items-center">
                                        <input 
                                            type="checkbox" 
                                            value="{{ $value }}"
                                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                                            wire:model="modalTags"
                                        />
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error for="modalTags" class="mt-2" />
                        </div>

                        <!-- Modal Footer -->
                        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 -mx-4 -mb-4 mt-6">
                            <button 
                                type="submit"
                                class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
                            >
                                @if($isEditing)
                                    <i class="ti ti-pencil w-4 h-4 mr-2"></i>
                                    {{ __('common.buttons.update') }}
                                @else
                                    <i class="ti ti-plus w-4 h-4 mr-2"></i>
                                    {{ __('blog.new_post') }}
                                @endif
                            </button>
                            <button 
                                type="button"
                                wire:click="closeModal"
                                class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                            >
                                {{ __('common.buttons.cancel') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
        
    </div>
</div>