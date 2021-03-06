<?php

return [
    'feeds' => [
        'main' => [
            /*
             * Here you can specify which class and method will return
             * the items that should appear in the feed. For example:
             * 'App\Model@getAllFeedItems'
             *
             * You can also pass an argument to that method:
             * ['App\Model@getAllFeedItems', 'argument']
             */
            'items' => 'App\Rss@newPoems',

            /*
             * The feed will be available on this url.
             */
            'url' => '/rss/poems',

            'title' => 'Newest Poems',

            /*
             * The view that will render the feed.
             */
            'view' => 'feed::feed',
        ],
    ],
];
