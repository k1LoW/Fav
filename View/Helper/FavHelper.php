<?php

App::uses('AppHelper', 'View/Helper');

class FavHelper extends AppHelper {

    public $helpers = array('Html');

    /**
     * urlAppend
     *
     */
    public function urlAppend($key, $modelId, $full = false){
        return $this->Html->url(array(
            'plugin' => 'fav',
            'controller' => 'fav',
            'action' => 'append',
            $key, $modelId
        ), $full);
    }

    /**
     * urlDrop
     *
     */
    public function urlDrop($key, $modelId, $full = false){
        return $this->Html->url(array(
            'plugin' => 'fav',
            'controller' => 'fav',
            'action' => 'drop',
            $key, $modelId
        ), $full);
    }

    /**
     * faved
     *
     */
    public function faved($key, $modelId){
        $Fav = ClassRegistry::init('Fav.Fav');
        return $Fav->faved($key, $modelId);
    }
}
