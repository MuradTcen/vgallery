<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/author">Управление авторами</a></li>
                    <li class="active">Добавить Автора</li>
                </ol>
            </div>


            <h4>Добавить нового автора</h4>

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
                    <form action="#" method="post">

                        <p>Фамилия И.О. автора</p>
                        <input type="text" name="name" placeholder="" value="">

                        <p>Название директории автора</p>
                        <input type="text" name="dirname" placeholder="" value="">

                        <p>Название изображения автора</p>
                        <input type="text" name="photo" placeholder="" value="">

                        <p>Статья об авторе</p>
                        <input type="text" name="article" placeholder="" value="">

                        <p>Статус</p>
                        <select name="status">
                            <option value="1" selected="selected">Отображается</option>
                            <option value="0">Скрыта</option>
                        </select>

                        <br><br>

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                    </form>
                </div>
            </div>


        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

