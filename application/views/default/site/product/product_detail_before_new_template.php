<?php 
$this->load->view('site/templates/header'); 
?>
<!-- Bootstrap -->
<script src="js/front/auction_script.js"></script> 
<!--<link href="css/default/front/fancyzoom.css" rel="stylesheet">-->
<link rel="shortcut icon" type="image/ico" href="img/logo.ico"/>
<?php if(isset($active_theme) &&  $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Product-Detail-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>footer.css" rel="stylesheet">
<?php } ?>
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/jquery.galleryview-3.0-dev.css"/>
<link rel="stylesheet" href="css/default/flexslider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/default/lightbox.css">
<script type="text/javascript" src="js/site/jquery.countdown.js"></script>
<script defer src="js/jquery.flexslider.js"></script>
<!--<script type="text/javascript" src="js/lightbox.js"></script>-->
<script type="text/javascript" src="js/front/freewall.js"></script>
<script type="text/javascript">
$( document ).on( 'click', ".price-block span i",  function () {
		$('#price_details').slideToggle();
		if ( $('.price-block span i').hasClass('fa-angle-double-down') ) {
			$('.price-block span i').removeClass('fa-angle-double-down').addClass('fa-angle-double-up');
		} else {
			$('.price-block span i').removeClass('fa-angle-double-up').addClass('fa-angle-double-down');
		}
	} );   

</script>

