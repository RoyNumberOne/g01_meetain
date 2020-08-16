$(Document).ready(function(){
    console.log(123);
    $("#memList").click(function(){
        console.log(123);
    $.getJSON('../json/Initial_member.json',function (data){
        console.log(123);
        // viewData= "<ul>"
        // let items = [];
        // $.each(data, function(key,value){
        //     items.push(`<li id="${key}"> ${value}</li>`)
        // })
        // viewData+=items;

        // viewData+= "</ul>"
        // $("#memList_ans").append(viewData);
    }
    )}
)});