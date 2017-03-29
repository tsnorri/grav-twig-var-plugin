# [Grav](http://getgrav.org/) Twig Var Plugin

Adds two filters to Twig, namely `var` and `set_var`. These allow the user to retrieve and set instance variables.

I was unable to find a way to set HTML attributes to `img` elements created with e.g. `(p.media.images|first).cropZoom(110, 110)` as only the object's `items` instance variable was accessible. The `Medium` class has a protected `$attributes` instance variable, which can be used to this end with this plugin. Obviously this circumvents visibility specifiers, which makes the approach less than optimal.

## Usage

Suppose `p` is a `Page` object.

	{% set image = (p.media.images|first).cropZoom(110, 110) %}
	{% set attrs = image|var('attributes') %}
	{% do image|set_var('attributes', attrs|merge({
		'data-something': 'your-data',
		'alt': p.title
	})) %}

	{{ image.html }}
