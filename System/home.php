<?php
  include '../View/header3.php';
  include_once '../Database/Database.php';

  session_start();

  $Username = $_SESSION['username'];
  $Password = $_SESSION['passwrod'];

  $RetEmail=get_email($Username);
  $RetID=get_UserID($Username);
  $RetPass=get_pass($Username, $Password);
  $RetName=get_name($Username);

  $UserID=$RetID[0];

  $FName=$RetName[0];
  $LName=$RetName[1];

  $task = get_incomplete_items($UserID);
  $cTask = get_complete_items($UserID);


  $TaskID = filter_input(INPUT_POST, 'task_id');
  if (!empty($TaskID)){
    delete_task($TaskID);
    header("Refresh:0");
  }


?>

<p id='b3'> Welcome back <?php echo $Username ?>! |
<span id='b4'> <a href='../index.php'>logout</a></span> </p>

<p id="b7"> <?php echo "$FName $LName"; ?>

<h1> To-Do Items  <button type="button" class="btn btn-success btn-circle">+</button></h1>
          <table>
            <tr>
                <th>Task&nbsp;</th>
                <th>Date Added&nbsp;</th>
                <th>Due Date&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($task as $tasks) : ?>
              <tr>
                  <td><?php echo $tasks['Task']; ?></td>
                  <td><?php echo $tasks['Date added']; ?></td>
                  <td><?php echo $tasks['Due Date']; ?></td>
                  <form action="home.php" method="post">
                      <input type="hidden" name="task_id" value="<?php echo $tasks['taskID']; ?>" >
                      <td><input type="submit" id="delete" name="delete" value="Delete" /></td>
                  </form>
                  <td id="tRows"><button id="edit" type="submit">Edit</button></td>
                  <td id="tswitch">
                      <label class="switch">
                      <input type="checkbox">
                      <div class="slider round"></div></label></td>
              </tr>
              <?php endforeach; ?>
          </table>
<h1> Items Completed</h1>
          <table>
            <tr>
                <th>Task&nbsp;</th>
                <th>Date Added&nbsp;</th>
                <th>Due Date&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($cTask as $ctasks) : ?>
              <tr>
                  <td><?php echo $ctasks['Task']; ?></td>
                  <td><?php echo $ctasks['Date added']; ?></td>
                  <td><?php echo $ctasks['Due Date']; ?></td>
                  <form action="home.php" method="post">
                      <input type="hidden" name="task_id" value="<?php echo $ctasks['taskID']; ?>" >
                      <td><input type="submit" id="delete" name="delete" value="Delete" /></td>
                  </form>
                  <td id="tRows"><button id="edit" type="submit">Edit</button></td>
                  <td id="tswitch">
                      <label class="switch" >
                      <input type="checkbox" checked>
                      <div class="slider round"></div></label></td>
              </tr>
              <?php endforeach; ?>
          </table>
</form>
<?php include '../View/footer.php'; ?>