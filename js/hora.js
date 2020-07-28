function startTime(){
today=new Date();
h=today.getHours();
m=today.getMinutes();
s=today.getSeconds();
m=checkTime(m);
s=checkTime(s);
document.getElementById('reloj').innerHTML=h+":"+m+":"+s;
t=setTimeout('startTime()',500);}
  function checkTime(i)
  {if (i<10) {i="0" + i;}return i;}
  window.onload=function(){startTime();}
