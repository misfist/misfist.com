<?php
if(have_posts()):
while(have_posts()):
the_post();
$meta = get_post_meta(get_the_ID(), '_wpiu_invoice_meta', true);
$trans = get_post_meta(get_the_ID(), '_wpiu_invoice_meta_trans', true);
$options = get_option(WPIU_OPTION);
$user = get_userdata($meta['_wpiu_invoice_meta_client']);

$currency = WPIU_Options::get_currency();
$tax = ($options['invoice_payment_tax'])?$options['invoice_payment_tax'].'%':'0%';
$balanceleft = $meta['_wpiu_invoice_meta_total'] - $meta['_wpiu_invoice_meta_paid'];

global $current_user;
get_currentuserinfo();

if($current_user->ID == $meta['_wpiu_invoice_meta_client']){$valid_user = true;}
elseif ( current_user_can('manage_options') ){$valid_user = true;}
else{$valid_user = false;}

if(isset($_GET['email']) && $_GET['email'] == 'true'){
	$valid_user = true;
}

?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php echo wp_title('',false).' #'.$meta['_wpiu_invoice_meta_invoice_number'];?></title> 
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js?ver=3.3'></script>
<script>
jQuery(document).ready(function() {
	jQuery('#invoice_trans .trans_show').click(function(){
		jQuery(this).next('div').slideToggle('slow');
	});
});
</script>
<style type="text/css">
body {
	background:#EEEEEE;
}

.container {
	width:680px;
}

#paypal {
	margin-left:8px;
}

.container.main {
	width:640px;
	margin: 80px auto 80px auto;
	padding:20px;
	background:#ffffff;

	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
}

#header td{
	border-top: none;
}

#header h1 {
	margin-bottom: 8px;
	text-align:center;
}

.alert-message{
	text-align:center;
}

#meta-info tr td{
	width: 50%;
	border:none;
}

#invoice-details tr td{
	border:none;
}

#invoice-details-items{
	margin-top:40px;
}

.item-centered {
	width:80px;
	text-align:center;
}

.totals {
	text-align:right;
}

.totals-tr td{
	font-weight:bold;
}

#invoice_trans td .details {
	display:none;
	font-size:10px;
}

#footer {
	margin-bottom:0px;
	margin-top:40px;
}

#footer tr td {
	border:none;
}

#lower_footer{
	font-size:10px;
	color:#666666;
}

.credit{
	text-align:center;
	margin-bottom:20px;
	font-size:11px;
}

<?php if(isset($_GET['email']) && $_GET['email'] == 'true'){?>
.topbar {
	display:none;
}
<?php }?>

#email_header{
	margin-bottom:-79px;
	background: #F9F9F9;
	padding:40px;
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
	min-height:80px;
}
</style>
<style type="text/css" media="print">
.topbar{
	display:none;
}
.container {
	margin-top:0px;
	box-shadow:none;
	border:1px solid #cccccc;
}
.well {
	box-shadow:none;
	border:1px solid #cccccc;
}	
</style>
</head>
<body <?php body_class(); ?>>

