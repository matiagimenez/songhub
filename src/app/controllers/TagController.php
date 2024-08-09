<?php
namespace Songhub\App\Controllers;

use Songhub\app\repositories\TagRepository;
use Songhub\core\Controller;
use Songhub\core\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->repositoryName = TagRepository::class;
        parent::__construct();
    }

    public function createTags($tags, $postID)
    {
        foreach ($tags as $tag) {
            $this->createTag($tag, $postID);
        }
    }

    private function createTag($tag, $postID) {
        $tagData["POST_ID"] = $postID;
        $tagData["TEXT"] = $tag;
        $this->repository->createTag($tagData);
    }

    public function getTags($post_id)
    {
        $tags = $this->repository->getTags($post_id);
        return $tags;
    }

}