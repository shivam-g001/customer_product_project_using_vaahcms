<?php

return [
    "name"=> "MyTheme",
    "title"=> "Theme for myself",
    "slug"=> "mytheme",
    "thumbnail"=> "https://img.site/p/300/160",
    "excerpt"=> "This theme will be used for testing purpose only",
    "description"=> "This theme will be used for testing purpose only",
    "download_link"=> "",
    "author_name"=> "mytheme",
    "author_website"=> "https://vaah.dev",
    "version"=> "v0.0.1",
    "is_migratable"=> true,
    "is_sample_data_available"=> false,
    "db_table_prefix"=> "vh_mytheme_",
    "providers"=> [
        "\\VaahCms\\Themes\\MyTheme\\Providers\\MyThemeServiceProvider"
    ],
    "aside-menu-order"=> null
];
