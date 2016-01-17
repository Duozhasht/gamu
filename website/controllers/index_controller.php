<?php
  class IndexController {
    public function home() {
      echo "<script>window.history.pushState(null, null, 'http://localhost:8888/gamu/website/?controller=index&action=home');</script>";


      $nr_audicoes = Audicao::count();
      $number_of_records = 50;
      $result_number=ceil($nr_audicoes/$number_of_records);

      $audicoes_next = Audicao::retrieve('data',1,$number_of_records,2);
      
      require_once('views/index/home.php');
    }

    public function error() {
      require_once('views/index/error.php');
    }
  }
?>