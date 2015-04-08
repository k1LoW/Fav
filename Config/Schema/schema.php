<?php
class FavSchema extends CakeSchema
{

    public function before($event = array())
    {
        return true;
    }

    public function after($event = array())
    {
        return true;
    }

    public $favs = array(        
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
        'type' => array('type' => 'text', 'null' => true, 'default' => null),
        'user_model' => array('type' => 'text', 'null' => true, 'default' => null),
        'user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
        'model' => array('type' => 'text', 'null' => true, 'default' => null),
        'model_id' => array('type' => 'integer', 'null' => false, 'default' => null),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1),
       )
    );
}
