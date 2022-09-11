<?php
return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'admin.dashboard',
        'title' => 'Dashboard',
        'active' => 'admin.admin',
    ],
    [
        'icon' => 'fas fa-tags nav-icon',
        'route' => 'admin.categories.index',
        'title' => 'Categories',
        'badge' => 'New',
        'active' => 'admin.categories.*',
        'ability' => 'categories.view',
    ],
    [
        'icon' => 'fas fa-box nav-icon',
        'route' => 'admin.products.index',
        'title' => 'Products',
        'active' => 'admin.products.*',
        'ability' => 'products.view',
    ],
    [
        'icon' => 'fas fa-receipt nav-icon',
        'route' => 'admin.categories.index',
        'title' => 'Orders',
        'active' => 'admin.orders.*',
        'ability' => 'orders.view',
    ],
//    [
//        'icon' => 'fas fa-shield nav-icon',
//        'route' => 'admin.roles.index',
//        'title' => 'Roles',
//        'active' => 'admin.roles.*',
//        'ability' => 'roles.view',
//    ],
//    [
//        'icon' => 'fas fa-users nav-icon',
//        'route' => 'admin.users.index',
//        'title' => 'Users',
//        'active' => 'admin.users.*',
//        'ability' => 'users.view',
//    ],
//    [
//        'icon' => 'fas fa-users nav-icon',
//        'route' => 'admin.admins.index',
//        'title' => 'Admins',
//        'active' => 'admin.admins.*',
//        'ability' => 'admins.view',
//    ],
];
