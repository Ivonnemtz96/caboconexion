                <div class="dashboard-header fl-wrap">
                    <h3>Estos son tus negocios registrados:</h3>
                </div>
                                            
                    <?php $empData = $db->getAllRecords('empresas','*','AND usuario='.($UserData['id']).'','ORDER BY fr DESC LIMIT '.($UserData['empCount']).'');
                    if (count($empData)>0){
                        $y	=	'';
                            foreach($empData as $empresa){
                                $y++;                                                            
                                ?>	
                                    <!-- dashboard-list end-->    
                                    <div class="dashboard-list">
                                        <div class="dashboard-message">
                                            <div class="dashboard-listing-table-image">
                                                <a href="#"><img src="/upload/empresas/<?php echo (strftime("%Y", strtotime(($empresa['fr']))));?>/<?php echo (strftime("%m", strtotime(($empresa['fr']))));?>/<?php echo ($empresa['fPortada']) ?>.jpg" alt=""></a>
                                            </div>
                                            <div class="dashboard-listing-table-text">
                                                <h4><a href="#"><?php echo ($empresa['nombre']) ?></a></h4>
                                                <p><?php echo (substr(($empresa['descripcion']), 0, 250));?>...</p>
                                                <ul class="dashboard-listing-table-opt  fl-wrap">
                                                    <li><a href="/empresa/<?php echo ($empresa['id']) ?>">Ver <i class="fa fa-globe"></i></a></li>
                                                    <li><a href="/panel/editar/empresa?editId=<?php echo ($empresa['id']) ?>">Editar <i class="fa fa-pencil-square-o"></i></a></li>
                                                    <li><a href="/panel/editar/galeria?empId=<?php echo $empresa['id']; ?>">Galería (<?php echo ($empresa['fotCount']) ?>) <i class="fa fa-picture-o"></i></a></li>
                                                    <li><a href="/panel/nuevo/cupon?empId=<?php echo $empresa['id']; ?>">Cupones (<?php echo ($empresa['cupCount']) ?>) <i class="fa fa-ticket"></i></a></li>
                                                    <li><a href="/panel/borrar/empresa?delId=<?php echo ($empresa['id']) ?>" onClick="return confirm('Estás seguro? Esto no se puede deshacer');" class="del-btn">Eliminar <i class="fa fa-trash-o"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                               
                                <?php  
                            }
                        }
                    ?>