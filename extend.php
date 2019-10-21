<?php
namespace XmugenX\PostBlackList;

use Flarum\Api\Event\Serializing;
use Flarum\Extend;
use Illuminate\Contracts\Events\Dispatcher;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),
    new Extend\Locales(__DIR__.'/resources/locale'),
    function (Dispatcher $events) {
        $events->listen(Serializing::class, Listeners\AddPostIsBlacklistedAttributes::class);
        $events->subscribe(Listeners\PostBlacklist::class);
    },
];
