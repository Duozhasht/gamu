<?php
  class IndexController {
    public function home() {
      require_once('views/index/home.php');
    }

    public function error() {
      require_once('views/index/error.php');
    }
  }
?>