
document.querySelector("#addButton").addEventListener("click", ()=>{
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
}