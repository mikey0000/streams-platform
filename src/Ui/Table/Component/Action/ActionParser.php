<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Action;

use Anomaly\Streams\Platform\Support\Parser;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ActionParser
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class ActionParser
{

    /**
     * The parser utility.
     *
     * @var Parser
     */
    protected $parser;

    /**
     * Create a new ButtonParser instance.
     *
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Parse the table buttons.
     *
     * @param TableBuilder $builder
     */
    public function parse(TableBuilder $builder)
    {
        $builder->setActions($this->parser->parse($builder->getActions()));
    }
}
