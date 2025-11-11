<?php

return [
    'title' => 'User Management',
    'subtitle' => 'Manage system users',
    'show_title' => 'User Details',
    'show_subtitle' => 'Complete user information',
    'edit_user' => 'Edit User',
    'edit_description' => 'Update user information',
    'total_users' => 'Total: :count users',
    'new_user' => 'New User',
    'no_users_found' => 'No users found',
    'no_role' => 'No Role',
    'personal_information' => 'Personal Information',
    'access_permissions' => 'Access and Permissions',
    'change_password' => 'Change Password',
    
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
        'user_not_found' => 'User not found.',
    ],

    'form' => [
        'select_type' => 'Select type',
        'select_role' => 'Select role',
        'select_user_type' => 'Select user type',
        'full_name' => 'Full Name',
        'user_type' => 'User Type',
        'role' => 'Role',
        'password' => 'Password',
        'new_password' => 'New Password',
        'confirm_password' => 'Confirm Password',
        'add_user' => 'Add User',
        'create_description' => 'Create a new user account',
        'edit_description' => 'Edit user account information',
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

    'danger_zone' => [
        'title' => 'Danger Zone',
        'delete_description' => 'Once a user is deleted, all of their data will be permanently removed. This action cannot be undone.',
        'delete_user' => 'Delete User',
        'delete_warning' => 'This action cannot be undone.',
        'delete_confirmation' => 'Are you sure you want to delete :name? This action cannot be undone.',
        'confirm_name_placeholder' => 'Type the user\'s name to confirm',
        'name_mismatch' => 'The name you entered does not match the user\'s name.',
    ],
];
