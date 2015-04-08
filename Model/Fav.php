<?php

App::uses('FavAppModel', 'Fav.Model');
App::uses('CakeSession', 'Model/Datasource');

class Fav extends FavAppModel {

    /**
     * append
     *
     */
    public function append($key, $modelId){
        if (empty($key) || empty($modelId)) {
            throw new FavException(__('Fav: Invalid Fav.keys.'));
        }
        $keys = Configure::read('Fav.keys');
        if (
            !array_key_exists($key, $keys)
            || !array_key_exists('model', $keys[$key])
            || !array_key_exists('type', $keys[$key])
        ) {
            throw new FavException(__('Fav: Invalid Fav.keys.'));
        }
        $sessionKey = 'Auth.User.id';
        if (array_key_exists('userIdSessionKey', $keys[$key])) {
            $sessionKey = $keys[$key]['userIdSessionKey'];
        }
        $userId = CakeSession::read($sessionKey);
        if (empty($userId)) {
            throw new FavException(__('Fav: User not found'));
        }
        $userModel = 'User';
        if (array_key_exists('userModel', $keys[$key])) {
            $userModel = $keys[$key]['userModel'];
        }
        
        $type = $keys[$key]['type'];
        $model = $keys[$key]['model'];
        $Model = ClassRegistry::init($model);
        if (!$Model->exists($modelId)) {
            throw new FavException(__('Fav: Model not found'));
        }

        $data = array(
            'type' => $type,
            'user_model' => $userModel,
            'user_id' => $userId,
            'model' => $model,
            'model_id' => $modelId,
        );
        
        if ($this->find('count', array('conditions' => $data)) > 0) {
            throw new FavException(__('Fav: Fav already exists'));
        }

        $this->create();
        $this->set($data);
        $result = $this->save();
        if ($result === false) {
            throw new FavException(__('Fav: Fav save error'));
        }
        return true;        
    }

    /**
     * drop
     *
     */
    public function drop($key, $modelId){
        $id = $this->faved($key, $modelId);
        if ($id) {
            return $this->delete($id);
        }
        return false;
    }

    /**
     * faved
     *
     * @return Mixed $id or false
     */
    public function faved($key, $modelId){
        if (empty($key) || empty($modelId)) {
            throw new FavException(__('Fav: Invalid Fav.keys.'));
        }
        $keys = Configure::read('Fav.keys');
        if (
            !array_key_exists($key, $keys)
            || !array_key_exists('model', $keys[$key])
            || !array_key_exists('type', $keys[$key])
        ) {
            throw new FavException(__('Fav: Invalid Fav.keys.'));
        }
        $sessionKey = 'Auth.User.id';
        if (array_key_exists('userIdSessionKey', $keys[$key])) {
            $sessionKey = $keys[$key]['userIdSessionKey'];
        }
        $userId = CakeSession::read($sessionKey);
        if (empty($userId)) {
            throw new FavException(__('Fav: User not found'));
        }
        $userModel = 'User';
        if (array_key_exists('userModel', $keys[$key])) {
            $userModel = $keys[$key]['userModel'];
        }
        
        $type = $keys[$key]['type'];
        $model = $keys[$key]['model'];
        
        $data = array(
            'type' => $type,
            'user_model' => $userModel,
            'user_id' => $userId,
            'model' => $model,
            'model_id' => $modelId,
        );

        $fav = $this->find('first', array('conditions' => $data));
        if (empty($fav)) {
            return false;
        }
        return $fav['Fav']['id'];
    }
}
