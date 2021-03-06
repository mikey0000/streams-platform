<?php namespace Anomaly\Streams\Platform\Ui\Tree\Component\Segment;

use Anomaly\Streams\Platform\Support\Translator;
use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;

/**
 * Class SegmentTranslator
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class SegmentTranslator
{

    /**
     * The translator instance.
     *
     * @var Translator
     */
    protected $translator;

    /**
     * Create a new SegmentTranslator instance.
     *
     * @param Translator $translator
     */
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * Translate the tree segments.
     *
     * @param TreeBuilder $builder
     */
    public function translate(TreeBuilder $builder)
    {
        $builder->setSegments($this->translator->translate($builder->getSegments()));
    }
}
