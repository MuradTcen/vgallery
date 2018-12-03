<?php

/**
 * Контроллер CatalogController
 * Каталог товаров
 */
class CatalogController
{

    /**
     * Action для страницы "Каталог работ"
     */
    public function actionIndex()
    {
        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        $authors = Category::getAuthorsList();

        // Список последних товаров
//        $latestProducts = Product::getLatestProducts(12);

        // Подключаем вид
        require_once(ROOT . '/views/catalog/index.php');
        return true;
    }

    /**
     * Action для страницы "Категория .."
     */
    public function actionCategory($categoryId, $page = 1)
    {
        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        $authors = Category::getAuthorsList();

        $is_author = False;



        $namePage = Category::getCategoryById($categoryId);

        // Список товаров в категории
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page, "fond");

        // Общее количетсво товаров (необходимо для постраничной навигации)
        $total = Product::getTotalProductsInCategory($categoryId, "fond");

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        // Подключаем вид
        require_once(ROOT . '/views/catalog/category.php');
        return true;
    }
    /**
     * Action для страницы "Категория .."
     */
    public function actionAuthor($categoryId, $page = 1)
    {
        // Список категорий для левого меню
        $categories = Category::getCategoriesList();
        $authors = Category::getAuthorsList();
        $is_author = True;

        $bio = Category::getAuthorBio($categoryId);
        $photo = Category::getPhoto($categoryId);

        $namePage = Category::getAuthorById($categoryId);

        // Список товаров в категории
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page, "author");

        // Общее количетсво товаров (необходимо для постраничной навигации)
        $total = Product::getTotalProductsInCategory($categoryId, "author");

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');


        // Подключаем вид
        require_once(ROOT . '/views/catalog/category.php');
        return true;
    }

}
