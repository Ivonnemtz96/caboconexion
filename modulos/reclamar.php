        <div class="main-register-wrap reclamar">
                <div class="main-overlay"></div>
                <div class="main-register-holder">
                    <div class="main-register fl-wrap">
                        <div class="close-reg"><i class="fa fa-times"></i></div>
                        <h3>Reclama la propiedad de: <span><strong><?php echo $empData['nombre']; ?></strong></span></h3>
                        <div id="tabs-container">
                           
                            <?php
                            if (!isset($_SESSION["UserId"])) {
                            ?>
                                <p style="text-align: left;margin: 0 30px;"><i>Necesitas iniciar sesión para reclamar una empresa.</i></p>
                            <?php        
                            } else { 
                            ?>
                                <div class="custom-form">
                                    <form method="post" action="/reclamar/"class="main-register-form" id="main-register-form2">
                                        <input hidden name="empresa" type="text" value="<?php echo $empData['id']; ?>">
                                        <label>Nombre</label>
                                        <input required name="nombre" type="text"> 
                                        <label>Teléfono</label>
                                        <input required name="telefono" type="text">                                              
                                        <label>Cuéntanos ¿Cómo puedes confirmar que eres propietario de este negocio?</label>
                                        <textarea required name="mensaje"></textarea>
                                        <button type="submit" name="reclamar" class="log-submit-btn"  ><span>Reclamar</span></button> 
                                    </form>
                                </div>
                            <?php 
                            }
                            ?>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            