<section class="section-content bg padding-top-sm">
    <div class="container">
        <header class="section-heading bg heading-line">
            <h2 class="title-section">Последние продукты</h2>
        </header><!-- sect-heading -->

        <div class="row row-sm">
            <?php foreach($productmodel as $product_item):?>
            <div class="col-md-3">
                <figure class="card card-product">
                    <div class="img-wrap">
                        <img src="images/items/3.jpg">
                        <a class="btn-overlay" href="#"><i class="fa fa-search-plus"></i> Quick view</a>
                    </div>
                    <figcaption class="info-wrap">
                        <h6 class="title text-dots"><a href="#"><?=$product_item->name;?></a></h6>
                        <div class="action-wrap">
                            <a href="<?=$product_item->slug;?>" class="btn btn-primary btn-sm float-right"> Order </a>
                            <div class="price-wrap h5">
                                <span class="price-new">$1280</span>
                                <del class="price-old">$1980</del>
                            </div>
                        </div>
                    </figcaption>
                </figure>
            </div>
            <?php endforeach;?>

        </div> <!-- row.// -->

    </div> <!-- container .//  -->
</section>