<style>
.msrp-price { text-decoration:line-through; }
.normal-price { color:#F00; font-size:large; font-weight:600; }
.price-block { color:#F00; font-size:14px; }
.price-block span { margin-left:10px; cursor:pointer; }
.discount_price { float:right; padding-right:100px; color:#F00; }
.option-label { float:left; text-align:left; color:#000; width:100%;font-size: 14px; }
.form-control { margin:0px; }
</style>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<div id="product_detail_div">
	<section class="container">
  <div class="seller-wrapper">
    <div class="col-md-6 seller"> 
	<?php if($selectedSeller_details[0]['thumbnail']!=""){ $Pro_pic=$selectedSeller_details[0]['thumbnail']; }else { $Pro_pic='profile_pic.png';} ?>
     <div class=" avatar"> <img src="images/users/thumb/<?php echo $Pro_pic; ?>" alt="small"></div>
     <div class="shop-name">
		<a href="shop-section/<?php echo $selectedSeller_details[0]['seourl']; ?>"> <span class="shop-txt"><?php echo $selectedSeller_details[0]['seller_businessname']; ?></span> </a> 
		<?php if($loginCheck !=''){
							$favArr = $this->product_model->getUserFavoriteShopDetails(stripslashes($selectedSeller_details[0]['seller_id']));
							
							if(empty($favArr)){ ?>
                       		<a href="javascript:void(0);" onclick="return changeShopToFavourite('<?php echo stripslashes($selectedSeller_details[0]['seller_id']); ?>','Fresh');">
                            	<div class="btn-secondary"> <i id="fav" class="fa fa-heart"></i><?php if($this->lang->line('shop_favshop') != '') { echo stripslashes($this->lang->line('shop_favshop')); } else echo 'Favorite Shop'; ?></div>                           	
                         	</a>
						<?php  } else { ?>                        
                        	<a href="javascript:void(0);" onclick="return changeShopToFavourite('<?php echo stripslashes($selectedSeller_details[0]['seller_id']); ?>','Old');">
								<div class="btn-secondary"> <i id="fav" class="fav-icon-sel"></i><?php if($this->lang->line('shop_favshop') != '') { echo stripslashes($this->lang->line('shop_favshop')); } else echo 'Favorite Shop'; ?></div>
                            </a>                                       
                        <?php }} else { ?>
                        	<a href="javascript:void(0);" onclick="return changeShopToFavourite('<?php echo stripslashes($selectedSeller_details[0]['seller_id']); ?>','Fresh');">
                            	<div class="btn-secondary"> <i id="fav" class="fa fa-heart"></i><?php if($this->lang->line('shop_favshop') != '') { echo stripslashes($this->lang->line('shop_favshop')); } else echo 'Favorite Shop'; ?></div>
                         	</a>
          <?php  } ?>
	</div>
    </div>
    <div class="col-md-6 cart-right-small">
      <div class="banner-user-profile">
			<?php if(count($shopProductDetails)<2){$c=count($shopProductDetails);}else{ $c=2; } 
				for($i=0;$i<$c;$i++){ 
					$imgArry=explode(',',$shopProductDetails[$i]['image']);
				?>
				
				<div class="rf-small"> 
					<a href="products/<?php echo $shopProductDetails[$i]['seourl']; ?>">
						<!-- <img alt="<?php echo $shopProductDetails[$i]['product_name']; ?>" src="images/product/list-image/<?php echo $imgArry[0]; ?>"> -->
						<img alt="<?php echo $shopProductDetails[$i]['product_name']; ?>" src="images/product/<?php echo $shopProductDetails[$i]['id']; ?>/cropthumb/<?php echo $imgArry[0]; ?>">
						
					</a>
				</div>
			
			<?php } ?>                       
			 <div class="rf-small"> 
				<a href="shop-section/<?php echo $selectedSeller_details[0]['seourl']; ?>" class="shop-listing-count"> <span class="listing-count"><?php echo count($shopProductDetails)+1; ?> </span><?php if($this->lang->line('user_items') != '') { echo stripslashes($this->lang->line('user_items')); } else echo 'items'; ?> 
				</a>
			</div>
      </div>
    </div>
  </div>
  
  
  <div class="content-seller">
  <div class="col-md-12">
    <div class="seller-right col-md-7">
      <div class="favorites-nag">
        <div class="fav-bt"> 		
			 <?php if($loginCheck !=''){ ?>
					<?php if($added_item_details[0]['user_id']==$loginCheck){ ?>
						<a href="javascript:void(0);" onclick="return ownProductFav();">
							<div class="btn-secondary col-md-11" id="fav-icon">
								<i class="fa fa-heart"></i>
							</div>
						</a>
						<?php
						}else{
						$favArr = $this->product_model->getUserFavoriteProductDetails(stripslashes($added_item_details[0]['id']));
						
						if(empty($favArr)){ ?>
                        <a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($added_item_details[0]['id']); ?>','Fresh',this);">
							<div class="btn-secondary col-md-11" id="fav-icon"> 
								<i id="prodfav" class="fa fa-heart"></i><?php if($this->lang->line('user_favorite') != '') { echo stripslashes($this->lang->line('user_favorite')); } else echo 'Favorite'; ?>
							</div>
                        </a>						
						
						<?php  } else { ?>                        
						<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($added_item_details[0]['id']); ?>','Old',this);">
							<div class="btn-secondary" id="fav-icon"> 
								<i id="prodfav" class="fav-icon-sel"></i><?php if($this->lang->line('user_favorite') != '') { echo stripslashes($this->lang->line('user_favorite')); } else echo 'Favorite'; ?>
							</div>
                        </a>	
						
                        <?php }}} else { ?>
                      
						<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($added_item_details[0]['id']); ?>','Fresh',this);">
							<div class="btn-secondary" id="fav-icon"> 
								<i id="prodfav" class="fa fa-heart"></i><?php if($this->lang->line('user_favorite') != '') { echo stripslashes($this->lang->line('user_favorite')); } else echo 'Favorite'; ?>
							</div>
                        </a>		
                        <?php  } ?> 
		 </div>		
		 
        <div class="nag-message">
             <h2>Like this item?</h2>Add it to your favorites to revisit it later.
		</div>
      </div>

			<div id="gallery" class="flexslider" >
				<ul class="slides">
				<?php 
					$imageArr=explode(',',$added_item_details[0]['image']);
					$imgCount=count($imageArr);
					for($i=0;$i<$imgCount;$i++){ 
				?>
					<li data-thumb="<?php echo 'images/product/'.$added_item_details[0]['id'].'/thumb/'.$imageArr[$i]; ?>">
						<a rel="example2" href="<?php echo 'images/product/org-image/'. $imageArr[$i];  ?>" data-lightbox="example-set">
							<img src="<?php echo 'images/product/'.$added_item_details[0]['id'].'/'. $imageArr[$i]; ?>" class="image0">
						</a>
					</li>   
				<?php 
					}
				?> 
				</ul>
			</div>
		</div>
		 
		 <div class="col-md-5">
		 
			<div class="listing-page-cart">
	  
			<div class="listing-page-cart-inner">
				<div class="btn-secondary">
				<?php if($this->session->userdata['shopsy_session_user_id'] != '') { ?>	
					<a data-toggle="modal" href="#ask_reg">Ask Question</a>
					<?php } else {?>
					<a href="login?action=<?php echo current_url(); ?>">Ask Question</a>
				<?php } ?>
			  </div>
			  <?php
					$store_disc_price = 0;

					//sale is available then calculate price
					if( isset($prod_promo) ||  isset($save_percent) )  {
						if(  strtotime($prod_promo['start_date'] ) <= strtotime( date('Y-m-d')  ) 
						   && strtotime( date('Y-m-d') ) <= strtotime($prod_promo['end_date']) ) {
							$product_disc_price = ( $added_item_details[0]['price'] / 100 * $prod_promo['discount_percent']);
						}
						if(  strtotime($store_promo['start_date'] ) <= strtotime( date('Y-m-d') ) 
						   && strtotime( date('Y-m-d') ) <= strtotime($store_promo['end_date']) ) {
							$store_disc_price = ( $added_item_details[0]['price'] / 100 * $store_promo['discount_percent']);
						}
					}
					if ( $product_disc_price > 0.0 || $store_disc_price > 0.0 ) {
						 if ( $product_disc_price > $store_disc_price ) {
							$final_disc_price = $pro_disc_price;
							$new_price = $added_item_details[0]['price'] - $product_disc_price;
							$final_disc_percent = $prod_promo['discount_percent'];
						 } else {
							$new_price = $added_item_details[0]['price'] - $store_disc_price;
							$final_disc_price = $store_disc_price;
							$final_disc_percent = $store_promo['discount_percent'];
						 }
					} else {
						$new_price = $added_item_details[0]['price'];
					}
			        $save_price = $added_item_details[0]['msrp']-$new_price;
					$save_percent = ( $save_price * 100 ) / $added_item_details[0]['msrp'];
					$save_msrp_price = $added_item_details[0]['msrp']-$added_item_details[0]['price'];
					$save_msrp_percent = ( $save_msrp_price * 100 ) / $added_item_details[0]['msrp'];

			  ?>
			  <h1><?php echo $added_item_details[0]['product_name']; ?></h1>
			  <div class="msrp-price">
			  <?php echo '$'.number_format($added_item_details[0]['msrp'],2); ?>
              </div>
              <div class="normal-price"><?php echo '$' . number_format($new_price,2); ?>
			  <input type="hidden" id="price_val" value="<?php echo $new_price; ?>" />
              </div>
			  <div class="price-block">
                  You save <?php echo '$'. number_format( $save_price, 2);?> ( <?php echo number_format($save_percent,2); ?>% off )
                  <span><i class="fa fa-2x fa-angle-double-down"></i></span>
              </div>
            <div id="price_details" style="display:none">
            <?php if( (float) $save_price > 0.0 ) { ?>
            <div><b>Shops@Avenue Savings</b></div>
            <div><?php echo number_format( $save_msrp_percent, 0 ); ?>% off MSRP   <span class="discount_price">- $<?php echo number_format($save_msrp_price,2); ?></span></div>
            <?php } ?>
            <?php if( (float) $store_disc_price > 0.0 ) { ?>
            <div><b>Store/Product Sale Discount</b></div>
            <div><?php echo number_format( $final_disc_percent, 0 ); ?>% off Shops@Avenue price  <span class="discount_price">- $<?php echo number_format($final_disc_price,2); ?></span></div>
            <?php } ?>
            <div style=" border-bottom:2px dotted rgba(0, 0, 0, 0.15)"></div>
            </div>
            <?php if ( $added_item_details[0]['sold_exclusive'] ) { ?>
                <div style="padding: 10px 0px;"><span>+</span> Shops@Avenue exclusive</div>
            <?php } ?>

		  </div>
          
			 <div class="price_left">
				<p id="QtyErr"></p><p id="ADDCartErr"></p>
			 </div>

			<?php if ( $added_item_details[0]['variable_product'] ) { ?>
				<?php 
                      $i=0;
                      foreach ( $options as $opt_id => $opt_row ) {
                 ?>
                        <?php if( $options[$opt_id]['option_type_id'] == 1  ) { 
						?>
                      <div style="width:100%">
                              <div><?php echo $options[$i]['product_option_name']; ?></div>
                              <div id="color_wrapper">
                              <?php foreach( $variations as $key => $row ) { ?>
                                  <div>
                                    <a href="javascript:;" onclick="setColor(this);" > <div class="varbox" style="background-color:<?php echo $row['color_code']; ?>" ></div>
                                    </a>
                                    <input type="radio" name="var_color_1" value="<?php echo $row['product_variant_name1']; ?>" style="display:none;"  >
                                  </div>
                              <?php } ?>
                              </div>
                      </div>
                        <?php }	?>
                        
                        <?php if( $options[$opt_id]['option_type_id'] == 2  ) { 
						?>
                      	<div style="width:100%" >
                              <div class="option-label">Select <?php echo $options[$opt_id]['product_option_name']; ?></div>
                              <select class="form-control" name="var-color" style="width:50%" >
                              <?php foreach( $option_values as $key => $row ) { 
							         if( $options[$opt_id]['product_option_id'] != $row['product_option_id'] ) continue;
							  ?>
                                  <option value="<?php echo $row['product_option_value_id']; ?>"><?php echo $row['option_value']; ?></option>
                              <?php } ?>
                              </select>
                      	</div>
                        <?php }	?>
                        <?php if( $options[$opt_id]['option_type_id'] == 3  ) { 

						?>
                      	<div style="width:100%" >
                              <div class="option-label">Select <?php echo $options[$opt_id]['product_option_name']; ?></div>
                              <select class="form-control" name="var-size" style="width:50%" >
                              <?php foreach( $option_values as $key => $row ) { 
							         if( $options[$opt_id]['product_option_id'] != $row['product_option_id'] ) continue;
							  ?>
                                  <option value="<?php echo $row['product_option_value_id']; ?>"><?php echo $row['option_value']; ?></option>
                              <?php } ?>
                              </select>
                      	</div>
                        <?php }	?>
                        
                      
                <?php } //foreach options ?>
            <?php } //variable product  ?>

             <div class="price_left">
                  <?php if($added_item_details[0]['quantity'] > 1) { ?>                                	
                    <label style="float:left; width:100%; margin-top:10px;">Quantity</label>
                    <select name="quantity" id="quantity_list" data-mqty="<?php echo $added_item_details[0]['quantity']; ?>">
                    <?php for($i=1;$i <= 10;$i++) { echo '<option>'.$i.'</option>'; }  ?>
                    </select>
                <?php } else if($added_item_details[0]['quantity'] == 1) { ?>
                    <input type="hidden" id="quantity_list" data-mqty="<?php echo $added_item_details[0]['quantity']; ?>"  />
                    <label style="float:left; width:100%">Only 1 available</label>
                    <?php } else if($added_item_details[0]['quantity'] <= 0) {?>
                    <label style="float:left; width:100%"><h2 style="color:#F0F"><?php if($this->lang->line('prod_stock') != '') { echo stripslashes($this->lang->line('prod_stock')); } else echo 'Out Of Stock'; ?>!</h2>
                    </label>
                    
                 <?php }?>
            </div>
            <div style=" width:100%; padding:10px; float:left;">
				<input class="btn-primary" id="add_to_cart" type="submit" value="Add to Cart"  onclick="return ajax_add_cart_new();" <?php if($added_item_details[0]['quantity'] <= 0) { echo 'disabled="disabled"'; } ?>  >
            </div>
            
			</div>
			<input type="hidden" name="product_id" id="product_id" value="<?php echo $added_item_details[0]['id'];?>">               
			<input type="hidden" name="seller_id" id="sell_id" value="<?php echo $selectedSeller_details[0]['seller_id']; ?>">
			<input type="hidden" name="pickup_option" id="pickup_option" value="<?php echo $added_item_details[0]['pickup_option']?>">
					
					
					<input type="hidden" name="price" id="price" value="<?php echo $withoutdealprice; ?>">
					<input type="hidden" name="qty" id="qty" value="1">

		 
        <div id="favoriting-and-sharing">
			<div id="fav-box">			   
					 <?php if($loginCheck !=''){ ?>
					 <?php if($added_item_details[0]['user_id']==$loginCheck){ ?>
						<a href="javascript:void(0);" onclick="return ownProductFav();">
							<div class="btn-secondary">
								<i class="fa fa-heart"></i><?php if($this->lang->line('user_favorite') != '') { echo stripslashes($this->lang->line('user_favorite')); } else echo 'Favorite'; ?>
							</div>
						</a>
						<?php
						}else{
						$favArr = $this->product_model->getUserFavoriteProductDetails(stripslashes($added_item_details[0]['id']));
						#print_r($favArr); die;
						if(empty($favArr)){ ?>
						<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($added_item_details[0]['id']); ?>','Fresh',this);">
							 <div class="btn-secondary"> <i class="fa fa-heart"></i><?php if($this->lang->line('user_favorite') != '') { echo stripslashes($this->lang->line('user_favorite')); } else echo 'Favorite'; ?></div>
						</a>
						<?php  } else { ?>   
						<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($added_item_details[0]['id']); ?>','Old',this);">
							<div class="btn-secondary"> <i class="fav-icon-sel"></i><?php if($this->lang->line('user_favorite') != '') { echo stripslashes($this->lang->line('user_favorite')); } else echo 'Favorite'; ?></div>
						</a>
						<?php }} } else { ?>
						<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($added_item_details[0]['id']); ?>','Fresh',this);">
							<div class="btn-secondary"> <i class="fa fa-heart"></i><?php if($this->lang->line('user_favorite') != '') { echo stripslashes($this->lang->line('user_favorite')); } else echo 'Favorite'; ?></div>
						</a>
					<?php  } ?> 
					
						
			  
			    <div class="btn-secondary">
					<?php /* <a href="javascript:void(0);" onclick="return hoverView('123');"> 
						<span class="glyphicon glyphicon-align-justify"></span><?php if($this->lang->line('add_to') != '') { echo stripslashes($this->lang->line('add_to')); } else echo 'Add to '; ?> <i class="fa fa-sort-desc"></i>
					</a>
				 */ ?>
	
									  <?php  if($loginCheck!=''){ ?>
                                        <a href="javascript:hoverView('123');">                                          
                                            <span class="glyphicon glyphicon-align-justify"></span><?php if($this->lang->line('add_to') != '') { echo stripslashes($this->lang->line('add_to')); } else echo 'Add to'; ?><i class="fa fa-sort-desc"></i>
                                        </a>
										<?php } else {?>
											<a href="login?action=<?php echo current_url();?>">                                         
                                            <span class="glyphicon glyphicon-align-justify"></span><?php if($this->lang->line('add_to') != '') { echo stripslashes($this->lang->line('add_to')); } else echo 'Add to'; ?><i class="fa fa-sort-desc"></i>
                                        </a>
											<?php  } ?>
                                    </div>
				<div id="hoverlist123" class="hover_lists">
								<h2><?php if($this->lang->line('user_your_lists') != '') { echo stripslashes($this->lang->line('user_your_lists')); } else echo 'Your Lists'; ?></h2>
								<div class="lists_check">
									<?php foreach($userLists as $Lists){ 
										$haveListIn = $this->user_model->check_list_products(stripslashes($proddetails['id']),$Lists['id'])->num_rows();
										#echo $haveListIn;
										if($haveListIn>0){$chk='checked="checked"';}else{ $chk='';}
									?>
									 <input type="checkbox" onclick="return addproducttoList('<?php echo $Lists['id']; ?>','<?php echo stripslashes($proddetails['id']); ?>');" <?php echo $chk; ?> />
									 <label><?php echo $Lists['name']; ?></label><br/>
									 <?php } ?>
									 
									 <?php if(!empty($userRegistry)){ 
											$haveRegisryIn = $this->user_model->check_registry_products($proddetails['id'],$userRegistry->user_id)->num_rows();
											if($haveRegisryIn>0){$chk='checked="checked"';}else{ $chk='';}
										?>
										<input type="checkbox"  onclick="return manageRegisrtyProduct('<?php echo $userRegistry->user_id; ?>','<?php echo $proddetails['id']; ?>');" <?php echo $chk; ?> /> 
										<label><span class="registry_icon"></span><?php if($this->lang->line('prod_wedding') != '') { echo stripslashes($this->lang->line('prod_wedding')); } else echo 'Wedding Registry'; ?></label>
										<?php }  ?>						
								  </div>       							  
							<div class="new_list">
								<form action="site/user/add_list" method="post">
									<input type="hidden" value="1" name="ddl" />
									<input type="hidden" value="<?php echo $proddetails['id']; ?>" name="productId" />
									<input type="text" placeholder="<?php if($this->lang->line('user_new_list') != '') { echo stripslashes($this->lang->line('user_new_list')); } else echo 'New list'; ?>" class="list_scroll" name="list" id="creat_list_<?php echo $i; ?>" />
									<input type="submit" value="<?php if($this->lang->line('user_add') != '') { echo stripslashes($this->lang->line('user_add')); } else echo 'Add'; ?>" class="primary-button" onclick="return validate_create_list('<?php echo $i; ?>');" />
								</form>
							</div>
							
						</div> 
				
				
				</div>
				
			  
			</div>
			<!-- AddThis Button BEGIN -->
			<?php if($loginCheck==''){ $att= current_url(); } else{ $att= current_url()."?aff=".$userDetails->row()->affiliateId;}?>
			<div class="addthis_toolbox addthis_default_style " addthis:url="<?php echo $att;?>">
				<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
				<a class="addthis_button_tweet"></a>
				<a class="addthis_button_pinterest_pinit" pi:pinit:layout="horizontal"></a>
				<a class="addthis_counter addthis_pill_style"></a>
			</div>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50ab628f64d148de"></script>
			<!-- AddThis Button END -->
			<!--<a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image;?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)"> 
			Insert text or an image here. 
			</a>-->
		</div>
		 
  
		 </div>
		 
		 
		</div>
		
		
		
		
		
		<div class="col-md-12 middel-detail"> 
		<div class="col-md-7">
      <div role="tabpanel" class="tab-content"> 
        
       

	   <!-- Nav tabs -->
        <ul class="nav nav-tabs cart-tabs" role="tablist">
            <li role="presentation" class="active" >
				<a href="#itemdetails" aria-controls="itemdetails" role="tab" data-toggle="tab" >Description</a>
		    </li>
			 <?php
				$rew_Pro_arr = array();
				if(count($productReview) > 0 ) { $rew_Pro_arr = array_column($productReview,'seo_url'); }
				$rev_flg=0;
				if(in_array($added_item_details[0]['seourl'],$rew_Pro_arr)){
					$rev_flg=1;
				}
			 ?>
			<li role="presentation" id="reviewTabbar">
				<a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Shipping</a>
			 </li>
			<li role="presentation">
					<a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Return Policy</a>
			</li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content cart-content">
            <div role="tabpanel" class="tab-pane fade in active" id="itemdetails">
                <div id="description-text"> 
				<?php if($added_item_details[0]['description']!=''){ ?>                        
					 <?php echo $added_item_details[0]['description'];
						}
					 ?><br>
					 	 
					 <?php if($variations_one == '' && $variations_two == '' && $subProduct->row()->digital_item!=''){?>
					   <br>
					  ......................................................................................<br>
					  <br>
						 
					<h4><b><u>
					<?php if($this->lang->line('prod_buyers') != '') { echo stripslashes($this->lang->line('prod_buyers')); } else echo 'Message to buyers for digital items'; ?> 
					</u></b></h4>
					<?php
					echo $selectedSeller_details[0]['msg_to_buyers_for_digiitem'];										
					 } ?>   
				</div>
             </div>
			
             <div role="tabpanel" class="tab-pane fade" id="profile">
                <div id="ship_rates">
                     <div class="col-md-5"><b>Ship place</b></div>
                     <div class="col-md-2"><b>Cost</b></div>
                     <div class="col-md-3"><b>Additional item</b></div>
					<?php foreach ( $product_shipping['rates'] as $code => $rate_row ) { 
                        $rate_row['next_item_price'] = ( (int) $rate_row['next_item_price'] == 0 ) ? $rate_row['ship_price'] : $rate_row['next_item_price'];
                    ?>
                     <div>
                         <div class="col-md-5"><?php  echo $rate_row['description']; ?></div>
                         <div class="col-md-2">$<?php echo number_format($rate_row['ship_price'], 2); ?></div>
                         <div class="col-md-3">$<?php echo number_format($rate_row['next_item_price'], 2); ?></div>
                     </div>
					<?php } ?>
                </div>
            </div>
			
            <div role="tabpanel" class="tab-pane fade" id="messages">
                 <div class="shipping-tab">
                      <?php echo $added_item_details[0]['return_policy']; ?>
                 </div>
				  
            </div>
          
        </div>
        
      </div>
    </div>
	
	
    <div class="col-md-5">
        
		
      <div class="related-listings">
        <div class="related-listing-inner">
             <div class="shop-info"> 
				 <span class="avatar"><a href="shop-section/<?php echo $selectedSeller_details[0]['seourl']; ?>"><img src="images/users/thumb/<?php echo $Pro_pic; ?>" width="75" height="75" /></a></span>
				 <div class="shop-name"> <a href="shop-section/<?php echo $selectedSeller_details[0]['seourl']; ?>"><?php echo $selectedSeller_details[0]['seller_businessname']; ?></a></div>
				  <?php if(trim($selectedSeller_details[0]['city']) !='' && trim($selectedSeller_details[0]['city'])!= 0 ) { ?>
					<span class="ship-label">
						<span><?php if($this->lang->line('prod_in') != '') { echo stripslashes($this->lang->line('prod_in')); } else echo 'in'; ?></span> <?php echo $selectedSeller_details[0]['city']; ?>
					</span>
                  <?php } else {
				  if(trim($selectedSeller_details[0]['country'])!='' && trim($selectedSeller_details[0]['country'])!= 0 ) {?>
					 <span class="ship-label">
						<span><?php if($this->lang->line('prod_in') != '') { echo stripslashes($this->lang->line('prod_in')); } else echo 'in'; ?></span> <?php echo $selectedSeller_details[0]['country']; ?>
					</span>				  
				  <?php }}?>
	         </div>
			
			<?php if(count($shopProductDetails)<4){$c=count($shopProductDetails);}else{ $c=4; } 
						for($i=0;$i<$c;$i++){ 
						$imgArry=explode(',',$shopProductDetails[$i]['image']);
						if($shopProductDetails[$i]['price']!=0){$price=$currencyValue*$shopProductDetails[$i]['price'];}else{$price=$currencyValue*$shopProductDetails[$i]['base_price'].'+';}
						?>
			
		    <div class="realated-brick col-md-6 odd"> 
				<a href="products/<?php echo $shopProductDetails[$i]['seourl']; ?>">
					<img src="images/product/<?php echo $shopProductDetails[$i]['id'];?>/thumb/<?php echo $imgArry[0] ?>" alt="<?php echo $shopProductDetails[$i]['product_name']; ?>" title="<?php echo $shopProductDetails[$i]['product_name']; ?>" />
				</a>
				<div class="info">
				  <h3><a href="products/<?php echo $shopProductDetails[$i]['seourl']; ?>"><?php echo $shopProductDetails[$i]['product_name']; ?></a></h3>
				  <span class="cat-name cat-price"><?php echo $currencySymbol; echo number_format($price,2);?> </span> 
				 </div>
				 
				 
				 <div class="collections-ui" style="display:none;">
				     <div  class="favorite-container"> 
					   <?php if($loginCheck !=''){ ?>
					   <?php if($shopProductDetails[$i]['user_id']==$loginCheck){ ?>
						<button onclick="return ownProductFav();" data-source="casanova"  class="btn-fave  inline-overlay-trigger btn-fave-action" type="button"> 
							<span class="icon"></span> <span class="ie-fix">&nbsp;</span> 
						</button>
						<?php
						}else{
						$favArr = $this->product_model->getUserFavoriteProductDetails(stripslashes($shopProductDetails[$i]['id']));
						if(empty($favArr)){ ?>
							 <button onclick="return changeProductToFavourite('<?php echo stripslashes($shopProductDetails[$i]['id']); ?>','Fresh',this);" data-source="casanova"  class="btn-fave  inline-overlay-trigger btn-fave-action" type="button"> 
								<span class="icon"></span> <span class="ie-fix">&nbsp;</span> 
							 </button>
						<?php } else {?>
							<button onclick="return changeProductToFavourite('<?php echo stripslashes($shopProductDetails[$i]['id']); ?>','Old',this);" data-source="casanova"  class="btn-fave  inline-overlay-trigger btn-fave-action" type="button"> 
							<span class="icon"></span> <span class="ie-fix">&nbsp;</span> 
						 </button>
						<?php }}} else {?> 
							<button onclick="return changeProductToFavourite('<?php echo stripslashes($shopProductDetails[$i]['id']); ?>','Fresh',this);" data-source="casanova"  class="btn-fave  inline-overlay-trigger btn-fave-action" type="button"> 
							<span class="icon"></span> <span class="ie-fix">&nbsp;</span> 
						 </button>
						<?php }?>
						</div>
						
						<div  class="collect-container">
							<button onclick="return hoverView('<?php echo $shopProductDetails[$i]['id'];?>');" class="btn-collect btn-dropdown  inline-overlay-trigger collection-add-action" type="button" >
								<span class="icon"></span> 
								<span class="icon-dropdown"></span> 
								<span class="ie-fix">&nbsp;</span>
							</button>							
						
							<div id="hoverlist<?php echo $shopProductDetails[$i]['id'];?>" class="hover_lists">
									<h2><?php if($this->lang->line('user_your_lists') != '') { echo stripslashes($this->lang->line('user_your_lists')); } else echo 'Your Lists'; ?></h2>
									<div class="lists_check">
										<?php foreach($userLists as $Lists){ 
											$haveListIn = $this->user_model->check_list_products(stripslashes($shopProductDetails[$i]['id']),$Lists['id'])->num_rows();
											#echo $haveListIn;
											if($haveListIn>0){$chk='checked="checked"';}else{ $chk='';}
										?>
										 <input type="checkbox" onclick="return addproducttoList('<?php echo $Lists['id']; ?>','<?php echo stripslashes($shopProductDetails[$i]['id']); ?>');" <?php echo $chk; ?> />
										 <label><?php echo $Lists['name']; ?></label><br/>
										 <?php } ?>
										 
										 <?php if(!empty($userRegistry)){ 
												$haveRegisryIn = $this->user_model->check_registry_products($shopProductDetails[$i]['id'],$userRegistry->user_id)->num_rows();
												if($haveRegisryIn>0){$chk='checked="checked"';}else{ $chk='';}
											?>
											<input type="checkbox"  onclick="return manageRegisrtyProduct('<?php echo $userRegistry->user_id; ?>','<?php echo $shopProductDetails[$i]['id']; ?>');" <?php echo $chk; ?> /> 
											<label><span class="registry_icon"></span><?php if($this->lang->line('prod_wedding') != '') { echo stripslashes($this->lang->line('prod_wedding')); } else echo 'Wedding Registry'; ?></label>
											<?php }  ?>						
									  </div>       							  
								<div class="new_list">
									<form action="site/user/add_list" method="post">
										<input type="hidden" value="1" name="ddl" />
										<input type="hidden" value="<?php echo $shopProductDetails[$i]['id']; ?>" name="productId" />
										<input type="text" placeholder="<?php if($this->lang->line('user_new_list') != '') { echo stripslashes($this->lang->line('user_new_list')); } else echo 'New list'; ?>" class="list_scroll" name="list" id="creat_list_<?php echo $i; ?>" />
										<input type="submit" value="<?php if($this->lang->line('user_add') != '') { echo stripslashes($this->lang->line('user_add')); } else echo 'Add'; ?>" class="primary-button" onclick="return validate_create_list('<?php echo $i; ?>');" />
									</form>
								</div>							
						    </div> 
						</div>	
				    </div>
				 
				 
				 
             </div>
            
			<?php }?>
         
         
        </div>
      </div>
	  </div>
	 </div>
	  	<div class="col-md-12 realated-this-item">
    <div class="col-md-7">
	<?php if($added_item_details[0]['tag']!=''){ ?>
	
	<h2><?php if($this->lang->line('shop_relateditem') != '') { echo stripslashes($this->lang->line('shop_relateditem')); } else echo 'Related to this Item'; ?></h2>
    <ul class="tag">
     <?php $Related=explode(',',$added_item_details[0]['tag']) ?>
            <?php foreach($Related as $tag){?>
        	<li><a href="market/<?php echo url_title($tag); ?>"><?php echo $tag; ?></a></li> 
            <?php } ?>
    </ul>
	<?php }?>
	</div>
	<div class="col-md-5">
    <div class="clear inner" id="fineprint">
      <ul class="clear">
        <li><?php if($this->lang->line('prod_listed') != '') { echo stripslashes($this->lang->line('prod_listed')); } else echo 'Listed on'; ?> 
		<?php echo date('M d,Y',strtotime($added_item_details[0]['created'])); ?></li>
        <li> <?php echo $added_item_details[0]['view_count']; ?> <?php if($this->lang->line('shopsec_views') != '') { echo stripslashes($this->lang->line('shopsec_views')); } else echo 'views'; ?> </li>
        <li> 
			<a href="product/<?php echo $added_item_details[0]['seourl']; ?>/favoriters"> <?php echo count($ProductFavoriteCount); ?> <?php if($this->lang->line('user_favorites') != '') { echo stripslashes($this->lang->line('user_favorites')); } else echo 'Favorites'; ?> </a> 
		</li>
        <?php /* <li> <a href="#"> 1 Treasury list </a> </li>
        <li id="add-treasury-item"> <a href="#" class="inline-overlay-trigger"> Add item to treasury </a> </li> */ ?>
        <li id="item-reporter">
          <div id="reporter-link-container"> 

				<?php if($this->session->userdata['shopsy_session_user_id'] != '') {
						if($this->session->userdata['shopsy_session_user_id']==$selectedSeller_details[0]['seller_id']){?>
						<a href="#ownshop_report" style="color:rgb(1, 173, 220);" data-toggle="modal"><?php if($this->lang->line('prod_report') != '') { echo stripslashes($this->lang->line('prod_report')); } else echo 'Report this item to'; ?> <?php echo $this->config->item('email_title'); ?></a>
						<?php } else { ?>
					<a href="#detailreport_reg" style="color:rgb(1, 173, 220);" data-toggle="modal"><?php if($this->lang->line('prod_report') != '') { echo stripslashes($this->lang->line('prod_report')); } else echo 'Report this item to'; ?> <?php echo $this->config->item('email_title'); ?></a>
				<?php } } else {?>
					<a href="login?action=<?php echo current_url(); ?>" style="color:rgb(1, 173, 220);"><?php if($this->lang->line('prod_report') != '') { echo stripslashes($this->lang->line('prod_report')); } else echo 'Report this item to'; ?> <?php echo $this->config->item('email_title'); ?></a>
				<?php } ?>

		  </div>
          <div id="reporter-complete-container"> </div>
        </li>
      </ul>
    </div>
	</div>
  </div>
	  
	  
    </div>

  </div>
  
</section>

</div>

<?php 
   
if($product_list->num_rows() > 0) { ?>
<div id="product_search_div">
<section class="container">
    
  		<div id="content">
        	<div class="purchase_review product-search-main">
            	<div class="content-wrap-inner1">
                	
					
                        
					
                
                    	<div id="primary">
                        	
							<div id="freewall" class="free-wall" style="margin-bottom: 51px;"> 
							
                            <div id="tiles">
                        
                        	<?php    $productsDetail=$product_list->result_array();
                        	
				
				if(!empty($productsDetail)){ $i=0;
				foreach($productsDetail as $proddetails){
					#echo $i;
                  	$imgSplit = explode(",",$proddetails['image']); 
					$shopDet = $this->product_model->get_business_name($proddetails['user_id']);
									
			?>
            	 <div class="brick">     
                    <div class="brick-hover">
                                <div class="product_hide">                                    
                                    <div class="product_fav">                             
										<?php if($loginCheck !=''){ ?>
										<?php if($proddetails['user_id']==$loginCheck){ ?>
										<a href="javascript:void(0);" onclick="return ownProductFav();">
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>
										<?php
										}else{
                                        $favArr = $this->product_model->getUserFavoriteProductDetails(stripslashes($proddetails['id']));
                                        #print_r($favArr); die;
                                        if(empty($favArr)){ ?>
                                        <a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($proddetails['id']); ?>','Fresh',this);">
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>
                                        <?php  } else { ?>                        
                                        <a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($proddetails['id']); ?>','Old',this);">
                                            <input type="submit" value="" class="hoverfav_icon1" />
                                        </a>
                                        <?php }}} else { ?>
                                        <a href="login" >
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>
                                        <?php  } ?> 
                                    </div>  
                                     
                                    <div class="hoverdrop_icon">
                                    	<a href="javascript:hoverView('<?php echo $i; ?>');">  </a>
                                        	<div class="hover_lists" id="hoverlist<?php echo $i; ?>">
                                               	<h2><?php if($this->lang->line('user_your_lists') != '') { echo stripslashes($this->lang->line('user_your_lists')); } else echo "Your Lists"; ?></h2>
                                                <div class="lists_check">
                                                	<?php foreach($userLists as $Lists){ 
													$haveListIn = $this->user_model->check_list_products(stripslashes($proddetails['id']),$Lists['id'])->num_rows();
													#echo $haveListIn;
													if($haveListIn>0){$chk='checked="checked"';}else{ $chk='';}
													?>
                                                    <input type="checkbox" class="check_box" onclick="return addproducttoList('<?php echo $Lists['id']; ?>','<?php echo stripslashes($proddetails['id']); ?>');" <?php echo $chk; ?> />
                                                    <label><?php echo $Lists['name']; ?></label>
                                                    <?php } ?>
                                                     <?php if(!empty($userRegistry)){ 
														$haveRegisryIn = $this->user_model->check_registry_products($proddetails['id'],$userRegistry->user_id)->num_rows();
														if($haveRegisryIn>0){$chk='checked="checked"';}else{ $chk='';}
													?>
													<input type="checkbox" class="check_box" onclick="return manageRegisrtyProduct('<?php echo $userRegistry->user_id; ?>','<?php echo $proddetails['id']; ?>');" <?php echo $chk; ?> />
													<label><span class="registry_icon"></span><?php if($this->lang->line('prod_wedding') != '') { echo stripslashes($this->lang->line('prod_wedding')); } else echo "Wedding Registry"; ?></label>
													<?php }  ?>
                                                    </div>                                                    
                                                    <div class="new_list">
                                                    <form method="post" action="site/user/add_list">
                                                        <input type="hidden" value="1" name="ddl" />
                                                        <input type="hidden" value="<?php echo $proddetails['id']; ?>" name="productId" />
                                                        <input type="text" placeholder="<?php if($this->lang->line('user_new_list') != '') { echo stripslashes($this->lang->line('user_new_list')); } else echo "New list"; ?>" class="list_scroll" name="list" id="creat_list_<?php echo $i; ?>" />
                                                        <input type="submit" value="<?php if($this->lang->line('user_add') != '') { echo stripslashes($this->lang->line('user_add')); } else echo "Add"; ?>" class="primary-button" onclick="return validate_create_list('<?php echo $i; ?>');" />
                                                    </form>
                                                </div>
                                        	</div>
                                    	
                                   	</div>  
                               </div>
                      
                        <a href="products/<?php echo $proddetails['seourl'];?>">
                            <img  src="<?php if(!empty($imgSplit[0])){ ?>images/product/thumb/<?php echo stripslashes($imgSplit[0]); } else { echo "images/dummyProductImage.jpg";  }?>" 
                              alt="<?php echo stripslashes($proddetails['product_name']);?>" title="<?php echo stripslashes($proddetails['product_name']);?>" width="100%" >
                        </a>
          </div>
          <div class="info">
						<h3><?php echo $proddetails['product_name']?></h3>
						<span class="cat-name"><a href="shop-section/<?php echo $shopDet->row()->shop_seourl; ?>"><?php echo $shopDet->row()->shop_name?></a></span>
						
						 <span class="cat-name cat-price">
						 <span class="currency_value" ><?php echo $currencySymbol; echo number_format($currencyValue*$proddetails['price'],2)?></span>
						
						</div>
                    
                   
                            
                </div> 
			<?php  
			
			$i++;	} 	}  
				
				
			?>
						
						 <?php echo $paginationDisplay;?>
                        </div>
						
                       
						</div>
						<div id="load_ajax_img" style="text-align: center;"></div>
						
                        </div>
						
						
                    </div>
						
						
						
						</div>
            </div>
        </div>
    
    
    </section>
	</div>
<?php } ?>




	<div id="ask_reg" class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<form name="contactshopowener" id="contactshopowener" method="post" action="site/user/prddetailaskQues">
					<div style='background:#fff;'>  
						<div class="conversation">							
							<div class="conversation_container">
								<a href="javascript:void(0);" onclick="javascript:$('#ask-cancel').trigger('click');" style="float: right;margin-right: 2%;">X</a>
								<h2 class="conversation_headline"><?php if($this->lang->line('new_conversation') != '') { echo stripslashes($this->lang->line('new_conversation')); } else echo 'New conversation with'; ?> <?php echo ucfirst($selectedSeller_details[0]['full_name']); ?>' <?php if($this->lang->line('shop_from') != '') { echo stripslashes($this->lang->line('shop_from')); } else echo 'from'; ?> <?php echo ucfirst($selectedSeller_details[0]['seller_businessname']); ?></h2>
								<div class="conversation_thumb">
									<img width="75" height="75" src="images/users/thumb/<?php echo $Pro_pic; ?>">
								</div>
								<div class="conversation_right">
								
									<input type="hidden" name="productseourl" id="productseourl" value="<?php echo $added_item_details[0]['seourl']; ?>" >
									<input class="conversation-subject" type="text" name="subject" placeholder="<?php if($this->lang->line('user_subject') != '') { echo stripslashes($this->lang->line('user_subject')); } else echo 'Subject'; ?>" value="<?php echo $added_item_details[0]['product_name']; ?>">
									<textarea class="conversation-textarea" rows="11" name="message_text" placeholder="<?php if($this->lang->line('user_msg_txt') != '') { echo stripslashes($this->lang->line('user_msg_txt')); } else echo 'Message text'; ?>"><?php if($this->lang->line('prod_product') != '') { echo stripslashes($this->lang->line('prod_product')); } else echo 'Product'; ?>: '<?php echo base_url().'products/'.$added_item_details[0]['seourl']; ?>'</textarea>
									<input type="hidden" name="productid" id="productid" value="<?php echo $added_item_details[0]['id']; ?>" >
									<input type="hidden" name="productname" id="productname" value="<?php echo $added_item_details[0]['product_name']; ?>" >
									<input type="hidden" name="username" id="username" value="<?php echo $this->session->userdata['shopsy_session_user_name']; ?>" >
									<input type="hidden" name="useremail" id="useremail" value="<?php echo $this->session->userdata['shopsy_session_user_email']; ?>" >
									<input type="hidden" name="userid" id="userid" value="<?php echo $this->session->userdata['shopsy_session_user_id']; ?>" >
									<input type="hidden" name="selleremail" id="selleremail" value="<?php echo $selectedSeller_details[0]['seller_email']; ?>" >
									<input type="hidden" name="sellerid" id="sellerid" value="<?php echo $selectedSeller_details[0]['seller_id']; ?>" >
									<input type="hidden" name="subject_name" id="subject_name" value="New conversation with <?php echo ucfirst($selectedSeller_details[0]['full_name']); ?>' from <?php echo ucfirst($selectedSeller_details[0]['seller_businessname']); ?>">									
								</div> 
							</div>						
							<div class="modal-footer footer_tab_footer">
								<div class="btn-group">
										<input class="submit_btn" type="submit" value="<?php if($this->lang->line('user_send') != '') { echo stripslashes($this->lang->line('user_send')); } else echo 'send'; ?>" />
										<a class="btn btn-default submit_btn" data-dismiss="modal" id="ask-cancel"><?php if($this->lang->line('user_cancel') != '') { echo stripslashes($this->lang->line('user_cancel')); } else echo 'Cancel'; ?></a>
								</div>
							</div>		
							
							
						</div>
					</div>												
				</form>		
			</div>
		</div>
	</div>	
		


	<div id='detailreport_reg' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="spam-report" name="span-form" method="post" onsubmit="return validate_spamreport();">
					<div style='background:#fff;'>  
						<div class="conversation">
							<div class="conversation_container">		
								<a href="javascript:void(0);" onclick="javascript:$('#report-cancel').trigger('click');">X</a>
								<h5 class="reportspan-head"><?php if($this->lang->line('shopsec_spam') != '') { echo stripslashes($this->lang->line('shopsec_spam')); } else echo 'Report Spam'; ?></h5><br /><br />
								<p style="margin:0 0 0 5px"><a target="_blank" href="pages/intellectual-property-policy"><?php if($this->lang->line('shopsec_property') != '') { echo stripslashes($this->lang->line('shopsec_property')); } else echo 'This is my intellectual property'; ?>.</a><br />
								<a target="_blank" href="pages/report-a-problem"><?php if($this->lang->line('shopsec_ordered') != '') { echo stripslashes($this->lang->line('shopsec_ordered')); } else echo 'I ordered this item and have not received it'; ?>.</a>
								</p>
								<ul> 
									<li>
										<input type="radio" value="The item may not comply with <?php echo $this->config->item('email_title'); ?>'s handmade guidelines" name="spam_title" class="spamchk">
										<label> <?php if($this->lang->line('shopsec_comply') != '') { echo stripslashes($this->lang->line('shopsec_comply')); } else echo 'The item may not comply with'; ?> <a target="_blank" href="pages/guidelines"><?php echo $this->config->item('email_title'); ?><?php if($this->lang->line('shopsec_guidelines') != '') { echo stripslashes($this->lang->line('shopsec_guidelines')); } else echo "'s handmade guidelines"; ?></a> . </label>
									</li>
									<li>
										<input  type="radio" value="The item may not be vintage" name="spam_title" class="spamchk">
										<label> <?php if($this->lang->line('shopsec_maynot') != '') { echo stripslashes($this->lang->line('shopsec_maynot')); } else echo "The item may not be"; ?> <a target="_blank" href="pages/guidelines"><?php if($this->lang->line('shopsec_vintage') != '') { echo stripslashes($this->lang->line('shopsec_vintage')); } else echo 'vintage'; ?></a> <?php if($this->lang->line('shopsec_years') != '') { echo stripslashes($this->lang->line('shopsec_years')); } else echo "(20+ years old)"; ?>. </label>
									</li>
									<li>
										<input  type="radio" value="The item is not a supply for crafting or shipping" name="spam_title" class="spamchk">
										<label> <?php if($this->lang->line('shopsec_itemnot') != '') { echo stripslashes($this->lang->line('shopsec_itemnot')); } else echo "The item is not a"; ?> <a target="_blank" href="pages/guidelines"><?php if($this->lang->line('shopsec_supply') != '') { echo stripslashes($this->lang->line('shopsec_supply')); } else echo "supply for crafting or shipping"; ?></a> . </label>
									</li>
									<li>
										<input type="radio" value="The item may be prohibited on <?php echo $this->config->item('email_title'); ?>." name="spam_title" class="spamchk">
										<label > <?php if($this->lang->line('shopsec_itemmay') != '') { echo stripslashes($this->lang->line('shopsec_itemmay')); } else echo "The item may be"; ?> <a target="_blank" href="pages/prohibited-items"><?php if($this->lang->line('prod_prohibited') != '') { echo stripslashes($this->lang->line('prod_prohibited')); } else echo "prohibited"; ?></a> <?php if($this->lang->line('shop_on') != '') { echo stripslashes($this->lang->line('shop_on')); } else echo "on"; ?> <?php echo $this->config->item('email_title'); ?>. </label>
									</li>
									<li>
										<input  type="radio" value="The listing is not labeled as mature content." name="spam_title" class="spamchk">
										<label><?php if($this->lang->line('shopsec_labeled') != '') { echo stripslashes($this->lang->line('shopsec_labeled')); } else echo "The listing is not labeled as"; ?> <a target="_blank" href="pages/guidelines"><?php if($this->lang->line('prod_content') != '') { echo stripslashes($this->lang->line('prod_content')); } else echo "mature content"; ?></a> . </label>
									</li>									
									<input type="hidden" name="p_id" value="<?php echo $added_item_details[0]['id']; ?>" id="p_id" />
									<input type="hidden" name="s_id" value="" id="s_id" />
									<input type="hidden" name="p_seourl" value="<?php echo $added_item_details[0]['seourl']; ?>" id="p_seourl" />									 
								</ul>
								<textarea name="complaint" placeholder="<?php if($this->lang->line('shopsec_violates') != '') { echo stripslashes($this->lang->line('shopsec_violates')); } else echo "Please explain why this item violates"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('shopsec_policy') != '') { echo stripslashes($this->lang->line('shopsec_policy')); } else echo "Policies"; ?>." id="spam_text"></textarea>
								<center><span class="error" id="spamErr"></span></center>								
								<div class="modal-footer footer_tab_footer">
									<div class="btn-group">
											<input class="submit_btn" type="submit" value="<?php if($this->lang->line('shopsec_spam') != '') { echo stripslashes($this->lang->line('shopsec_spam')); } else echo "Report Spam"; ?>" />
											<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel"><?php if($this->lang->line('user_cancel') != '') { echo stripslashes($this->lang->line('user_cancel')); } else echo 'Cancel'; ?></a>
									</div>
								</div>		
							</div>
						</div>
					</div>			
				</form>
			</div>
		</div>
	</div>


	<div id='ownproduct-alert' class="modal language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				 <div style='background:#fff;'>  
					<div class="conversation" style="width: 340px; margin-left: 191px; margin-top: 171px;">
						<div class="conversation_container">
							<h2 class="conversation_headline" style="margin: 8px;color: #9E612F;"> <?php if($this->lang->line('cant_buy_ur_item') != '') { echo stripslashes($this->lang->line('cant_buy_ur_item')); } else echo 'Whoa! You can\'t buy your own item.'; ?> </h2>
							<div class="modal-footer footer_tab_footer">
									<div class="btn-group">
											<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel"> <?php if($this->lang->line('land_okay') != '') { echo stripslashes($this->lang->line('land_okay')); } else echo 'Okay'; ?></a>
									</div>
							</div>		
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>	

		<div id='ownshop_ask' class="modal language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				 <div style='background:#fff;'>  
					<div class="conversation" style="width: 340px; margin-left: 191px; margin-top: 171px;">
						<div class="conversation_container">
							<h2 class="conversation_headline" style="margin: 8px;color: #9E612F;"> <?php if($this->lang->line('cant_question_ur_shop') != '') { echo stripslashes($this->lang->line('cant_question_ur_shop')); } else echo 'Whoa!You can\'t question your own shop.'; ?>  </h2>
							<div class="modal-footer footer_tab_footer">
									<div class="btn-group">
											<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel"><?php if($this->lang->line('land_okay') != '') { echo stripslashes($this->lang->line('land_okay')); } else echo 'Okay'; ?></a>
									</div>
							</div>		
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>	

	
         
        <div style='display:none'>
        <div id='contact_reg' style=' background: none repeat scroll 0 0 rgba(0, 0, 0, 0.3); border-radius:8px; padding:15px'>
            <div style="background:#fff;border-radius:8px;"> 
                <div class="contact_reg-header">
                    <h2><?php if($this->lang->line('confirm_acct') != '') { echo stripslashes($this->lang->line('confirm_acct')); } else echo 'Hold on! You still need to confirm your account.'; ?></h2>
                    <div class="contact_reg-body">
                        <p>We'll resend your confirmation email to <?php echo $this->session->userdata['shopsy_session_user_email'];?>.</p>
                    </div>
                </div>
                <div class="contact_reg-footer">
                    <span><input class="resending" type="button" value="Cancel" onclick="javascript:$('#cboxClose').trigger('click');"></span> 
                    <span><input class="resending" type="submit" value="Resend Email" onClick="return resendConfirmationPopUp('<?php echo $this->session->userdata['shopsy_session_user_email'];?>');"></span>
                </div>
            </div>         
        </div>
    </div> 
         
		 <div id='ownshop_report' class="modal language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				 <div style='background:#fff;'>  
					<div class="conversation" style="width: 340px; margin-left: 191px; margin-top: 171px;">
						<div class="conversation_container">
							<h2 class="conversation_headline" style="margin: 8px;color: #9E612F;">Whoa!You can\'t report your own shop.</h2>
							<div class="modal-footer footer_tab_footer">
									<div class="btn-group">
											<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel">Okay</a>
									</div>
							</div>		
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>	
	
 
<a href="#product_add_cart_popup" id="product_add_cart" data-toggle="modal"></a>
 <div id='product_add_cart_popup' class="modal language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				 <div style='background:#fff;'>  
					<div class="conversation" style="width: 64%; margin-left: 191px; margin-top: 171px;">
						<div class="conversation_container">
							<h2 class="conversation_headline" style="margin: 8px;color: #9E612F;">Product Added to cart</h2>
							<div class="modal-footer footer_tab_footer">
								<div class="btn-group">
										<a class="btn btn-default submit_btn" data-dismiss="modal" ><?php echo shopsy_lg('lg_continue_shop','Continue Shopping');?></a>
										<a class="btn btn-default submit_btn" href="cart">Go to Checkout</a>
								</div>
							</div>		
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>

<style>
span.label{
color:#000;
}
.quant-input .arrows {
	height: 100%;
	position: absolute;
	right: -100;
	top: -4;
	z-index: 2;
}
.arrows .arrow {
	box-sizing: border-box;
	cursor: pointer;
	display: block;
	margin-left:10px;
	text-align: center;
	width: 40px;
}
#zoom{
	position: fixed !important;
	z-index: 9999 !important;
	 top: 50px !important;
}
#content #primary {
    float: left;
    padding-top: 0;
    width: 100%;
}
</style>

<script src="js/front/jquery.fancyzoom.js"></script> 
<script type="text/javascript" src="js/validation.js"></script> 
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery("#prodZoom").fancyZoom();
	jQuery('[data-toggle="tooltip"]').tooltip();  
	jQuery('[data-countdown]').each(function() {
	   var $this = $(this), finalDate = jQuery(this).data('countdown');
	   $this.countdown(finalDate, function(event) {
		 $this.html(event.strftime('%D days %H:%M:%S'));
	   });
	 });
}); 
jQuery(window).load(function(){
	jQuery('.flexslider').flexslider({
		animation: "slide",
		controlNav: "thumbnails",
		start: function(slider){
			jQuery('body').removeClass('loading');
		}
	});
});
function change_variationone(evt){
	var split_val = evt.value;
	var variation1 = split_val.split('[<?php echo $currencySymbol?>');
	var variation = variation1[1].split(']');
	var currencyVal = '<?php echo $currencyValue?>';
	var price = (parseFloat(variation[0])/parseFloat(currencyVal)).toFixed(2);
	
	$('#price').val($.trim(price));
}
var loading = true;
jQuery(window).scroll(function(){
	if(loading==true){
		if(($(document).scrollTop()+$(window).height())>($(document).height()-200)){
			//wall.fitWidth();
			$url = $(document).find('.landing-btn-more').attr('href');
			console.log($url);
			if($url){
				loading = false;
				$(document).find('#load_ajax_img').append('<img id="theImg" src="<?php echo base_url(); ?>images/loader64.gif" />');
				$.ajax({
					type : 'get',
					url : $url,
					dataType : 'html',
					success : function(html){
						
						$html = $($.trim(html));
						//console.log($html);
						$(document).find('.landing-btn-more').remove();
						$(document).find('#tiles').append($html.find('#tiles').html());
						$(document).find('#tiles').after($html.find('.landing-btn-more'));
						
						
					},
					error : function(a,b,c){
						console.log(c);
					},
					complete : function(){
						//alert("Asdf");
						$("#load_ajax_img img:last-child").remove();
						loading = true;
						
					}
				});
			}
		}
	}
});
</script>
						<script type="text/javascript">
									var wall = new freewall("#freewall");
									wall.reset({
										selector: '.brick',
										animate: true,
										cellW: 230,
										cellH: 'auto',
										onResize: function() {
											wall.fitWidth();
										}
									});
									
									wall.container.find('.brick img').load(function() {
										wall.fitWidth();
										setTimeout(function(){wall.fitWidth();},100);
									});
									setTimeout(function(){ wall.fitWidth(); }, 100);

						</script> 
