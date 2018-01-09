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
  <nav class="text-center">
<!--                    <ul class="pagination">-->
<!--                       -->
<!--                        <li class="disabled">-->
<!--                            <a href="">-->
<!--                            <i class="fa fa-chevron-left"></i>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="active"><a href="">1</a></li>-->
<!--                        <li>-->
<!--                            <a href="">-->
<!--                            <i class="fa fa-chevron-right"></i>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                       -->
<!--                    </ul>-->
      <?=@$pag?>
                </nav>
