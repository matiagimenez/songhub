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

    public function createTags($tags, $contentID)
    {
        foreach ($tags as $tag) {
            $this->createTag($tag, $contentID);
        }
    }

    private function createTag($tag, $contentID) {
        $tagData["POST_ID"] = $contentID;
        $tagData["TEXT"] = $tag;
        $this->repository->createTag($tagData);
    }

}