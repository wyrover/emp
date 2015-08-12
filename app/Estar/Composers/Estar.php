<?php
/**
 */

namespace App\Estar\Composers;



 class Estar {

     protected $urls = [
         'home'=>['name'=>'人员概况','icon'=>'pie-chart'],
         'employee'=>['name'=>'人员详情','icon'=>'file-text-o'],
         'locale'=>['name'=>'现场统计','icon'=>'cubes'],
         'job'=>['name'=>'岗位分析','icon'=>'bar-chart'],
         'company'=>['name'=>'所属公司','icon'=>'building'],
         'admin'=>[
             'name'=>'系统设置','icon'=>'cogs',
             'submenu'=>[
                 'admin/employee'=>'人员管理',
                 'admin/position'=>'岗位管理',
                 'admin/company'=>'所属公司管理',
                 'admin/locale'=>'所在位置管理',
                 'admin/visa'=>'签证管理'
             ]
         ]
     ];

     public function showBreadcrumbs()
    {
        $path = \Request::path();
        $pattern = '/^[a-z0-9-]+/';
        $pattern_before2 = '/^[a-z0-9]+\/?[^\/]+/';
        preg_match($pattern,$path,$firstSlug);
//        记住!!  这个$firstSlug返回的是一个数组 因此用 $this->urls[$firstSlug[0]}

        preg_match($pattern_before2, $path,$beforetwo);

        if(array_key_exists('submenu',$this->urls[$firstSlug[0]])){
            return $this->urls[$firstSlug[0]]['submenu'][$beforetwo[0]];
        }

        $icon = ' <i class="fa fa-'.$this->urls[$firstSlug[0]]['icon'].'"></i> ';

        echo $this->urls[$firstSlug[0]]['name'].$icon;
    }

     public function makeMenu()
     {
         
         foreach( $this->urls as $k => $url){
             if(array_key_exists('submenu',$url)){
                echo '<li class="has-submenu"><a href="'.url($k).'"><i class="fa fa-'.$url['icon'].'"></i><span class="nav-label">'.$url['name'].'</span></a>';
                 echo ' <ul class="list-unstyled">';
                 foreach($url['submenu'] as $key => $sub){
                     echo ' <li><a href="'.url($key).'">'.$sub.'</a></li>';
                 }
                 echo '</ul></li>';
             }
             else
                echo '<li><a href="'.url($k).'"  ><i class="fa fa-'.$url['icon'].'"></i><span class="nav-label">' .$url['name'].'</span></a></li>';
        }
     }

public function showTime()
{
    $weekarray=array("日","一","二","三","四","五","六");
    $week = "周".$weekarray[date('w')];
    return date('Y年m月d日 '.$week);
}

     public function showAtLeastEditor()
     {
         if(\Auth::user()->level() > 1){
             return $show = 'visible';
         }
         return $show = 'hidden';
}

     public function showOnlyAdmin()
     {
         if(\Auth::user()->level() < 9){
             return $show = 'hidden';
         }
         return $show = 'visible';
     }

}