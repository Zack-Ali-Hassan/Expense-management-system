$("#from").attr("disabled",true)
$("#to").attr("disabled",true)


$("#type").on("change", function(){
    if($("#type").val()==0){
        $("#from").attr("disabled",true)
        $("#to").attr("disabled",true)
    }
    else{
        $("#from").attr("disabled",false)
        $("#to").attr("disabled",false)
    }
})

$("#printStatement").on("click", function(){
    printStatement();
})
function printStatement(){
    let prinArea=document.querySelector("#printArea");
    let newWindow=window.open("");
    newWindow.document.write(`<html><head>`);
    newWindow.document.write(`<style media="print">
    table{
        font-size: 12px !important;
        font-weight: bold !important;
        width: 100% !important;
    }
    th{
        background-color:04AA6D !important;
        color:white !important;
    }
    th,td{
        border-bottom: 1px solid #ddd !important;
        padding: 15px !important;
        text-align: left !important;
    }
    </style>`);
    newWindow.document.write(`</head><body>`);
    //newWindow.document.write(`<img width ="100%" height="300px" src="../Views/image.png">`);
    newWindow.document.write(prinArea.innerHTML);
    newWindow.document.write(`</body></html>`);
    newWindow.print();
    newWindow.close();
}
//EXPORT 
$("#exportStatement").on("click", function(){
    let file= new Blob([$("#printArea").html()],{type:'application/vnd.ms-excel'});
    let url =URL.createObjectURL(file);
    let a=$("<a />", {
    href: url,
    download: "print_statement.xls"}).appendTo("body").get(0).click();
e.preventDefault()});
//Register function
$("#userExpense").submit(function(event){
    event.preventDefault();
    $("#userTable tr").html("");
    let from=$("#from").val();
    let to=$("#to").val();
    let sendData={
        'from': from,
        'to': to,
        'action':'getUserStatement'
    }
    $.ajax({
        method:'POST',
        dataType :'JSON',
        url:'../api/expense.php',
        data:sendData,
        success:function(data){
            let status=data.status;
            let response=data.data;
            let tr="";
            let thead="";
            if(status){
                response.forEach(item=>{
                    thead="<tr>";
                    for(let i in item){
                        thead+=`<th>${i}</th>`;
                    }
                    thead+="</tr>";
                    tr+="<tr>";
                    for(let i in item){
                            tr+=`<td>${item[i]}</td>`;
                        }
                         tr+="</tr>";
                    })
                    $("#userTable thead").append(thead);
                    $("#userTable tbody").append(tr);
            }
               
        
        },
        error:function(data){

        }
    })
})

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
//Display alert message
function displayMessage(type,message){
    let success=document.querySelector("#alertSuccess");
    let error=document.querySelector("#alertDanger");
    if(type=="success"){
        error.classList="alert alert-danger d-none";
        success.classList="alert alert-success";
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



