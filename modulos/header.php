            <style>
                .bus-header input, .main-search-input  {
                    width: 1000px;
                    transition-duration: 1s;
                }
               
                
                @media (max-width: 1930px) {
                  .bus-header input, .main-search-input {
                    width: 900px;
                }
                }
                    
                @media (max-width: 1800px) {
                  .bus-header input, .main-search-input {
                    width: 800px;
                }
                    
                @media (max-width: 1680px) {
                  .bus-header input, .main-search-input {
                    width: 700px;
                    }
                }
                    
                @media (max-width: 1560px) {
                  .bus-header input, .main-search-input {
                    width: 600px;
                }
                }
                    
                @media (max-width: 1430px) {
                  .bus-header input, .main-search-input {
                    width: 380px;
                }
                }
                   
                    
                
            }

            
            </style>
           
            <header class="main-header dark-header fs-header sticky">
                <div class="header-inner">
                    <div class="logo-holder">
                        <a href="/"><img src="/images/logo.png" alt=""></a>
                    </div>
                    <div class="header-search vis-header-search">
                        <form method="GET" action="/busqueda">
                            <div class="main-search-input-wrap">
                                <div class="main-search-input fl-wrap">
			    	        	    <div class="main-search-input-item item-top bus-header location">
			    	        		    <input style="width: 100%;" type="text" name="s" placeholder="Negocios, servicios, productos y más...">
			    	                </div>
                                    
                                    <button class="main-search-button">Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="show-search-button">
                        <i class="fa fa-search"></i>
                        <span>Buscar</span>
                    </div>
                    <a href="/panel/anunciar" class="add-list">Crear anuncio <span><i class="fa fa-plus"></i></span></a>
                    
                    
                    <?php
                    if (isset($_SESSION["UserId"])) {
                        require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/userNav.php");
                        
                        } else { ?><div class="show-reg-form"><a style="color: #fff;" href="/acceder"><i class="fa fa-sign-in"></i>Acceder</a></div><?php }
                    ?>
                    <!-- nav-button-wrap--> 
                    
                    <?php // require_once($_SERVER["DOCUMENT_ROOT"]."/modulos/nav.php");?>
                </div>
            </header>
            
            
           