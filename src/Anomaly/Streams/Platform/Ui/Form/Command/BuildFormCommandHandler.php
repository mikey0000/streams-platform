<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Ui\Form\Event\FormIsBuilding;
use Anomaly\Streams\Platform\Ui\Form\Event\FormWasBuilt;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Laracasts\Commander\CommanderTrait;
use Laracasts\Commander\Events\DispatchableTrait;

class BuildFormCommandHandler
{

    use CommanderTrait;
    use DispatchableTrait;

    public function handle(BuildFormCommand $command)
    {
        $builder = $command->getBuilder();
        $form    = $builder->getForm();

        $form->raise(new FormIsBuilding($builder));

        $this->dispatchEventsFor($form);

        $this->loadFormInput($builder);
        $this->loadFormSections($builder);
        $this->loadFormRedirects($builder);
        $this->loadFormButtons($builder);

        $this->loadFormEntry($builder);

        $form->raise(new FormWasBuilt($builder));

        $this->dispatchEventsFor($form);
    }

    protected function loadFormInput(FormBuilder $builder)
    {
        $form = $builder->getForm();

        if (app('request')->isMethod('post')) {
            // Put all the input.
        }
    }

    protected function loadFormSections(FormBuilder $builder)
    {
        $form     = $builder->getForm();
        $sections = $form->getSections();

        foreach ($builder->getSections() as $parameters) {

            $section = $this->execute(
                'Anomaly\Streams\Platform\Ui\Form\Section\Command\MakeSectionCommand',
                compact('parameters')
            );

            $sections->push($section);
        }
    }

    protected function loadFormRedirects(FormBuilder $builder)
    {
        $form    = $builder->getForm();
        $redirects = $form->getRedirects();

        foreach ($builder->getRedirects() as $parameters) {

            $redirect = $this->execute(
                'Anomaly\Streams\Platform\Ui\Form\Redirect\Command\MakeRedirectCommand',
                compact('parameters')
            );

            $redirect->setPrefix($form->getPrefix());
            $redirect->setActive(app('request')->has($form->getPrefix() . 'redirect'));

            $redirects->put($redirect->getSlug(), $redirect);
        }
    }

    protected function loadFormButtons(FormBuilder $builder)
    {
        $form    = $builder->getForm();
        $buttons = $form->getButtons();

        foreach ($builder->getButtons() as $parameters) {

            $button = $this->execute(
                'Anomaly\Streams\Platform\Ui\Button\Command\MakeButtonCommand',
                compact('parameters')
            );

            $button->setSize('sm');

            $buttons->push($button);
        }
    }

    protected function loadFormEntry(FormBuilder $builder)
    {
        $form  = $builder->getForm();
        $model = $builder->getModel();
        $entry = $builder->getEntry();

        if (is_object($entry)) {

            $form->setEntry($entry);
        }

        if (is_numeric($entry) or $entry === null) {

            $form->setEntry($model::findOrNew($entry));
        }
    }
}
 