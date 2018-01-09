<div class="row masonry" data-columns>
    <?php foreach ($videos as $video):?>

         <div class="item">
        <div class="thumbnail">
           <iframe width="350" height="250" src='<?=$video["url"]?>'
                frameborder="0" allowfullscreen>
           </iframe>
            <div class="caption">
                <h3> <?=$video["name"]?></h3>
            </div>
        </div>
    </div>
    <?php endforeach;?>
    </div>
       
