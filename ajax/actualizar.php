<?	session_start();

	include("../funciones/prueba.php");
	
	$op=recibe_POST('op','');

	$conecta= new conector();

	$conecta->consulta("SET NAMES utf8");

	switch ($op) 
	{
		case "insert":
				$sku=recibe_POST('txt-sku-i','');
				$articulo=recibe_POST('txt-articulo','');
				$marca=recibe_POST('txt-marca','');
				$modelo=recibe_POST('txt-modelo','');
				$depar=recibe_POST('sel-departamento','');
				$clase=recibe_POST('sel-clase','');
				$familia=recibe_POST('sel-familia','');
				$fec_alta=recibe_POST('txt-falta','');
				$stock=recibe_POST('txt-stock','');
				$cantidad=recibe_POST('txt-cantidad','');
				$descont=0;
				$fec_baja=recibe_POST('txt-fbaja','');

				if ($cantidad < $stock) 
				{
					
					$bd=$conecta->consulta("select * from articulo where sku = '$sku'");
					if ($bd->num_rows == 0)
					{
						$query="Insert into articulo values('$sku','$articulo','$marca','$modelo','$depar','$clase','$familia','$fec_alta','$stock','$cantidad','$descont','$fec_baja')";
						$conecta->consulta($query,'I','u_artic');

						echo "Datos guardados con exito.!";
					}
					else
					{ 
						$query="Update articulo 
									set articulo='$articulo',marca='$marca',modelo='$modelo',depar=$depar,clase='$clase',
										familia='$familia',fec_alta='$fec_alta',stock='$stock',cantidad='$cantidad',
										descont=$descont,fec_baja='$fec_baja'
									where sku='$sku'";
						$conecta->consulta($query,'U','u_artic');			
						echo "Datos actualizados con éxito.!";
					}
				}	
				else
				{
					echo "La cantidad no debe ser mayor al stock";
				}	
		break;
		case "delete":

			$sku=recibe_POST('sku','');

			$bd=$conecta->consulta("select * from articulo where sku = '$sku'");

			if ($bd->num_rows != 0)
			{
				$conecta->consulta("Delete from articulo where sku='$sku'");
				echo "El sku $sku fue eliminado con exito.!";
			}
			else
			{
				echo "El sku $sku no esta regisgrado en el sistema.";;
			}
		break;
		case "chk":
			$sku=recibe_POST('sku','');
			$chk_descont=recibe_POST('chk-descont','');
			$fec_baja = date("Y-m-d");

			if($chk_descont==0)
			{	
				$descont=1;
				$query="Update articulo
						set fec_baja='$fec_baja',descont='$descont'
						where sku='$sku'";
				$conecta->consulta($query);
				echo "Articulo descontinuado.!";
			}
		break;
		case "sel":
			$id=recibe_POST('id','');
			$bd=$conecta->consulta("select c.* 
										from (select * from departamento where n_depa = '$id') d
									    inner join clase c on(d.n_depa = c.n_depa)");
			while($tb=mysqli_fetch_array($bd))
			{
				echo $tb['nombre_clase']."|".$tb['n_clase']."/";
			}
		break;
		case "selec":
			$id=recibe_POST('id','');
			$bd=$conecta->consulta("select f.* 
										from (select * from departamento where n_depa = '$id') d
									    inner join clase c on(d.n_depa = c.n_depa)
									    inner join familia f on (c.n_clase = f.n_clase)");			
			while($tb=mysqli_fetch_array($bd))
			{
				echo $tb['nom_familia']."|".$tb['n_familia']."/";
			}
		break;
	}
?>