<?php
namespace XmugenX\PostBlackList\Events;

use Flarum\Post\Post;
use Flarum\User\User;

class PostWasUnBlacklisted
{
    /**
     * @var Post
     */
    public $post;

    /**
     * @var User
     */
    public $user;

    /**
     * @param Post $post
     * @param User $actor
     */
    public function __construct(Post $post, User $actor)
    {
        $this->post = $post;
        $this->user = $actor;
    }
}
