var selection=0;
function checkpwd(){
    var cur_pass_group = document.getElementById("cur_pass_group");
    var pass_group = document.getElementById("pass_group");
    var status= document.getElementById("status");

    if(selection==0){
        var valpass = document.getElementById("valpass").value;
        var curpass = document.getElementById("curpass").value;
        if(valpass == curpass){
            cur_pass_group.setAttribute("class","hide");
            pass_group.setAttribute("class","unhide");
            document.getElementById("checkbtn").setAttribute("value","Change");
            selection=1;
            status.setAttribute("class","status hide");
        }
        else{
            status.setAttribute("class","status unhide");
            status.style.color='#d80606';
            status.setAttribute("value","Wrong password");
        }
    }else{
        var newpass = document.getElementById("newpass").value;
        if(newpass == document.getElementById("confirmpass").value && newpass!="" && newpass!=""){
            $.post("admin.php?change=user&pass="+newpass);
            selection=0;
            document.getElementById("div1").setAttribute("class","hide");
            document.getElementById("div2").setAttribute("class","unhide");
            status.setAttribute("class","status unhide");
            status.style.color='black';
            status.setAttribute("value","Password changed");
            cur_pass_group.setAttribute("class","unhide");
            pass_group.setAttribute("class","hide");
            newpass.setAttribute("value","");
            document.getElementById("confirmpass").setAttribute("value","");
            document.getElementById("curpass").setAttribute("value","");
        }
        else{
            status.setAttribute("class","status unhide");
            status.style.color='#d80606';
            status.setAttribute("value","Password dosen't match");
        }
    }
}
