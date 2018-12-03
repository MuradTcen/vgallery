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
                                        <a href="/category/<?php echo $categoryItem['id']; ?>"
                                           class="<?php if ($categoryId == $categoryItem['id']) echo 'active'; ?>"
                                           >                                                                                    
                                               <?php echo $categoryItem['name']; ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <br>
                        <button class="btn btn-info btn-block center-block" data-toggle="collapse" data-target="#hide-me">Cписок авторов</button>
                        <?php if($is_author) echo("<button class=\"btn btn-info btn-block center-block \" data-toggle=\"collapse\" data-target=\"#hide-me-too\">Об авторе</button>"); ?>

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
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center"><?php echo $namePage['name']; ?></h2>
                    <div id="hide-me-too" class="collapse">
                        <div>
                            <div >
                            <img class="img-rounded center-block" src="<?php echo $photo; ?>" alt="" />
                        </div>
                            <br>
                            <p class="text-left">
                            <?php echo $bio['article'] ?>
                            </p>
                                <br>
                        </div>
                    </div>
                    <?php foreach ($categoryProducts as $product): ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="<?php echo Product::getImage($product['id'], "_normal"); ?>" data-lightbox="roadtrip">
                                        <img src="<?php echo Product::getImage($product['id']); ?>" alt=""/>
                                        </a>
                                            <p>
                                            <a href="/product/<?php echo $product['id']; ?>" >
                                                <?php echo $product['name']; ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div><!--features_items-->

                <!-- Постраничная навигация -->
                <?php echo $pagination->get(); ?>

            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>