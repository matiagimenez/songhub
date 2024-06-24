<?php

namespace Songhub\app\models;

use Songhub\core\exceptions\InvalidValueException;

class Post
{
    public $fields = [
        "POST_ID" => null,
        "DATETIME" => null,
        "DESCRIPTION" => null,
        "LIKES" => null,
        "RATING" => null,
        "CONTENT_ID" => null,
        "USER_ID" => null,
    ];

    public function setPostId($post_id)
    {
        $this->fields["POST_ID"] = $post_id;
    }

    public function setDatetime(string $date)
    {
        if (!strtotime($date)) {
            throw new InvalidValueException('Formato de fecha incompatible');
        }

        $this->fields["DATETIME"] = $date;
    }

    public function setDescription(string $description)
    {
        $this->fields["DESCRIPTION"] = $description;
    }

    public function setLikes(int $likes = 0)
    {
        $this->fields["LIKES"] = $likes;
    }

    public function setRating($rating)
    {
        $this->fields["RATING"] = $rating;
    }
    
    public function setContentId($content_id)
    {
        $this->fields["CONTENT_ID"] = $content_id;
    }

    public function setUserId($user_id)
    {
        $this->fields["USER_ID"] = $user_id;
    }

    public function set(array $values)
    {
        // var_dump($values);
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