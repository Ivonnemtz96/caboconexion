                    <!--section -->
                    <section class="gray-section">
                        <div class="container">
                            <div class="section-title">
                                <h2>Últimos Cupones</h2>
                                <span class="section-separator"></span>
                                <p>Cupones <b>más recientes </b></p>
                            </div>
                        </div>
                        <!-- carousel -->
                        <div class="list-carousel fl-wrap card-listing">
                            <!--listing-carousel-->
                            <div class="listing-carousel  fl-wrap ">

                                <?php $cupData = $db->getAllRecords('empCupones ', '*', 'ORDER BY id ASC LIMIT 10');
                                if (count($cupData) > 0) {
                                    $y    =    '';
                                    foreach ($cupData as $cupon) {

                                        $empSel = $db->getAllRecords('empresas ', '*', ' AND id="' . $cupon['empresa'] . '" LIMIT 1');
                                        $empSel = $empSel[0];

                                        $y++;

                                ?>
                                        <div class="slick-slide-item">
                                            <div class="listing-item">
                                                <article class="geodir-category-listing fl-wrap">
                                                    <div class="geodir-category-img">
                                                        <img src="/upload/cupones/<?php echo (strftime("%Y", strtotime(($empSel['fr'])))); ?>/<?php echo (strftime("%m", strtotime(($empSel['fr'])))); ?>/<?php echo ($cupon['codigo']) ?>.jpg" alt="">
                                                        <div class="overlay"></div>
                                                    </div>
                                                </article>
                                            </div>
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
                            <a href="#" class="btn  big-btn circle-btn dec-btn  color-bg flat-btn">Ver todo<i class="fa fa-eye"></i></a>
                        </div>
                    </section>