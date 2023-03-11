                <div class="dashboard-header fl-wrap">
                    <h3>Estos son tus productos registrados:</h3>
                </div>
                                            
                    <?php $prodData = $db->getAllRecords('productos','*','AND usuario='.($UserData['id']).'','ORDER BY fr DESC');
                    if (count($prodData)>0){
                        $y	=	'';
                            foreach($prodData as $productos){
                                $y++;                                                            
                                ?>	
                                    <!-- dashboard-list end-->    
                                    <div class="dashboard-list">
                                        <div class="dashboard-message">
                                            <div class="dashboard-listing-table-image">
                                                <a href="#"><img src="/upload/productos/<?php echo (strftime("%Y", strtotime(($productos['fr']))));?>/<?php echo (strftime("%m", strtotime(($productos['fr']))));?>/<?php echo ($productos['fPortada']) ?>.jpg" alt=""></a>
                                            </div>
                                            <div class="dashboard-listing-table-text">
                                                <h4><a href="#"><?php echo ($productos['nombre']) ?></a></h4>
                                                <p><?php echo (substr(($productos['descripcion']), 0, 250));?>...</p>
                                                <ul class="dashboard-listing-table-opt  fl-wrap">
                                                    <li><a href="/productos/<?php echo ($productos['id']) ?>">Ver <i class="fa fa-globe"></i></a></li>
                                                    <li><a href="/panel/editar/productos?editId=<?php echo ($productos['id']) ?>">Editar <i class="fa fa-pencil-square-o"></i></a></li>
                                                    <li><a href="/panel/editar/galeria?empId=<?php echo $productos['id']; ?>">Galería (<?php echo ($productos['FotCount']) ?>) <i class="fa fa-picture-o"></i></a></li>
                                                    <li><a href="/panel/nuevo/cupon?empId=<?php echo $productos['id']; ?>">Cupones (<?php echo ($productos['catProducto']) ?>) <i class="fa fa-ticket"></i></a></li>
                                                    <li><a href="/panel/borrar/productos?delId=<?php echo ($empresa['id']) ?>" onClick="return confirm('Estás seguro? Esto no se puede deshacer');" class="del-btn">Eliminar <i class="fa fa-trash-o"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                               
                                <?php  
                            }
                        }
                    ?>