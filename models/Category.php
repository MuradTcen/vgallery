<?php

/**
 * Класс Category - модель для работы с категориями товаров
 */
class Category
{

    /**
     * Возвращает массив категорий для списка на сайте
     * @return array <p>Массив с категориями</p>
     */
    public static function getCategoriesList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $result = $db->query('SELECT id, name FROM fond WHERE status = "1" ORDER BY sort ASC');

        // Получение и возврат результатов
        $i = 0;
        $categoryList = array();
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }
        return $categoryList;
    }

    /**
 * Возвращает массив категорий для списка на сайте
 * @return array <p>Массив с категориями</p>
 */
    public static function getAuthorsList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $result = $db->query('SELECT id, name FROM author WHERE status = "1" ORDER BY sort, name ASC');

        // Получение и возврат результатов
        $i = 0;
        $categoryList = array();
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }
        return $categoryList;
    }

    /**
     * Возвращает массив категорий для списка на сайте
     * @return array <p>Массив с категориями</p>
     */
    public static function getAuthorsListAdmin()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $result = $db->query('SELECT id, name, dirname, article, photo, sort, status  FROM author  ORDER BY id DESC');

        // Получение и возврат результатов
        $i = 0;
        $categoryList = array();
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['dirname'] = $row['dirname'];
            $categoryList[$i]['article'] = $row['article'];
            $categoryList[$i]['photo'] = $row['photo'];
            $categoryList[$i]['sort'] = $row['sort'];
            $categoryList[$i]['status'] = $row['status'];
            $i++;
        }
        return $categoryList;
    }

    /**
     * Возвращает массив категорий для списка на сайте
     * @return array <p>Массив с категориями</p>
     */
    public static function getAuthorBio($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT article FROM author WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }


    /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */

    public static function getPhoto($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT photo, dirname FROM author WHERE id = :id';


        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();

        $row = $result->fetch();


        $image = $row['photo'];

        $dir = $row['dirname'];


        // Название изображения-пустышки
        $noImage = 'no-image.jpg';


        if ($_SERVER['SERVER_NAME'] == "vgallery.herokuapp.com") {
            $path = 'https://s3.us-east-2.amazonaws.com/vgallery/upload/images/';
            $pathToProductImage = $path . $dir . '/' .$image . '.jpg';
            return $pathToProductImage;
        }
        else {
            $path = '/upload/images/products/';
//            $path = '~/src_diploma/all/';
            $pathToProductImage = $path . $dir . '/' .$image;
//            if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage. '.jpg')) {
                // Если изображение для товара существует
                // Возвращаем путь изображения товара
                return $pathToProductImage. '.jpg';
            }
            if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage. '.png')) {
                // Если изображение для товара существует
                // Возвращаем путь изображения товара
                return $pathToProductImage. '.png';
            }
            if (file_exists($_SERVER['DOCUMENT_ROOT'].$path . $dir . '/' .'author'. '.png')) {
                // Если изображение для товара существует
                // Возвращаем путь изображения товара
                return $path . $dir . '/' .'author'. '.png';
            }
            if (file_exists($_SERVER['DOCUMENT_ROOT'].$path . $dir . '/' .'author'. '.jpg')) {
                // Если изображение для товара существует
                // Возвращаем путь изображения товара
                return $path . $dir . '/' .'author'. '.jpg';
            }

            return $path . $noImage;
        }

        // Возвращаем путь изображения-пустышки
