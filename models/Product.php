<?php

/**
 * Класс Product - модель для работы с товарами
 */
class Product
{

    // Количество отображаемых товаров по умолчанию
    const SHOW_BY_DEFAULT = 6;


    /**
     * Возвращает список товаров в указанной категории
     * @param type $categoryId <p>id категории</p>
     * @param type $page [optional] <p>Номер страницы</p>
     * @return type <p>Массив с товарами</p>
     */
    public static function getProductsListByCategory($categoryId, $page = 1, $table_)
    {

        try {
            $limit = Product::SHOW_BY_DEFAULT;
            // Смещение (для запроса)
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            // Соединение с БД
            $db = Db::getConnection();

            // Текст запроса к БД
            if ($table_ == "fond") {
                $sql = 'SELECT id, name FROM product '
                    . 'WHERE status = 1 AND fond_id = :category_id '
                    . 'ORDER BY id ASC LIMIT :limit OFFSET :offset';
            } else {
//                echo self::SHOW_BY_DEFAULT->getMessage();
                $sql = 'SELECT id, name FROM product '
                    . 'WHERE status = 1 AND author_id = :category_id '
                    . 'ORDER BY id ASC LIMIT :limit OFFSET :offset';
            }

            // Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
            $result->bindParam(':limit', $limit, PDO::PARAM_INT);
            $result->bindParam(':offset', $offset, PDO::PARAM_INT);


            // Выполнение коменды
            $result->execute();
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
        // Получение и возврат результатов
        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $i++;
        }
        return $products;
    }

    /**
     * Возвращает продукт с указанным id
     * @param integer $id <p>id товара</p>
     * @return array <p>Массив с информацией о товаре</p>
     */
    public static function getProductById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM product WHERE id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        return $result->fetch();
    }
    /**
     * Возвращает категорию продукт с указанным id
     * @param integer $id <p>id товара</p>
     * @return array <p>Массив с информацией о товаре</p>
     */
    public static function getCategoryOfProductById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();


        // Текст запроса к БД
        $sql = 'SELECT author.name FROM author, product WHERE product.id = :id AND product.author_id = author.id';


        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();

        $row = $result->fetch();
        return $row['name'];;
    }

    /**
     * Возвращает  случайный продукт из всех
     * @param
     * @return array <p>Массив с информацией о товаре</p>
     */
    public static function getRandomProduct()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
//        $sql = 'SELECT count(*) FROM product';
        $result = $db->query('SELECT count(*) FROM product');
        $row = $result->fetch();
//        $result = $db->prepare($sql);

//        $result->execute();
//        $result->setFetchMode(PDO::FETCH_ASSOC);
//        $row = $result->fetch();
        $random = rand(1, $row['count(*)']);

        return Product::getProductById($random);
//        return $random
    }

    /**
     * Возвращаем количество товаров в указанной категории
     * @param integer $categoryId
     * @return integer
     */
    public static function getTotalProductsInCategory($categoryId, $type)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        if ($type == "fond")
            {
                $sql = 'SELECT count(id) AS count FROM product WHERE status="1" AND fond_id = :category_id';
            }
        else
            {
                $sql = 'SELECT count(id) AS count FROM product WHERE status="1" AND author_id = :category_id';
            }

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();

        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];
    }

    /**
     * Возвращает список товаров с указанными индентификторами
     * @param array $idsArray <p>Массив с идентификаторами</p>
     * @return array <p>Массив со списком товаров</p>
     */
    public static function getProdustsByIds($idsArray)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Превращаем массив в строку для формирования условия в запросе
        $idsString = implode(',', $idsArray);

        // Текст запроса к БД
        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";

        $result = $db->query($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Получение и возврат результатов
        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $i++;
        }
        return $products;
    }


    /**
     * Возвращает список товаров
     * @return array <p>Массив с товарами</p>
     */
    public static function getProductsList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT id, name FROM product ORDER BY id ASC');
        $productsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $i++;
        }
        return $productsList;
    }

    /**
     * Возвращает список товаров
     * @return array <p>Массив с товарами</p>
     */
    public static function getProductsListAdmin()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT * FROM product ORDER BY image ASC');
        $productsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['image'] = $row['image'];
            $productsList[$i]['description'] = $row['description'];
            $i++;
        }
        return $productsList;
    }

    /**
     * Удаляет товар с указанным id
     * @param integer $id <p>id товара</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteProductById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM product WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
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
        $sql = 'SELECT image, author_id FROM product WHERE id = :id';


        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();

        $row = $result->fetch();


        $image = $row['image'];

        $author_id = $row['author_id'];

        // Текст запроса к БД
        $sql = 'SELECT dirname FROM author WHERE id = :author_id';


        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':author_id', $author_id, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();

        $row = $result->fetch();

        $dir = $row['dirname'];
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами

        // Путь к изображению товара
//        $pathToProductImage = $path . $id . '.jpg';

//        $pathToProductImage = $path . $dir . '/' .$image . $type. '.jpg';

        if ($_SERVER['SERVER_NAME'] == "vgallery.herokuapp.com") {
            $path = 'https://s3.us-east-2.amazonaws.com/vgallery/upload/images/';
            $pathToProductImage = $path . $dir . '/' .$image . $type. '.jpg';
            return $pathToProductImage;
        }
        else {
            $path = '/upload/images/products/';
//            $path = '~/src_diploma/all/';
            $pathToProductImage = $path . $dir . '/' .$image . $type. '.jpg';
//            if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
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
     * Добавляет новую категорию
     * @param string $name <p>Название</p>
     * @param integer $sortOrder <p>Порядковый номер</p>
     * @param integer $status <p>Статус <i>(включено "1", выключено "0")</i></p>
     * @return boolean <p>Результат добавления записи в таблицу</p>
     */
    public static function createProduct($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO product (author_id, code_1, code_2, comment, description, fond_id, image, name, status) '
            . 'VALUES (:author_id, :code_1, :code_2, :comment, :description, :fond_id, :image, :name, :status)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':author_id', $options['author_id'], PDO::PARAM_INT);
        $result->bindParam(':code_1', $options['code_1'], PDO::PARAM_STR);
        $result->bindParam(':code_2', $options['code_2'], PDO::PARAM_STR);
        $result->bindParam(':comment', $options['comment'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);

        $result->bindParam(':fond_id', $options['fond_id'], PDO::PARAM_INT);
        $result->bindParam(':image', $options['image'], PDO::PARAM_STR);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }


    /**
     * Редактирует товар с заданным id
     * @param integer $id <p>id товара</p>
     * @param array $options <p>Массив с информацей о товаре</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function updateProductById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = "UPDATE product
            SET 
                name = :name, 
                image = :image_name, 
                code_1 = :code_1, 
                code_2 = :code_2, 
                description = :description,
                author_id = :author_id,
                fond_id = :fond_id, 
                status = :status
            WHERE id = :id";
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':image_name', $options['image_name'], PDO::PARAM_STR);
        $result->bindParam(':code_1', $options['code_1'], PDO::PARAM_STR);
        $result->bindParam(':code_2', $options['code_2'], PDO::PARAM_STR);
        $result->bindParam(':author_id', $options['author_id'], PDO::PARAM_INT);
        $result->bindParam(':fond_id', $options['fond_id'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
         $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }

}
