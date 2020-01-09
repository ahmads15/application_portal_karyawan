function renderTime(){





    //Time
    var currentTime = new Date();
    var h = currentTime.getHours();
    var m = currentTime.getMinutes();
    var s = currentTime.getSeconds();
    var ampm = h >= 12 ? 'pm' : 'am';
      if(h == 24){
        h = 0;
      }else if(h>12){
        h = h - 0
      }

      if(h < 10){
        h ="0" +h;
      }
      if( m < 10){
        m ="0" + m;
      }
      if (s < 10) {
        s="0"+s;
      }

      var myClock = document.getElementById("timeDisplay");

     myClock.innerHTML =  +h+ ":" +m+ ":" +s;

      setTimeout("renderTime()",1000);

 }

 renderTime();
