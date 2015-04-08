<?php

App::uses('FavAppController', 'Fav.Controller');

class FavController extends FavAppController {

    public $uses = false;
    public $components = array(
        'Session',
    );

    /**
     * append
     *
     */
    public function append($key = null, $modelId = null){
        $this->Fav = ClassRegistry::init('Fav.Fav');

        try {
            $result = $this->Fav->append($key, $modelId);
            $message = Configure::read('Fav.flashMessage.append');
            if ($message) {
                $this->Session->setFlash(
                    $message,
                    Configure::read('Fav.setFlashElement.success'),
                    Configure::read('Fav.setFlashParams.success'));
            }
        } catch (FavException $e) {
            $message = Configure::read('Fav.flashMessage.append');
            if ($message) {
                $this->Session->setFlash(
                    $e->getMessage(),
                    Configure::read('Fav.setFlashElement.error'),
                    Configure::read('Fav.setFlashParams.error'));
            }
        }
        
        $this->redirect($this->request->referer());
    }

    /**
     * drop
     *
     */
    public function drop($key = null, $modelId = null){
        $this->Fav = ClassRegistry::init('Fav.Fav');
        try {
            $result = $this->Fav->drop($key, $modelId);
            $message = Configure::read('Fav.flashMessage.drop');
            if ($message) {
                $this->Session->setFlash(
                    $message,
                    Configure::read('Fav.setFlashElement.success'),
                    Configure::read('Fav.setFlashParams.success'));
            }
        } catch (FavException $e) {
            $message = Configure::read('Fav.flashMessage');
            if ($message) {
                $this->Session->setFlash(
                    $e->getMessage(),
                    Configure::read('Fav.setFlashElement.error'),
                    Configure::read('Fav.setFlashParams.error'));
            }
        }

        $this->redirect($this->request->referer());
    }
    
    /**
     * toggle
     *
     */
    public function toggle(){
        // @todo
    }

}
