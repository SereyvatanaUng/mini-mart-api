<?php

return [
    'authentication' => [
        'login' => [
            'method' => 'POST',
            'url' => '/api/v1/login',
            'description' => 'User login',
            'body' => ['email', 'password'],
            'example' => [
                'email' => 'owner@minimart.com',
                'password' => 'password123'
            ]
        ],
        'logout' => [
            'method' => 'POST',
            'url' => '/api/v1/logout',
            'description' => 'User logout',
            'auth' => 'required'
        ],
        'forgot_password' => [
            'method' => 'POST',
            'url' => '/api/v1/forgot-password',
            'description' => 'Request password reset OTP',
            'body' => ['email']
        ],
        'verify_otp' => [
            'method' => 'POST',
            'url' => '/api/v1/verify-otp',
            'description' => 'Verify OTP code',
            'body' => ['email', 'otp', 'token']
        ],
        'reset_password' => [
            'method' => 'POST',
            'url' => '/api/v1/reset-password',
            'description' => 'Reset password with OTP',
            'body' => ['email', 'otp', 'password', 'password_confirmation']
        ],
        'change_password' => [
            'method' => 'POST',
            'url' => '/api/v1/change-password',
            'description' => 'Change current password',
            'auth' => 'required',
            'body' => ['current_password', 'password', 'password_confirmation']
        ],
        'profile' => [
            'method' => 'GET',
            'url' => '/api/v1/profile',
            'description' => 'Get user profile',
            'auth' => 'required'
        ]
    ],
    
    'cashiers' => [
        'list' => [
            'method' => 'GET',
            'url' => '/api/v1/cashiers',
            'description' => 'List all cashiers',
            'auth' => 'shop_owner'
        ],
        'create' => [
            'method' => 'POST',
            'url' => '/api/v1/cashiers',
            'description' => 'Create new cashier',
            'auth' => 'shop_owner',
            'body' => ['name', 'email', 'password', 'phone?']
        ],
        'show' => [
            'method' => 'GET',
            'url' => '/api/v1/cashiers/{id}',
            'description' => 'Get cashier details',
            'auth' => 'shop_owner'
        ],
        'update' => [
            'method' => 'PUT',
            'url' => '/api/v1/cashiers/{id}',
            'description' => 'Update cashier',
            'auth' => 'shop_owner',
            'body' => ['name', 'email', 'phone?', 'is_active?']
        ],
        'delete' => [
            'method' => 'DELETE',
            'url' => '/api/v1/cashiers/{id}',
            'description' => 'Delete cashier',
            'auth' => 'shop_owner'
        ]
    ],
    
    'products' => [
        'list' => [
            'method' => 'GET',
            'url' => '/api/v1/products',
            'description' => 'List products with search/filter',
            'auth' => 'required',
            'params' => ['search?', 'category_id?', 'low_stock?', 'per_page?']
        ],
        'create' => [
            'method' => 'POST',
            'url' => '/api/v1/products',
            'description' => 'Create new product',
            'auth' => 'shop_owner',
            'body' => ['name', 'price', 'stock_quantity', 'category_id', 'section_id', 'shelf_id', 'barcode?', 'description?', 'cost_price?', 'min_stock_level?', 'image?']
        ],
        'show' => [
            'method' => 'GET',
            'url' => '/api/v1/products/{id}',
            'description' => 'Get product details',
            'auth' => 'required'
        ],
        'update' => [
            'method' => 'PUT',
            'url' => '/api/v1/products/{id}',
            'description' => 'Update product',
            'auth' => 'shop_owner'
        ],
        'delete' => [
            'method' => 'DELETE',
            'url' => '/api/v1/products/{id}',
            'description' => 'Delete product',
            'auth' => 'shop_owner'
        ],
        'scan_barcode' => [
            'method' => 'GET',
            'url' => '/api/v1/products/barcode/scan',
            'description' => 'Scan product by barcode',
            'auth' => 'required',
            'params' => ['barcode']
        ],
        'low_stock' => [
            'method' => 'GET',
            'url' => '/api/v1/products/alerts/low-stock',
            'description' => 'Get low stock products',
            'auth' => 'required'
        ]
    ],
    
    'sales' => [
        'list' => [
            'method' => 'GET',
            'url' => '/api/v1/sales',
            'description' => 'List sales',
            'auth' => 'required',
            'params' => ['start_date?', 'end_date?', 'today?', 'cashier_id?']
        ],
        'create' => [
            'method' => 'POST',
            'url' => '/api/v1/sales',
            'description' => 'Create new sale',
            'auth' => 'required',
            'body' => ['items', 'payment_method', 'tax?', 'discount?']
        ],
        'show' => [
            'method' => 'GET',
            'url' => '/api/v1/sales/{id}',
            'description' => 'Get sale details',
            'auth' => 'required'
        ],
        'daily_summary' => [
            'method' => 'GET',
            'url' => '/api/v1/sales/summary/daily',
            'description' => 'Daily sales summary',
            'auth' => 'required',
            'params' => ['date?']
        ]
    ],
    
    'categories' => [
        'list' => [
            'method' => 'GET',
            'url' => '/api/v1/categories',
            'description' => 'List categories',
            'auth' => 'required'
        ],
        'create' => [
            'method' => 'POST',
            'url' => '/api/v1/categories',
            'description' => 'Create category',
            'auth' => 'shop_owner',
            'body' => ['name', 'description?']
        ],
        'show' => [
            'method' => 'GET',
            'url' => '/api/v1/categories/{id}',
            'description' => 'Get category details',
            'auth' => 'required'
        ],
        'update' => [
            'method' => 'PUT',
            'url' => '/api/v1/categories/{id}',
            'description' => 'Update category',
            'auth' => 'shop_owner'
        ],
        'delete' => [
            'method' => 'DELETE',
            'url' => '/api/v1/categories/{id}',
            'description' => 'Delete category',
            'auth' => 'shop_owner'
        ]
    ],
    
    'sections' => [
        'list' => [
            'method' => 'GET',
            'url' => '/api/v1/sections',
            'description' => 'List sections',
            'auth' => 'required'
        ],
        'create' => [
            'method' => 'POST',
            'url' => '/api/v1/sections',
            'description' => 'Create section',
            'auth' => 'shop_owner',
            'body' => ['name', 'description?', 'position?']
        ],
        'show' => [
            'method' => 'GET',
            'url' => '/api/v1/sections/{id}',
            'description' => 'Get section details',
            'auth' => 'required'
        ],
        'update' => [
            'method' => 'PUT',
            'url' => '/api/v1/sections/{id}',
            'description' => 'Update section',
            'auth' => 'shop_owner'
        ],
        'delete' => [
            'method' => 'DELETE',
            'url' => '/api/v1/sections/{id}',
            'description' => 'Delete section',
            'auth' => 'shop_owner'
        ],
        'create_shelf' => [
            'method' => 'POST',
            'url' => '/api/v1/sections/{id}/shelves',
            'description' => 'Create shelf in section',
            'auth' => 'shop_owner',
            'body' => ['name', 'level', 'description?']
        ]
    ],
    
    'shelves' => [
        'list' => [
            'method' => 'GET',
            'url' => '/api/v1/shelves',
            'description' => 'List shelves',
            'auth' => 'required',
            'params' => ['section_id?']
        ],
        'create' => [
            'method' => 'POST',
            'url' => '/api/v1/shelves',
            'description' => 'Create shelf',
            'auth' => 'shop_owner',
            'body' => ['name', 'section_id', 'level', 'description?']
        ],
        'show' => [
            'method' => 'GET',
            'url' => '/api/v1/shelves/{id}',
            'description' => 'Get shelf details',
            'auth' => 'required'
        ],
        'update' => [
            'method' => 'PUT',
            'url' => '/api/v1/shelves/{id}',
            'description' => 'Update shelf',
            'auth' => 'shop_owner'
        ],
        'delete' => [
            'method' => 'DELETE',
            'url' => '/api/v1/shelves/{id}',
            'description' => 'Delete shelf',
            'auth' => 'shop_owner'
        ]
    ],
    
    'dashboard' => [
        'overview' => [
            'method' => 'GET',
            'url' => '/api/v1/dashboard/overview',
            'description' => 'Dashboard overview stats',
            'auth' => 'required'
        ],
        'sales_chart' => [
            'method' => 'GET',
            'url' => '/api/v1/dashboard/sales-chart',
            'description' => 'Sales chart data',
            'auth' => 'required',
            'params' => ['days?']
        ],
        'top_products' => [
            'method' => 'GET',
            'url' => '/api/v1/dashboard/top-products',
            'description' => 'Top selling products',
            'auth' => 'required',
            'params' => ['limit?', 'days?']
        ]
    ],
    
    'helpers' => [
        'categories_dropdown' => [
            'method' => 'GET',
            'url' => '/api/v1/data/categories',
            'description' => 'Categories for dropdowns',
            'auth' => 'required'
        ],
        'sections_dropdown' => [
            'method' => 'GET',
            'url' => '/api/v1/data/sections',
            'description' => 'Sections for dropdowns',
            'auth' => 'required'
        ],
        'shelves_by_section' => [
            'method' => 'GET',
            'url' => '/api/v1/data/sections/{id}/shelves',
            'description' => 'Shelves by section',
            'auth' => 'required'
        ]
    ]
];