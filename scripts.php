<?php
    //INCLUDE DATABASE FILE
    include('database.php');
    //SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
    session_start();

    //ROUTING
    if(isset($_POST['save']))        saveTask();
    if(isset($_POST['update']))      updateTask();
    if(isset($_POST['delete']))      deleteTask();
    if(isset($_POST['openTask']))    getSpecificTask($_POST['openTask']);
    

    function getTasks($status)
    {
        //CODE HERE
        //SQL SELECT
        $count = 1;
        $link = connection();

        $sql = "SELECT ts.id, ts.title, ty.name AS 'type', pr.name AS 'priority', ts.task_datetime, ts.description 
        FROM tasks AS ts, types AS ty, priorities AS pr 
        WHERE ts.type_id = ty.id AND ts.priority_id = pr.id AND ts.status_id = $status
        ORDER BY ts.task_datetime";

        $icon = 'far fa-question-circle';
        if($status == 2){
            $icon = 'fas fa-circle-notch fa-spin';
        }else if($status == 3){
            $icon = 'far fa-circle-check';
        }
        
        if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){

                    echo "
                    <button onclick=editTask($row[id]) class='list-group-item list-group-item-action d-flex'>
                        <div class='me-3 fs-16px'>
                            <i class='$icon text-green fa-fw'></i> 
                        </div>
                        <div class='flex-fill w-75'>
                            <div class='fs-14px lh-12 mb-2px fw-bold text-dark text-truncate'>$row[title]</div>
                            <div class='mb-1 fs-12px'>
                                <div class='text-gray-600 flex-1'>#".$count++." created in $row[task_datetime]</div>
                                <div class='text-gray-900 flex-1 text-truncate' title='$row[description]'>$row[description]</div>
                            </div>
                            <div class='mb-1'>
                                <span class='badge bg-primary'>$row[priority]</span>
                                <span class='badge bg-gray-300 text-gray-900'>$row[type]</span>
                            </div>
                        </div>
                    </button> ";
                }
            }
        }
         
        // Close connection
        mysqli_close($link);
    }

    function getSpecificTask($id)
    {
        header('Content-Type: application/json');
        $aResult = [];
        // CODE HERE
        // SQL SELECT
        $link = connection();

        $sql = "SELECT * FROM tasks where id = $id";
        if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $aResult[0] = $row['title'];
                    $aResult[1] = $row['type_id'];
                    $aResult[2] = $row['priority_id'];
                    $aResult[3] = $row['status_id'];
                    $aResult[4] = $row['task_datetime'];
                    $aResult[5] = $row['description'];
                }
                // Free result set
                mysqli_free_result($result);
            }
        }
         
        // Close connection
        mysqli_close($link);
        echo json_encode($aResult);
    }

    function saveTask()
    {
        //CODE HERE
        //SQL INSERT
        $link = connection();

        $title = $_POST["task-title"];
        $type = $_POST["task-type"];
        $priotity = $_POST["task-priority"];
        $status = $_POST["task-status"];
        $date = $_POST["task-date"];
        $description = $_POST["task-description"];

        $sql = "INSERT INTO tasks (`title`, `type_id`, `priority_id`, `status_id`, `task_datetime`, `description`) VALUES ('$title', '$type', '$priotity', '$status', '$date', '$description')";
        mysqli_query($link, $sql);
        
        // Close connection
        mysqli_close($link);
        
        $_SESSION['message'] = "Task has been added successfully !";
		header('location: index.php');
    }

    function updateTask()
    {
        //CODE HERE
        //SQL UPDATE
        $link = connection();
        $id = $_POST["task-id"];
        $title = $_POST["task-title"];
        $type = $_POST["task-type"];
        $priotity = $_POST["task-priority"];
        $status = $_POST["task-status"];
        $date = $_POST["task-date"];
        $description = $_POST["task-description"];

        $sql = "UPDATE tasks SET `title`='$title',`type_id`='$type',`priority_id`='$priotity',`status_id`='$status',`task_datetime`='$date',`description`='$description' WHERE id = $id";
        mysqli_query($link, $sql);
         
        // Close connection
        mysqli_close($link);

        $_SESSION['message'] = "Task has been updated successfully !";
		header('location: index.php');
    }

    function deleteTask()
    {
        //CODE HERE
        //SQL DELETE
        $link = connection();
        $id = $_POST["task-id"];

        $sql = "DELETE FROM tasks WHERE id = $id";
        mysqli_query($link, $sql);
         
        // Close connection
        mysqli_close($link);

        $_SESSION['message'] = "Task has been deleted successfully !";
		header('location: index.php');
    }

    function getCountTasks($status)
    {
        //CODE HERE
        //SQL UPDATE
        $link = connection();

        $sql = "SELECT * FROM tasks where status_id = $status";
        $result = mysqli_query($link, $sql);

        echo mysqli_num_rows($result);
         
        // Close connection
        mysqli_close($link);
    }

?>