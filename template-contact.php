<?php
/*
Template Name: Contact
*/
?>

<?php 

$nameError = '';
$emailError = '';
$commentError = '';

if(isset($_POST['submitted'])) {

		if(trim($_POST['contactName']) === '') {
			$nameError = 'Ingresa tu nombre.';
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		if(trim($_POST['email']) === '')  {
			$emailError = 'Ingresa tu dirección de email.';
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'Ingresa una dirección valida.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		if(trim($_POST['comments']) === '') {
			$commentError = 'Escribe tu mensaje.';
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
		
			
		if(!isset($hasError)) {
			$emailTo = get_option('tz_email');
			if (!isset($emailTo) || ($emailTo == '') ){
				$emailTo = get_option('admin_email');
			}
			$subject = '[Contacto desde Brium.cl] From '.$name;
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			//$headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body);
			$emailSent = true;
		}
		
	//email('contacto@brium.cl', 'contacto', 'test');
} ?>
<?php get_header(); ?>

            <!--BEGIN .page-header -->
            <div class="page-header">
                <h1 class="page-title"><?php the_title(); ?></h1>
                 <div id="googleMap"></div>
                 
                 
                <div class="separador"></div>
                                 
                
                <?php if ( current_user_can( 'edit_post', $post->ID ) ): 
				    edit_post_link( __('edit', 'framework'), '<span class="edit-post">[', ']</span>' );
				endif; ?>
            <!--END .page-header -->
            </div>

			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
			<h3>Queremos trabajar contigo</h3>
			<p>¡¡Cuéntanos sobre tu proyecto!!</p> 
			
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<!--BEGIN .hentry-->
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                    
					<!--BEGIN .entry-content -->
					<div class="entry-content">

				<?php if(isset($emailSent) && $emailSent == true) { ?>

					<div class="thanks">
						<p><?php _e('Gracias, el mensaje ha sido enviado correctamente ;).', 'framework') ?></p>
					</div>

				<?php } else { ?>

					<?php the_content(); ?>
		
					<?php if(isset($hasError) || isset($captchaError)) { ?>
						<p class="error"><?php _e('Oh no, ha ocurrido un problema.', 'framework') ?><p>
					<?php } ?>
	
					<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
						<ul class="contactform">
							<li><label for="contactName"><?php _e('Nombre:', 'framework') ?></label>
								<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
								<?php if($nameError != '') { ?>
									<span class="error"><?php echo $nameError; ?></span> 
								<?php } ?>
							</li>
				
							<li><label for="email"><?php _e('E-mail:', 'framework') ?></label>
								<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
								<?php if($emailError != '') { ?>
									<span class="error"><?php echo $emailError; ?></span>
								<?php } ?>
							</li>
				
							<li class="textarea"><label for="commentsText"><?php _e('Mensaje:', 'framework') ?></label>
								<textarea name="comments" id="commentsText" rows="20" cols="30" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
								<?php if($commentError != '') { ?>
									<span class="error"><?php echo $commentError; ?></span> 
								<?php } ?>
							</li>
				
							<li class="buttons">
								<input type="hidden" name="submitted" id="submitted" value="true" />
								<button type="submit"><?php _e('Enviar e-mail', 'framework') ?></button>
							</li>
						</ul>
					</form>
				<?php } ?>
				</div><!-- .entry-content -->	
				<!--END .hentry-->
				</div>
				
				<?php endwhile; endif; ?>
			
			<!--END #primary .hfeed-->
			</div>
			
<!--BEGIN #sidebar .aside-->
<div id="sidebar" class="aside">
	                  Estamos ubicados en:<br> 
	                  <strong>Avda Larraín 6642, La Reina, Santiago, CL</strong>
	                  <br> <br> 
	
	 				  Llámanos al:<br> 
	 				  <strong>fijo. +562 4017735</strong><br> 
	 				  <strong>cel. +569 56371958</strong>
	 				  <br> <br> 
	 				  
	                  Escríbenos al email:<br> 
	                  <strong>contacto[at]brium.cl</strong>
	                  <br> 	<br> 
	                  o si lo prefieres utiliza nuestro formulario de contacto.
	                 

<!--END #sidebar .aside-->
</div>

<?php get_footer(); ?>