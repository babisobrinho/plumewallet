<?php

return [
    'title' => 'Contact Us',
    'subtitle' => 'Get in touch with our team',
    
    'labels' => [
        'name' => 'Name',
        'company' => 'Company',
        'email' => 'Email',
        'phone' => 'Phone',
        'subject' => 'Subject',
        'custom_subject' => 'Custom Subject',
        'message' => 'Message',
        'preferred_language' => 'Preferred Language',
        'process_number' => 'Process Number',
        'status' => 'Status',
        'observation' => 'Observation',
    ],
    
    'form' => [
        'name' => 'Name',
        'company' => 'Company',
        'email' => 'Email',
        'phone' => 'Phone',
        'subject' => 'Subject',
        'custom_subject' => 'Custom Subject',
        'message' => 'Message',
        'preferred_language' => 'Preferred Language',
    ],
    
    'placeholders' => [
        'select_subject' => 'Select a subject',
        'custom_subject' => 'Please specify your subject',
        'message' => 'Tell us how we can help you...',
        'observation' => 'Add your observation...',
    ],
    
    'buttons' => [
        'submit' => 'Submit',
        'submitting' => 'Submitting...',
        'update_status' => 'Update Status',
        'add_observation' => 'Add Observation',
    ],
    
    'messages' => [
        'submitted' => 'Your message has been submitted successfully! Your process number is :process_number. We will contact you soon.',
        'error' => 'There was an error submitting your message. Please try again.',
        'status_updated' => 'Status updated successfully',
        'observation_added' => 'Observation added successfully',
        'no_forms' => 'No contact forms found',
        'no_observations' => 'No observations yet',
    ],
    
    'management' => [
        'title' => 'Contact Forms',
        'subtitle' => 'Manage contact form submissions',
    ],
    
    'metrics' => [
        'total_forms' => 'Total Forms',
        'new_forms' => 'New Forms',
        'in_progress' => 'In Progress',
        'resolved' => 'Resolved',
    ],
    
    'details' => [
        'title' => 'Contact Form Details',
        'subtitle' => 'View and manage contact form',
        'information' => 'Contact Information',
        'update_status' => 'Update Status',
        'observations' => 'Observations',
        'status' => 'Status',
        'status_changed_to' => 'Status changed to',
        'keep_current_status' => 'Keep current status',
    ],
    
    'filters' => [
        'all_status' => 'All Status',
        'all_subjects' => 'All Subjects',
        'all_languages' => 'All Languages',
        'search_placeholder' => 'Search by name, email, or process number...',
    ],
    
    'modals' => [
        'add_observation' => 'Add Observation',
    ],
    
    'confirmation' => [
        'title' => 'Contact Form Submission',
        'subject' => 'Thanks! Your submission is confirmed - :process_number',
        'intro' => 'Hi :name, thank you for reaching out to us! We\'ve successfully received your message and our team will review it shortly.',
        'details_title' => 'Your Message Details',
        'process_info' => 'Process Information',
        'process_details' => 'Your process number is :process_number. Please keep this number for your records and reference it in any future communications.',
        'button' => 'Go to PlumeWallet',
        'footer' => '© 2025 Plume Wallet. All rights reserved.',
    ],
    
    'notification' => [
        'title' => 'New Contact Form Submission',
        'intro' => 'A new contact form has been submitted through the website.',
        'details' => 'Contact Details',
        'footer' => 'Please review and respond to this contact form as soon as possible.',
    ],
];
