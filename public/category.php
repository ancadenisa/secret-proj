<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->



<?php
    include_once '/../library/class/Avizier.php';
    $result = Category::getAllCategories();
    $categories = array();
    $i = 0;
    while($category = $result->fetch(PDO::FETCH_ASSOC)){
        $categories[$i]['id'] = $category['id'];
        $categories[$i]['name'] = $category['name'];
        $i++;
    } 

    if(isset($_GET['id'])){
        for($i = 0; $i < count($categories); $i++){
            if($_GET['id'] == $categories[$i]['id']){
                //echo $categoriesNames[$i];
                $result = Avizier::getAvizierByCatId($categories[$i]['id']);
                while($avizier = $result->fetch(PDO::FETCH_ASSOC)){
                    
                
                ?> 
                <div class="col-xs-4" style="border: dotted 1px aqua;">
                    <a href="public/avizier.php?id=<?php echo $avizier['id']; ?>&tip=<?php echo $categories[$i]['name'] ?>" style="text-decoration: none"><h1 class="text-center"><?php echo $avizier['title']; ?></h1></a>
                </div>
              
                <?php }
            }  
        }
    }
?>