<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categories as $categoryItem): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="/category/<?php echo $categoryItem['id']; ?>">
                                            <?php echo $categoryItem['name']; ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <br>
                        <button class="btn btn-info btn-block center-block " data-toggle="collapse" data-target="#hide-me">Cписок авторов</button>
                        <div id="hide-me" class="collapse">
                            <?php foreach ($authors as $authorItem): ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="/author/<?php echo $authorItem['id']; ?>">
                                                <?php echo $authorItem['name']; ?>
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 text-xs-center">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center"><?php echo $namePage['name']; ?></h2>
                    <div class="row padding-right"><!--product-details-->
                        <div class="card text-center">
                            <div class="text-xs-center">
                                <img class="img-rounded m-x-auto center-block" src="<?php echo Product::getImage($product['id'], "_normal"); ?>" alt="" style="width: 80%; display: block"/>
                            </div>
                            <div >
                                <p class="card-text">
                                <div>
                                    <h2> <?php echo $product['name']; ?></h2>
                                    <?php echo $product['description']; ?>
                                    <br/>
                                    Инвентарный номер [1]: <?php echo $product['code_1']; ?>
                                    <br/>
                                    Инвентарный номер [2]: <?php echo $product['code_2']; ?>
                                </div>
                                </p>
                            </div>
                        </div>
                    </div><!--/product-details-->
                </div>

            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>