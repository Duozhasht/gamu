<?php
  class IndexController {
    public function home() {
      echo "<script>window.history.pushState(null, null, 'http://localhost:8888/gamu/website/?controller=index&action=home');</script>";
      require_once('views/index/home.php');
    }

    public function error() {
      require_once('views/index/error.php');
    }
  }
?>