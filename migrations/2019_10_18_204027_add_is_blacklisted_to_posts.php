<?php
use Flarum\Database\Migration;

return Migration::addColumns('posts', [
    'is_blacklisted' => ['boolean', 'default' => 0]
]);
