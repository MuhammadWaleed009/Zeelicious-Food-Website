<?php
include_once'connection.php';
$mid=$_GET['mid'];
$weeks=$_GET['weeks'];
$sql1="select *  from receipe";
$result1=mysqli_query($conn,$sql1);
$sql="select * from mealplans where id='".$mid."'";
if($result=mysqli_query($conn,$sql))
{
    $row=mysqli_fetch_assoc($result);
}
?>
<h2><?php echo "$row[category]"; ?></h2>
<h2>Enter data for week <?php echo "$weeks"; ?></h2>
<?php
$weeks=$weeks-1;
echo '<form method="post" action ="mealplanprocess.php?mid='.$mid.'&weeks='.$weeks.'" >';?>

	<table id="editableTable" class="table table-bordered">
		<thead>
			<tr>
				<th></th>
				<th>Monday</th>
				<th>Tuesday</th>
				<th>Wednesday</th>
				<th>Thursday</th>
				<th>Friday</th>
				<th>Saturday</th>
				<th>Sunday</th>													
			</tr>
		</thead>
		<tbody>
			<?php 
			$arr = array('Before Breakfast' ,'Breakfast', 'Mid Day Snack','Lunch','Evening Snack','Dinner','Calories');
				$i=0;
				while($i<7)
				{
					echo '
					   <tr>
					   <td>'.$arr[$i].'</td>';
					   if($i==0)
						   {
						   	echo '
						   		<td><input type="text" name="a1'.$i.'"></td>';
						   	}
						else if($i==6)
						   {
						   	echo '
						   		<td><input type="number" min=1 name="a1'.$i.'"></td>';
						   	}
						else
						{
							echo '<td>
					   		<select name="a1'.$i.'">';
					   			while($data=mysqli_fetch_assoc($result1))
					   			{
					   				echo '
					   					<option value="'.$data['title'].'">'.$data['title'].'</option>
					   					 ';
					   			}
					   			$sql1="select *  from receipe";
								$result1=mysqli_query($conn,$sql1);
					   	echo'	
					   		</select>
					   </td>	';
						}
						   if($i==0)
						   {
						   	echo '
						   		<td><input type="text" name="a2'.$i.'"></td>';
						   	}
						   	else if($i==6)
						   {
						   	echo '
						   		<td><input type="number" min=1 name="a2'.$i.'"></td>';
						   	}
						else
						{
							echo '<td>
					   		<select name="a2'.$i.'">';
					   			while($data=mysqli_fetch_assoc($result1))
					   			{
					   				echo '
					   					<option value="'.$data['title'].'">'.$data['title'].'</option>
					   					 ';
					   			}
					   			$sql1="select *  from receipe";
								$result1=mysqli_query($conn,$sql1);
					   	echo'	
					   		</select>
					   </td>	';
						}
					   if($i==0)
						   {
						   	echo '
						   		<td><input type="text" name="a3'.$i.'"></td>';
						   	}
						   	else if($i==6)
						   {
						   	echo '
						   		<td><input type="number" min=1 name="a3'.$i.'"></td>';
						   	}
						else
						{
							echo '<td>
					   		<select name="a3'.$i.'">';
					   			while($data=mysqli_fetch_assoc($result1))
					   			{
					   				echo '
					   					<option value="'.$data['title'].'">'.$data['title'].'</option>
					   					 ';
					   			}
					   			$sql1="select *  from receipe";
								$result1=mysqli_query($conn,$sql1);
					   	echo'	
					   		</select>
					   </td>	';
						}
					   if($i==0)
						   {
						   	echo '
						   		<td><input type="text" name="a4'.$i.'"></td>';
						   	}
						   	else if($i==6)
						   {
						   	echo '
						   		<td><input type="number" min=1 name="a4'.$i.'"></td>';
						   	}
						else
						{
							echo '<td>
					   		<select name="a4'.$i.'">';
					   			while($data=mysqli_fetch_assoc($result1))
					   			{
					   				echo '
					   					<option value="'.$data['title'].'">'.$data['title'].'</option>
					   					 ';
					   			}
					   			$sql1="select *  from receipe";
								$result1=mysqli_query($conn,$sql1);
					   	echo'	
					   		</select>
					   </td>	';
						}
					   if($i==0)
						   {
						   	echo '
						   		<td><input type="text" name="a5'.$i.'"></td>';
						   }
						   else if($i==6)
						   {
						   	echo '
						   		<td><input type="number" min=1 name="a5'.$i.'"></td>';
						   	}
						else
						{
							echo '<td>
					   		<select name="a5'.$i.'">';
					   			while($data=mysqli_fetch_assoc($result1))
					   			{
					   				echo '
					   					<option value="'.$data['title'].'">'.$data['title'].'</option>
					   					 ';
					   			}
					   			$sql1="select *  from receipe";
								$result1=mysqli_query($conn,$sql1);
					   	echo'	
					   		</select>
					   </td>	';
						}
					   if($i==0)
						   {
						   	echo '
						   		<td><input type="text" name="a6'.$i.'"></td>';
						   	}
						   	else if($i==6)
						   {
						   	echo '
						   		<td><input type="number" min=1 name="a6'.$i.'"></td>';
						   	}
						else
						{
							echo '<td>
					   		<select name="a6'.$i.'">';
					   			while($data=mysqli_fetch_assoc($result1))
					   			{
					   				echo '
					   					<option value="'.$data['title'].'">'.$data['title'].'</option>
					   					 ';
					   			}
					   			$sql1="select *  from receipe";
								$result1=mysqli_query($conn,$sql1);
					   	echo'	
					   		</select>
					   </td>	';
						}
					   if($i==0)
						   {
						   	echo '
						   		<td><input type="text" name="a7'.$i.'"></td>';
						   	}
						   	else if($i==6)
						   {
						   	echo '
						   		<td><input type="number" min=1 name="a7'.$i.'"></td>';
						   	}
						else
						{
							echo '<td>
					   		<select name="a7'.$i.'">';
					   			while($data=mysqli_fetch_assoc($result1))
					   			{
					   				echo '
					   					<option value="'.$data['title'].'">'.$data['title'].'</option>
					   					 ';
					   			}
					   			$sql1="select *  from receipe";
								$result1=mysqli_query($conn,$sql1);
					   	echo'	
					   		</select>
					   </td>	';
						}
					
						echo'  				  
					   </tr>';
				   $i=$i+1;
				}
			?>
		</tbody>
	</table>
	<div style="text-align: center; padding-top: 10px;">
		<button type="submit" style=""> Add </button>
	</div>
<?php echo '</form>'?>