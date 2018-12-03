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


            <h4>Добавить новую работу</h4>

            <br/>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Название работы</p>
                        <input type="text" name="name" placeholder="" value="">

                        <p>Название изображения</p>
                        <input type="text" name="image" placeholder="" value="">

                        <p>Описание</p>
                        <input type="text" name="description" placeholder="" value="">

                        <p>Автор</p>
                        <select name="author_id">
                            <?php if (is_array($authorsList)): ?>
                                <?php foreach ($authorsList as $author): ?>
                                    <option value="<?php echo $author['id']; ?>">
                                        <?php echo $author['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <br/><br/>

                        <p>Фонд</p>
                        <select name="fond_id">
                            <?php if (is_array($fondsList)): ?>
                                <?php foreach ($fondsList as $fond): ?>
                                    <option value="<?php echo $fond['id']; ?>">
                                        <?php echo $fond['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <br/><br/>

                        <p>Изображение работы</p>
                        <input type="file" name="image" placeholder="" value="">

                        <p>Инвентарный номер 1</p>
                        <textarea name="code_1"></textarea>

                        <p>Инвентарный номер 2</p>
                        <textarea name="code_2"></textarea>

                        <br/><br/>

                        <p>Комментарий</p>
                        <textarea name="comment"></textarea>

                        <br/><br/>

                        <p>Статус</p>
                        <select name="status">
                            <option value="1" selected="selected">Отображается</option>
                            <option value="0">Скрыт</option>
                        </select>

                        <br/><br/>

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

