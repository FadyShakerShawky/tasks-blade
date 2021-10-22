const host =  window.location.origin;

function sendAjax(url, data, method, callback) {
    $.ajax({
        url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "Accept": "application/json"
        },
        contentType: "application/json",
        data: JSON.stringify(data),
        method,
        success: (res) => {
            callback && callback(res)
        },
        error: (err) => {
            console.log(err);
        }
    })
}
$(".delete-btn").on("click",function(){
    let id = $(this).data("id");
    let url = host + `/api/tasks/delete/${id}`;
    sendAjax(url, null, "DELETE", (res)=>deleteCallBack(res,id))
});
function deleteCallBack(res,id){
    if(res.status){
        $(`.task-row[data-id='${id}']`).remove();
        if($(`.task-row`).length == 0){
            $("#tasks-table").remove();
            $("#tasks-container").append("<h4 class='text-center'>No other tasks exsist</h4>")
        }
    }
}
$(".ready-checkbox").on("change",function(){
    let id = $(this).data("id");
    let status = $(this).prop('checked') ? "ready" : "postponed";
    changeTaskStatus(id,status)
})
$(".postponed-checkbox").on("change",function(){
    let id = $(this).data("id");
    let status = $(this).prop('checked') ? "postponed" : "ready";
    changeTaskStatus(id,status)
})
function changeTaskStatus(id,status){
    let url = host + `/api/tasks/updateStatus`;
    let data = {
        id,status
    }
    sendAjax(url, data, "PUT", (res)=>changeStatusCallBack(res,id,status))
}
function changeStatusCallBack(res,id,status){
    if(res.status){
        if(status == "postponed"){
            $(`.task-row[data-id='${id}']`).addClass("bg-light-red");
            $(`.task-row[data-id='${id}']`).removeClass("bg-light-green");
            $(`.postponed-checkbox[data-id='${id}']`).prop('checked',true);
            $(`.ready-checkbox[data-id='${id}']`).prop('checked',false);
        }   else    {
            $(`.task-row[data-id='${id}']`).addClass("bg-light-green");
            $(`.task-row[data-id='${id}']`).removeClass("bg-light-red");
            $(`.postponed-checkbox[data-id='${id}']`).prop('checked',false);
            $(`.ready-checkbox[data-id='${id}']`).prop('checked',true);
        }
        $(`.task-status[data-id='${id}']`).text(status);
    }
}
