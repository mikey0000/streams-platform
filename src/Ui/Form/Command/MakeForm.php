<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class MakeForm
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class MakeForm
{

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new MakeForm instance.
     *
     * @param FormBuilder $builder
     */
    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        $form = $this->builder->getForm();

        $options = $form->getOptions();
        $data    = $form->getData();

        $content = view(
            $options->get('form_view'),
            $data->all()
        );

        $form->setContent($content);
        $form->addData('content', $content);
    }
}
