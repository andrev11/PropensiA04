<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use app\controllers\SiteController;
$this->title = 'Dashboard';
?>
<div class="site-index">

    <div class="jumbotron">
        
		<h1>Welcome, 
		
		<?php
                          if(isset(Yii::$app->user->identity->username))
                              $info[] = (\Yii::$app->user->identity->nama);

                          echo implode($info);

        ?>!</h1>
        
        <?php 
        	if(Yii::$app->user->identity->role=='purchasing'){
        		echo "<br>"; 
        		echo "<h3>Daftar Re-Order</h3> <br>"; 
        		echo "<table class='table table-striped table-bordered'>"; 
		        echo "<thead>";
		         echo "<th>#</th>";
		        echo "<th>Nama Jenis</th>";
		        echo "<th>Stok Kilo</th>";
		        echo "<th>Stok Karton</th>";
		        echo "<th>ROP</th>";
		        echo "</thead>";
				echo "<tbody>"; 
					echo SiteController::connect();
	 				$query=pg_query("Select * from jenis where stok_kilo < rop;");
	 				$count=0;
		        	while($value = pg_fetch_array($query)){
		        		$count++;
		        		echo "<td align='left'>".$count."</td>";
						echo "<td align='left'>".$value['namajenis']."</td>";
						echo "<td align='left'>".$value['stok_kilo']."</td>";
						echo "<td align='left'>".$value['stok_karton']."</td>";
						echo "<td align='left'>".$value['rop']."</td>";
						echo "</tr>";
					}
				echo "</tbody>";  
		    	echo "</table>";
			} 
		?>        
 	</div>
</div>
