<?php

return [
    'title' => 'User Management',
    'subtitle' => 'Manage system users',
    'total_users' => 'Total: :count users',
    'new_user' => 'New User',
    'no_users_found' => 'No users found',
    
    'filters' => [
        'status' => 'Status',
        'user_type' => 'User Type',
        'all_status' => 'All Status',
        'all_types' => 'All Types',
    ],
    
    'sort_options' => [
        'created_at' => 'Registration Date',
        'email_verified_at' => 'Verification Date',
    ],
    
    'messages' => [
        'user_created' => 'User created successfully.',
        'user_updated' => 'User updated successfully.',
        'user_deleted' => 'User deleted successfully.',
        'cannot_delete_self' => 'You cannot delete your own account.',
    ],

    'form' => [
        'select_type' => 'Select type',
        'select_role' => 'Select role',
        'full_name' => 'Full Name',
        'phone_number' => 'Phone Number',
        'user_type' => 'User Type',
        'role' => 'Role',
        'password' => 'Password',
        'email_verified' => 'Email Verified',
        'verified_on' => 'Verified on',
        'create_description' => 'Create a new user account with the required information.',
        'edit_description' => 'Update the user information below.',
        'password_optional' => 'Leave blank to keep current password',
    ],

    'metrics' => [
        'total_users' => 'Total Users',
        'active_users' => 'Active Users',
        'staff_users' => 'Staff Users',
        'client_users' => 'Client Users',
    ],
];
