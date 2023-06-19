    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <a href="<?= base_url(); ?>/usuarios/perfil">
            <div id="app-sidebar__user" class="app-sidebar__user">
                <img id="user-imgMin" class="app-sidebar__user-avatar" src="<?= base_url(); ?>/Assets/images/uploads/<?=$_SESSION['userData']['url_logo'];?>" alt="User Image">
                <i id="user-iconMin" class="d-none fa fa-user app-menu__icon"></i>
                <div>
                    <p class="app-sidebar__user-name"><b><?= $_SESSION['userData']['nombres']; ?></b></p>
                    <p class="app-sidebar__user-designation"><?= $_SESSION['userData']['nombrerol']; ?></p>
                </div>
            </div>
        </a>

      <ul class="app-menu">
        <li>
            <?php
            $id = $_SESSION['userData']['id_restaurante'];
            $codeIndex = $_SESSION['userData']['identificacion'];
            $url_menu = $_SESSION['userData']['url'];            
            $ultimoPago = selectUltimoPago();
            $countPedidos = countPedidos();                        

            if($ultimoPago['status'] == 'vencido'){
                $classPago = "linkDisable";
            } else { $classPago = "";}
            ?>
            <a onclick="abrirModalQR();" class="app-menu__item" target="_blank">
                <i class="app-menu__icon fa fas fa-globe" aria-hidden="true"></i>
                <span class="app-menu__label">Ver Menú</span>
            </a>
        </li>
        <?php if(!empty($_SESSION['permisos'][1]['r'])){ ?>            
        <li>
            <a class="app-menu__item <?=
                $classPago; if($data['page_title'] == 'Dashboard'){echo "activeBtn";}?>" href="<?= base_url(); ?>/dashboard">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <?php } ?>     
        <?php if(!empty($_SESSION['permisos'][4]['r']) || !empty($_SESSION['permisos'][6]['r'])){ ?>
        <li class="treeview <?php if($data['page_title'] == 'Sliders' || $data['page_title'] == 'Categorias' || $data['page_title'] == 'Productos'){echo "is-expanded";}?>">
            <a class="app-menu__item <?=$classPago; if($data['page_title'] == 'Sliders' || $data['page_title'] == 'Categorias' || $data['page_title'] == 'Productos'){echo "activeBtn";}?>" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-archive" aria-hidden="true"></i>
                <span class="app-menu__label">Tu menú</span>
                <i class="grey-indi treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <?php if(!empty($_SESSION['permisos'][6]['r'])){ ?>
                <li><a class="treeview-item <?= $classPago; if($data['page_title'] == 'Sliders'){echo "activeBtn";}?>" href="<?= base_url(); ?>/sliders">Sliders</a></li>
                <?php } ?>
                <?php if(!empty($_SESSION['permisos'][6]['r'])){ ?>
                <li><a class="treeview-item <?= $classPago; if($data['page_title'] == 'Categorias'){echo "activeBtn";}?>" href="<?= base_url(); ?>/categorias">Categorías</a></li>
                <?php } ?>
                <?php if(!empty($_SESSION['permisos'][4]['r'])){ ?>
                <li><a class="treeview-item <?=$classPago; if($data['page_title'] == 'Productos'){echo "activeBtn";}?>" href="<?= base_url(); ?>/productos">Productos</a></li>
                <?php } ?>
            </ul>
        </li>
        <?php } ?>
        <?php if(!empty($_SESSION['permisos'][5]['r'])){ ?>
        <li>
            <a class="app-menu__item <?=$classPago; if($data['page_title'] == 'Pedidos'){echo "activeBtn";}?>" href="<?= base_url(); ?>/pedidos">
                <i class="app-menu__icon fa-solid fa-bag-shopping" aria-hidden="true"></i>           
                <span class="app-menu__label">Pedidos</span>
                <?php if($countPedidos['totalPedidos'] != 0){ ?>
                <span class="notiPedidos"><?=$countPedidos['totalPedidos']?></span>
                <?php } ?>
            </a>
        </li>
        <?php } ?>
        <?php if(!empty($_SESSION['permisos'][5]['r'])){ ?>
        <li>
            <a class="app-menu__item <?php if($data['page_title'] == 'Pagos'){echo "activeBtn";}?>" href="<?= base_url(); ?>/pagos">
                <i class="app-menu__icon fa-solid fa-money-bill-wave" aria-hidden="true"></i>                 
                <span class="app-menu__label">Pagos</span>                
            </a>
        </li>
        <?php } ?>
         <li>
            <a class="app-menu__item app-menu__item-qr <?=$classPago; if($data['page_title'] == 'Mi QR'){echo "activeBtn";}?>" href="<?= base_url(); ?>/miqr">
                <div>
                    <i class="app-menu__icon fa fa-qrcode" aria-hidden="true"></i>
                    <span class="app-menu__label">Mi codigo QR</span>
                </div>
                <?php if(empty($classPago)) { ?>
                    <div class="app-menu_qr">
                        <?php $codeIndex = $_SESSION['userData']['identificacion'];?>
                        <img src="<?= media(); ?>/images/uploads/qr/qr_<?=$url_menu;?>_150x150.jpg" alt="">          
                    </div>   
                <?php } ?>      
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/logout">
                <i class="app-menu__icon fa fa-sign-out" aria-hidden="true"></i>
                <span class="app-menu__label">Cerrar sesión</span>
            </a>
        </li>          
      </ul>      

        
    </aside>