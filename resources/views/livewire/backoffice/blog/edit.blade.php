<x-slot name="header">
    <x-backoffice-header
        :title="__('blog.edit_post')"
        :subtitle="__('blog.edit_description')"
    />
</x-slot>

<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header com ações -->
        <div class="mb-6 flex justify-between items-center">
            <div class="flex space-x-3">
                <a 
                    href="{{ route('backoffice.blog.index') }}" 
                    class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-500 focus:bg-gray-400 dark:focus:bg-gray-500 active:bg-gray-500 dark:active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150"
                >
                    <i class="ti ti-arrow-left w-4 h-4 mr-2"></i>
                    {{ __('common.buttons.back') }}
                </a>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-900 shadow rounded-lg">
            <form wire:submit="update" class="p-6 space-y-6">
                <!-- Title and Status Row -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Title -->
                    <div class="lg:col-span-2">
                        <x-label for="title" :value="__('blog.form.title')" />
                        <input 
                            id="title" 
                            type="text" 
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                            wire:model="title" 
                            required 
                            autofocus 
                        />
                        <x-input-error for="title" class="mt-2" />
                    </div>

                    <!-- Status -->
                    <div>
                        <x-label for="status" :value="__('blog.form.status')" />
                        <select 
                            id="status" 
                            wire:model.live="status" 
                            class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            required
                        >
                            @foreach($statuses as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="status" class="mt-2" />
                    </div>
                </div>

                <!-- Category and Published At Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Category -->
                    <div>
                        <x-label for="category" :value="__('blog.form.category')" />
                        <select 
                            id="category" 
                            wire:model="category" 
                            class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="">{{ __('blog.form.select_category') }}</option>
                            @foreach($categories as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="category" class="mt-2" />
                    </div>

                    <!-- Published At -->
                    @if($status === 'published')
                    <div>
                        <x-label for="published_at" :value="__('blog.form.published_at')" />
                        <input 
                            id="published_at" 
                            type="datetime-local" 
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                            wire:model="publishedAt" 
                        />
                        <x-input-error for="publishedAt" class="mt-2" />
                    </div>
                    @endif
                </div>

                <!-- Featured Checkbox -->
                <div class="flex items-center">
                    <input 
                        id="is_featured" 
                        type="checkbox" 
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                        wire:model="isFeatured" 
                    />
                    <label for="is_featured" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                        {{ __('blog.form.is_featured') }}
                    </label>
                </div>

                <!-- Content -->
                <div>
                    <x-label for="content" :value="__('blog.form.content')" />
                    <textarea 
                        id="content" 
                        rows="12"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                        wire:model="content" 
                        required 
                    ></textarea>
                    <x-input-error for="content" class="mt-2" />
                </div>

                <!-- Excerpt -->
                <div>
                    <x-label for="excerpt" :value="__('blog.form.excerpt')" />
                    <textarea 
                        id="excerpt" 
                        rows="4"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                        wire:model="excerpt" 
                        placeholder="{{ __('blog.form.excerpt_placeholder') }}"
                    ></textarea>
                    <x-input-error for="excerpt" class="mt-2" />
                </div>

                <!-- SEO Fields -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <x-label for="meta_title" :value="__('blog.form.meta_title')" />
                        <input 
                            id="meta_title" 
                            type="text" 
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                            wire:model="metaTitle" 
                        />
                        <x-input-error for="metaTitle" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="featured_image" :value="__('blog.form.featured_image')" />
                        <input 
                            id="featured_image" 
                            type="url" 
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                            wire:model="featuredImage" 
                            placeholder="https://example.com/image.jpg"
                        />
                        <x-input-error for="featuredImage" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-label for="meta_description" :value="__('blog.form.meta_description')" />
                    <textarea 
                        id="meta_description" 
                        rows="3"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                        wire:model="metaDescription" 
                        placeholder="{{ __('blog.form.meta_description_placeholder') }}"
                    ></textarea>
                    <x-input-error for="metaDescription" class="mt-2" />
                </div>

                <!-- Tags -->
                <div>
                    <x-label for="tags" :value="__('blog.form.tags')" />
                    <div class="mt-2 p-4 border border-gray-200 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800">
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                            @foreach($availableTags as $value => $label)
                                <label class="inline-flex items-center p-3 rounded-md transition-colors cursor-pointer">
                                    <input 
                                        type="checkbox" 
                                        value="{{ $value }}"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                                        wire:model="tags"
                                    />
                                    <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                        <div class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                            <i class="ti ti-info-circle w-4 h-4 inline mr-1"></i>
                            Select one or more tags to categorize your post
                        </div>
                    </div>
                    <x-input-error for="tags" class="mt-2" />
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a 
                        href="{{ route('backoffice.blog.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-500 focus:bg-gray-400 dark:focus:bg-gray-500 active:bg-gray-500 dark:active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >
                        {{ __('common.buttons.cancel') }}
                    </a>
                    <button 
                        type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >
                        {{ __('common.buttons.update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
