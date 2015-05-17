<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php 
    include '../library/class/Avizier.php';
    $avizier = Avizier::getAllAviziere();
?>

<section class="widget">
    <header>
        <h3><i class="fa fa-home"></i> Home </h3>
    </header>
    <div class="body">
        <div class="row" style="margin-top:20px;">
            <div class="col-xs-4">
                <div class="box">
                    <div class="icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <div class="description">
                        <h3><strong>14</strong> meetings</h3>
                    </div>
                </div>
            </div>
        </div>    
    </div>    
</section>