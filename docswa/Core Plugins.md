As of 04/08/2023, these are the enabled joomla plugins. 
```mysql
SELECT `name`,`type`,`folder` FROM swana_extensions
WHERE type = "plugin" and enabled = "1"
ORDER BY folder, name;
```

 ```dataview
    TABLE WITHOUT ID name, type, folder
    FROM csv("./attachments/swana_extensions.csv")
```