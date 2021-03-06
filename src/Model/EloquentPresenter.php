<?php namespace Anomaly\Streams\Platform\Model;

use Anomaly\Streams\Platform\Support\Presenter;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Class EloquentPresenter
 * The base presenter for all our models.
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 */
class EloquentPresenter extends Presenter implements Arrayable
{

    /**
     * Create a new EloquentPresenter instance.
     *
     * @param $object
     */
    public function __construct($object)
    {
        if ($object instanceof EloquentModel) {
            $this->object = $object;
        }
    }

    /**
     * Return the ID.
     *
     * @return mixed
     */
    public function id()
    {
        return $this->object->getKey();
    }

    /**
     * Return the object as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->object->toArray();
    }
}
