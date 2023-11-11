<!--
    Author: Jeonghyeon Lee
    Date: Apr 3rd
    File: index.php
    Lab Objective: This is for index(main) page
-->

<?php
require_once('./dao/postDAO.php'); 
require_once('./lib.php'); 

$postDAO = new postDAO();

$limit = 10;
$page_limit = 10;
$page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
$start = ($page -1) * $limit;

$posts = $postDAO->getPosts($start,$limit);

$total = $postDAO->getCnt();
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Forum</title>

        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
            crossorigin="anonymous"></script>
        
        <!-- java script -->
        <script src="./main.js" defer></script>
    </head>
    <body>
        <div class="container mt-3">
            <h1 class="h1">Open Forum (Open Blog)</h1>
        </div>
        <div class="container mt-3">
            <h4 class="h4">Description</h4>
            This is an Open Forum where everyone can post their stories. It's simple to use.<br>
            <b>1. Click on the post to view the content/edit your content.</b><br>
            <b>2. Click on the write button to post your stories. - Author name should be less than 13 characters with no space and PW should be longer than 4 characters</b><br>
        </div>
        <div class="container mt-3">
            <table class="table table-bordered table-hover">
                <colgroup>
                    <col width="7%"/>
                    <col width="63%"/>
                    <col width="10%"/>
                    <col width="10%"/>
                    <col width="10%">
                </colgroup>
                <thead class="text-bg-primary text-center">
                <tr>
                    <th>#No</th>
                    <th>Subject</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th>View</th>
                </tr>
                </thead>
                <?php
                    if($posts){
                    foreach($posts AS $row) {
                    ?>
                <tr class="view_detail" data-idx="<?= $row->getIdx()?>">
                    <td class="text-center"><?= $row->getIdx()?></td>
                    <td><?= $row->getSubject()?></td>
                    <td class="text-center"><?= $row->getName()?></td>
                    <td class="text-center"><?= substr($row->getRdate(),0,10)?></td>
                    <td class="text-center"><?= $row->getHit()?></td>
                </tr>
                <?php } }?>
            </table>

            
            <div class="mt-3 d-flex justify-content-between align-items-start">
                <?php $rs_pg=my_pagination($total, $limit, $page_limit, $page); 
                        echo $rs_pg;?>

                <button class="btn btn-primary" id="btn_write">Write</button>
            </div>


        </div>
        <?php
        include 'footer.php';
        ?>
    </body>
</html>