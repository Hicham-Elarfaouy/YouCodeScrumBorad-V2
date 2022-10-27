
document.querySelector("#addButton").addEventListener("click", ()=>{
    clearForm();

    // Open Modal
    $("#modal-task").modal('show');

    document.querySelector("#task-save-btn").style.display = 'block';
    document.querySelector("#task-delete-btn").style.display = 'none';
    document.querySelector("#task-update-btn").style.display = 'none';
});

function editTask(id){
    $("#modal-task").modal('show');
    console.log(id);

    document.querySelector("#task-save-btn").style.display = 'none';
    document.querySelector("#task-delete-btn").style.display = 'block';
    document.querySelector("#task-update-btn").style.display = 'block';

    document.querySelector("#task-id").value = id;
}

function clearForm(){
    document.querySelector("#task-id").value = '';
    document.querySelector("#task-title").value = '';
    document.querySelector("#task-type-feature").checked = true;
    document.querySelector("#task-priority").value = '1';
    document.querySelector("#task-status").value = '1';
    document.querySelector("#task-date").value = '';
    document.querySelector("#task-description").value = '';
}