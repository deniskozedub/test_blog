<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"
      xmlns="http://www.w3.org/1999/html">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a style="margin-left:10px" class="btn btn-primary" href="<?=URLROOT?>posts/showall">to home</a>
                    <?php foreach ($posts as $post):?>
                    <b><?=$post["title"]?></b>
                </div>
                <div class="panel-body">
                    <div>
                        <time><?=$post["time"]?></time> by <b><?=$post["authors_name"]?></b>
                    </div>

                    <ul class="blockquote-reverse">
                        <?php foreach ($coments as $item):?>
                            <?php if($post['id'] == $item['post_id']) :?>
                                <li><?=$item["com"]?></li>
                                <hr>
                            <?php endif;?>
                        <?php endforeach;?>
                    </ul>
                </div>
                <?php endforeach;?>
            </div>
            <form method="POST" action="<?=URLROOT?>posts/addcomment">
                <input type="hidden" name="id" value="<?=$post["id"]?>">
                <input type="text" name="com" placeholder="your comment">
                <input class="btn-primary" type="submit" value="Add Comment">
            </form>
            </div>
        </div>
    </div>
</div>

<style>

    .panel-heading{
        text-align: center;
        font-size: 22px;
    }
    .blockquote-reverse >li{
        list-style-type: none;
    }
</style>



