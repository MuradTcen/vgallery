<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/author">Управление авторами</a></li>
                    <li class="active">Удалить автора</li>
                </ol>
            </div>


            <h4>Удалить автора <?php echo $author['name']; ?></h4>


            <p>Вы действительно хотите удалить этого автора?</p>

            <form method="post">
                <input type="submit" name="submit" value="Удалить" />
            </form>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

