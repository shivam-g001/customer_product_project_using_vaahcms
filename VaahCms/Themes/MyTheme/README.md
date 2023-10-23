# vaahcms-theme-mytheme
MyTheme Theme for VaahCMS


#### To Run Theme Dusk Test:
- Change path of dusk in `phpunit.dusk.xml` to following:
```xml
...
<directory suffix="Test.php">./VaahCms/Themes/MyTheme/Tests/Browser</directory>
...
```

- Then run `php artisan dusk`