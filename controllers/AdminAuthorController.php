<?php

/**
 * Контроллер AdminAuthorController
 * Управление авторами в админпанели
 */
class AdminAuthorController extends AdminBase
{

    /**
     * Action для страницы "Управление авторами"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список работ
        $authorsList = Category::getAuthorsListAdmin();

        // Подключаем вид
        require_once(ROOT . '/views/admin_author/index.php');
        return true;
    }

    /**
     * Action для страницы "Редактирование автора"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAdmin();


        $author = Category::getAuthorByIdAdmin($id);



        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена   
            // Получаем данные из формы
            $authorName = $_POST['authorName'];
            $authorDirname = $_POST['authorDirname'];
            $authorPhoto = $_POST['authorPhoto'];
            $authorArticle = $_POST['authorArticle'];
            $status = $_POST['status'];

            // Сохраняем изменения
            Category::updateAuthorById($id, $authorName, $authorDirname, $authorPhoto, $authorArticle, $status);

            // Перенаправляем пользователя на страницу управлениями работами
            header("Location: /admin/author/view/$id");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_author/update.php');
        return true;
    }

    /**
     * Action для страницы "Просмотр автора"
     */
    public function actionView($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретном заказе
        $author = Category::getAuthorById($id);

        // Получаем массив с идентификаторами и количеством товаров
//        $productsQuantity = json_decode($order['products'], true);

        // Получаем массив с индентификаторами товаров
//        $productsIds = array_keys($productsQuantity);

        // Получаем список товаров в заказе
//        $products = Product::getProdustsByIds($productsIds);

        // Подключаем вид
        require_once(ROOT . '/views/admin_author/view.php');
        return true;
    }

    /**
     * Action для страницы "Удалить автора"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретном заказе
        $author = Category::getAuthorByIdAdmin($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем работу
            Category::deleteAuthorById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/author");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_author/delete.php');
        return true;
    }

    /**
     * Action для страницы "Добавить автора"
     */
    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $name = $_POST['name'];
            $dirname = $_POST['dirname'];
            $photo = $_POST['photo'];
            $article = $_POST['article'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($name) || empty($name)) {
                $errors[] = 'Заполните поля';
            }


            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новую категорию
                Category::createAuthor($name, $dirname, $photo,$article);

                // Перенаправляем пользователя на страницу управлениями категориями
                header("Location: /admin/author");
            }
        }

        require_once(ROOT . '/views/admin_author/create.php');
        return true;
    }


}
