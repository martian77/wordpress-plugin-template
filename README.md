# Plugin Template

This project contains the outline of a plugin. It includes templating, admin menus etc.

To create a project based on this template:

- Check this project out locally.
- CD into the project, and archive it using
  ```
  git archive --format=zip -o ../plugintemplate.zip master
  ```
- Go and expand plugintemplate.zip, then rename the folder to the new plugin name.
- Replace value of PT_PLUGIN_SHORTNAME with your plugin shortname.
- Search and replace the PT\ namespace.
- Search and replace all instances of PT_ to find constants and classnames.
- Search and replace -pt- for file includes.
- Search for plugintemplate and replace as required.
- Don't forget to change the notes at the top of the plugin main file.
