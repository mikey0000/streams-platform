<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class ActionBuilder
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 */
class ActionBuilder
{

    /**
     * The action reader.
     *
     * @var ActionInput
     */
    protected $input;

    /**
     * The action factory.
     *
     * @var ActionFactory
     */
    protected $factory;

    /**
     * Create a new ActionBuilder instance.
     *
     * @param ActionInput   $input
     * @param ActionFactory $factory
     */
    public function __construct(ActionInput $input, ActionFactory $factory)
    {
        $this->input   = $input;
        $this->factory = $factory;
    }

    /**
     * Build the actions.
     *
     * @param FormBuilder $builder
     */
    public function build(FormBuilder $builder)
    {
        $form = $builder->getForm();

        $this->input->read($builder);

        foreach ($builder->getActions() as $action) {
            if (array_get($action, 'enabled', true)) {
                $form->addAction($this->factory->make($action));
            }
        }
    }
}
