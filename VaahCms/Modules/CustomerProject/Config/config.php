<?php

return [
    "name"=> "CustomerProject",
    "title"=> "Customer-Product Project",
    "slug"=> "customerproject",
    "thumbnail"=> "https://img.site/p/300/160",
    "is_dev" => env('MODULE_CUSTOMERPROJECT_ENV')?true:false,
    "excerpt"=> "Customer-Product project For Admin",
    "description"=> "Customer-Product project For Admin",
    "download_link"=> "",
    "author_name"=> "vaah",
    "author_website"=> "https://vaah.dev",
    "version"=> "0.0.1",
    "is_migratable"=> true,
    "is_sample_data_available"=> false,
    "db_table_prefix"=> "vh_customerproject_",
    "providers"=> [
        "\\VaahCms\\Modules\\CustomerProject\\Providers\\CustomerProjectServiceProvider"
    ],
    "aside-menu-order"=> null
];
