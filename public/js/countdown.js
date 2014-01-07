function updateTimer( id , timediff , refresh) {
    // Vars
    var tm=new Date(timediff*1000);
    var days=Math.floor(timediff/86400); 
    var hours=tm.getUTCHours(); 
    var minutes=tm.getUTCMinutes(); 
    var seconds=tm.getUTCSeconds(); 
    var timeString="";
    if(days>0){timeString=timeString+days+" dni, ";}
    if(hours>0){timeString=timeString+hours+" ur, ";}
    if(minutes>0){timeString=timeString+minutes+" minut, ";}
    timeString=timeString+seconds+" sekund";
    $("#"+id).text( timeString ); 
    
    // Over or not?
    if( timediff > 0 ){
        setTimeout(
            function(){
                updateTimer(  id , (timediff-1) , refresh);
            }
            , 1000
        );
        
        
    }
    else{
        if( refresh == "true" && id != "quiz"){
             location.reload();
             return;
        }
        if( id == "quiz"){
            document.quiz.submit();
            return;
        }
        else{
            $("#"+id).text("Cas je potekel");
        }                     
    }
} 