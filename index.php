<?php require_once( 'couch/cms.php' ); ?>
<cms:template clonable='1'>
    
    <cms:editable 
        name='product_desc' 
        label='Product description' 
        type='richtext' 
        order='10'
    />
    
    
    
    <cms:editable name='group_images' label='Images' type='group' order='20' />
        <cms:editable 
            name='product_image' 
            label='Main Image' 
            width='382'
            show_preview='1' 
            preview_width='150'
            type='image' 
            group='group_images'
            order='10'
        />
        
        <cms:editable
            name='pp_product_thumb'
            label='Thumbnail'
            width='70'
            height='64'
            show_preview='1'
            assoc_field='product_image'
            type='thumbnail'
            group='group_images'
            order='11'
        />

        
        
    <cms:editable name='group_price' label='Price' type='group' order='30' />    
        <cms:editable 
            name='pp_price' 
            label='Base Price' 
            desc='Amount in USD (correct upto 2 decimal points without the $ sign)'
            maxlength='10'
            required='1'
            search_type='decimal'
            validator='non_zero_decimal'
            width='150'
            type='text' 
            group='group_price'
            order='10'
        />
        <cms:editable
            name='explain_discount_scale' 
            type='message'
            group='group_price'
            order='20'
            >
            <b>Quantity based pricing:</b> <i>(Tiered pricing)</i><br/>
            <font color='#777'>If the base price of this product varies based on the quantity purchased (useful for bulk purchases),<br>
            for example, if the base price is $10 but you want the price to be reduced by $2 (i.e. made $8) for purchase of more than 5 units, and by $3 (i.e. made $7) for purchase of more than 10 units, set it to:</font> <br/>
            <font color='blue'><pre>[ 5=2 | 10=3 ]</pre></font>
            <font color='#777'>where the string above stands for '<i>reduce price by 2 for more than 5, reduce by 3 for more than 10</i>'<br>
            If you want the reduction to be a percentage of the base price (instead of a fixed value as done above), add a '%' sign e.g.<br></font>
            <font color='blue'><pre>[ 5=2 | 10=3 ]%</pre></font>        
            <font color='#777'>where the string above now stands for '<i>reduce price by 2% for more than 5, reduce by 3% for more than 10</i>'</font>
        </cms:editable>   

        <cms:editable 
            name='pp_discount_scale' 
            label=':'
            type='text' 
            group='group_price'
            validator='regex=/\[\[?([^\]]*)\](\]?)\s*(%?)/'
            order='21'
        />
    

    
    <cms:editable name='group_variants' label='Variants' type='group' order='40' />    
        <cms:editable
            name='explain_options' 
            type='message'
            group='group_variants'
            order='10'
            >
            <b>Product Variants:</b><br/>
            <font color='#777'>If this product has variants (e.g. Size, Color or a Custom message) 
            add each to the box below using the following format:</font> <br/>
            <font color='blue'><pre>
			Color[Red | Black=+3  | Green=-2]        
			Size[Large | Medium | Small]*
			Your Message[*TEXT*]
			Your Message[*TEXT*=5]</pre></font>
            <font color='#777'>Note that<br/>
            1. Each variant is on a separate line.<br/>
            2. If an option has a different price than the base price, you can specify the price difference too.<br/> 
            For example, the 'Black' option of 'Color' above will add $3 to the base price while the 'Green' will deduct $2. <br>
            3. To create radio buttons instead of a dropdown add a '*' at the end as with 'Size' in the example above. <br/>
            4. To create a textbox (if the variant consists of custom text e.g. message to be printed on T-Shirts), use '*TEXT*' as shown in the third variant above. You can also specify any price difference as shown in the last variant.</font>
        </cms:editable>   
        
        <cms:editable 
            name='pp_options' 
            label=':'
            height='130'
            type='textarea' 
            group='group_variants'
            order='11'
        />


        
    <cms:editable name='group_shipping' label='Shipping' type='group' order='50' /> 
        <cms:editable 
            name='pp_requires_shipping' 
            label='Requires shipping' 
            desc='Select No if this is not a physical product that requires shipping'
            opt_values='Yes=1 | No=0'
            opt_selected = '1'
            type='radio'
            group='group_shipping'
            order='10'
        />

        <cms:editable
            name='explain_shipping_scale' 
            type='message'
            group='group_shipping'
            order='20'
            >
            <b>Shipping Charges:</b><br/>
            <font color='#777'>Set the option below if you want to set up a sliding scale of shipping charges based on the number of this item ordered.<br>
            For example, if you charge $3 to deliver one to five units, $7 to ship six to 15 units, and $10 to ship more than 15 units, set it to:</font> <br/>
            <font color='blue'><pre>[ 0=3 | 5=7 | 15=10 ]</pre></font>
            <font color='#777'>where the string above stands for '<i>3 for more than 0, 7 for more than 5, 10 for more than 15</i>'</font>
        </cms:editable>   

        <cms:editable 
            name='pp_shipping_scale' 
            label=':'
            type='text' 
            validator='regex=/\[\[?([^\]]*)\](\]?)\s*(%?)/'
            group='group_shipping'
            order='21'
        />

