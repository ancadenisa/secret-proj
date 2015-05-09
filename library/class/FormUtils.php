<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormUtils
 *
 * @author Anca
 */
class FormUtils {
    public static function isActionViewOrDel($action_){
        if($action_ == 'edit' || $action_ == 'add'){
            return " ";
        }
        return "hidden";
    }
    
    public static function isNotActionDel($action_){
        if($action_ == 'delete'){
            return " ";
        }
        return "hidden";
    }
    
    public static function isActionViewOrDel_readonly($action_) {
        if($action_ == 'view' || $action_ == "delete"){
            return "readonly";
        }
        return " ";        
    }
    
    public static function isActionViewDelOrEdit_readonly($action_) {
        if($action_ == 'edit' || $action_ == 'view' || $action_ == "delete"){
            return "disabled";
        }
        return " ";        
    }
}
