<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>
                        
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление авторами</li>
                </ol>
            </div>
            <a href="/admin/author/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить автора</a>
            <h4>Список авторов</h4>

            <br/>

            
            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID автора</th>
                    <th>Фамилия И.О. автора</th>
                    <th>Директория изображений</th>
                    <th>Статья об авторе</th>
                    <th>Название изображения с автором</th>
                    <th>Сорт</th>
                    <th>Статус</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($authorsList as $author): ?>
                    <tr>
                        <td>
                            <a href="/admin/author/view/<?php echo $author['id']; ?>">
                                <?php echo $author['id']; ?>
                            </a>
                        </td>
                        <td><?php echo $author['name']; ?></td>
                        <td><?php echo $author['dirname']; ?></td>
                        <td><?php echo $author['article']; ?></td>
                        <td><?php echo $author['photo']; ?></td>
                        <td><?php echo $author['sort']; ?></td>
                        <td><?php echo Category::getStatusText($author['status']); ?></td>
                        <td><a href="/admin/author/view/<?php echo $author['id']; ?>" title="Смотреть"><i class="fa fa-eye"></i></a></td>
                        <td><a href="/admin/author/update/<?php echo $author['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/author/delete/<?php echo $author['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

