<?php

return [
    'base_url' => env('APP_URL', 'http://localhost:8000'),
    'version' => '1.0.0',
    'title' => 'Mini Mart API',
    'description' => 'Complete REST API for Mini Mart POS System with User Registration',
    
    'authentication' => [
        'login' => [
            'method' => 'POST',
            'url' => '/api/v1/login',
            'description' => 'User login for all roles (shop_owner, cashier, user)',
            'body' => ['email', 'password'],
            'example' => [
                'email' => 'owner@minimart.com',
                'password' => 'password123'
            ]
        ],
        'signup' => [
            'method' => 'POST',
            'url' => '/api/v1/signup',
            'description' => 'User registration - Create new user account',
            'auth' => 'public',
            'body' => ['name', 'email', 'password', 'password_confirmation', 'phone?'],
            'example' => [
                'name' => 'John Customer',
                'email' => 'customer@example.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
                'phone' => '+1-555-0123'
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
            'auth' => 'public',
            'body' => ['email'],
            'example' => [
                'email' => 'owner@minimart.com'
            ]
        ],
        'verify_otp' => [
            'method' => 'POST',
            'url' => '/api/v1/verify-otp',
            'description' => 'Verify OTP code',
            'auth' => 'public',
            'body' => ['email', 'otp', 'token']
        ],
        'reset_password' => [
            'method' => 'POST',
            'url' => '/api/v1/reset-password',
            'description' => 'Reset password with OTP',
            'auth' => 'public',
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
            'body' => ['name', 'email', 'password', 'phone?', 'send_welcome_email?']
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
            'description' => 'List products with search/filter - PUBLIC ACCESS',
            'auth' => 'public',
            'params' => ['search?', 'category_id?', 'section_id?', 'low_stock?', 'per_page?'],
            'note' => 'Anyone can browse products without authentication'
        ],
        'show' => [
            'method' => 'GET',
            'url' => '/api/v1/products/{id}',
            'description' => 'Get product details - PUBLIC ACCESS',
            'auth' => 'public',
            'note' => 'Product details available to everyone'
        ],
        'scan_barcode' => [
            'method' => 'GET',
            'url' => '/api/v1/products/barcode/scan',
            'description' => 'Scan product by barcode - PUBLIC ACCESS',
            'auth' => 'public',
            'params' => ['barcode'],
            'note' => 'Barcode scanning available without login'
        ],
        'create' => [
            'method' => 'POST',
            'url' => '/api/v1/products',
            'description' => 'Create new product with images',
            'auth' => 'shop_owner',
            'body' => ['name', 'price', 'stock_quantity', 'category_id', 'section_id', 'shelf_id', 'barcode?', 'description?', 'cost_price?', 'min_stock_level?', 'image?', 'image_url?'],
            'note' => 'Can upload image file OR provide image URL'
        ],
        'update' => [
            'method' => 'PUT',
            'url' => '/api/v1/products/{id}',
            'description' => 'Update product',
            'auth' => 'shop_owner',
            'body' => ['name', 'price', 'stock_quantity', 'category_id', 'section_id', 'shelf_id', 'image?', 'image_url?']
        ],
        'delete' => [
            'method' => 'DELETE',
            'url' => '/api/v1/products/{id}',
            'description' => 'Delete product',
            'auth' => 'shop_owner'
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
            'description' => 'List sales (cashiers see own, shop owners see all)',
            'auth' => 'required',
            'params' => ['start_date?', 'end_date?', 'today?', 'cashier_id?']
        ],
        'create' => [
            'method' => 'POST',
            'url' => '/api/v1/sales',
            'description' => 'Create new sale (cashiers & shop owners only)',
            'auth' => 'cashier+',
            'body' => ['items', 'payment_method', 'tax?', 'discount?'],
            'example' => [
                'items' => [
                    ['product_id' => 1, 'quantity' => 2],
                    ['product_id' => 3, 'quantity' => 1]
                ],
                'payment_method' => 'cash',
                'tax' => 1.50,
                'discount' => 0.50
            ]
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
            'description' => 'List categories - PUBLIC ACCESS',
            'auth' => 'public',
            'note' => 'Categories available to everyone for browsing'
        ],
        'show' => [
            'method' => 'GET',
            'url' => '/api/v1/categories/{id}',
            'description' => 'Get category details - PUBLIC ACCESS',
            'auth' => 'public'
        ],
        'create' => [
            'method' => 'POST',
            'url' => '/api/v1/categories',
            'description' => 'Create category',
            'auth' => 'shop_owner',
            'body' => ['name', 'description?']
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
            'description' => 'List sections - PUBLIC ACCESS',
            'auth' => 'public',
            'note' => 'Store layout available to everyone'
        ],
        'show' => [
            'method' => 'GET',
            'url' => '/api/v1/sections/{id}',
            'description' => 'Get section details - PUBLIC ACCESS',
            'auth' => 'public'
        ],
        'create' => [
            'method' => 'POST',
            'url' => '/api/v1/sections',
            'description' => 'Create section',
            'auth' => 'shop_owner',
            'body' => ['name', 'description?', 'position?']
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
            'description' => 'List shelves - PUBLIC ACCESS',
            'auth' => 'public',
            'params' => ['section_id?'],
            'note' => 'Shelf information available to everyone'
        ],
        'show' => [
            'method' => 'GET',
            'url' => '/api/v1/shelves/{id}',
            'description' => 'Get shelf details - PUBLIC ACCESS',
            'auth' => 'public'
        ],
        'create' => [
            'method' => 'POST',
            'url' => '/api/v1/shelves',
            'description' => 'Create shelf',
            'auth' => 'shop_owner',
            'body' => ['name', 'section_id', 'level', 'description?']
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
            'description' => 'Categories for dropdowns - PUBLIC ACCESS',
            'auth' => 'public',
            'note' => 'Helper endpoint for form dropdowns'
        ],
        'sections_dropdown' => [
            'method' => 'GET',
            'url' => '/api/v1/data/sections',
            'description' => 'Sections for dropdowns - PUBLIC ACCESS',
            'auth' => 'public'
        ],
        'shelves_by_section' => [
            'method' => 'GET',
            'url' => '/api/v1/data/sections/{id}/shelves',
            'description' => 'Shelves by section - PUBLIC ACCESS',
            'auth' => 'public'
        ]
    ],

    'user_roles' => [
        'shop_owner' => [
            'description' => 'Full access - Can manage everything',
            'permissions' => [
                'Manage cashiers (CRUD)',
                'Manage products (CRUD)',
                'Manage categories/sections/shelves (CRUD)',
                'View all sales and analytics',
                'Access dashboard',
                'Process sales'
            ]
        ],
        'cashier' => [
            'description' => 'POS access - Can process sales',
            'permissions' => [
                'Process sales',
                'View own sales history',
                'View products (read-only)',
                'Basic dashboard access'
            ]
        ],
        'user' => [
            'description' => 'Customer access - Can browse products',
            'permissions' => [
                'Browse products',
                'View categories/sections/shelves',
                'Use barcode scanner',
                'View product details'
            ]
        ]
    ],

    'image_handling' => [
        'product_images' => [
            'description' => 'Products support dual image system',
            'options' => [
                'Upload file' => 'Use multipart/form-data with image file',
                'External URL' => 'Provide image_url field with external link'
            ],
            'priority' => 'image_url takes priority over uploaded file',
            'fallback' => 'Default placeholder if no image provided',
            'response_field' => 'full_image_url - Complete URL for frontend use'
        ]
    ],

    'examples' => [
        'signup_request' => [
            'method' => 'POST',
            'url' => '/api/v1/signup',
            'headers' => ['Content-Type: application/json'],
            'body' => [
                'name' => 'John Customer',
                'email' => 'customer@example.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
                'phone' => '+1-555-0123'
            ]
        ],
        'product_with_image_url' => [
            'method' => 'POST',
            'url' => '/api/v1/products',
            'headers' => [
                'Content-Type: application/json',
                'Authorization: Bearer YOUR_TOKEN'
            ],
            'body' => [
                'name' => 'Coca Cola 330ml',
                'price' => 1.50,
                'stock_quantity' => 100,
                'category_id' => 1,
                'section_id' => 1,
                'shelf_id' => 1,
                'image_url' => 'https://images.unsplash.com/photo-1629203851122-3726ecdf080e?w=400'
            ]
        ],
        'public_product_browse' => [
            'method' => 'GET',
            'url' => '/api/v1/products?search=cola&category_id=1',
            'note' => 'No authentication required - public access'
        ]
    ]
];