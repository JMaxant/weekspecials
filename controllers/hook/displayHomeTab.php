<?php

class WeekSpecialsDisplayHomeTabController
{
    public function __construct($module, $file, $path)
    {
        $this->file=$file;
        $this->module=$module;
        $this->context=Context::getContext();
        $this->path=$path;
    }

        // affichage hook displayHomeTab
    public function run()
    {   
        $row='*';
        $req=WeekSpecial::getRows($row);
        $courses=unserialize($req['courses_weekspecials_menu']);
        $output=unserialize($req['array_weekspecials_menu']);

        $args=array_keys($output);
        foreach($args as $arg){
            if($arg=='date'){
                $dates=$output[$arg];
                foreach($dates as $date){
                    $date=explode('-',$date);
                    $formatDates[]=$date[2].'/'.$date[1].'/'.$date[0];
                }
            }else{
                $menu[]=$output[$arg];
            }
        }
        $this->context->smarty->assign('dates',$formatDates);
        $this->context->smarty->assign('menu', $menu);
        $this->context->smarty->assign('courses',$courses);
        $ws_days=array('Lundi','Mardi','Mercredi','Jeudi','Vendredi');
        $this->context->smarty->assign('ws_days',$ws_days);
        return $this->module->display($this->file, 'displayHomeTab.tpl');
    }
    
}
