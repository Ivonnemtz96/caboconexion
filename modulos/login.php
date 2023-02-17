        <div class="main-register-wrap modal">
                <div class="main-overlay"></div>
                <div class="main-register-holder">
                    <div class="main-register fl-wrap">
                        <div class="close-reg"><i class="fa fa-times"></i></div>
                        <h3>Acceder a <span>Cabo<strong>Conexion</strong></span></h3>
                        
                        <div id="tabs-container">
                            <ul class="tabs-menu">
                                <li class="current"><a href="#tab-1">Acceder</a></li>
                                <li><a href="#tab-2">Registrate</a></li>
                            </ul>
                            <div class="tab">
                                <div id="tab-1" class="tab-content">
                                    <div class="custom-form">
                                        <form method="post" action="/acceder/">
                                            <label>Correo electrónico</label>
                                            <input name="email" type="text"> 
                                            <label>Contraseña</label>
                                            <input name="pass" type="password"> 
                                            <button type="submit" name="login" class="log-submit-btn"><span>Acceder</span></button> 
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div id="tab-2" class="tab-content">
                                        <div class="custom-form">
                                            <form method="post" action="/registrate/"class="main-register-form" id="main-register-form2">
                                                <label>Nombre</label>
                                                <input name="rnombre" type="text"> 
                                                <label>Correo</label>
                                                <input name="remail" type="email">                                              
                                                <label>Contraseña</label>
                                                <input name="rpassword" type="password"> 
                                                <button type="submit" name="register" class="log-submit-btn"  ><span>Registrarme</span></button> 
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            