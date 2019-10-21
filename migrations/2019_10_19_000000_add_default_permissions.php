<?php
use Flarum\Database\Migration;
use Flarum\Group\Group;

return Migration::addPermissions([
    'discussion.blacklist' => Group::MODERATOR_ID
]);
