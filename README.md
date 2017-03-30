# [Grav](http://getgrav.org/) Twig Var Plugin

Adds two filters to Twig, namely `var` and `set_var`. These allow the user to retrieve and set instance variables.

I was unable to find a way to set HTML attributes to `img` elements created with e.g. `(p.media.images|first).cropZoom(110, 110)` as only the object's `items` instance variable was accessible. The `Medium` class has a protected `$attributes` instance variable, which can be used to this end with this plugin. Obviously this circumvents visibility specifiers, which makes the approach less than optimal.

## Installation

Installing the Twig Var Extension plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install twig-var-extension

This will install the Twig Var Extension plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/twig-var-extension`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `twig-var-extension`. You can find these files on [GitHub](https://github.com/tuukka-norri/grav-plugin-twig-var-extension) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/twig-var-extension
	
> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/twig-var-extension/twig-var-extension.yaml` to `user/config/plugins/twig-var-extension.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
```

## Usage

Suppose `p` is a `Page` object.

	{% set image = (p.media.images|first).cropZoom(110, 110) %}
	{% set attrs = image|var('attributes') %}
	{% do image|set_var('attributes', attrs|merge({
		'data-something': 'your-data',
		'alt': p.title
	})) %}

	{{ image.html }}
