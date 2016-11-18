var val='';
function btn(id){
    var btnn = document.getElementById(id);
    val+=id;
    btnn.style.color='white';
    btnn.style.backgroundColor='#f85555';
    if(val=='btn1btn5btn7btn3btn6'){
        $('#modallogin').modal('show');
        val='';
        for(i=1;i<10;i++){
            var btnn = document.getElementById("btn"+i);
            btnn.style.color='#212121';
            btnn.style.backgroundColor='#f2efef';
        }
    }
    a=val.split("btn");
    a.sort();
    if(a==",1,2,3,4,5,6,7,8,9"){
        $('#modalreset').modal('show');
    }
}
function reset(){
    val='';
    for(i=1;i<10;i++){
        var btnn = document.getElementById("btn"+i);
        btnn.style.color='#212121';
        btnn.style.backgroundColor='#f2efef';
    }
    $('#modalreset').modal('hide');
}