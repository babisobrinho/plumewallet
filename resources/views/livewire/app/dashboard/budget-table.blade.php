<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800">Budget</h2>
    </div>

    <!-- Budget Summary -->
    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
        <div class="grid grid-cols-3 gap-4 text-sm">
            <div>
                <div class="text-gray-600">Total Assigned</div>
                <div class="text-lg font-semibold text-gray-900">${{ number_format($this->getTotalAssigned(), 2) }}</div>
            </div>
            <div>
                <div class="text-gray-600">Total Activity</div>
                <div class="text-lg font-semibold
                    {{ $this->getTotalActivity() < 0 ? 'text-red-600' : 'text-green-600' }}">
                    ${{ number_format($this->getTotalActivity(), 2) }}
                </div>
            </div>
            <div>
                <div class="text-gray-600">Total Balance</div>
                <div class="text-lg font-semibold
                    {{ $this->getTotalBalance() < 0 ? 'text-red-600' : 'text-green-600' }}">
                    ${{ number_format($this->getTotalBalance(), 2) }}
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Activity</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Balance</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($categoryGroups as $group)
                <!-- Group Header -->
                <tr class="bg-gray-100">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                        {{ $group->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                        ${{ number_format($group->categories->sum('assigned_amount'), 2) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                        ${{ number_format($group->categories->sum('activity'), 2) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                        ${{ number_format($group->categories->sum('balance'), 2) }}
                    </td>
                </tr>

                <!-- Categories -->
                @foreach($group->categories as $category)
                    <tr class="hover:bg-gray-50">
                        <!-- Category Name -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 pl-8">
                            {{ $category->name }}
                        </td>

                        <!-- Assigned Amount -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if($editingCategoryId === $category->id && $editingField === 'assigned_amount')
                                <input type="number" step="0.01" wire:model="editValue"
                                       wire:blur="saveEdit"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       autofocus>
                            @else
                                <span wire:click="startEditing({{ $category->id }}, 'assigned_amount', '{{ $category->assigned_amount }}')"
                                      class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">
                                    ${{ number_format($category->assigned_amount, 2) }}
                                </span>
                            @endif
                        </td>

                        <!-- Activity -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm
                                  {{ $category->activity < 0 ? 'text-red-600' : 'text-green-600' }}">
                            ${{ number_format($category->activity, 2) }}
                        </td>

                        <!-- Balance -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium
                                  {{ $category->balance < 0 ? 'text-red-600' : 'text-green-600' }}">
                            ${{ number_format($category->balance, 2) }}
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
</div>
