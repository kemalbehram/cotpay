<?php

function showErrors($errors, $name)
{
    if($errors->has($name))
    return '
        <div>
            <p class="error-input">'.$errors->first($name).'</p>
        </div>
    ';


}
function ShowError($errors,$name){
    if($errors->has($name))
    return '
    <div class="alert alert-danger" role="alert">
        <strong>'. $errors->first($name) .'</strong>
    </div>
    ';}


 // xử lý ví

 function getWallet($mang, $id_select)
{
    foreach ($mang as $value) {
        if($value['id'] == $id_select)
        {
            echo "<option value=".$value['id']." selected>".$value['name']."</option>";
        }
        else{
            echo "<option value=".$value['id'].">".$value['name']."</option>";
        }

    }
}


 // get đơn vị vận chuyển

 function getShipingUnit($mang, $id_select)
{
    foreach ($mang as $value) {
        if($value['id'] == $id_select)
        {
            echo "<option value=".$value['id']." selected>".$value['name']."</option>";
        }
        else{
            echo "<option value=".$value['id'].">".$value['name']."</option>";
        }

    }
}

