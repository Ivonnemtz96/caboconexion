


                        <!--section -->
                        <section class="gray-section">
                        <div class="container">
                            <div class="section-title">
                                <h2>Servicios a domicilio - Servicios del hogar</h2>
                                <span class="section-separator"></span>
                                <p>Encuentralos en <b>CaboConexion</b></p>
                            </div>
                        </div>
                        <!-- carousel --> 
                        <div class="list-carousel fl-wrap card-listing">
                            <!--listing-carousel-->
                            <div class="listing-carousel  fl-wrap ">
                                
                                                <?php $servData = $db->getAllRecords('servicios','*','ORDER BY rand() LIMIT 10');
                                                if (count($servData)>0){
                                                    $y	=	'';
                                                        foreach($servData as $servicio){
                                                            $y++;
                                                            
                                                            $catServicio = $db->getAllRecords('catSubServicios','*','AND id='.($servicio['catSubServicio']).' LIMIT 1')[0];
                                                            
                                                            $userSer    = $db->getAllRecords('usuarios','*','AND id='.($servicio['usuario']).' LIMIT 1')[0];
                                                            
                                                            $lugSer     = $db->getAllRecords('lugar','*','AND id='.($servicio['lugar']).' LIMIT 1')[0];
                                                            
                                                            if ($userSer['fPerfil']) {
                                                                $fotUserEmp = '/upload/usuarios/'.(strftime("%Y/%m", strtotime(($userSer['fr'])))).'/'.($userSer['fPerfil']).'.jpg';
                                                                } else {$fotUserEmp = '/upload/usuarios/default.jpg';}
                                                                  
                                                            ?>
                                                            
                                                            <div class="slick-slide-item">
                                                                <!-- listing-item -->
                                                                <div class="listing-item">
                                                                    <article class="geodir-category-listing fl-wrap">
                                                                       
                                                                        <div class="geodir-category-img">
                                                                            <img src="/upload/servicios/<?php echo (strftime("%Y/%m", strtotime(($servicio['fr']))));?>/<?php echo ($servicio['fPortada']) ?>.jpg" alt="">
                                                                            <div class="overlay"></div>
                                                                        </div>
                                                                        
                                                                        <div class="geodir-category-content fl-wrap">
                                                                            <a class="listing-geodir-category" href="/servicios?cat=<?php echo ($servicio['catServicio']) ?>"><?php echo $catServicio['nombre']; ?></a>
                                                                            <div class="listing-avatar">
                                                                                <a href="/perfil/<?php echo ($userSer['id']) ?>"><img src="<?php echo $fotUserEmp; ?>" alt=""></a>
                                                                                <span class="avatar-tooltip">Enviado por  <strong><?php echo ($userSer['nombre']) ?></strong></span>
                                                                            </div>
                                                                            <h3><a href="/servicio/<?php echo ($servicio['id']) ?>"><?php echo $servicio['nombre']; ?></a></h3>
                                                                            <p><?php echo (substr(($servicio['descripcion']), 0, 150));?>...</p>
                                                                            <div class="geodir-category-options fl-wrap">
                                                                                
                                                                                <div class="geodir-category-location"><a href="/servicios?lug=<?php echo ($servicio['lugar']) ?>"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo ($lugEmp['nombre']) ?></a></div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </article>
                                                                </div>
                                                                <!-- listing-item end-->                         
                                                            </div>
						                                    
                                                        <?php     
                                                        }
                                                    }
                                                ?>
                                
                                
                            </div>
                            <!--listing-carousel end-->
                            <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
                            <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
                            
                        </div>
                        <!--  carousel end--> 
                        
                    </section>
                    <section class="gray-section">
                        <div class="container">
                            <a href="/servicios" class="btn  big-btn circle-btn dec-btn  color-bg flat-btn">Ver todo<i class="fa fa-eye"></i></a>
                        </div>
                    </section>