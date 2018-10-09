# Plugin Template

This project contains the outline of a plugin. It includes templating, admin menus etc.

To create a project based on this template:

- Check this project out locally.
- CD into the project, and archive it using
  ```
  git archive --format=zip -o ../plugintemplate.zip master
  ```
- Go and expand plugintemplate.zip, then rename the folder to the new plugin name.
- You can use the following bash script to rename all of the class files, just swap out -??- for your plugin shortname.
  ```
  for file in *-pt-*.php
  do
    mv "$file" "${file/-pt-/-??-}";
  done
  ```
- Replace value of PT_PLUGIN_SHORTNAME with your plugin shortname.
- Search and replace all instances of PT_ to find constants and classnames.
