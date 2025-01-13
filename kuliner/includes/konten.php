<?php
if (isset($_GET['page'])) {
    $page = basename($_GET['page']);
    switch ($page) {
        case 'home':
            include "views/home.php";
            break;
        case 'about':
            include "views/about.php";
            break;
        case 'contact':
            include "views/contact.php";
            break;
        case 'makanan':
            include "views/makananView.php";
            break;
        case 'makananAdd':
            include "modul/makananAdd.php";
            break;
        case 'makananDelete':
            include "modul/makananDelete.php";
            break;
        case 'makananUpdate':
            include "modul/makananUpdate.php";
            break;
        case 'minuman':
            include "views/minumanView.php";
            break;
        case 'minumanAdd':
            include "modul/minumanAdd.php";
            break;
        case 'minumanDelete':
            include "modul/minumanDelete.php";
            break;
        case 'minumanUpdate':
            include "modul/minumanUpdate.php";
            break;
        default:
            include "views/404.php";
    }
} else {
    include "views/home.php";
}
