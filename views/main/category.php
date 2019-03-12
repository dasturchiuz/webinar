<div class="card">
    <header class="card-header bg-secondary white">
        <i class="icon-menu"></i> Категории
    </header>
    <?php
        $data=\app\models\Category::buildTree();
    ?>
    <ul class="nav-category">
        <?php foreach($data as $item):?>

            <?php if(count($item['childs'])>0):?>
                <li class="has-submenu"> <a href="<?=$item['slug'];?>"><?=$item['name'];?>  <i class="icon-arrow-right pull-right"></i></a>
                    <ul class="menu-more">
                        <?php foreach($item['childs'] as $childs):?>
                            <li> <a href="<?=$childs['slug'];?>"><?=$childs['name'];?> </a></li>
                        <?php endforeach;?>
                    </ul>
                </li>
            <?php else: ?>
                <li> <a href="<?=$item['slug'];?>"><?=$item['name'];?> </a></li>
            <?php endif;?>
        <?php endforeach;?>
    </ul>
</div> <!-- card.// -->