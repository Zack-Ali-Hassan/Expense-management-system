loadData();
let btnAction='Insert';
$("#addNew").click(function(){
    $("#expenseModal").modal("show");
})
//Register function
$("#expenseForm1").submit(function(event){
    event.preventDefault();
    let amount =$("#amount").val();
    let type =$("#type").val();
    let description =$("#description").val();
    let id =$("#UpdateExpenseHidden").val();
    let sendData={};
    if(btnAction=='Insert'){
        sendData={
        'amount' : amount,
        'type': type,
        'description': description,
        'action':'registerExpense'
    }
    }
    else{
        sendData={
        'id':id,
        'amount' : amount,
        'type': type,
        'description': description,
        'action':'updateExpense'
    }
    }

    $.ajax({
        method:'POST',
        dataType :'JSON',
        url:'../api/expense.php',
        data:sendData,
        success:function(data){
            let status=data.status;
            let response=data.data;
            if(status){
               displayMessage("success",response);
               btnAction = "Insert"; 
              loadData();

            }
            else{
                displayMessage("error",response);
            }
        },
        error:function(data){

        }
    })
})
//read ALl Expenses
function loadData(){
    $("#expenseTable1 tbody").html("");
    let sendData={
        'action':'readAllExpense'
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/expense.php",
        data:sendData,
        success:function(data){
            let status=data.status;
            let response=data.data;
            let tr="";
            let html="";
            if(status){
                response.forEach(item=>{
                    tr+="<tr>";
                    for(let i in item){
                        if(i=="type"){
                            if(item[i]=="Income"){
                                tr+=`<td ><span class="badge badge-success"> ${item[i]} </span> </td>`;
                            }
                            else{
                                tr+=`<td> <span class="badge badge-danger"> ${item[i]} </span> </td>`;
                            }
                        }
                        else{
                            tr+=`<td>${item[i]}</td>`;
                        }
                    }
                   tr+=`<td><a class="btn btn-info update_info" update_info="${item['id']}"><i class="fas fa-edit" style="color:#fff"></i></a>
                    &nbsp; &nbsp <a class="btn btn-danger delete_info" delete_info="${item['id']}"><i class="fas fa-trash" style="color:#fff"></i</a></td>`;
                    tr+="</tr>";
                })
               $("#expenseTable1 tbody").append(tr);
            }
        
        },
        error:function(data){
           displayMessage('error',message)
        }
    })
}
//fetch function
function fetchDataExpense(id){
    let sendData={
        "action":"readExpense",
        "id" : id
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/expense.php",
        data:sendData,
        success:function(data){
            let status=data.status;
            let response=data.data;
            let html="";
            let tr="";
            if(status){
                btnAction="Update";
                $("#UpdateExpenseHidden").val(response[0].id)
                $("#amount").val(response[0].amount)
                $("#type").val(response[0].type)
                $("#description").val(response[0].description)
                $("#expenseModal").modal("show");
                 //loadData();
                
            }
        },
        error:function(data){
             displayMessage("error",response);
        }
    })
}
//Display alert message
function displayMessage(type,message){
    let success=document.querySelector("#alertSuccess");
    let error=document.querySelector("#alertDanger");
    if(type=="success"){
        error.classList="alert alert-danger d-none";
        success.classList="alert mbnjhh";
        success.innerHTML=message;
        setTimeout(function() {
        $("#expenseModal").modal("hide");
        success.classList="alert alert-success d-none";
        $("#expenseForm1")[0].reset(); 
         loadData();
        }, 3000);
    }
    else{
        error.classList="alert alert-danger";
        error.innerHTML=message;
    }
}
//deleteFunction
function deleteDataExpense(id){
    let sendData={
        "action":"deleteExpense",
        "id" : id
    }
    $.ajax({
        method:"POST",
        dataType:"JSON",
        url:"../api/expense.php",
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
            
        }
    })
}

$("#expenseTable1 ").on("click","a.update_info",function(){
    let id=$(this).attr("update_info");
     fetchDataExpense(id);
})

$("#expenseTable1 ").on("click","a.delete_info",function(){
    let id=$(this).attr("delete_info");
    if(confirm(`Are you sure you want to delete id = ` + id)){
        deleteDataExpense(id);
    }
     
})
