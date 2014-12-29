<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter\Command;

/**
 * Class RunTableQueryHooksCommandHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Ui\Table\Component\Filter\Command
 */
class RunTableQueryHooksCommandHandler
{

    /**
     * Handle the command.
     *
     * @param RunTableQueryHooksCommand $command
     */
    public function handle(RunTableQueryHooksCommand $command)
    {
        $event = $command->getEvent();

        $table   = $event->getTable();
        $filters = $table->getFilters();

        foreach ($filters->active() as $filter) {
            $filter->onTableQuery($command->getEvent());
        }
    }
}
