                                        <div class="fixed-bar fl-wrap">
                                            <div class="user-profile-menu-wrap fl-wrap">
                                                <!-- user-profile-menu-->
                                                <div class="user-profile-menu">
                                                    <h3>Menú de usuario</h3>
                                                    <ul>
                                                    	<li><a href="#"><i class="fa fa-gears"></i>Panel de control</a></li>															
                                                        <li><a href="/panel/perfil"><i class="fa fa-user-o"></i> Editar perfil</a></li>
                                                    </ul>
                                                </div>
                                                <!-- user-profile-menu end-->
                                                <!-- user-profile-menu-->
                                                <div class="user-profile-menu">
                                                    <h3>Contenido</h3>
                                                    <ul>
                                                        <li><a href="/panel/mis-empresas"><i class="fa fa-th-list"></i> Mis negocios
                                                        <?php 
                                                            if (($UserData['empCount'])>0) { ?>
                                                            <span><?php echo ($UserData['empCount'])?></span>
                                                        <?php } ?>
                                                        </a></li>
                                                        <li><a href="/panel/mis-servicios"><i class="fa fa-th-list"></i> Mis servicios
                                                        <?php 
                                                            if (($UserData['serCount'])>0) { ?>
                                                            <span><?php echo ($UserData['serCount'])?></span>
                                                        <?php } ?>
                                                        </a></li>
                                                        <li><a href="/panel/favoritos"><i class="fa fa-heart"></i> Favoritos
                                                        <?php
                                                            if (($UserData['empFavCount'])>0) { ?>
                                                            <span><?php echo ($UserData['empFavCount'])?></span>
                                                        <?php } ?>
                                                        </a></li>
                                                    </ul>
                                                </div>
                                                <!-- user-profile-menu end-->                                        
                                                <a href="/cerrar" class="log-out-btn">Salir</a>
                                            </div>
                                        </div>