                                <div class="slider-item fl-wrap">
                                    <div class="bg"  data-bg="images/bg/slider/1.jpg"></div>
                                    <div class="overlay"></div>
                                    <div class="hero-section-wrap fl-wrap">
                                        <div class="container">
                                            <div class="intro-item fl-wrap">
                                                <h2>¡Te ayudaremos a encontrar de todo!</h2>
                                                <h3>Encuentra excelentes servicios en Los Cabos.</h3>
                                            </div>
                                            <form method="get" action="/empresas">
                                            <div class="main-search-input-wrap">
                                                <div class="main-search-input fl-wrap">
													<div class="main-search-input-item location" id="autocomplete-container">
														<select name="lug" data-placeholder="Selecciona un servicio" class="chosen-select" >
                                                            <option value="">¿Dónde te ubicas?</option>
                                                            <?php
                                                            $OptionData = $db->getAllRecords('lugar','*','ORDER BY nombre ASC');
                                                            if (count($OptionData)>0){
                                                                foreach($OptionData as $lugar){?>			    		
                                                                    <option value="<?php echo ($lugar['id']);?>"><?php echo ($lugar['nombre']);?></option>
                                                                    <?php 
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
													</div>
                                                    <div class="main-search-input-item">
                                                        <select name="cat" data-placeholder="Selecciona un servicio" class="chosen-select" >
                                                            <option value="">¿Qué tipo de negocio buscas?</option>
                                                            
                                                            <?php
                                                            $OptionData = $db->getAllRecords('catEmpresa','*','ORDER BY nombre ASC');
                                                            if (count($OptionData)>0){
                                                                foreach($OptionData as $servicio){?>			    		
                                                                    <option value="<?php echo ($servicio['id']);?>"><?php echo ($servicio['nombre']);?></option>
                                                                    <?php 
                                                                    }
                                                                }
                                                            ?>
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="main-search-input-item">
                                                        <select name="subcat" data-placeholder="Selecciona un servicio" class="chosen-select" >
                                                            <option value="">Categoría</option>
                                                            
                                                            <?php
                                                            $OptionData = $db->getAllRecords('catSubEmpresa','*','ORDER BY nombre ASC');
                                                            if (count($OptionData)>0){
                                                                foreach($OptionData as $servicio){?>			    		
                                                                    <option value="<?php echo ($servicio['id']);?>"><?php echo ($servicio['nombre']);?></option>
                                                                    <?php 
                                                                    }
                                                                }
                                                            ?>
                                                            
                                                        </select>
                                                    </div>
                                                    <button class="main-search-button">Buscar</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>