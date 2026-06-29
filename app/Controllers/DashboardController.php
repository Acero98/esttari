<?php

class DashboardController
{
    public function index()
    {
        if (!isset($_SESSION['idUser'])) {

            header("Location: index.php?url=login");
            exit;
        }

        require_once "../app/Views/dashboard.php";
    }
}