<!-- –––––––––––––––[ HEADER ]––––––––––––––– -->
<header id="mainHeader" class="main-header">
    <?php if (strpos($_SERVER['SERVER_NAME'], 'dev.zotdeal.re')) : ?>
        <div class='col-md-12' style='position: fixed; bottom: 0;left: 0;width: 100%;height: 60px;z-index:2000'>
            <div class='alert alert-success text-center' style="background-color: #<?php echo $this->config->item('admin')['color_1']; ?>; border-color:#<?php echo $this->config->item('admin')['color_1']; ?>; color:#FFF">
                <i class="fa fa-exclamation-triangle"></i> #GeekZone !
            </div>
        </div>
    <?php endif; ?>
    <!-- Top Bar -->
    <div class="top-bar bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4 is-hidden-sm-down">
                </div>
                <div class="col-sm-12 col-md-8">
                    <ul class="nav-top nav-top-right list-inline t-xs-center t-md-right">
                        <li class='hidden-sm hidden-md hidden-lg'>
                            <a href="<?php echo base_url('users/cart') ?>">
                                <i class="fa fa-shopping-cart"></i> <span class="cart-number"><?php echo $this->users_cart->countInCart(); ?></span>
                            </a>
                        </li>
                        <li class='hidden-sm hidden-md hidden-lg'>
                            <a href="<?php echo base_url('users/favorites') ?>">
                                <i class="fa fa-heart"></i> <span class="cart-number favorite-count"><?php echo $this->users_favorites->countFavorites(); ?></span>
                            </a>
                        </li>
                        <?php if ($this->users->isLogged()) : ?>
                            <li><a href="<?php echo base_url('users/coupons'); ?>"><i class="fa fa-user"></i> <?php echo $this->lang->line('hello'); ?>, <?php echo $this->session->userdata('name'); ?></a></li>
                            <li><a href="<?php echo base_url('users/coupons'); ?>"><i class="fa fa-tags"></i> <?php echo $this->lang->line('my_deals'); ?></a></li>
                            <li><a href="<?php echo base_url('users/inbox'); ?>"><i class="fa fa-commenting"></i> <?php echo $this->lang->line('my_inbox'); ?></a></li>
                        <?php else : ?>
                            <?php if ($this->users_pro->isLogged()) : ?>
                                <li><a href="<?php echo base_url('store/pro') ?>"><i class="fa fa-building"></i><?php echo $this->lang->line('my_store'); ?></a>
                                </li>
                                <li><a href="<?php echo base_url('store/inbox'); ?>"><i class="fa fa-commenting"></i> <?php echo $this->lang->line('my_inbox'); ?></a></li>
                            <?php else : ?>
                                <li><a href="<?php echo base_url('users/signin') ?>"><i class="fa fa-lock"></i><?php echo $this->lang->line('customer_login'); ?></a>
                                </li>
                                <li class="hidden-xs"><a href="<?php echo base_url('users/signup') ?>"><i class="fa fa-user"></i><?php echo $this->lang->line('customer_signup'); ?></a>
                                </li>
                                <li><a href="<?php echo base_url('store/signin') ?>"><i class="fa fa-lock"></i><?php echo $this->lang->line('pro_login'); ?></a>
                                </li>
                                <li class="hidden-xs"><a href="<?php echo base_url('deals/add') ?>"><i class="fa fa-building"></i><?php echo $this->lang->line('pro_signup'); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Top Bar -->
    <!-- Header Header -->
    <div class="header-header bg-white">
        <div class="container">
            <div class="row row-rl-0 row-tb-20 row-md-cell">
                <div class="brand col-md-3 t-xs-center t-md-left valign-middle">
                    <a href="<?php echo base_url() ?>" class="logo">
                        <img src="<?php echo base_url(isset($this->config->item('admin')['logo']) ? 'assets/uploads/logo.png' : 'assets/images/logo.png'); ?>" alt="" width="250">
                    </a>
                </div>
                <div class="header-search col-md-9">
                    <div class="row row-tb-10 ">
                        <div class="col-sm-8 text-center">
                            <form class="search-form" action="<?php echo base_url('deals/search') ?>" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg search-input" placeholder="<?php echo $this->lang->line('search'); ?>..." name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
                                    <div class="input-group-btn">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="submit" class="btn btn-lg btn-search btn-block">
                                                    <i class="fa fa-search font-16"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-4 t-xs-center t-md-right hidden-xs">
                            <div class="header-cart">
                                <a href="<?php echo base_url('users/cart') ?>">
                                    <span class="icon lnr lnr-cart"></span>
                                    <div><span class="cart-number"><?php echo $this->users_cart->countInCart(); ?></span>
                                    </div>
                                    <span class="title"><?php echo $this->lang->line('cart'); ?></span>
                                </a>
                            </div>
                            <div class="header-wishlist ml-20">
                                <a href="<?php echo base_url('users/favorites') ?>">
                                    <span class="icon lnr lnr-heart"></span>
                                    <div><span class="cart-number favorite-count"><?php echo $this->users_favorites->countFavorites(); ?></span>
                                    </div>
                                    <span class="title"><?php echo $this->lang->line('favorite'); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Header -->

    <!-- Header Menu -->
    <div class="header-menu bg-blue">
        <div class="container">
            <nav class="nav-bar">
                <div class="nav-header">
                    <span class="nav-toggle" data-toggle="#header-navbar">
                        <i></i>
                        <i></i>
                        <i></i>
                    </span>
                </div>
                <div id="header-navbar" class="nav-collapse">
                    <ul class="nav-menu">
                        <li <?php echo isset($menu) && $menu == 'home' ? 'class="active"' : '' ?>>
                            <a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('menu_home'); ?></a>
                        </li>
                        <li  <?php echo isset($menu) && $menu == 'deal' ? 'class="active dropdown-mega-menu"' : 'class="dropdown-mega-menu"' ?>>
                            <a href="#"><?php echo $this->lang->line('menu_deals'); ?></a>
                            <div class="mega-menu bg-blue">
                                <div class="row row-v-10">
                                    <div class="col-md-3">
                                        <?php $this->load->view('partial/categories', array('show_icons' => true, 'show_count' => false, 'add_class' => 'header_cat border-bottom-white')); ?>
                                    </div>
                                    <?php $categories = $this->categories->getAll(); ?>
                                    <?php if ($categories) : ?>
                                        <?php foreach ($categories as $key => $category) : ?>
                                            <?php $subCategories = $this->sub_categories->getSubCategories($category->id); ?>
                                            <div class="category_bloc category_bloc_<?php echo $category->id ?>" <?php echo $key > 0 ? 'style="display: none"' : '' ?>>
                                                <?php if ($subCategories) : ?>
                                                    <?php $compt = 0; ?>
                                                    <?php foreach ($subCategories as $key => $subCategory) : ?>
                                                        <?php $compt++; ?>
                                                        <?php if ($subCategory->partner == NULL) : ?>
                                                            <div class="col-md-3">
                                                                <?php $this->load->view('partial/menu_bloc', array('infos' => $subCategory)); ?>
                                                            </div>
                                                            <?php if ($compt == 3) break; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                        <li <?php echo isset($menu) && $menu == 'store' ? 'class="active"' : '' ?>><a href="<?php echo base_url('les-commerces') ?>"><?php echo $this->lang->line('menu_network'); ?></a>
                        <li <?php echo isset($menu) && $menu == 'concept' ? 'class="active"' : '' ?>><a href="<?php echo base_url('comment-ca-marche') ?>"><?php echo $this->lang->line('menu_about'); ?></a>
                    </ul>
                </div>
                <div class="nav-menu nav-menu-fixed <?php echo isset($section_pro) || $this->users_pro->isLogged() ? 'nav-menu-pro' : '' ?>">
                    <?php if (!isset($section_pro) && !$this->users_pro->isLogged()) : ?>
                        <?php if (isset($this->config->item('admin')['active_pro']) && $this->config->item('admin')['active_pro'] == 1) : ?>
                            <a href="<?php echo base_url('deals/add'); ?>"><?php echo $this->lang->line('menu_add_store'); ?></a>
                        <?php endif; ?>
                    <?php else : ?>
                        <a href="<?php echo $this->users_pro->isLogged() ? base_url('store/pro') : base_url('deals/add'); ?>"><?php echo $this->users_pro->isLogged() ? ($this->session->userdata('role') == 'admin' ? $this->lang->line('menu_admin_connected') : $this->lang->line('menu_store_connected')) : $this->lang->line('menu_pro_section'); ?></a>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </div>
    <!-- End Header Menu -->
