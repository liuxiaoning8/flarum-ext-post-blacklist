<?php
use Flarum\Database\Migration;

return Migration::addColumns('discussions', [
    'is_blacklisted' => ['boolean', 'default' => 0]
]);
