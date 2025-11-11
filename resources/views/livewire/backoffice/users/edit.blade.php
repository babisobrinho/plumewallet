<x-slot name="header">
    <x-backoffice-header
        :title="__('users.title')"
        :subtitle="__('users.edit_description')"
    />
</x-slot>

<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('users.edit_user') }}</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ $user->name }} ({{ $user->email }})
                </p>
            </div>
            <a 
                href="{{ route('backoffice.users.index') }}" 
                class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-500 focus:bg-gray-400 dark:focus:bg-gray-500 active:bg-gray-500 dark:active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
            >
                <i class="ti ti-arrow-left w-4 h-4 mr-2"></i>
                {{ __('common.buttons.back') }}
            </a>
        </div>

        <!-- Form -->
        <form wire:submit="update" class="bg-white dark:bg-gray-900 shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        {{ __('users.form.full_name') }}
                    </label>
                    <input 
                        wire:model="name" 
                        type="text" 
                        id="name"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('name') border-red-500 @enderror"
                        placeholder="{{ __('users.form.full_name') }}"
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        {{ __('common.labels.email') }}
                    </label>
                    <input 
                        wire:model="email" 
                        type="email" 
                        id="email"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('email') border-red-500 @enderror"
                        placeholder="email@example.com"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div class="mb-6">
                    <label for="phoneNumber" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        {{ __('common.labels.phone_number') }}
                    </label>
                    <input 
                        wire:model="phoneNumber" 
                        type="tel" 
                        id="phoneNumber"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('phoneNumber') border-red-500 @enderror"
                        placeholder="+351 XXX XXX XXX"
                    >
                    @error('phoneNumber')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Type Selection -->
                <div class="mb-6">
                    <label for="roleType" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        {{ __('users.form.user_type') }}
                    </label>
                    <select 
                        wire:model.live="roleType" 
                        id="roleType"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('roleType') border-red-500 @enderror"
                    >
                        <option value="">{{ __('users.form.select_user_type') }}</option>
                        <option value="staff">{{ __('enums.role_type.staff') }}</option>
                        <option value="client">{{ __('enums.role_type.client') }}</option>
                    </select>
                    @error('roleType')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Selection -->
                @if($roleType)
                    <div class="mb-6">
                        <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('users.form.role') }}
                        </label>
                        <select 
                            wire:model="role" 
                            id="role"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('role') border-red-500 @enderror"
                        >
                            <option value="">{{ __('users.form.select_role') }}</option>
                            @foreach($roleOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                <!-- Password Section -->
                 @role("admin") 
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                            {{ __('users.change_password') }}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            {{ __('users.form.password_optional') }}
                        </p>

                        <!-- New Password -->
                        <div class="mb-6">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('users.form.new_password') }}
                            </label>
                            <input 
                                wire:model="password" 
                                type="password" 
                                id="password"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('password') border-red-500 @enderror"
                                placeholder="••••••••"
                            >
                            @error('password')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-6">
                            <label for="passwordConfirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('users.form.confirm_password') }}
                            </label>
                            <input 
                                wire:model="passwordConfirmation" 
                                type="password" 
                                id="passwordConfirmation"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('passwordConfirmation') border-red-500 @enderror"
                                placeholder="••••••••"
                            >
                            @error('passwordConfirmation')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                @endrole
            </div>

            <!-- Form Actions -->
            <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 sm:px-6 flex justify-end space-x-3 rounded-b-lg">
                <a 
                    href="{{ route('backoffice.users.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800"
                >
                    {{ __('common.buttons.cancel') }}
                </a>
                <button 
                    type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800"
                >
                    <i class="ti ti-check w-4 h-4 mr-2"></i>
                    {{ __('common.buttons.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
