<?php

$conexion=mysqli_connect('localhost','grupoar6_cabocon','E,}pE=OI0L;=','grupoar6_caboconexion2');
$cat=$_POST['cat'];

$sql='SELECT id, nombre, categoria from catSubEmpresa where categoria='.$cat.'';

	$result=mysqli_query($conexion,$sql);

	$cadena='<select name="subcat" data-placeholder="Selecciona un servicio" class="chosen-select" >
                    <option value="">Categoría</option>';

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[2]).'</option>';
	}

	echo  $cadena."</select>";
?>
<script
	src="https://code.jquery.com/jquery-3.3.1.min.js"
	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	crossorigin="anonymous"></script>                               
                                                                           
                                
<script type="text/javascript">
	$(document).ready(function(){
		$('#cat').val(1);
		recargarLista();

		$('#cat').change(function(){
			recargarLista();
		});
	})
</script>

<script type="text/javascript">
	function recargarLista(){
		$.ajax({
			type:"POST",
			url:"/include/subcat.php",
			data:"cat=" + $('#cat').val(),
			success:function(r){
				$('.subCat').html(r);
			}
		});
	}
</script>                                                  
                                                            
                                                            
                                                            
                                                        
