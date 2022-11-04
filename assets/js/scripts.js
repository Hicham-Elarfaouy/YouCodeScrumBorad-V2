
document.querySelector("#addButton").addEventListener("click", ()=>{
    document.querySelector("#form-task").reset();
    document.querySelector('#task-title').classList.remove('errorVal');
    document.querySelector('#task-description').classList.remove('errorVal');

    // Open Modal
    $("#modal-task").modal('show');

    document.querySelector("#task-save-btn").style.display = 'block';
    document.querySelector("#task-delete-btn").style.display = 'none';
    document.querySelector("#task-update-btn").style.display = 'none';
});

function editTask(id){
    $.ajax({
        type: "POST",
        url: 'scripts.php',
        data: {openTask : id},
        success: function (obj) {
            document.getElementById('task-title').value                                     = obj[0];
            document.getElementById("task-type-"+obj[1]).checked                            = true;
            document.getElementById('task-priority').value                                  = obj[2];
            document.getElementById('task-status').value                                    = obj[3];
            document.getElementById('task-date').value                                      = obj[4];
            document.getElementById('task-description').value                               = obj[5];
        }
    });

    document.querySelector('#task-title').classList.remove('errorVal');
    document.querySelector('#task-description').classList.remove('errorVal');
    $("#modal-task").modal('show');
    console.log(id);

    document.querySelector("#task-save-btn").style.display = 'none';
    document.querySelector("#task-delete-btn").style.display = 'block';
    document.querySelector("#task-update-btn").style.display = 'block';

    document.querySelector("#task-id").value = id;
}

function deleteTask(){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            let button = document.querySelector("#buttonSubmit");
            button.removeAttribute('name');
            button.setAttribute('name', 'delete');
            button.click();
        }
      });
}

function validation(save){
    let taskTitle = document.querySelector('#task-title');
    let titlePattern = /^[aA0-zZ9\s]+$/;
    validationBorder(taskTitle, titlePattern);
    let taskDescription = document.querySelector('#task-description');
    let descriptionPattern = /^[aA0-zZ9\s]+$/;
    validationBorder(taskDescription, descriptionPattern);
    

    if(titlePattern.test(taskTitle.value) && descriptionPattern.test(taskDescription.value)){
        let button = document.querySelector("#buttonSubmit");
        button.removeAttribute('name');

        if(save == 1){
            button.setAttribute('name', 'save');
        }else{
            button.setAttribute('name', 'update');
        }

        button.click();
    }
}

function validationBorder(input, pattern){
    if(input.value == ''){
        input.classList.add('errorVal');
    }
    input.addEventListener('input', ()=>{
        if(!pattern.test(input.value)){
            input.classList.add('errorVal');
        }else{
            input.classList.remove('errorVal');
        }
    });
}