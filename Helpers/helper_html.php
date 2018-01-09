<?php

class Helper_HTML
{
    public static function css($name){
        return "<link rel='stylesheet' href='".URLROOT."Media/css/".$name.".css'/>";
    }
    public static function js($name){
        return "<script src='".URLROOT."Media/js/".$name.".js'></script>";
    }
    public static function img($url,$attr=[]){
        $res = "<img src='{$url}'";
        foreach ($attr as $name=>$value)
           $res.=" {$name}='{$value}'";

        return $res."/>";
    }
    public static function pagination($page_count,$active_page,$baseurl,$addition=""){
        $html = "<ul class='pagination'>";
        if($active_page>1) $html.= "<li><a href='{$baseurl}/".($active_page-1)."{$addition}'><i class=\"fa fa-chevron-left\"></i></a></li>\n";
        for($i=$active_page-4;$i<$active_page;$i++){
            if($i>0) $html.= "<li><a href='{$baseurl}/{$i}{$addition}'>{$i}</a></li>";
        }
        $html.= "<li class='active'><a href='#'>{$active_page}</a></li>";
        for($i=$active_page+1; $i<$active_page+4 && $i<=$page_count;$i++){
            if($i>0) $html.= "<li><a href='{$baseurl}/{$i}{$addition}'>{$i}</a></li>\n";
        }

        if($active_page<$page_count) $html.= "<li><a href='{$baseurl}/".($active_page+1)."{$addition}'><i class=\"fa fa-chevron-right\"></i></a></li>\n";
        $html.="</ul>";
        return $html;

    }

}