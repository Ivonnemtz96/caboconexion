                    <div class="header-user-menu">
                        <div class="header-user-name">
                            <span><img src="<?php echo ($fPerfil);?>" alt=""></span>
                            <div class="menuName">Mi panel</div>
                        </div>
                        <ul>
                           
                            <?php if (($UserData["rol"])<3 ) { ?>
                            <li><a href="/admin"> Administrador</a></li> <?php
                            } ?>
                            
                            <li><a href="/panel/perfil"> Perfil</a></li>
                            <li>
                                <a href="/panel/mis-empresas/"> Mis negocios 
                                 <?php if (($UserData['empCount'])>0) { ?>
                                         (<?php echo ($UserData['empCount']); ?>)
                                    <?php } ?>
                                </a>
                            </li>
                            <li>
                                <a href="/panel/mis-servicios/"> Mis servicios 
                                 <?php if (($UserData['serCount'])>0) { ?>
                                         (<?php echo ($UserData['serCount']); ?>)
                                    <?php } ?>
                                </a>
                            </li>
                            <li>
                                <a href="/panel/favoritos/"> Favoritos 
                                 <?php if (($UserData['empFavCount'])>0) { ?>
                                         (<?php echo ($UserData['empFavCount']); ?>)
                                    <?php } ?>
                                </a>
                            </li>
                            <li><a href="/cerrar">Salir</a></li>
                        </ul>
                    </div>