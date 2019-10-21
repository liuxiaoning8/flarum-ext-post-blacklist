<?php

namespace XmugenX\PostBlackList\Events;

use Flarum\Post\Post;
use Flarum\User\User;

class PostWasBlacklisted
{
    /**
     * The post that was approved.
     *
     * @var Post
     */
    public $post;

    /**
     * @var User
     */
    public $actor;

    /**
     * @param Post $post
     * @param User $actor
     */
    public function __construct(Post $post, User $actor)
    {
        $this->post = $post;
        $this->actor = $actor;
    }
}
