<?php
if(count(get_included_files()) ==1){
    http_response_code(404);
    include('../view/404.php');
    exit;
}
?>