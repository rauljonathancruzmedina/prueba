
let res_confirma="";

//------------------------------------------------------------------------------------------------------- Validar formulario
validarForm = (f) =>
{
	let res="";
	return new Promise(function(resolve,reject)
			   {
			   		let men="";			   	
					for (i=0; i < f.length; i++) 
					{
						if(f[i].value == "" || f[i].value == 0)
						{
					    	men=f[i].dataset.men;
					    	if(men != undefined)
					    	{
								res=i + "|" + men;
								break;
							}
						}
						else
						{	
							if(f[i].dataset.r == "")
							{
								if(f[i].dataset.l != undefined)
								{
									if(f[i].value.length != f[i].dataset.l)
									{
										men=f[i].dataset.menl;
										res=i + "|" + men;
										break;
									}
								}
							}
							else
							{
								if(f[i].dataset.l != undefined)
								{
									if(f[i].value.length > f[i].dataset.l)
									{
										men=f[i].dataset.menl;
										res=i + "|" + men;
										break;
									}
								}
							}	
						}
					}
					if(res=="")
			   			resolve();
			   		else
			   			reject(res);
			   });
}

//--------------------------------------------------------------------------------------------------------------- Alertas
alerta= (men) =>
{
	return new Promise(function(resolve)
			   {
					const alertaDiv = document.createElement("div");
					alertaDiv.id="alert-container";
					document.body.appendChild(alertaDiv);

					const alertaBox=document.createElement("div");
					alertaBox.className = "alerta-box";
					alertaDiv.appendChild(alertaBox);

					const alertaImg=document.createElement("div");
					alertaImg.className = "alerta-img";
					const cs=document.createElement("img");
					cs.src="./img/Imagen_alert.png";
					alertaImg.appendChild(cs);
					alertaBox.appendChild(alertaImg);

					const alertaMensaje=document.createElement("div");
					alertaMensaje.className = "alerta-mensaje";
					alertaSpan = document.createElement("span");
					alertaSpan.innerText = men;
					alertaMensaje.appendChild(alertaSpan);
					alertaBox.appendChild(alertaMensaje);

					const alertaBtn=document.createElement("div");
					alertaBtn.className = "alerta-btn";
					btn = document.createElement("input");
					btn.className = "btn-factorv";
					btn.id="btn-alerta";
					btn.type="button";
					btn.value="Aceptar";
					alertaBtn.appendChild(btn);
					alertaBox.appendChild(alertaBtn);

					btn.addEventListener("click",() =>
					{
						document.body.removeChild(alertaDiv);
						resolve();
					});
				});
}

confirma= (men,btnNombre1="Sí, eliminar",btnNombre2="Cancelar",activaBtn2=0) =>
{
	return new Promise(function(resolve)
			   {
					const alertaDiv = document.createElement("div");
					alertaDiv.id="alert-container";
					document.body.appendChild(alertaDiv);

					const alertaBox=document.createElement("div");
					alertaBox.className = "alerta-box";
					alertaDiv.appendChild(alertaBox);

					const alertaImg=document.createElement("div");
					alertaImg.className = "alerta-img";
					const cs=document.createElement("img");
					cs.src="./img/Imagen_alert.png";
					alertaImg.appendChild(cs);
					alertaBox.appendChild(alertaImg);

					const alertaMensaje=document.createElement("div");
					alertaMensaje.className = "alerta-mensaje";
					alertaSpan = document.createElement("span");
					alertaSpan.innerText = men;
					alertaMensaje.appendChild(alertaSpan);
					alertaBox.appendChild(alertaMensaje);

					const alertaBtn=document.createElement("div");
					alertaBtn.className = "alerta-btn";

						btn = document.createElement("input");
						btn.className = "btn-factorv";
						btn.id="btn-alerta";
						btn.type="button";
						btn.value=btnNombre1;
						alertaBtn.appendChild(btn);

						btncancel = document.createElement("input");
						btncancel.className = "btn-danger";
						btncancel.id="btn-danger";
						btncancel.type="button";
						btncancel.value=btnNombre2;
						btncancel.style.marginLeft = "50px";
						alertaBtn.appendChild(btncancel);

					alertaBox.appendChild(alertaBtn);

					btn.addEventListener("click",() =>
					{
						res_confirma='S';
						document.body.removeChild(alertaDiv);
						resolve();
					});

					btncancel.addEventListener("click",() =>
					{
						res_confirma='N';
						document.body.removeChild(alertaDiv);
						if(activaBtn2==1)
							resolve();
					});

				});
}
//-------------------------------------------------------------------------------------------------------- envio de formalarios
envioAjax = (data,url) =>
{
	return new Promise(function(resolve)
			   {
					fetch(url, 
					{
						method: 'POST',
					   	body: data
					})
					.then(response =>  
						{
						   	if(response.ok)
						    	return response.text();
						    else
						    	alerta("Existe un error en la conexión o en la página. \nVuelve a intentarlo más tarde por favor");
						})
						.then(txt => 
							{
								resolve(txt);
							});
				});
}

