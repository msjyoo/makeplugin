MakePlugin
==========

MakePlugin is a library for packing PocketMine plugins without having to use DevTools and PocketMine itself.
Unlike DevTools Console, it also reads plugin configuration files like the full DevTools, and writes it as a phar metadata.

Usage:
```
use sekjun9878\MakePlugin\MakePlugin;

MakePlugin::makePlugin("/path/to/your/project/SimpleAuth", "/path/to/anywhere/for/the/phar/output", MakePlugin::MAKEPLUGIN_COMPRESS);
```

The first parameter is for your plugin folder.

The second parameter is the *directory* where your .phar file will go.
By default, it will make up a filename consisting of the plugin name and version.
If you want to override this behaviour (writing directly to the *file* specified), set the flag `MAKEPLUGIN_REAL_OUTPUT_PATH`

The third and final option are the flags.
Possible flags are:
- MAKEPLUGIN_REAL_OUTPUT_PATH - described above
- MAKEPLUGIN_COMPRESS - compress the resulting phar using the default Phar compression mechanism.

And that's it!

Oh, and there's another function called `MakePlugin::getPluginDescription($filename);`.
You can use this to get the PluginDescription object off of a plugin.yml. (Used internally)

Have fun!
