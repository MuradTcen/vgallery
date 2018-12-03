<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/product">Управление работами</a></li>
                    <li class="active">Редактировать работу</li>
                </ol>
            </div>


            <h4>Редактировать работу <?php echo $product['name']; ?></h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Название работы</p>
                        <input type="text" name="name" placeholder="" value="<?php echo $product['name']; ?>">

                        <p>Название файла изображения</p>
                        <input type="text" name="image_name" placeholder="" value="<?php echo $product['image']; ?>">

                        <p>Фонд</p>
                        <select name="fond_id">
                            <?php if (is_array($fondsList)): ?>
                                <?php foreach ($fondsList as $fond): ?>
                                    <option value="<?php echo $fond['id']; ?>"
                                        <?php if ($product['fond_id'] == $fond['id']) echo ' selected="selected"'; ?>>
                                        <?php echo $fond['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        
                        <br/><br/>

                        <p>Автор</p>
                        <select name="author_id">
                            <?php if (is_array($authorsList)): ?>
                                <?php foreach ($authorsList as $author_): ?>
                                    <option value="<?php echo $author_['id']; ?>"
                                        <?php if ($product['author_id'] == $author_['id']) echo ' selected="selected"'; ?>>
                                        <?php echo $author_['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>


                        <p>Инвентарный номер 1</p>
                        <input type="text" name="code_1" placeholder="" value="<?php echo $product['code_1']; ?>">

                        <p>Инвентарный номер 2</p>
                        <input type="text" name="code_2" placeholder="" value="<?php echo $product['code_2']; ?>">

                        <p>Изображение</p>
                        <img src="<?php echo Product::getImage($product['id']); ?>" width="200" alt="" />
                        <input type="file" name="image" placeholder="" value="<?php echo $product['image']; ?>">

                        <p>Описание</p>
                        <textarea name="description"><?php echo $product['description']; ?></textarea>
                        
                        <br/><br/>

                        <p>Статус</p>
                        <select name="status">
                            <option value="1" <?php if ($product['status'] == 1) echo ' selected="selected"'; ?>>Отображается</option>
                            <option value="0" <?php if ($product['status'] == 0) echo ' selected="selected"'; ?>>Скрыт</option>
                        </select>
                        
                        <br/><br/>
                        
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                        
                        <br/><br/>
                        
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

