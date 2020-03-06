<?php
include_once 'connection.php';
$sql="select * from products";
$result=mysqli_query($conn,$sql);
echo '
	<div class="panel-body">
        <table class="table table-striped task-table">
            <thead>
            <th>Products</th>
            <th>&nbsp;</th>
            </thead>
            <tbody>';
	            while($row=mysqli_fetch_assoc($result))
	            {
	            	echo'
		                <tr>
		                    <td>
		                        <div>
		                        	<img style="width:150px;height:150px" src="images/Product and service/'.$row['image'].'"
		                        </div>
		                    </td>
		                    <td>
		                        <form action="Admin_DeleteProduct.php?id='.$row['id'].'" method="POST">
		                          <button>Delete Task</button>
		                        </form>
		                    </td>
		                </tr>'
		            ;
	            }
	        echo '    
            </tbody>
        </table>
    </div>';
?>