<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
<?=Helper_HTML::js("ax")?>
<?=Helper_HTML::css("form")?>

<select >

<?php foreach ($users as $user):?>
    <option value="<?=$user["id"]?>"><?=$user["login"]?></option>

	 <?php endforeach;?>

</select>
<button id="del">Удалить пользователя</button>

<div class="ajax_container">


</div>
<div class="edit">
    <div class="inp">
    <input type="text" name="name"/>
    <input type="text" name="addr"/>
    <input type="submit" value="Сохранить" data-type="save"/>
    </div>

</div>
