                    <!--section -->
                    <section class="gray-section">
                        <div class="container">
                            <div class="section-title">
                                <h2>ESTABLECIMIENTOS - NEGOCIOS ESTABLECIDOS</h2>
                                <span class="section-separator"></span>
                                <p>Encuentra miles de negocios en <b>CaboConexion</b></p>
                            </div>
                        </div>
                        <!-- carousel -->
                        <div class="list-carousel fl-wrap card-listing">
                            <!--listing-carousel-->
                            <div class="listing-carousel  fl-wrap ">

                                <?php $empData = $db->getAllRecords('empresas', '*', 'ORDER BY rand() LIMIT 10');
                                if (count($empData) > 0) {
                                    $y    =    '';
                                    foreach ($empData as $empresa) {
                                        $y++;

                                        $fav        =    $db->getQueryCount('empFavoritos', 'id', 'AND empresa=' . ($empresa['id']) . '');

                                        $catSubEmpresa = $db->getAllRecords('catSubEmpresa', '*', 'AND id=' . ($empresa['catSubEmpresa']) . ' LIMIT 1');
                                        $catSubEmpresa = $catSubEmpresa[0];

                                        $catEmpresa = $db->getAllRecords('catEmpresa', '*', 'AND id=' . ($empresa['catEmpresa']) . ' LIMIT 1');
                                        $catEmpresa = $catEmpresa[0];

                                        $userEmp    = $db->getAllRecords('usuarios', '*', 'AND id=' . ($empresa['usuario']) . ' LIMIT 1');
                                        $userEmp    = $userEmp[0];

                                        $lugEmp     = $db->getAllRecords('lugar', '*', 'AND id=' . ($empresa['lugar']) . ' LIMIT 1');
                                        $lugEmp     = $lugEmp[0];

                                        if ($userEmp['fPerfil']) {
                                            $fotUserEmp = '/upload/usuarios/' . (strftime("%Y", strtotime(($userEmp['fr'])))) . '/' . (strftime("%m", strtotime(($userEmp['fr'])))) . '/' . ($userEmp['fPerfil']) . '.jpg';
                                        } else {
                                            $fotUserEmp = '/upload/usuarios/default.jpg';
                                        }

                                ?>

                                        <div class="slick-slide-item">
                                            <!-- listing-item -->
                                            <div class="listing-item">
                                                <article class="geodir-category-listing fl-wrap">

                                                    <div class="geodir-category-img">
                                                        <img src="/upload/empresas/<?php echo (strftime("%Y", strtotime(($empresa['fr'])))); ?>/<?php echo (strftime("%m", strtotime(($empresa['fr'])))); ?>/<?php echo ($empresa['fPortada']) ?>.jpg" alt="">
                                                        <div class="overlay"></div>
                                                        <div class="list-post-counter"><span><?php echo ($fav[0]['total']); ?></span><a href="/panel/nuevo/favorito?addId=<?php echo $empresa['id']; ?>"><i class="fa fa-heart"></i></a></div>
                                                    </div>

                                                    <div class="geodir-category-content fl-wrap">
                                                        <a class="listing-geodir-category" href="/empresas?subcat=<?php echo ($empresa['catSubEmpresa']) ?>"><?php echo $catSubEmpresa['nombre']; ?></a>
                                                        <div class="listing-avatar">
                                                            <a href="/perfil/<?php echo ($userEmp['id']) ?>"><img src="<?php echo $fotUserEmp; ?>" alt=""></a>
                                                            <span class="avatar-tooltip">Enviado por <strong><?php echo ($userEmp['nombre']) ?></strong></span>
                                                        </div>
                                                        <h3><a href="/empresa/<?php echo ($empresa['id']) ?>"><?php echo $empresa['nombre']; ?></a></h3>
                                                        <p><?php echo (substr(($empresa['descripcion']), 0, 150)); ?>...</p>
                                                        <div class="geodir-category-options fl-wrap">

                                                            <div class="geodir-category-location"><a href="/empresas?lug=<?php echo ($empresa['lugar']) ?>"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo ($lugEmp['nombre']) ?></a></div>
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
                            <a href="/empresas" class="btn  big-btn circle-btn dec-btn  color-bg flat-btn">Ver todo<i class="fa fa-eye"></i></a>
                        </div>
                    </section>