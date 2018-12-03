<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/author">Управление авторами</a></li>
                    <li class="active">Просмотр автора</li>
                </ol>
            </div>


            <h4>Просмотр автора <?php echo $author['name']; ?></h4>
            <br/>




            <h5>Информация о заказе</h5>
            <table class="table-admin-small table-bordered table-striped table">
                <tr>
                    <td>Номер автора</td>
                    <td><?php echo $author['id']; ?></td>
                </tr>
                <tr>
                    <td>Фамилия И.О. автора</td>
                    <td><?php echo $author['name']; ?></td>
                </tr>
                <tr>
                    <td>Название директории автора</td>
                    <td><?php echo $author['dirname']; ?></td>
                </tr>

                <tr>
                    <td>Название изображения автора</td>
                    <td><?php echo $author['photo']; ?></td>
                </tr>
<!--                --><?php //if ($order['user_id'] != 0): ?>
<!--                    <tr>-->
<!--                        <td>ID клиента</td>-->
<!--                        <td>--><?php //echo $order['user_id']; ?><!--</td>-->
<!--                    </tr>-->
<!--                --><?php //endif; ?>
                <tr>
                    <td><b>Статус заказа</b></td>
                    <td><?php echo Category::getStatusText($author['status']); ?></td>
                </tr>

            </table>

<!--            <h5>Товары в заказе</h5>-->
<!---->
<!--            <table class="table-admin-medium table-bordered table-striped table ">-->
<!--                <tr>-->
<!--                    <th>ID товара</th>-->
<!--                    <th>Артикул товара</th>-->
<!--                    <th>Название</th>-->
<!--                    <th>Цена</th>-->
<!--                    <th>Количество</th>-->
<!--                </tr>-->
<!--                --><?php //foreach ($products as $product): ?>
<!--                    <tr>-->
<!--                        <td>--><?php //echo $product['id']; ?><!--</td>-->
<!--                        <td>--><?php //echo $product['code']; ?><!--</td>-->
<!--                        <td>--><?php //echo $product['name']; ?><!--</td>-->
<!--                        <td>$--><?php //echo $product['price']; ?><!--</td>-->
<!--                        <td>--><?php //echo $productsQuantity[$product['id']]; ?><!--</td>-->
<!--                    </tr>-->
<!--                --><?php //endforeach; ?>
<!--            </table>-->

            <a href="/admin/author/" class="btn btn-default back"><i class="fa fa-arrow-left"></i> Назад</a>
        </div>


</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

