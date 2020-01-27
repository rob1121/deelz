<?php if($deals_slider): ?>
		<div class="banner-top container">
			<header class="codrops-header">
				<h1>HA designer</h1>
			</header>
			<div id="slideshow" class="slideshow">
      <?php foreach($deals_slider as $deal): ?>
				<div class="slide">
        <h2 class="slide__title slide__title--preview"><?php echo $deal->title; ?><span class="slide__price">
          <div class="deal-price pos-r mb-15"><span class="price-sale"><?php echo $deal->price_promo > 0 ? priceToShow($deal->price_base) : ''; ?></span><?php echo $deal->price_promo > 0 ? priceToShow($deal->price_promo) : ($deal->price_base > 0 ? priceToShow($deal->price_base) : ($deal->promo_discount > 0 ? '-' . $deal->promo_discount . '%' : ($deal->price_type == 'quotation' ? 'Sur devis' : 'GRATUIT'))); ?>
                                        </div>
          </h2>
					<div class="slide__item">
						<div class="slide__inner">
              <?php if ($deal->promo_discount > 0) : ?>
                  <div class="label-discount" style="position: absolute;left: 0px; top:100px"><?php echo '-' . $deal->promo_discount . '%'; ?></div>
              <?php endif; ?>
							<img class="slide__img slide__img--small" src="<?php echo base_url('assets/images/' . $deal->cover); ?>" alt="Some image" />
							<a class="action action--open" href="<?php echo routeDeal($deal->deal_id, $deal->title); ?>"><i class="fa fa-plus"></i></a>
						</div>
					</div>
				</div>
      <?php endforeach;?>
				<button class="action action--close" aria-label="Close"><i class="fa fa-close"></i></button>
			</div>
			</div>

<?php endif; ?>