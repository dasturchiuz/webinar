

<?=$model->user->lastname.' '.$model->user->firstname?>
<?= '<div class="stars-wrap">
        <ul class="list-rating">
            <li style="width:'.($model->star_rating*20).'%" class="stars-active">
                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </li>
            <li>
                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </li>
        </ul>
    </div>'?>
<?=$model->otziv_text?>