</cms:template>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Products - CouchCart</title>
	<link href="css/styles.css" rel="stylesheet" media="screen,projection" type="text/css">
	<link href="css/bootstrap.css" rel="stylesheet" media="screen,projection" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,700" rel="stylesheet" media="screen,projection" type="text/css">
	<!--[if lt IE 9]>
		<script src="js/ie9.js" type="text/javascript"></script>
	<![endif]-->
</head>
<body>
	<div class="page-wrap">
		<header>
			<div class="header">
				<a href="index.html" class="logo">Couch<span class="color">Cart</span></a>
			</div>
			<nav>
				<ul>
					<li class="nav-button">
						<a href="index.html" class="nav">Products</a>
					</li>
					<li class="nav-button">
						<a href="cart.html" class="nav cart"><span class="quantity">0</span> item(s) - $<span class="price">0.00</span></a>
					</li>
				</ul>
			</nav>
		</header>
		<section>
			<div class="row">
				<div class="five columns">
					<div class="product-image-full">
						<img src="uploads/image/globe.png" class="product-image-preview" width="382" height="337" alt="Raised Relief World Globe" title="Raised Relief World Globe">
					</div>
				</div>
				<div class="seven columns left-gutter">
					<h1 class="product-headline">Raised Relief World Globe</h1>
					<div class="product-details">
						<cms:pp_product_form class="cart-form">
							<div class="product-top-box">
								<h2 class="product-price-big">$50.00</h2>
								<div class="purchase-box">
									<label class="quantity-label">Qty:</label>
									<input class="product-quantity" name="qty" id="quantity" type="number" step="1" value="1" title="Quantity">
									<input class="button product-add" type="submit" value="Add to Cart">
								</div>
							</div>
							<div class="product-options">
						   <cms:pp_product_options >
							  <cms:if option_type='list'>
								<cms:if option_modifier='*' || option_modifier='**'>
									<label><cms:show option_name />:</label><br>
									<input type="hidden" name="on<cms:show k_count />" value="<cms:show option_name />" style="display:none;">
									<cms:set radio_input_name="os<cms:show k_count />" />
									<cms:pp_option_values>
										<label class="radio-label">
											<input type="radio" name="<cms:show radio_input_name />" value="<cms:show k_count />"<cms:if k_count='0'> checked="true"</cms:if>>
											<cms:show option_val />
											<cms:if option_price >
												[<cms:show option_price_sign /><cms:pp_config 'currency_symbol' /><cms:show option_price />]
											</cms:if>
										</label>
										<cms:if option_modifier='*'><br/></cms:if>
									</cms:pp_option_values>
								<cms:else />
									<label><cms:show option_name />:</label><br>
									<input type="hidden" name="on<cms:show k_count />" value="<cms:show option_name />" style="display:none;">
									<select name="os<cms:show k_count />">
										<cms:pp_option_values>
											<option value="<cms:show k_count />">
												<cms:show option_val />
												<cms:if option_price >
													[<cms:show option_price_sign /><cms:pp_config 'currency_symbol' /><cms:show option_price />]
												</cms:if>
											</option>
										</cms:pp_option_values>
									</select>
								</cms:if>
							  <cms:else />
								<label><cms:show option_name />:</label><br>:
								<input type="hidden" name="on<cms:show k_count />" value="<cms:show option_name />" style="display:none;">
								<input type="text" name="os<cms:show k_count />" maxlength="200">
							  </cms:if>
						   </cms:pp_product_options>
						   <br>
						</div>
						</cms:pp_product_form>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<div class="products-hr"></div>
				</div>
				<div class="five columns">
					<div class="product-image-full">
						<img src="uploads/image/paper-airplane.png" class="product-image-preview" width="382" height="337" alt="Paper Airplane" title="Paper Airplane">
					</div>
				</div>
				<div class="seven columns left-gutter">
					<h1 class="product-headline">Paper Airplane</h1>
					<div class="product-details">
						<form class="cart-form" action="cart.html" method="post" accept-charset="utf-8">
							<div class="product-top-box">
								<h2 class="product-price-big">$6.00</h2>
								<div class="purchase-box">
									<label class="quantity-label">Qty:</label>
									<input class="product-quantity" name="quantity" id="quantity" type="number" step="1" value="1" title="Quantity">
									<input class="button product-add" type="submit" value="Add to Cart">
								</div>
							</div>
							<div class="product-options">
								<label>Color:</label>
								<select name="color">
									<option>Red</option>
									<option>Green</option>
									<option>Blue</option>
								</select>
								<label>Custom Text:</label>
								<input type="text" name="custom-text" maxlength="200" value="">
								<p><strong>Description:</strong><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<div class="products-hr"></div>
				</div>
				<div class="five columns">
					<div class="product-image-full">
						<img src="uploads/image/paper-clip.png" class="product-image-preview" width="382" height="337" alt="500 Steel Paper Clips" title="500 Steel Paper Clips">
					</div>
				</div>
				<div class="seven columns left-gutter">
					<h1 class="product-headline">500 Steel Paper Clips</h1>
					<div class="product-details">
						<form class="cart-form" action="cart.html" method="post" accept-charset="utf-8">
							<div class="product-top-box">
								<h2 class="product-price-big">$11.00</h2>
								<div class="purchase-box">
									<label class="quantity-label">Qty:</label>
									<input class="product-quantity" name="quantity" id="quantity" type="number" step="1" value="1" title="Quantity">
									<input class="button product-add" type="submit" value="Add to Cart">
								</div>
							</div>
							<div class="product-options">
								<label>Size:</label>
								<br><label class="radio-label"><input type="radio" name="size" value="large">Large</label>
								<br><label class="radio-label"><input type="radio" name="size" value="medium" checked="true">Medium</label>
								<br><label class="radio-label"><input type="radio" name="size" value="small">Small</label>
								<p><strong>Description:</strong><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="footer-wrap">
		<div class="footer-bar">
			<p>
				<span class="copyright">Theme by <a href="http://incrementwebservices.com/">Increment Web Services</a></span><span class="powered-by">Powered by <a href="http://www.couchcms.com/">CouchCMS</a></span>
			</p>
		</div>
	</div>
	<div id="cart-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-body"></div>
		<button class="modal-close" data-dismiss="modal" title="Close">&times;</button>
		<img src="images/ajax-loader.gif" class="ajax-loader" width="32" height="32" alt="Loading...">
	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.js" type="text/javascript"></script>
	<!--
    <script type="text/javascript">
		// Set global values for 'js/cart-modal.js' that follows
		var cart_link = "cart-modal.html";
		var checkout_link = "cart.html?action=checkout";
	</script>
	<script src="js/cart-modal.js" type="text/javascript"></script>
	<script src="js/input-restriction.js" type="text/javascript"></script>
    -->
</body>
</html>
<?php COUCH::invoke(); ?> 