//
        return $pathToProductImage;
    }

    /**
     * Возвращает массив категорий для списка в админпанели <br/>
     * (при этом в результат попадают и включенные и выключенные категории)
     * @return array <p>Массив категорий</p>
     */
    public static function getCategoriesListAdmin()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $result = $db->query('SELECT id, name, status, sort FROM fond');

        // Получение и возврат результатов
        $categoryList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['status'] = $row['status'];
            $categoryList[$i]['sort'] = $row['sort'];
            $i++;
        }
        return $categoryList;
    }

    /**
     * Удаляет категорию с заданным id
     * @param integer $id
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteCategoryById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM fond WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }


    /**
     * Удаляет категорию с заданным id
     * @param integer $id
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteAuthorById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM author WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Редактирование категории с заданным id
     * @param integer $id <p>id категории</p>
     * @param string $name <p>Название</p>
     * @param integer $sortOrder <p>Порядковый номер</p>
     * @param integer $status <p>Статус <i>(включено "1", выключено "0")</i></p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function updateCategoryById($id, $name, $sortOrder, $status)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE fond SET name = :name, sort = :sort, status = :status WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Возвращает категорию с указанным id
     * @param integer $id <p>id категории</p>
     * @return array <p>Массив с информацией о категории</p>
     */
    public static function getCategoryById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM fond WHERE id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполняем запрос
        $result->execute();

        // Возвращаем данные
        return $result->fetch();
    }

    /**
     * Возвращает категорию с указанным id
     * @param integer $id <p>id категории</p>
     * @return array <p>Массив с информацией о категории</p>
     */
    public static function getAuthorById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM author WHERE id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполняем запрос
        $result->execute();

        // Возвращаем данные
        return $result->fetch();
    }


    /**
     * Возвращает категорию с указанным id
     * @param integer $id <p>id категории</p>
     * @return array <p>Массив с информацией о категории</p>
     */
    public static function getAuthorByIdAdmin($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM author WHERE id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполняем запрос
        $result->execute();

        // Возвращаем данные
        return $result->fetch();
    }


    /**
     * Возвращает текстое пояснение статуса для категории :<br/>
     * <i>0 - Скрыта, 1 - Отображается</i>
     * @param integer $status <p>Статус</p>
     * @return string <p>Текстовое пояснение</p>
     */
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Отображается';
                break;
            case '0':
                return 'Скрыта';
                break;
        }
    }

    /**
     * Добавляет новую категорию
     * @param string $name <p>Название</p>
     * @param integer $sortOrder <p>Порядковый номер</p>
     * @param integer $status <p>Статус <i>(включено "1", выключено "0")</i></p>
     * @return boolean <p>Результат добавления записи в таблицу</p>
     */
    public static function createCategory($name, $sortOrder, $status)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO fond (name, status, sort) '
                . 'VALUES (:name, :status, :sort)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Добавляет новую категорию
     * @param string $name <p>Название</p>
     * @param integer $sortOrder <p>Порядковый номер</p>
     * @param integer $status <p>Статус <i>(включено "1", выключено "0")</i></p>
     * @return boolean <p>Результат добавления записи в таблицу</p>
     */
    public static function createAuthor($name, $dirname, $photo, $article)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO author (name, dirname, photo, article) '
            . 'VALUES (:name, :dirname, :photo, :article)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':dirname', $dirname, PDO::PARAM_STR);
        $result->bindParam(':photo', $photo, PDO::PARAM_STR);
        $result->bindParam(':article', $article, PDO::PARAM_STR);
        return $result->execute();
    }


    /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */
    public static function getImage($id, $type="_thumb")
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT dirname, photo FROM author WHERE id = :id';


        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();

        $row = $result->fetch();


        $image = $row['image'];

        $dir = $row['dirname'];

        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        if ($_SERVER['SERVER_NAME'] == "vgallery.herokuapp.com") {
            $path = 'https://s3.us-east-2.amazonaws.com/vgallery/upload/images/';
            $pathToProductImage = $path . $dir . '/' .$image . $type. '.jpg';
            return $pathToProductImage;
        }
        else {
            $path = '/upload/images/products/';

            $pathToProductImage = $path . $dir . '/' .$image . $type. '.jpg';

            if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
                // Если изображение для товара существует
                // Возвращаем путь изображения товара
                return $pathToProductImage;
            }
            return $path . $noImage;
        }

        // Возвращаем путь изображения-пустышки
//
        return $pathToProductImage;
    }

    /**
     * Возвращает статью
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */
    public static function getArticle($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT article FROM author WHERE id = :id';


        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();

        $row = $result->fetch();


        $text = $row['article'];


        // Возвращаем текст
        return $text;
    }


    /**
     * Редактирование категории с заданным id
     * @param integer $id <p>id категории</p>
     * @param string $name <p>Название</p>
     * @param integer $sortOrder <p>Порядковый номер</p>
     * @param integer $status <p>Статус <i>(включено "1", выключено "0")</i></p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function updateAuthorById($id, $authorName, $authorDirname, $authorPhoto, $authorArticle, $status)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE author SET name = :name, dirname = :dirname, photo = :photo, article = :article, status = :status WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $authorName, PDO::PARAM_STR);
        $result->bindParam(':dirname', $authorDirname, PDO::PARAM_STR);
        $result->bindParam(':photo', $authorPhoto, PDO::PARAM_STR);
        $result->bindParam(':article', $authorArticle, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }


}
