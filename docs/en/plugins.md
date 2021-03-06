# Developing plugins

- [Introduction](#introduction)
	- [Creating A Plugin](#creating-a-plugin)
	- [Example Plugin](#example-plugin)
- [Plugin Components](#plugin-components)

<a name="introduction"></a>
## Introduction

Plugins are special [Twig extensions](http://twig.sensiolabs.org/doc/advanced.html#creating-an-extension). As such, they give you a simple and direct root to extending Twig and the features available in the view system.

<a name="example-plugin"></a>
### Example Plugin

You may reference the request plugin shipped with PyroCMS on GitHub:

[https://github.com/anomalylabs/request-plugin](https://github.com/anomalylabs/request-plugin).

<a name="creating-a-plugin"></a>
### Creating A plugin

Creating a plugin is the same as creating any other addon.

	php artisan make:addon anomaly.plugin.example

The new plugin will be located at `addons/{app_reference}/anomaly/example-plugin`. 

The `--shared` option may also be used to create the plugin in the shared addons directory.

	php artisan make:addon anomaly.plugin.example --shared

This plugin will be located at `addons/shared/anomaly/example-plugin`.

<a name="plugin-components"></a>
## Plugin Components

The structure of a plugin is the exact same as other addons. It also can provide any of the methods of a typical Twig [extension](http://twig.sensiolabs.org/doc/advanced.html#creating-an-extension).

	/**
     * Initializes the runtime environment.
     *
     * This is where you can load some file that contains filter functions for instance.
     *
     * @param Twig_Environment $environment The current Twig_Environment instance
     */
    public function initRuntime(Twig_Environment $environment)
    {
    }

    /**
     * Returns the token parser instances to add to the existing list.
     *
     * @return array An array of Twig_TokenParserInterface or Twig_TokenParserBrokerInterface instances
     */
    public function getTokenParsers()
    {
        return [];
    }

    /**
     * Returns the node visitor instances to add to the existing list.
     *
     * @return Twig_NodeVisitorInterface[] An array of Twig_NodeVisitorInterface instances
     */
    public function getNodeVisitors()
    {
        return [];
    }

    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array An array of filters
     */
    public function getFilters()
    {
        return [];
    }

    /**
     * Returns a list of tests to add to the existing list.
     *
     * @return array An array of tests
     */
    public function getTests()
    {
        return [];
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return [];
    }

    /**
     * Returns a list of operators to add to the existing list.
     *
     * @return array An array of operators
     */
    public function getOperators()
    {
        return [];
    }

    /**
     * Returns a list of global variables to add to the existing list.
     *
     * @return array An array of global variables
     */
    public function getGlobals()
    {
        return [];
    }

Most commonly plugins provide functions. Here is an example of how you can define functions in the context of a PyroCMS project.

    public function __construct(ExamplePluginFunctions $functions)
    {
        $this->functions = $functions;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('example_function', [$this->functions, 'example']), // Where example uppercases the string.
            new \Twig_SimpleFunction('another_function', function($name = 'Ryan') {
                return 'Hello ' . $name;
            }),
            new \Twig_SimpleFunction('favorite_function', function($params = []) {
                return $this->dispatch(new GetFavoriteThings($params));
            })
        ];
    }

Now you can use your plugin functions in views.

    {% verbatim %}
    {{ example_function('foo', true) }} // FOO

    {{ another_function('Batman') }} // Hello Batman

    {{ favorite_function({'category': 'foo'}) }} // Favorite things in the foo category
    {% endverbatim %}
