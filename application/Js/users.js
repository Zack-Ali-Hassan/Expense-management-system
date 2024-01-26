loadData();
let btnAction='Insert';
let fileInput =document.querySelector("#image");
let showInput =document.querySelector("#show");
const reader=new FileReader();
fileInput.addEventListener("change",(e)=>{
    const selectFile=e.target.files[0];
    reader.readAsDataURL(selectFile);
})
reader.onload=e=>{
    showInput.src=e.target.result;
}
$("#addNew").click(function(){
    $("#userModal").modal("show");
})
//Register function
$("#userForm1").submit(function(event){
    event.preventDefault();
    // let amount =$("#amount").val();
    // let type =$("#type").val();
    // let description =$("#description").val();
    // let id =$("#UpdateExpenseHidden").val();
    let sendData=new FormData($("#userForm1")[0]);
    //sendData.append("image",$("input[type=file]")[0].files[0]);
    if(btnAction=='Insert'){
        
        sendData.append('action','register_user');
    }
    else{
        sendData.append('action','update_user');
    }
    $.ajax({
        method:'POST',
        dataType :'JSON',
        url:'../api/users.php',
        data:sendData,
        processData:false,
        contentType:false,
        success:function(data){
            let status=data.status;
            let response=data.data;
            if(status){
               displayMessage("success",response);
               btnAction = "Insert"; 
               $("#userForm1")[0].reset();
              loadData();

            }
            else{
                displayMessage("error",response);
            }
        },
        error:function(data){
            alert(data)
        }
    })
})
//read ALl Expenses
function loadData(){
    $("#userTable1 tr").html("");
    let sendData={
        'action':'readAllUsers'
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/users.php",
        data:sendData,
        success:function(data){
            let status=data.status;
            let response=data.data;
            let tr="";
            let html="";
            if(status){
                response.forEach(item=>{
                    html="<tr>";
                    for(let i in item){
                        html+=`<th>${i}</th>`;
                    }
                     html+=`<th>Action</th>`;
                    html+="</tr>";
                    tr+="<tr>";
                    for(let i in item){
                        if(i=="image"){
                            tr+=`<td ><img src= "../uploads/${item[i]}" style ="width:100px;height:100px;border-radius:50%;object-fit:cover">  </td>`;
                        }
                        else{
                            tr+=`<td>${item[i]}</td>`;
                        }
                    }
                   tr+=`<td><a class="btn btn-info update_info" update_info="${item['id']}"><i class="fas fa-edit" style="color:#fff"></i></a>
                    &nbsp; &nbsp <a class="btn btn-danger delete_info" delete_info="${item['id']}"><i class="fas fa-trash" style="color:#fff"></i</a></td>`;
                    tr+="</tr>";
                })
               $("#userTable1 thead").append(html);
               $("#userTable1 tbody").append(tr);
            }
        
        },
        error:function(data){
           displayMessage('error',message)
        }
    })
}
//fetch function
function fetchDataUsers(id){
    let sendData={
        "action":"readUser",
        "id" : id
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/users.php",
        data:sendData,
        success:function(data){
             console.log(data); 
            let status=data.status;
            let response=data.data;
            let html="";
            let tr="";
            if(status){
           
                btnAction="Update";
                $("#update_id").val(response['id']);
                $("#username").val(response['username']);
                $("#password").val(response['password']);
                $("#show").attr('src',`../uploads/${response['image']}`);
                $("#userModal").modal("show");
                 //loadData();
                
            }
            else{
                displayMessage('error',response)
            }
        },
        error:function(data){
             alert(data)
        }
    })
}
//Display alert message
function displayMessage(type,message){
    let success=document.querySelector("#alertSuccess");
    let error=document.querySelector("#alertDanger");
    if(type=="success"){
        error.classList="alert alert-danger d-none";
        success.classList="alert alert-success";
        success.innerHTML=message;
        setTimeout(function() {
        $("#userModal").modal("hide");
        success.classList="alert alert-success d-none";
        $("#userForm1")[0].reset(); 
         loadData();
        }, 3000);
    }
    else{
        error.classList="alert alert-danger";
        error.innerHTML=message;
    }
}
//deleteFunction
function deleteDataUser(id){
    let sendData={
        "action":"deleteUser",
        "id" : id
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/users.php",
        data:sendData,
        success:function(data){
            let status=data.status;
            let response=data.data;
            let html="";
            let tr="";
            if(status){
                swal("Good job!", response, "SUCCESS");
                loadData();
                
            }else{
                swal("Good job!", response, "danger");
            }
        },
        error:function(data){
            alert(data);
        }
    })
}

$("#userTable1 ").on("click","a.update_info",function(){
    let id=$(this).attr("update_info");
     fetchDataUsers(id);
})

$("#userTable1 ").on("click","a.delete_info",function(){
    let id=$(this).attr("delete_info");
    if(confirm("Are you sure you want to delete this " + id)){
        deleteDataUser(id);
    }
     
})
