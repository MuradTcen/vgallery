<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/author">Управление авторами</a></li>
                    <li class="active">Редактировать автора</li>
                </ol>
            </div>
            <div>
            <h4>Автор <?php echo $author['name']; ?></h4>
            </div>
            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post">

                        <p>Фамилия И.О. автора</p>
                        <input type="text" name="authorName" placeholder="" value="<?php echo $author['name']; ?>">

                        <p>Название директории автора</p>
                        <input type="text" name="authorDirname" placeholder="" value="<?php echo $author['dirname']; ?>">

                        <p>Название изображения автора</p>
                        <input type="text" name="authorPhoto" placeholder="" value="<?php echo $author['photo']; ?>">

                        <p>Статья об авторе</p>
<!--                        <input type="text" class="form-control" aria-label="With textarea" name="authorArticle" placeholder="" value="--><?php //echo $author['article']; ?><!--">-->
                        <textarea class="form-control" aria-label="With textarea" name="authorArticle" placeholder=""><?php echo $author['article']; ?></textarea>
                        <p>Статус</p>
                        <select name="status">
                            <option value="1" <?php if ($author['status'] == 0) echo ' selected="selected"'; ?>>Скрыт</option>
                            <option value="2" <?php if ($author['status'] == 1) echo ' selected="selected"'; ?>>Отображается</option>
                        </select>
                        <br>
                        <br>
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

