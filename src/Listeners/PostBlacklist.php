<?php

namespace XmugenX\PostBlackList\Listeners;

use Flarum\Post\Event\Saving as PostSaving;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\AssertPermissionTrait;
use Illuminate\Contracts\Events\Dispatcher;
use XmugenX\PostBlackList\Events\PostWasBlacklisted;
use XmugenX\PostBlackList\Events\PostWasUnBlacklisted;

class PostBlacklist
{
    use AssertPermissionTrait;
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * LoadSettingsFromDatabase constructor.
     *
     * @param SettingsRepositoryInterface $settings
     */
    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(PostSaving::class, [$this, 'whenPostSaving']);
        $events->listen(PostWasBlacklisted::class, [$this, 'blacklistDiscussion']);
        $events->listen(PostWasUnBlacklisted::class, [$this, 'unBlacklistDiscussion']);
    }

    /**
     * @param PostSaving $event
     * @throws \Flarum\User\Exception\PermissionDeniedException
     */
    public function whenPostSaving(PostSaving $event)
    {
        if (isset($event->data['attributes']['isBlacklisted'])) {
            $isBlacklisted = (bool) $event->data['attributes']['isBlacklisted'];

            $post = $event->post;
            $actor = $event->actor;

            $this->assertCan($actor, 'blacklist', $post);

            if ((bool) $post->is_blacklisted === $isBlacklisted) {
                return;
            }

            $post->is_blacklisted = $isBlacklisted;
            $post->raise(
                $post->is_blacklisted
                    ? new PostWasBlacklisted($post, $actor)
                    : new PostWasUnBlacklisted($post, $actor)
            );

        } else {
            $black_list = $this->settings->get('xmugenx-post-blacklist.words');
            $words = explode(' ',$black_list);
            $post = $event->post;

            $title = $event->data['attributes']['title'];
            $content = $event->data['attributes']['content'];

            if ($title && $this->check($post->discussion, $title, $words)) {
                $post->discussion->save();
                $post->is_blacklisted = true;
            }
            if ($this->check($post, $content, $words)) {
                $post->raise(new PostWasBlacklisted($post, $event->actor));
            }

        }


    }

    private function check($item, $content, $words)
    {
        foreach ($words as $word) {
            if (stripos($content, $word) !== false) {
                $item->is_blacklisted = true;
                return true;
            }
        }
        return false;
    }

    /**
     * @param PostWasBlacklisted $event
     */
    public function blacklistDiscussion(PostWasBlacklisted $event)
    {
        $post = $event->post;
        $discussion = $post->discussion;

        $discussion->refreshCommentCount();
        $discussion->refreshLastPost();

        if ($post->number == 1 && !$discussion->is_blacklisted) {
            $discussion->is_blacklisted = true;
            $discussion->save();
        }
    }

    /**
     * @param PostWasUnBlacklisted $event
     */
    public function unBlacklistDiscussion(PostWasUnBlacklisted $event)
    {
        $post = $event->post;
        $discussion = $post->discussion;

        $discussion->refreshCommentCount();
        $discussion->refreshLastPost();

        if ($post->number == 1 && $discussion->is_blacklisted) {
            $discussion->is_blacklisted = false;
            $discussion->save();
        }
    }

}
