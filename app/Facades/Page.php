<?php namespace DCN\Facades;


use Illuminate\Support\Facades\Facade;
use DCN\Page as Pages;

class Page extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'page';
    }

    public static function navigation($inputOptions=array('name'=>'smith'))
    {
        $options=array('id'=>'ok','name'=>'bob');
        $options=array_replace($options,$inputOptions);
        $pages = Pages::roots()->get();
        $html = "";
        foreach($pages as $page)
        {
            $html .= self::navWork($page,$options);
        }
        return $html;
    }

    protected static function navWork($page,$options)
    {
        $router = static::$app['router'];
        if($router->currentRouteName()=="page")
        {
            $currentPage=$router->current()->pageUrl;
        }
        if($page->descendants()->count() > 0){
            if(isset($currentPage)&&$currentPage->isSelfOrDescendantOf($page))
            {
                $html = "<li class=\"dropdown active\">";
            }else{
                $html = "<li class=\"dropdown\">";
            }

            $html .= "<a data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\" class=\"dropdown-toggle\" href=\"".URL::page($page)."\">".$page->title."</a>";
            //Page has children
            $html .= "<ul class=\"dropdown-menu\" role=\"menu\">";
            foreach($page->descendants()->get() as $subPage)
            {
                $html .= self::navWork($subPage,$options);
            }
            $html .= "</ul>";
        }else{
            if(isset($currentPage)&&$currentPage->isSelfOrDescendantOf($page))
            {
                $html = "<li class=\"active\">";
            }else{
                $html = "<li>";
            }
            $html .= "<a class=\"page-scroll\" href=\"".URL::page($page)."\">".$page->title."</a>";
        }
        $html .= "</li>";
        return $html;
    }
}