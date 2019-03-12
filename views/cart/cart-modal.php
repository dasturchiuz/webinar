<?php if(!empty($session['cart'])):?>
<table class="table table table-hover">
    <thead>
    <tr>
        <th scope="col">Фото</th>
        <th scope="col">Наименаваний</th>
        <th scope="col">Количество</th>
        <th scope="col">Цена</th>
        <th scope="col"><i class="fas fa-minus-square"></i></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($session['cart'] as $key =>$item):?>
    <tr>
        <th><img src="<?=$item['img']?>" style="width: 60px;"> </th>
        <th><?=$item['name']?></th>
        <th><?=$item['qty']?> / <?=$item['unit']?> </th>
        <th><?=number_format(($item['price']*$item['qty']), 0, ',', ' ')?></th>
        <th><i data-id="<?=$key;?>" class="dell-item fas fa-trash-alt"></i></th>

    </tr>
    <?php endforeach;?>
    <tr>

        <td colspan="2">Итого: </td>
        <td  colspan="2"><?=$session['cart.qty']?> </td>
        <td> </td>
    </tr>
    <tr>
        <td  colspan="2">На сумму: </td>
        <td  colspan="2"><?=number_format($session['cart.sum'], 0, ',', ' ')?></td>
        <td> </td>
    </tr>

    </tbody>
</table>
<?php  else: ?>
<h3>Корзина пуста</h3>
<?php endif;?>
