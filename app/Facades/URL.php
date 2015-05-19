<?php namespace DCN\Facades;

class URL extends \Illuminate\Support\Facades\URL
{
    public static function page($parameters = array(), $absolute = true, $route = null)
    {
        if(is_array($parameters))
        {
            foreach($parameters as $key=>$value)
            {
                if(is_a($value,'DCN\Page'))
                {
                    $page = $parameters[$key];
                }
            }
        }elseif(is_a($parameters,'DCN\Page')){
            $page = $parameters;
            $parameters = array();
        }
        if(isset($page))
        {
            $url = "";
            if($page->system)
            {
                switch($page->slug)
                {
                    case "home":
                        break;
                    case "about":
                        $url='about';
                        break;
                    default:
                        $url=$page->slug;
                        break;
                }
            }else{
                $url=$page->getURLAttribute();
            }
            $parameters['page']=$url;
        }
        $urlGenerator = static::$app['url'];
        return $urlGenerator->route('page', $parameters, $absolute, $route);
    }
}