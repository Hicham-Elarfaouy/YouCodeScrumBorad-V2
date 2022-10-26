<?php
    //INCLUDE DATABASE FILE
    include('database.php');
    //SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
    session_start();

    //ROUTING
    if(isset($_POST['save']))        saveTask();
    if(isset($_POST['update']))      updateTask();
    if(isset($_POST['delete']))      deleteTask();
    

    function getTasks($status)
    {
        //CODE HERE
        //SQL SELECT
        $link = connection();

        $sql = "SELECT * FROM tasks where status_id = $status";
        if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $icon = 'far fa-question-circle';
                    if($status == 2){
                        $icon = 'fas fa-circle-notch fa-spin';
                    }elseif($status == 3){
                        $icon = 'far fa-circle-check';
                    }

                    echo '
                    <button onclick="editTask('.$row['id'].')" class="list-group-item list-group-item-action d-flex">
                        <div class="me-3 fs-16px">
                            <i class=" '.$icon.' text-green fa-fw"></i> 
                        </div>
                        <div class="flex-fill w-75">
                            <div class="fs-14px lh-12 mb-2px fw-bold text-dark text-truncate">'.$row['title'].'</div>
                            <div class="mb-1 fs-12px">
                                <div class="text-gray-600 flex-1">#'.$row['id'].' created in '.$row['task_datetime'].'</div>
                                <div class="text-gray-900 flex-1 text-truncate" title="'.$row['description'].'">'.$row['description'].'</div>
                            </div>
                            <div class="mb-1">
                                <span class="badge bg-primary">'.$row['priority_id'].'</span>
                                <span class="badge bg-gray-300 text-gray-900">'.$row['type_id'].'</span>
                            </div>
                        </div>
                    </button> ';
                }
                // Free result set
                mysqli_free_result($result);
            } else{
                echo "No records matching your query were found.";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
         
        // Close connection
        mysqli_close($link);
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

        // Attempt insert query execution
        $sql = "INSERT INTO tasks (`title`, `type_id`, `priority_id`, `status_id`, `task_datetime`, `description`) VALUES ('$title', '$type', '$priotity', '$status', '$date', '$description')";
        if(mysqli_query($link, $sql)){
            echo "Records inserted successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
        
        // Close connection
        mysqli_close($link);
        
        $_SESSION['message'] = "Task has been added successfully !";
		header('location: index.php');
    }

    function updateTask()
    {
        //CODE HERE
        //SQL UPDATE
        $_SESSION['message'] = "Task has been updated successfully !";
		header('location: index.php');
    }

    function deleteTask()
    {
        //CODE HERE
        //SQL DELETE
        $_SESSION['message'] = "Task has been deleted successfully !";
		header('location: index.php');
    }

?>