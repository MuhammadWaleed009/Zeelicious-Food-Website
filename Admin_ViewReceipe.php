<?php
include_once 'connection.php';
$sql="select * from receipe";
$result=mysqli_query($conn,$sql);
echo '
	<div class="panel-body">
        <table class="table table-striped task-table">
            <thead>
            <th>Recepies</th>
            <th>&nbsp;</th>
            </thead>
            <tbody>';
	            while($row=mysqli_fetch_assoc($result))
	            {
	            	echo'
		                <tr>
		                    <td class="table-text">
		                        <div>'.$row['title'].'</div>
		                    </td>
		                    <td>
		                        <form action="Admin_DeleteReceipe.php?id='.$row['id'].'" method="POST">
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