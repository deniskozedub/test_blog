<h2>Добавить видео</h2>
<form method="post" action="<?=URLROOT?>api/addvideo" enctype="multipart/form-data">
    <dl>
        <dt>Имя видео:</dt>
        <dd><input type="text" name="name"></dd>
        <dt>Ссылка на видео:</dt>
        <dd><input type="text" name="url"></dd>

        <input type="submit">
    </dl>
</form>