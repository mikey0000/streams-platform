<?php namespace Anomaly\Streams\Platform\Ui\Form\Action;

/**
 * Class ActionFactory
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Ui\Form\Action
 */
class ActionFactory
{

    /**
     * Available action defualt.
     *
     * @var array
     */
    protected $actions = [
        'save' => [
            'type' => 'success',
            'text' => 'streams::button.save',
        ]
    ];

    /**
     * Make an action.
     *
     * @param array $parameters
     * @return mixed
     */
    public function make(array $parameters)
    {
        if (isset($parameters['action']) && class_exists($parameters['action'])) {
            return app()->make($parameters['action'], $parameters);
        }

        if ($action = array_get($this->actions, array_get($parameters, 'action'))) {
            $parameters = array_replace_recursive($action, array_except($parameters, 'action'));
        }

        return app()->make('Anomaly\Streams\Platform\Ui\Form\Action\Action', $parameters);
    }
}
