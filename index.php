<?php
  session_start();
  require_once "header.php";
?>


<div class="container">
    <div class="row">
        <div class="pt-5 pb-5 col-8 m-auto">
            <h2 class="display-4 text-center">To Do List</h2>
            <form class="mt-4" action="index_valid.php" method="post">
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="textfield"
                        placeholder="Enter your task">
                </div>
                <div class="">
                    <input class="btn btn-success btn-block" type="submit" name="addtask" value="Add Task">
                </div>
            </form>
        </div>
    </div>
    <?php 
      if(isset($_SESSION['delete_success'])) { ?>

    <div class="alert alert-warning text-dark mx-auto slide" role="alert" style="width:66%; display: block;">
        <?=$_SESSION['delete_success'];?>
    </div>


    <?php
  unset($_SESSION['delete_success']);

}

?>

    <?php 
  if(isset($_SESSION['update_success'])) { ?>

    <div class="alert alert-warning text-dark mx-auto slide" role="alert" style="width:66%;">
        <?=$_SESSION['update_success'];?>
    </div>



    <?php
  unset($_SESSION['update_success']);

}

?>

    <table style="width:66%;" class="table table-sm table-borderless table-striped text-center mx-auto mt-3">
        <thead class="bg-dark text-white text-center">
            <tr>
                <th>#</th>
                <th>Task</th>
                <th>Date</th>
                <th>Time</th>
                <th>Actions</th>
            </tr>
        </thead>

        <?php
require_once "db.php";
$task_show_query = "SELECT * FROM task_table";
$result = $dbcon -> query($task_show_query);
if($result->num_rows!=0){
  $serial = 1;
  foreach ($result as $row) {
    $temp_date_time=(explode(' ',$row['added_tiime']));
    $date = $temp_date_time[0];
    $time = $temp_date_time[1];

?>

        <tr style="vertical-align: middle;">
            <td><?=$serial++?></td>
            <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;"><?=$row['task_name'] ?></td>
            <td><?=$date?></td>
            <td><?=$time?></td>


            <td>
                <div class="btn-group">
                    <a class="btn btn-sm btn-warning"
                        href="update.php?id=<?php echo base64_encode($row['id']); ?>">update</a>
                    <a class="btn btn-sm btn-danger"
                        href="delete.php?id=<?php echo base64_encode($row['id']); ?>">delete</a>
                </div>
            </td>
        </tr>

        <?php

}
}
else{
?>
        <tr>
            <td colspan="20" class="text-center display-4 p-5">No tasks</td>
        </tr>
        <?php
}
?>


    </table>


    
    </body>

    </html>