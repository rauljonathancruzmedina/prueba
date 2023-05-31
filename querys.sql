select c.* 
        from (select * from departamento where n_depa = '$id') d
        inner join clase c on(d.n_depa = c.n_depa)

select f.* 
        from (select * from departamento where n_depa = '$id') d
        inner join clase c on(d.n_depa = c.n_depa)
        inner join familia f on (c.n_clase = f.n_clase)

call s_articulo_p('$sku')

DELIMITER $$
create procedure s_articulo_p(in _sku int)
begin
    select * from articulo where sku = _sku;
end $$      

call s_departamento()

DELIMITER //
CREATE PROCEDURE s_departamento()
BEGIN
    Select * from departamento;
END 

DELIMITER $$


call i_articulo('$sku')
DELIMITER $$
CREATE PROCEDURE i_articulo(in sku_ int, in articulo_ varchar(15), in marca_ varchar(15), in modelo_ varchar(20), in depar_ int(1), 
                            in clase_ int(2), in familia_ int(3), in fec_alta_ char(10), in stock_ int(9), in cantidad_ int(9), 
                            in descont_ smallint(1), in fec_baja_ char(10))
BEGIN
    Insert into articulo (sku,articulo,marca,modelo,depar,clase,familia,fec_alta,stock,cantidad,descont,fec_baja)                      values(sku_,articulo_,marca_,modelo_,depar_,clase_,familia_,fec_alta_,stock_,cantidad_,descont_,fec_baja_);
END



call u_articulo(

DELIMITER $$
CREATE PROCEDURE u_articulo(in sku_ int, in articulo_ varchar(15), in marca_ varchar(15), in modelo_ varchar(20), in depar_ int(1), 
                            in clase_ int(2), in familia_ int(3), in fec_alta_ char(10), in stock_ int(9), in cantidad_ int(9), 
                            in descont_ smallint(1), in fec_baja_ char(10))
BEGIN
    Update articulo 
       set articulo=articulo_,marca=marca_,modelo=modelo_,depar=depar_,clase=clase_,
            familia=familia_,fec_alta=fec_alta_,stock=stock_,cantidad=cantidad_,
            descont=descont_,fec_baja=fec_baja_
    where sku=sku_;
END







$query="call i_articulo('$sku','$articulo','$marca','$modelo','$depar','$clase','$familia','$fec_alta','$stock','$cantidad','$descont','$fec_baja')";

$row = mysqli_fetch_assoc($bd);