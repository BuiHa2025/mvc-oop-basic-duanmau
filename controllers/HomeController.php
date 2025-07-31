<?php
class HomeController
{
    public function index()
    {
        require_once PATH_VIEW . 'trangchu.php';
        $act = $_GET['act'] ?? '';
            switch ($act) {
                case 'chitiet':
                    $view = 'chitiet';
                    break;
                
                default:
                    $view = 'trangchu';
                    break;
            }

            include_once PATH_VIEW . $view . '.php';
            }
}
