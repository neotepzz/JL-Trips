$(document).ready( function() {
 done();
});
 
function done() {
	  setTimeout( function() { 
	  updates(); 
	  done();
	  }, 200);
}
 
function updates() {
	 $.getJSON("selecttest.php", function(data) {
       $("ul").empty();
	   $.each(data.result, function(){
	    $("ul").append("<li>Name: "+this['1st']+"</li><li>Age: "+this['2nd']+"</li><li>Company: "+this['3rd']+"</li><br />");
	   });
 });
}