<script type="text/javascript">
function ajax_add_cart_new() {

	$('.error-msg').remove();
	
	if( $('input[type=radio][name=var_color_1]').length > 0 && $('input[type=radio][name=var_color_1]:checked').length == 0 ) {
		$('#color_wrapper').append('<div class="error-msg">Select Color</div>');
		return false;
	}
	
	var data = $('select[name=quantity], #product_id, #price ').add('input[type=radio][name=var_color_1]:checked' ).add('select[name=var-color]').add('select[name=var-size]');
	
		$.ajax({
			type: 'POST',
			url: baseURL+'site/cart/userAddToCart',
			data: $( data ).serialize() + "&mqty=" + $('#quantity_list').data('mqty') + "&shop_name=<?php echo $selectedSeller_details[0]['seller_businessname'];?>" ,
			success: function(response){
				var arr = response.split('|');
				if(arr[0] =='login'){
					window.location.href= baseURL+"login";	
				}else if(arr[0] == 'Error'){
					if($.isNumeric(arr[1])==true){
						$('#ADDCartErr').html('<font color="red">Maximum Purchase Quantity: '+mqty+'. Already in your cart: '+arr[1]+'.</font>');
					}else{
						$('#ADDCartErr').html('<font color="red">'+arr[1]+'.</font>');
					}					
						$('#ADDCartErr').show().delay('2000').fadeOut();
				}else{
					//alert(arr[1]);
					$('#CartCount').html(arr[1]);
					$('.CartCount1').html(arr[1]);
					$('#product_add_cart').trigger('click');
				}
		
			}
		});
		return false;
		
}
</script>

<?php $this->load->view('site/templates/footer'); ?>