<?php

return [
    [
        'icon' => 'home',
        'name' => 'Tổng quan',
        'route' => 'get_admin.home',
        'prefix' => [''],
    ],
    // [
    //     'icon' => 'user-check',
    //     'name' => 'Quản lý nhân viên',
    //     'route' => '',
    //     'prefix' => ['staff'],
    // ],
    [
        'icon' => 'file-text',
        'name' => 'Quản lý phòng ban',
        'route' => 'get_admin.department.index',
        'prefix' => ['department'],
    ],
    // [
    //     'icon' => 'users',
    //     'name' => 'Quản lý người dùng',
    //     'route' => '',
    //     'prefix' => ['user'],
    // ]
];