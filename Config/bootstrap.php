<?php
App::uses('FavException', 'Fav.Error');

Configure::write('Fav.flashMessage.append', false);
Configure::write('Fav.flashMessage.drop', false);

// setFlash settings
Configure::write('Fav.setFlashElement', array(
    'success' => 'default',
    'error' => 'default',
));
Configure::write('Fav.setFlashParams', array(
    'success' => array(),
    'error' => array(),
));
