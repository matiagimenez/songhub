<?php

namespace Songhub\app\models;

class Follow
{
    public $fields = [
        "FOLLOWER_ID" => null,
        "FOLLOWED_ID" => null,
    ];

    public function setFollowerId($follower_id)
    {
        $follower_id = trim($follower_id);
        $this->fields["FOLLOWER_ID"] = $follower_id;
    }

    public function setFollowedId($followed_id)
    {
        $followed_id = trim($followed_id);
        $this->fields["FOLLOWED_ID"] = $followed_id;
    }

    public function set(array $values)
    {
        foreach ($values as $key => $value) {
            if (array_key_exists($key, $this->fields)) {
                $this->fields[$key] = (int)$value;
            }
        }
    }
}