//------------------------------------------------------------------------------------------------------ Validar nueva contraseña

validaPwd = (pwd) =>
{
	return new Promise(function(resolve,reject)
			   {
			   		let men="";
					if(pwd.length>=10)
					{
						var car;
						var i=0;
						var may=0;
						var min=0;
						var num=0;
						while(i<10)
						{
							car=pwd.charAt(i);
							if(car=="1" || car=="2" || car=="3" || car=="4" || car=="5" || car=="6" || car=="7" || car=="8" || car=="9" || car=="0")
								num++;
							else
							{
								if(car.toUpperCase()==pwd.charAt(i))
									may++;
								else
									min++;
							}
							i=i+1;
						}
						if(num >=2)
						{
							if(may >=1)
							{
								if(min < 1)
									men="La contraseña debe tener al menos una minúscula";
							}
							else
								men="La contraseña debe tener al menos una mayúscula";
						}
						else
							men="La contraseña debe tener al menos 2 caracteres numéricos";
					}
					else
						men="La contraseña debe de ser mínimo de 10 caracteres";
					if(men=="")
						resolve();
					else
						reject(men);
				});
}

formatear_moneda= (cantidad) =>
{
	let m=cantidad.replace(/,/,"").replace("$","") * 1;
	let cant=Number(m).toLocaleString('en',{ style: 'currency', currency: 'USD' });
	
	return cant;
}

/*---------------------------------------------------------------------
						AUTOCOMPLETAR
---------------------------------------------------------------------*/

autocompletar = (objeto,id,l,extra='',obj_complementa='',id_complementa='') =>
{
	let indexFocus= -1;
	const obj= document.querySelector("#" + objeto);

	obj.addEventListener("input", function()
	{
		const valor=this.value;

		cerrarLista();
		
		if(valor.length < l)
		{	
			return false;
		}
		else
		{	
			cerrarLista();

			const divlista= document.createElement("div");
			divlista.setAttribute("id", this.id + "-lista-autocompletar");
			divlista.setAttribute("class","lista-autocompletar-items");
			this.parentNode.appendChild(divlista);

			const data = new FormData();
		  	data.append('id', id);
		  	data.append('valor', valor);
		  	data.append('extra', extra);
			envioAjax(data,"autocompletar.php")
				.then((txt) => 
					{
						const res=JSON.parse(txt);

						if(res.length==0) return false;

						res.forEach(item => 
							{
								const dato = document.createElement("div");
								dato.innerHTML= item;
								dato.addEventListener("click", function()
								{
									obj.value= this.innerText;
									cerrarLista();
									if(obj_complementa !='')
									{
										const datac = new FormData();
									  	datac.append('op', id_complementa);
									  	datac.append('empleado', obj.value);
										envioAjax(datac,"./ajax/consultar.php")
											.then((txt) => 
											{
												document.getElementById(obj_complementa).value=txt;
												return false;
											});
									}	
									return false;
								});
								divlista.appendChild(dato);
							});
					});
		}
	});

	cerrarLista = () =>
	{
		const items = document.querySelectorAll(".lista-autocompletar-items");
		items.forEach(item => 
		{
			item.parentNode.removeChild(item);
		});
	}
}

cerrarBox = (nobj) =>
{
	let box=document.querySelector("#" + nobj);

	box.style.visibility="hidden";
}

esperar = () =>
{
	const divespera = document.createElement("div");
	let html="<div><img src='./img/cargando.gif' height='100%'></div>";
	divespera.id="cargar";
	document.body.appendChild(divespera);
	divespera.innerHTML=html;
}

esperar_hide = () =>
{
	let div = document.getElementById("cargar");

	document.body.removeChild(div);
}

submenu = (modulo,clave) =>
{
	const data = new FormData();
	data.append('clave', clave);
	data.append('modulo', modulo);
	envioAjax(data,"./ajax/submenu.php")
		.then((txt) => 
		{
			let submenu = document.getElementById("menu-lateral");
			submenu.innerHTML=txt;
		});
}

obtenerAtributoStyle = (nom_objeto,atributo) =>
{
	let obj = document.getElementById(nom_objeto);
	let objStyle = window.getComputedStyle(obj);
	return objStyle.getPropertyValue(atributo);
}