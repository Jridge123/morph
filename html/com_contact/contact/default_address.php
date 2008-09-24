<?php
/** $Id: default_address.php 12387 2009-06-30 01:17:44Z ian $ */
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<?php if ( ( $this->contact->address || $this->contact->suburb  || $this->contact->state || $this->contact->country || $this->contact->postcode ) ) : ?>

<div id="hcard-Chris-Rault" class="vcard">

    <div class="contact">

        <?php if ( $this->contact->name && $this->contact->params->get( 'show_name' ) ) : ?>
        <h2 class="contact-name"><span class="fn"><?php echo $this->escape($this->contact->name); ?></span></h2>
        <?php endif; ?>
        <?php if ( $this->contact->con_position && $this->contact->params->get( 'show_position' ) ) : ?>
        <h3 class="contact-position"><span class="role"><?php echo $this->escape($this->contact->con_position); ?></span></h3>
        <?php endif; ?>
     
    </div>

    <?php if ( $this->contact->address && $this->contact->params->get( 'show_street_address' ) ) : ?>
    <div class="adr">
        
        <?php if ( $this->contact->address && $this->contact->params->get( 'show_street_address' ) ) : ?>
        <span class="street-address"><?php echo nl2br($this->escape($this->contact->address)); ?></span>
        <?php endif; ?>
      
        <?php if ( $this->contact->suburb && $this->contact->params->get( 'show_suburb' ) ) : ?>
        <span class="locality"><?php echo $this->escape($this->contact->suburb); ?></span>
        <?php endif; ?>
        
        <?php if ( $this->contact->state && $this->contact->params->get( 'show_state' ) ) : ?>
        <span class="region"><?php echo $this->escape($this->contact->state); ?></span>
        <?php endif; ?>
        
        <?php if ( $this->contact->postcode && $this->contact->params->get( 'show_postcode' ) ) : ?>
        <span class="postal-code"><?php echo $this->escape($this->contact->postcode); ?></span>
        <?php endif; ?>
        
        <?php if ( $this->contact->country && $this->contact->params->get( 'show_country' ) ) : ?>
        <span class="country-name"><?php echo $this->escape($this->contact->country); ?></span>
        <?php endif; ?>
    
    </div>
    <?php endif; ?>
 
    <?php if ( $this->contact->telephone && $this->contact->params->get('show_telephone') || $this->contact->fax && $this->contact->params->get('show_fax')
      || $this->contact->mobile && $this->contact->params->get('show_mobile')) : ?>		
    <ul class="tel">
         <?php if ( $this->contact->telephone && $this->contact->params->get( 'show_telephone' ) ) : ?>
        <li class="contact-tel"><span class="type">Phone</span> <?php echo nl2br($this->escape($this->contact->telephone)); ?></li>
        <?php endif; ?>
        
        <?php if ( $this->contact->fax && $this->contact->params->get( 'show_fax' ) ) : ?>
        <li class="contact-fax"><span class="type">Fax</span> <?php echo nl2br($this->escape($this->contact->fax)); ?></li>
        <?php endif; ?>
        
        <?php if ( $this->contact->mobile && $this->contact->params->get( 'show_mobile' ) ) :?>
        <li class="contact-mob"><span class="type">Mobile</span> <?php echo nl2br($this->escape($this->contact->mobile)); ?></li>
        <?php endif; ?>
        
    </ul>
    <?php endif; ?>

    <?php if ( $this->contact->webpage && $this->contact->params->get( 'show_webpage' )) : ?>
	<p class="website"><strong>Web</strong> <a href="<?php echo $this->escape($this->contact->webpage); ?>" target="_blank"><span class="org url">
	<?php echo $this->escape($this->contact->webpage); ?></span></a></p>
    <?php endif; ?>  
        
    <?php if ( $this->contact->params->get( 'allow_vcard' ) ) : ?>
	    <p class="vcard"><?php echo JText::_( 'Download information as a' );?>
		<a href="<?php echo JURI::base(); ?>index.php?option=com_contact&amp;task=vcard&amp;contact_id=<?php echo $this->contact->id; ?>&amp;format=raw&amp;tmpl=component">
			<?php echo JText::_( 'VCard' );?></a>.</p>
	<?php endif; ?>	
	
</div>
<?php endif; ?>