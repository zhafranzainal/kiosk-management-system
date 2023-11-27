<?php

return [

    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'applications' => [
        'name' => 'Applications',
        'index_title' => 'Applications List',
        'new_title' => 'New Application',
        'create_title' => 'Create Application',
        'edit_title' => 'Edit Application',
        'show_title' => 'Show Application',
        'inputs' => [
            'transaction_id' => 'Transaction',
            'kiosk_id' => 'Kiosk',
            'user_id' => 'User',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'status' => 'Status',
        ],
    ],

    'banks' => [
        'name' => 'Banks',
        'index_title' => 'Banks List',
        'new_title' => 'New Bank',
        'create_title' => 'Create Bank',
        'edit_title' => 'Edit Bank',
        'show_title' => 'Show Bank',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'business_types' => [
        'name' => 'Business Types',
        'index_title' => 'BusinessTypes List',
        'new_title' => 'New Business type',
        'create_title' => 'Create BusinessType',
        'edit_title' => 'Edit BusinessType',
        'show_title' => 'Show BusinessType',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'complaints' => [
        'name' => 'Complaints',
        'index_title' => 'Complaints List',
        'new_title' => 'New Complaint',
        'create_title' => 'Create Complaint',
        'edit_title' => 'Edit Complaint',
        'show_title' => 'Show Complaint',
        'inputs' => [
            'kiosk_participant_id' => 'Kiosk Participant',
            'user_id' => 'User',
            'description' => 'Description',
            'status' => 'Status',
        ],
    ],

    'courses' => [
        'name' => 'Courses',
        'index_title' => 'Courses List',
        'new_title' => 'New Course',
        'create_title' => 'Create Course',
        'edit_title' => 'Edit Course',
        'show_title' => 'Show Course',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'kiosks' => [
        'name' => 'Kiosks',
        'index_title' => 'Kiosks List',
        'new_title' => 'New Kiosk',
        'create_title' => 'Create Kiosk',
        'edit_title' => 'Edit Kiosk',
        'show_title' => 'Show Kiosk',
        'inputs' => [
            'business_type_id' => 'Business Type',
            'name' => 'Name',
            'location' => 'Location',
            'suggested_action' => 'Suggested Action',
            'comment' => 'Comment',
            'status' => 'Status',
        ],
    ],

    'kiosk_participants' => [
        'name' => 'Kiosk Participants',
        'index_title' => 'Kiosk Participants List',
        'new_title' => 'New Kiosk Participant',
        'create_title' => 'Create Kiosk Participant',
        'edit_title' => 'Edit Kiosk Participant',
        'show_title' => 'Show Kiosk Participant',
        'inputs' => [
            'user_id' => 'User',
            'kiosk_id' => 'Kiosk',
            'bank_id' => 'Bank',
            'account_no' => 'Account No',
        ],
    ],

    'sales' => [
        'name' => 'Sales',
        'index_title' => 'Sales List',
        'new_title' => 'New Sale',
        'create_title' => 'Create Sale',
        'edit_title' => 'Edit Sale',
        'show_title' => 'Show Sale',
        'inputs' => [
            'kiosk_participant_id' => 'Kiosk Participant',
            'amount' => 'Amount',
        ],
    ],

    'students' => [
        'name' => 'Students',
        'index_title' => 'Students List',
        'new_title' => 'New Student',
        'create_title' => 'Create Student',
        'edit_title' => 'Edit Student',
        'show_title' => 'Show Student',
        'inputs' => [
            'kiosk_participant_id' => 'Kiosk Participant',
            'course_id' => 'Course',
            'matric_no' => 'Matric No',
            'year' => 'Year',
            'semester' => 'Semester',
        ],
    ],

    'transactions' => [
        'name' => 'Transactions',
        'index_title' => 'Transactions List',
        'new_title' => 'New Transaction',
        'create_title' => 'Create Transaction',
        'edit_title' => 'Edit Transaction',
        'show_title' => 'Show Transaction',
        'inputs' => [
            'user_id' => 'User',
            'amount' => 'Amount',
            'status' => 'Status',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
            'mobile_no' => 'Mobile No',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

];
