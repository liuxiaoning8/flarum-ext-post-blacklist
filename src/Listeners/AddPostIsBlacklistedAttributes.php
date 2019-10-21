<?php

namespace XmugenX\PostBlackList\Listeners;

use Flarum\Api\Event\Serializing;
use Flarum\Api\Serializer\BasicDiscussionSerializer;
use Flarum\Api\Serializer\DiscussionSerializer;
use Flarum\Api\Serializer\PostSerializer;

class AddPostIsBlacklistedAttributes
{
    public function handle(Serializing $event)
    {
        if ($event->isSerializer(PostSerializer::class)) {
            $event->attributes['isBlacklisted'] = (bool) $event->model->is_blacklisted;
            $event->attributes['canBlacklist'] = (bool) $event->actor->can('blacklist', $event->model->post);
        }
        if ($event->isSerializer(DiscussionSerializer::class)) {
            $event->attributes['isBlacklisted'] = (bool) $event->model->is_blacklisted;
            $event->attributes['canBlacklist'] = (bool) $event->actor->can('blacklist', $event->model->post);

        }
    }
}
