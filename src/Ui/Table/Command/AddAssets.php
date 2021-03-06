<?php namespace Anomaly\Streams\Platform\Ui\Table\Command;

use Anomaly\Streams\Platform\Asset\Asset;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class AddAssets
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class AddAssets
{

    /**
     * The form builder.
     *
     * @var TableBuilder
     */
    protected $builder;

    /**
     * Create a new AddAssets instance.
     *
     * @param TableBuilder $builder
     */
    public function __construct(TableBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param  Asset      $asset
     * @throws \Exception
     */
    public function handle(Asset $asset)
    {
        foreach ($this->builder->getAssets() as $collection => $assets) {
            if (!is_array($assets)) {
                $assets = [$assets];
            }

            foreach ($assets as $file) {
                $filters = explode('|', $file);

                $file = array_shift($filters);

                $asset->add($collection, $file, $filters);
            }
        }
    }
}
