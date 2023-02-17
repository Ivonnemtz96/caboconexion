                <div class="dashboard-header fl-wrap">
                    <h3>Todos los servicios registrados:</h3>
                </div>
                                            
                    <?php $empData = $db->getAllRecords('servicios','*','AND usuario='.($UserData['id']).'','ORDER BY id DESC LIMIT 20');
                    if (count($empData)>0){
                        $y	=	'';
                            foreach($empData as $empresa){
                                $y++;                                                            
                                ?>	
                                    <!-- dashboard-list end-->    
                                    <div class="dashboard-list">
                                        <div class="dashboard-message">
                                            <div class="dashboard-listing-table-image">
                                                <a href="#"><img src="/upload/servicios/<?php echo (strftime("%Y/%m", strtotime(($empresa['fr']))));?>/<?php echo ($empresa['fPortada']) ?>.jpg" alt=""></a>
                                            </div>
                                            <div class="dashboard-listing-table-text">
                                                <h4><a href="#"><?php echo ($empresa['nombre']) ?></a></h4>
                                                <p><?php echo (substr(($empresa['descripcion']), 0, 250));?>...</p>
                                                <ul class="dashboard-listing-table-opt  fl-wrap">
                                                    <li><a href="/servicio/<?php echo ($empresa['id']) ?>">Ver <i class="fa fa-globe"></i></a></li>
                                                    <li><a href="/panel/editar/servicio?editId=<?php echo ($empresa['id']) ?>">Editar <i class="fa fa-pencil-square-o"></i></a></li>
                                                    <li><a href="/panel/editar/galeria-servicio?serId=<?php echo $empresa['id']; ?>">Galería (<?php echo ($empresa['fotCount']) ?>) <i class="fa fa-picture-o"></i></a></li>
                                                    <li><a href="/panel/borrar/servicio?delId=<?php echo ($empresa['id']) ?>" onClick="return confirm('¿Estás seguro? Esto no se puede deshacer');" class="del-btn">Eliminar <i class="fa fa-trash-o"></i></a></li>
                                                </ul>
                                                
                                            </div>
                                        </div>
                                    </div>
                               
                                <?php  
                            }
                        }
                    ?>