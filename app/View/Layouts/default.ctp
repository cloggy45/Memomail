<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Remind.Me');
?>

<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('screen');

		echo $this->Html->script('jquery-1.11.0.min');
		
		if(isset($cssIncludes)) {
			foreach($cssIncludes as $css) {
				echo $this->Html->css($css);
			}
		}

		if(isset($jsIncludes)) {
			foreach($jsIncludes as $js) {
				echo $this->Html->script($js);
			}
		}

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
    
	?>
</head>
<body>
	<div class="container" id="default_view">
		<div id="header" class="ag ag1">	
			<h1 class="ag ag2"><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>
			<nav class="ag ag3">
				<ul>
					
					<?php if($this->Session->check('User')): ?>
					
					<li> <?php echo $this->Html->link('Logout','/Users/logout'); ?> </li>
					<li> <?php echo $this->Html->link('Settings','/Users/sett// #get ings'); ?> </li>
					<li> <?php echo $this->Html->link('Add Reminders','/Reminder/add'); ?> </li>
					<li> <?php echo $this->Html->link('View Reminders','/Reminder/get'); ?> </li>
						
					<?php else: ?>
						
					<li class="login_menu_item"><?php echo $this->Html->link('Login','/Users/login'); ?></li>
					<li class="login_menu_item"><?php echo $this->Html->link('Register','/Users/register'); ?></li>

					<?php endif; ?>

				</ul>
			</nav>
		</div>

		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
	
</body>
</html>