<?php if(!$valid_user){?>
<div class="container main">
<p>Sorry you must be logged in to view invoices, please login:</p>
<form id="loginform" method="post" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) );?>" name="loginform" class="well">
<p class="login-username">
<label for="user_login">Username</label>
<input id="user_login" class="input" type="text" tabindex="10" size="20" value="" name="log">
</p>
<p class="login-password">
<label for="user_pass">Password</label>
<input id="user_pass" class="input" type="password" tabindex="20" size="20" value="" name="pwd">
</p>
<p class="login-submit">
<label for="wp-submit"> </label>
<input id="wp-submit" class="btn primary input" type="submit" tabindex="100" value="Log In" name="wp-submit">
<input type="hidden" value="<?php echo get_permalink();?>" name="redirect_to">
</p>
</form>
</div>
<div class="container credit">
<a href="http://no-half-pixels.com/portfolio/wp-invoices-ultimate/" target="_blank">Invoice Created by WP Invoice Ultimate Plugin</a>
</div>
</body>
</html>
<?php
return;
}?>



    <div class="topbar">
      <div class="fill">
        <div class="container">
          <a class="brand" href="<?php echo site_url();?>"><?php bloginfo('name');?></a>
		
		
		<form action="https://www.paypal.com/cgi-bin/webscr" id="paypal" method="post" class="pull-right">
		    <input type="hidden" name="cmd" value="_xclick">
		    <input type="hidden" name="business" value="<?php echo $options['invoice_payment_email'];?>">
		    <input type="hidden" name="item_name" value="<?php the_title(); echo ' #'.$meta['_wpiu_invoice_meta_invoice_number'];?>">
		    <input type="hidden" name="item_number" value="<?php echo $meta['_wpiu_invoice_meta_invoice_number'];?>">
		    <input type="text" class="input-small" name="amount" value="<?php echo $balanceleft;?>">
		    <input type="hidden" name="return" value="<?php echo add_query_arg( array('proccessing' => 'true'), get_permalink()); ?>">
		    <input type="hidden" name="notify_url" value="<?php echo add_query_arg( array('action' => 'wpiu_paypal_ipn', 'invoice_id' => get_the_ID()), site_url('/')); ?>">  
		    <input type="hidden" name="no_shipping" value="0">
		    <input type="hidden" name="no_note" value="1">
		    <input type="hidden" name="currency_code" value="<?php echo $options['invoice_payment_currency'];?>">
		    <input type="hidden" name="lc" value="AU">
		    <input type="hidden" name="bn" value="PP-BuyNowBF">
		    <!--<input type="image" src="https://www.paypal.com/en_AU/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">-->
		    <img alt="" border="0" src="https://www.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1">
		    <button class="btn primary" type="submit" name="submit"><?php _e('Pay with Paypal', WPIU_LANG);?></button>
		</form>
		
		<form class="pull-right">
			<?php if($valid_user) {?>
				<button class="btn" onclick="window.print()"><?php _e('Print PDF', WPIU_LANG);?></button>
		</form>
		

		
		<?php }else{?>
          <form action="<?php echo wp_login_url(get_permalink()); ?>" class="pull-right">
            <input class="input-small" type="text" placeholder="Username">
            <input class="input-small" type="password" placeholder="Password">
            <button class="btn primary" type="submit"><?php _e('Login', WPIU_LANG);?></button>
          </form>
        <?php } ?>
        </div>
      </div>
    </div>

    
<?php if(isset($_GET['email']) && $_GET['email'] == 'true'){?>
<div id="email_header">
<?php _e('Dear ', WPIU_LANG); echo $user->display_name;?>,<br/><br/>
<?php if(isset($_GET['proccessing']) && $_GET['proccessing'] == 'true'){?>
<?php _e('A payment has been made on your invoice and it is being proccessed.<br/><br/>', WPIU_LANG);?>
<?php }else{?>
<?php _e('Your invoice has been generated and is ready for your payment. You can view the details of the invoice below.<br/><br/>', WPIU_LANG);?>
<?php }?>
<?php _e('To pay/print your Invoice view it online <a href="'.get_permalink().'">here</a>', WPIU_LANG);?>

</div>
<?php }?>

<?php if(isset($_GET['proccessing']) && $_GET['proccessing'] == 'true' && !isset($_GET['email'])){?>
	<div class="container" style="margin-top:80px;">
    <div class="alert-message success">
    <?php _e('<p><strong>Please Wait</strong> We are just updating the invoice to contain the latest payment data. You will be redirected in a few seconds.</p>', WPIU_LANG);?>
    </div>
    </div> 
    <meta http-equiv="refresh" content="5; url=<?php echo get_permalink();?>"> 
<?php }?>
    
<div class="container main">
<table id="header">
<tr>
<td><h1><?php bloginfo('name');?></h1></td>
</tr>
</table>

	<?php if($meta['_wpiu_invoice_meta_paid'] >= $meta['_wpiu_invoice_meta_total']){?>
		<div class="alert-message success"><strong><?php _e('Paid', WPIU_LANG);?></strong></div>
	<?php }elseif($meta['_wpiu_invoice_meta_paid'] != '0.00'){?>
		<div class="alert-message error"><strong><?php _e('Part Paid', WPIU_LANG);?></strong></div>
	<?php }else{?>
		<div class="alert-message error"><strong><?php _e('Unpaid', WPIU_LANG);?></strong></div>
	<?php }?>

<table id="meta-info">
<tr>
<td>
<?php 
echo '<strong>'.$user->display_name.'</strong><br/>';
echo get_the_author_meta('company_name',$user->ID).'<br/>';
echo get_the_author_meta('company_street',$user->ID).'<br/>';
echo get_the_author_meta('company_city',$user->ID).'<br/>';
echo get_the_author_meta('company_zip',$user->ID).'<br/>';
echo get_the_author_meta('company_phone',$user->ID).'<br/>';
?>
</td>
<td>
<div class="well">
<?php
//echo '<strong>Invoice Details</strong><br/>';
echo '<strong>'.get_the_title().'</strong><br/>';
echo '<strong>'.__('Invoice #:', WPIU_LANG).'</strong> '.$meta['_wpiu_invoice_meta_invoice_number'].'<br/>';
echo '<strong>'.__('Invoice Date:', WPIU_LANG).'</strong> '.get_the_date().'<br/>';
echo '<strong>'.__('Invoice Total:', WPIU_LANG).'</strong> '.$currency.$meta['_wpiu_invoice_meta_total'].'<br/>';
echo '<strong>'.__('Due Date:', WPIU_LANG).'</strong> '.date(get_option('date_format'), strtotime($meta['_wpiu_invoice_meta_due_date'])).'<br/>';
echo '<strong>'.__('Paid:', WPIU_LANG).'</strong> '.$currency.$meta['_wpiu_invoice_meta_paid'].'<br/>';
?>
</div>
</td>
</tr>
</table>

