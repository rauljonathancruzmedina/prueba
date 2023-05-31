<?
	include("funciones/prueba.php");
	$conecta = new conector();
	$conecta->consulta("SET NAMES utf8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Raúl Jonathan</title>
	<link rel="stylesheet" href="css/prueba.css">
	<script type="text/javascript" src="js/prueba.js"></script>
</head>
<body>
	<div class="principal">
		<div class="head text-flex-center">
			<h1>Jonathan</h1>
		</div>
		<div class="area-trabajo grid-at-2">
			<form id="frm-buscar" action="index.php" method="post">				  
				<div class="row row-1-2 line-bottom">
			    	<div class="col col-1-5 responsive-usu autocompletar">
			    		<input type='hidden' id='p' name='p' value=1>
						<label for="txt-sku" class="etiqueta">SKU</label>
						<input type="text" id="txt-sku" name="txt-sku" placeholder="SKU" value="">
					</div>
					<div class="col col-5-6 responsive-search btn-prueba pt-30" id="btn-search">
						<img src="img/lupa.png" height="25px">
					</div>
				</div>
			</form>

<? 
		if(count($_POST) != 0)
		{
			$sku=recibe_POST('txt-sku','');
			$query="Select * from articulo where sku = '$sku'";

			$bd=$conecta->consulta($query);
			if ($bd->num_rows != 0)
			{
				$tb=mysqli_fetch_array($bd);
					
				$sku=$tb["sku"];
				$articulo=$tb["articulo"];
				$marca=$tb["marca"];
				$modelo=$tb["modelo"];
				$depar=$tb["depar"];
				$clase=$tb["clase"];
				$familia=$tb["familia"];
				$fec_alta=$tb["fec_alta"];
				$stock=$tb["stock"];
				$cantidad=$tb["cantidad"];
				$fec_baja=$tb["fec_baja"];
				$pase = 1;
				$chk = $tb["descont"];

				$chk_activo="";
				if($tb["descont"] == 1)
					$chk_activo="CHECKED";
			}
			else 
			{
				$sku=$articulo=$marca=$modelo=$depar=$clase=$familia=$fec_alta=$stock=$cantidad=$descont=$fec_baja=$pase=$chk=$chk_activo="";
			}
?>
	
			<form id="frm-datos" class="form-group grid-ak-8" action="index.php" method="post">
				<div class="row row-2-3">
					<div class="col col-2-5" id="div-sku">
						<input type="hidden" id="txt-sku-e" name='txt-sku-e' placeholder='SKU' value="<?= $sku; ?>">
						<label for="txt-sku-i" class="etiqueta">SKU</label>
						<input type="number" id="txt-sku-i" name='txt-sku-i' placeholder='SKU' value="<?= $sku; ?>" data-men='El SKU es obligatorio' data-l=6 data-r='max' data-menl='El SKU debe tener 6 dígitos máximo' onkeyup="javascript:this.value=this.value.toUpperCase();">
					</div>
					<div class="col col-12-14 text-flex-right mt-15" id="div-chk">
						<label><b>Descontinuado</b>
							<input type="checkbox" id="chk-descont" onclick="alertaValue()" <?= $chk_activo ?> name="chk-descont" value="<?= $chk?>" data-sku="<?= $sku; ?>">
							<input type="hidden" name="in-chk" id="in-chk" value="<?= $chk?>" data-sku="<?= $sku; ?>">
						</label>
					</div>
				</div>
				<div class="row row-3-4">
					<div class="col col-2-8">
						<label for="txt-articulo" class="etiqueta">Artículo</label>
						<input type="text" id='txt-articulo' name='txt-articulo' placeholder='Nombre del artículo' value="<?= $articulo; ?>" data-men='El Artículo es obligatorio' data-l=15 data-r='max' data-menl='El Artículo debe tener 15 dígitos máximo' onkeyup="javascript:this.value=this.value.toUpperCase();">
					</div>
					<div class="col col-8-11">
						<label for="txt-marca" class="etiqueta">Marca</label>
						<input type="text" id='txt-marca' name='txt-marca' placeholder='Nombre de la Marca' value="<?= $marca; ?>" data-men='La Marca es obligatorio' data-l=15 data-r='max' data-menl='La Marca debe tener 15 dígitos máximo' onkeyup="javascript:this.value=this.value.toUpperCase();">
					</div>
					<div class="col col-11-14">
						<label for="txt-modelo" class="etiqueta">Modelo</label>
						<input type="text" id='txt-modelo' name='txt-modelo' placeholder='Nombre del Modelo' value="<?= $modelo; ?>" data-men='El Modelo es obligatorio' data-l=20 data-r='max' data-menl='El Modelo debe tener 20 dígitos máximo' onkeyup="javascript:this.value=this.value.toUpperCase();">
					</div>
				</div>
				<div class="row row-4-5">
					<div class="col col-2-4">
						<label for="sel-departamento" class="etiqueta">Departamento</label>
						<select id="sel-departamento" name="sel-departamento" data-men="No se ha seleccionado el departamento" onchange="depar()">
<? 
					$querys="Select * from departamento where n_depa = '$depar'";
					$bds=$conecta->consulta($querys);
					if ($bds->num_rows != 0)
					{	
						$tb=mysqli_fetch_array($bds);
						$nom_depar = $tb["nombre_depa"];
						$nu_depa = $tb["n_depa"];
					}	
					else
					{
						$nom_depar=$nu_depa="";
					}	
						
?>							
							<option value="<?= $nu_depa; ?>"><?= $nom_depar; ?></option>
<?
							$bd=$conecta->consulta("Select * from departamento");
							while($tb=mysqli_fetch_array($bd))
							{
?>
								<option value="<?= $tb['n_depa']; ?>"><?= $tb['nombre_depa']; ?></option>
<?
							}
?>
						</select>	
					</div>					
					<div class="col col-4-6">
						<label for="sel-clase" class="etiqueta">Clase</label>
						<select id="sel-clase" name="sel-clase" data-men="No se ha seleccionado la clase">
<? 
					$querys="Select * from clase where n_clase = '$clase'";
					$bds=$conecta->consulta($querys);
					if ($bds->num_rows != 0)
					{	
						$tb=mysqli_fetch_array($bds);
						$nom_clase = $tb["nombre_clase"];
						$nu_clase = $tb["n_clase"];
					}	
					else
					{
						$nom_clase=$nu_clase="";
					}	
						
?>							
							<option value="<?= $nu_clase; ?>"><?= $nom_clase; ?></option>
                        </select>	
					</div>
					<div class="col col-6-8">
						<label for="sel-familia" class="etiqueta">Familia</label>
						<select id="sel-familia" name="sel-familia" data-men="No se ha seleccionado la familia">
<? 
					$querys="Select * from familia where n_familia = '$familia'";
					$bds=$conecta->consulta($querys);
					if ($bds->num_rows != 0)
					{	
						$tb=mysqli_fetch_array($bds);
						$nom_familia = $tb["nom_familia"];
						$nu_familia = $tb["n_familia"];
					}	
					else
					{
						$nom_familia=$nu_familia="";
					}	
						
?>							
							<option value="<?= $nu_familia; ?>"><?= $nom_familia; ?></option>
                        </select>
					</div>
					<div class="col col-8-11">
						<label for="txt-stock" class="etiqueta">Stock</label>
						<input type="number" id='txt-stock' name='txt-stock' placeholder='Stock' value="<?= $stock; ?>" data-men='El Stock es obligatorio' data-l=9 data-r='max' data-menl='El Stock debe tener 9 dígitos máximo' onkeyup="javascript:this.value=this.value.toUpperCase();">
					</div>
					<div class="col col-11-14">
						<label for="txt-cantidad" class="etiqueta">Cantidad</label>
						<input type="number" id='txt-cantidad' name='txt-cantidad' placeholder='Cantidad' value="<?= $cantidad; ?>" data-men='La Cantidad es obligatorio' data-l=9 data-r='max' data-menl='La Cantidad debe tener 9 dígitos máximo' onkeyup="javascript:this.value=this.value.toUpperCase();">
					</div>
				</div>
				<div class="row row-5-6">
					<div class="col col-6-8">
						<label for="txt-falta" class="etiqueta">Fecha alta</label>
						<input type="date" id='txt-falta' name='txt-falta' value="<?= $fec_alta; ?>">
					</div>
					<div class="col col-8-10">
						<label for="txt-fbaja" class="etiqueta">Fecha baja</label>
						<input type="date" id='txt-fbaja' name='txt-fbaja' value="<?= $fec_baja; ?>">
					</div>
					
				</div>
				<div class="row row-6-7">
					
				</div>
				<div class="row row-7-8">
					<div class="col col-2-4 btn-danger" name="btn-eliminar" id="btn-eliminar">
						Eliminar
					</div>
					<div class="col col-12-14 btn-prueba" name="btn-guardar" id="btn-guardar">
						Guardar
					</div>
				</div>
			</form>

<script type="text/javascript">
	let btn_guardar = document.getElementById("btn-guardar");
	let btn_eliminar = document.getElementById("btn-eliminar");
	let chk_descont = document.querySelectorAll("chk-descont");
	let sel_depa = document.getElementById("sel-departamento");
	let frm_datos = document.getElementById("frm-datos");
	if (document.getElementById("txt-sku-i").value != "") 
	{	
  		document.getElementById("div-sku").style.display = "none";
  		document.getElementById("div-chk").style.display = "block";
  		document.getElementById("btn-eliminar").style.display = "display";
  	}
  	else
  	{
  		document.getElementById("div-sku").style.display = "block";
  		document.getElementById("div-chk").style.display = "none";
  		document.getElementById("btn-eliminar").style.display = "none";
  	}	

	btn_guardar.onclick = () => 
  	{
  		
	  	validarForm (frm_datos)
	  		.then(() =>
	  		{
	  			esperar();
	  			const data = new FormData(frm_datos);
	  			data.append('op', 'insert');
	  			envioAjax(data,"./ajax/actualizar.php")
	  				.then((txt) => 
		  				{
		  					esperar_hide();
		  					alerta(txt)
								.then(() =>
								{
									frm_datos.submit();
									window.location="index.php";
								});
		  				});
	  		})
	  		.catch((res) =>
	  			{
	  				d=res.split("|"); 
	  				alerta(d[1])
	  					.then (() =>
	  						{
				  				frm_datos[d[0]].focus();
				  			});
	  			});
  	};

  	function alertaValue(){ 

	  	if (document.getElementById('chk-descont').value != 1) 
	  	{	
			const data = new FormData();
			data.append('op', 'chk');
			data.append('sku', document.getElementById('txt-sku-e').value);
			data.append('chk-descont', document.getElementById('chk-descont').value);
			envioAjax(data,"./ajax/actualizar.php")
				.then((txt) => 
					{
						alerta(txt);
					});
		}		
	}

  	btn_eliminar.onclick = () => 
  	{
  		confirma("¿Estas seguro de eliminar?").then (() =>
		{	
			if (res_confirma == 'S') {
				const data = new FormData();
	  			data.append('op', "delete");
	  			data.append('sku', document.getElementById('txt-sku-e').value);
	  			envioAjax(data,"./ajax/actualizar.php")
	  				.then((txt) => 
		  				{
		  					alerta(txt).then (() =>
							{
								window.location="index.php";
			  				});
		  				});	
			}
		});
  	}

  	function depar() 
  	{	
  		const data = new FormData();
		data.append('op', "sel");
		data.append('id', sel_depa.value);
		envioAjax(data,"./ajax/actualizar.php")
			.then((txt) => 
				{
					d=txt.split("/");
					//r=String(d).split("|");
					//console.log(d);

					for(var i = 0; i < d.length-1; i++)
					{
						anadirclase(d[i]);
					}
				});

		familia();	
  	}

  	function familia() 
  	{	
  		const data = new FormData();
		data.append('op', "selec");
		data.append('id', sel_depa.value);
		envioAjax(data,"./ajax/actualizar.php")
			.then((txt) => 
				{
					d=txt.split("/");
					//console.log(d);
					for(var i = 0; i < d.length-1; i++)
					{
						anadirfamilia(d[i]);
					}
				});		
  	}

  	function anadirclase(txt)
  	{	
  			r=txt.split("|");
	  		var clase = document.getElementById("sel-clase");
		    var inputAficion = r[0];
		    var option = document.createElement("option");
		    option.text = inputAficion;
		    option.value = r[1];
		    clase.add(option);
  	}
  	
  	function anadirfamilia(txt)
  	{
  		r=txt.split("|");
  		var familia = document.getElementById("sel-familia");
	    var inputAficion = r[0];
	    var option = document.createElement("option");
	    option.text = inputAficion;
	    option.value = r[1];
	    familia.add(option);
  	}

</script>				

<?
		}	
?>

			

		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	
	//autocompletar("txt-empleado","usuarios",4);
	
	const form_B = document.getElementById("frm-buscar");
	let btn_search = document.getElementById("btn-search");

	btn_search.onclick = () =>{
		if (document.getElementById("txt-sku").value == 0) 
  		{
  			alerta("No se ha seleccionado el SKU a buscar")
  				.then(() =>
		  		{
					document.getElementById("txt-sku").focus();
				});
  		}
  		else
  		{
  			validarForm(form_B)
			  .then(() =>
		  		{
		  			form_B.submit();
		  		})
		  		.catch((res) =>
		  		{ 
	  				d=res.split("|");
	  				alerta(d[1]);
	  			});	
  		}
	}

</script>