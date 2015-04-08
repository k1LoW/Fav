<?php
/**
 * FavException
 *
 */
class FavException extends CakeException {

    public function __construct($message = null, $code = 500) {
        if (empty($message)) {
            $message = __('Fav Exception Error.');
        }
        parent::__construct($message, $code);
    }
}
