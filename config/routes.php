<?php

return array(
    // Работа:
    'product/([0-9]+)' => 'product/view/$1', // actionView в ProductController
    // Категория работ:
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', // actionCategory в CatalogController
    'category/([0-9]+)' => 'catalog/category/$1', // actionCategory в CatalogController
    'author/([0-9]+)/page-([0-9]+)' => 'catalog/author/$1/$2', // actionCategory в CatalogController
    'author/([0-9]+)' => 'catalog/author/$1', // actionAuthor в CatalogController
    // Пользователь:
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
    // Управление работами:
    'admin/product/create' => 'adminProduct/create',
    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/product' => 'adminProduct/index',
    // Управление категориями:    
    'admin/category/create' => 'adminCategory/create',
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',
    // Управление авторами:
    'admin/author/create' => 'adminAuthor/create',
    'admin/author/update/([0-9]+)' => 'adminAuthor/update/$1',
    'admin/author/delete/([0-9]+)' => 'adminAuthor/delete/$1',
    'admin/author/view/([0-9]+)' => 'adminAuthor/view/$1',
    'admin/author' => 'adminAuthor/index',
    // Админпанель:
    'admin' => 'admin/index',
    // О проекте
    'contacts' => 'site/contact',
    'about' => 'site/about',
    // Главная страница
    'index.php' => 'site/index', // actionIndex в SiteController
    '' => 'site/index', // actionIndex в SiteController
);