<table id="invoice-details">
<tr>
<td>
<?php 
echo '<h3>Invoice Details</h3>';
the_content();
?>
</td>
</tr>
</table>

<table id="invoice-details-items" class="zebra-striped">
<thead>
<tr>
<th><?php _e('Description', WPIU_LANG);?></th>
<th class="item-centered"><?php _e('Qty', WPIU_LANG);?></th>
<th class="item-centered"><?php _e('Unit Cost', WPIU_LANG);?></th>
<th class="item-centered"><?php _e('Item Total', WPIU_LANG);?></th>
</tr>
</thead>

<?php

$index = 0;

while($index < count($meta['_wpiu_invoice_meta_item']['title'])){
	if($meta['_wpiu_invoice_meta_item']['title'][$index] != ''){
		echo '<tr>';
		echo '<td>'.$meta['_wpiu_invoice_meta_item']['title'][$index].'</td>';
		echo '<td class="item-centered">'.$meta['_wpiu_invoice_meta_item']['qty'][$index].'</td>';
		echo '<td class="item-centered">'.$currency.$meta['_wpiu_invoice_meta_item']['unit_price'][$index].'</td>';	
		echo '<td class="item-centered">'.$currency.$meta['_wpiu_invoice_meta_item']['sub_total'][$index].'</td>';
		echo '</tr>';
	}	
$index++;
}
?>

<tr class="totals-tr">
<td colspan="3" class="totals"><?php _e('Sub Total:', WPIU_LANG);?></td>
<td class="item-centered"><?php echo $currency.$meta['_wpiu_invoice_meta_sub_total'];?></td>
</tr>

<tr class="totals-tr">
<td colspan="3" class="totals"><?php _e('Tax Total: ('.$tax.')', WPIU_LANG);?></td>
<td class="item-centered"><?php echo $currency.$meta['_wpiu_invoice_meta_tax'];?></td>
</tr>

<tr class="totals-tr">
<td colspan="3" class="totals"><?php _e('Total:', WPIU_LANG);?></td>
<td class="item-centered"><?php echo $currency.$meta['_wpiu_invoice_meta_total'];?></td>
</tr>

</table>



<table id="footer">
<tr>
<td>
<h4><?php _e('Payment Details', WPIU_LANG);?></h4>
<div class="well">
<?php
echo $options['invoice_payment_details'];
?>
</div>
<div id="lower_footer">
<?php echo $options['invoice_payment_deadlines'];?>
</div>
</td>
</tr>
</table>

</div>
<?php
	if($trans){
		echo '<div class="container main">';
		echo '<h4>'.__('Transaction History', WPIU_LANG).'</h4>';
		
		echo '<table class="widefat" id="invoice_trans">';
		
		echo '<thead><tr>';
			echo '<th>'.__('Amount', WPIU_LANG).'</th>';	
			echo '<th>'.__('Date', WPIU_LANG).'</th>';
			echo '<th>'.__('Transaction ID', WPIU_LANG).'</th>';
			echo '<th>'.__('Details', WPIU_LANG).'</th>';		
		echo '</tr></thead>';
		
		echo '<tbody>';
		
		foreach(array_reverse($trans) as $transaction){
			echo '<tr>';
				echo '<td>'.$currency.$transaction['mc_gross'].'</td>';
				echo '<td>'.$transaction['payment_date'].'</td>';
				echo '<td>'.$transaction['txn_id'].'</td>';
				echo '<td width="40%">';
					echo '<a href="javascript:void(0);" class="trans_show">'.__('Show Details', WPIU_LANG).'</a>';
					echo '<div class="details">';
						foreach($transaction as $transk => $transv){
							echo '<strong>'.$transk.': </strong> '.$transv.'<br/>'; 	
						}
					echo '</div>';
				echo '</td>';
			echo '</tr>';
		}//foreach
		
		echo '</tbody>';

		echo '</table>';
		
		echo '</div>';				
	}//meta
?>
<div class="container credit">
<a href="http://no-half-pixels.com/portfolio/wp-invoices-ultimate/" target="_blank">Invoice Created by WP Invoice Ultimate Plugin</a>
</div>
</body>
</html>
<?php
endwhile;
endif;
?>