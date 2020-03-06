<script type="text/javascript" src="js/jquery.js">
	var rid=<?php echo $_GET['rid'];?>	
</script>
<?php
include_once'connection.php';
$rid=$_GET['rid'];
$sql="select * from receipe where id='".$rid."'";
if($result=mysqli_query($conn,$sql))
{
    $row=mysqli_fetch_assoc($result);
}
?>
<h3><?php echo "$row[category]"; ?></h3>
<h5>Enter ingredients </h5>

<html>
<head>
 
<script type="text/javascript" src="jquery-1.3.2.min.js"></script>

<style type="text/css">
	div{
		padding:8px;
	}
</style>

</head>

<body>
 

<script type="text/javascript">

$(document).ready(function(){

    var counter = 2;
		
    $("#addButton").click(function () { 
    
		
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + counter);
                
	newTextBoxDiv.after().html('<label>Ingredient '+ counter + ' : </label>' +
	      '<input type="text" name="ingredients[] " id="textbox' + counter + '" value="" >');
            
	newTextBoxDiv.appendTo("#TextBoxesGroup");

				
	counter++;
     });

     $("#removeButton").click(function () {
	if(counter==1){
          alert("No more textbox to remove");
          return false;
       }   
        
	counter--;
			
        $("#TextBoxDiv" + counter).remove();
			
     });
		
     $("#getButtonValue").click(function () {
		
	var msg = '';
	for(i=1; i<counter; i++){
   	  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
	}
    	  alert(msg);
     });
  });
</script>
</head><body>
<form method="post" action="Admin_AddReceipe_Pro.php?rid=<?php echo $rid;?>">
<div id='TextBoxesGroup'>
	<div id="TextBoxDiv1">
		<label>Ingredient 1 : </label><input type='textbox' name="ingredients[]"id='textbox1' required >
	</div>
</div>
<input type='button' value='Add Ingredient' id='addButton' >
<input type='button' value='Remove Last Ingredient' id='removeButton'>
<div style="padding-top:10;padding-left:100">

<button type="submit"> Submit </button>
</from>
</div>
</body>
</html>