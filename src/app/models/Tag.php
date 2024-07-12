<?php

namespace Songhub\app\models;

use Songhub\core\exceptions\InvalidValueException;

class Tag
{
    public $fields = [
      "POST_ID" => null,
      "TEXT" => null,
    ];
      
    
    public function setPostId($post_id)
    {
        $this->fields["POST_ID"] = $post_id;
    }
    
    public function setText(string $text)
    {
        $this->fields["TEXT"] = $text;
    }
      
      
    public function set(array $values)
    {
        
        foreach (array_keys($this->fields) as $field) {
          $field = trim($field);
          if (!isset($values[$field])) {
            continue;
          }
          
            $property = explode("_", $field);
            if (count($property) > 1) {
                $method = "set" . ucfirst(strtolower($property[0])) . ucfirst(strtolower($property[1]));

            } else {
                $method = "set" . ucfirst(strtolower($property[0]));
            }

            $this->$method($values[$field]);
        }

    }

}