</header>
<!-- –––––––––––––––[ HEADER ]––––––––––––––– -->

<!-- –––––––––––––––[ POPUPS ]––––––––––––––– -->
<div id="proPopup"  class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('pro_signup'); ?></h4>
            </div>
            <div class="modal-body text-center">
                <h3 class="text-center"><?php echo $this->lang->line('popup_add_store'); ?></h3>
            </div>
            <div class="modal-footer text-center" style="text-align: center">
                <a href="<?php echo base_url('deals/add'); ?>" class="btn btn-lg btn-info"><?php echo $this->lang->line('yes'); ?> !</a>
                <br />
                <a href="#" onclick="$('#proPopup').modal('hide')" class="btn btn-danger btn-xs mt-10"><?php echo $this->lang->line('no'); ?></a>
            </div>
        </div>
    </div>
</div>

<!-- IMG GALLERY -->
<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only"><?php echo $this->lang->line('close'); ?></span></button>
                <h4 class="modal-title" id="image-gallery-title"></h4>
            </div>
            <div class="modal-body">
                <img id="image-gallery-image" class="img-responsive" src="">
            </div>
            <div class="modal-footer">

                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" id="show-previous-image"><i class='fa fa-arrow-left'></i></button>
                </div>

                <div class="col-md-2">
                    <button type="button" id="show-next-image" class="btn btn-default"><i class='fa fa-arrow-right'></i></button>
                </div>
            </div>
        </div>
    </div>
</div>