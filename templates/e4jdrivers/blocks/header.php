<?php
/**
 * Copyright (c) Extensionsforjoomla.com - E4J - Templates for Joomla
 *
 * You should have received a copy of the License
 * along with this program.  If not, see <http://www.extensionsforjoomla.com/>.
 *
 * For any bug, error please contact us
 * We will try to fix it.
 *
 * Extensionsforjoomla.com - All Rights Reserved
 *
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<header>
	<?php include('./templates/'.$this->template.'/blocks/header/upmenu.php'); ?>
	<div class="logomenupart e4j-mainmenu <?php echo ($this->params->get('getmenufixed') ? "fixedmenu" : ''); ?>">
		<div id="lmpart">
			<div class="menumob-btn">
				<div id="menumob-btn-ico" onclick="vikShowResponsiveMenu();">
				  <span></span>
				  <span></span>
				  <span></span>
				  <span></span>
				</div>
			</div>
			<?php $get_logo = $this->params->get('logo');
			if (!empty($get_logo)) { ?>	
				<div id="tbar-logo">
					<p><a href="<?php echo $this->params->get('logolink');?>"><img src="<?php echo $get_logo;?>" /></a></p>
				</div>
			<?php } ?>		
			<?php if($this->countModules('user')) { ?>				
			<div id="tbar-user">
				<div id="tbar-preuser">
					<?php include('./templates/'.$this->template.'/blocks/header/user.php'); ?>
				</div>
			</div>
			<?php } ?>
			<?php if($this->countModules('mainmenu')) { ?>		
			<div id="mainmenu">
				<?php include('./templates/'.$this->template.'/blocks/header/mainmenu.php'); ?>
			</div>
		<?php } ?>	
		</div>
		<?php if($this->countModules('submenu')) { ?>		
			<div id="submenu">
				<?php include('./templates/'.$this->template.'/blocks/header/submenu.php'); ?>
			</div>
		<?php } ?>	
		
	</div>
	<div id="contentheader">	
		<div id="slideadv">
			<?php if($this->countModules('slide-up')) { ?>
				<div class="upsearch h-search md-search">
					<div class="grid-block">
						<jdoc:include type="modules" name="slide-up" style="e4jstyle" />
					</div>
				</div>
			<?php } ?>			
			<?php if($this->countModules('slider')) { ?>					
				<div id="contain-slider" class="cnt-slider">
					<div class="slidmodule">
						<div id="slider">
							<div id="imgslider">
								<jdoc:include type="modules" name="slider" style="e4jstyle" />
							</div>
						</div>
					</div>
					<?php if($this->countModules('slide-left')) { ?>
						<div class="leftsearch v-search md-search">
							<div class="grid-block">
								<jdoc:include type="modules" name="slide-left" style="e4jstyle" />
							</div>
						</div>
					<?php } ?>	
					<?php if($this->countModules('slide-right')) { ?>
						<div class="rightsearch v-search md-search">
							<div class="grid-block">
								<jdoc:include type="modules" name="slide-right" style="e4jstyle" />
							</div>
						</div>
					<?php } ?>
				</div>					
			<?php } ?>
			<?php if($this->countModules('slider-fullscreen')) { ?>					
				<div id="contain-slider-fullscreen" class="cnt-slider">						
					<div class="slidmodule">
						<div id="slider">
							<div id="imgslider">
								<jdoc:include type="modules" name="slider-fullscreen" style="e4jstyle" />
							</div>
						</div>
					</div>						
				</div>
				<?php if($this->countModules('slide-left')) { ?>
					<div class="leftsearch v-search md-search">
						<div class="grid-block">
							<jdoc:include type="modules" name="slide-left" style="e4jstyle" />
						</div>
					</div>
				<?php } ?>
				<?php if($this->countModules('slide-right')) { ?>
					<div class="rightsearch v-search md-search">
						<div class="grid-block">
							<jdoc:include type="modules" name="slide-right" style="e4jstyle" />
						</div>
					</div>
				<?php } ?>				
			<?php } ?>
			
			
			<?php if($this->countModules('slide-center')) { ?>
				<div class="centersearch h-search md-search">
					<div class="grid-block">
						<div class="h-search-inner">
							<jdoc:include type="modules" name="slide-center" style="e4jstyle" />
						</div>
					</div>
				</div>
			<?php } ?>
		</div>			
	</div>
</header>	
	
