function showFirstChoice(str,str2)
{
var xmlhttp;    
if (str=="")
  {
  document.getElementById("first-choice").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("first-choice").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getfirstchoice.php?q="+str"p="+str2,true);
xmlhttp.send();
}
