<?php
class View
{
    private
        $view_name,
        $template=NULL,
        $data=[],
        $styles=[];

    public function __construct($name){
        $this->view_name = VIEWS_PATH.$name.".php";
    }

    public function setTemplate($name = "default"){
        $this->template = TEMPLATES_PATH.$name.".php";
    }

    private function _renderView($data=[]){
        $data = array_merge($data,$this->data);
        ob_start();
        extract($data);
        include $this->view_name;
        return ob_get_clean();
    }

    private function _renderWithTemplate($data=[]){
        $data = array_merge($data,$this->data);
        ob_start();
        extract($data);
        $content = $this->_renderView($data);
        include $this->template;
        return ob_get_clean();
    }

    public function render($data=[]){
        $data["style"] = $this->getSlylesString();
        return $this->template ? $this->_renderWithTemplate($data) : $this->_renderView($data);
    }
    public function renderGZ($data=[]){
        if(strstr($_SERVER["HTTP_ACCEPT_ENCODING"],"gzip")){
            header("Content-encoding:gzip");
            return gzencode($this->render($data),5);
        }else return $this->render($data);
    }

    public function __set($name,$value){
        $this->data[$name] = $value;
    }
    public function addStyle($style){
        $this->styles[] = Helper_HTML::css($style);
    }
    public function getSlylesString(){
        return implode("\n",$this->styles);
    }

}