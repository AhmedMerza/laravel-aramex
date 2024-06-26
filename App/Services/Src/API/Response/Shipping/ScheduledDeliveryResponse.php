<?php

namespace App\Services\Src\API\Response\Shipping;

use App\Services\Src\API\Response\Response;

/**
 * Returns a reference ID of the scheduled delivery.
 *
 * Class ScheduledDeliveryResponse
 * @package App\Services\Src\API\Response
 */
class ScheduledDeliveryResponse extends Response
{
    private $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ScheduledDeliveryResponse
     */
    public function setId($id): ScheduledDeliveryResponse
    {
        $this->id = $id;
        return $this;
    }


    /**
     * @param object $obj
     * @return self
     */
    protected function parse($obj)
    {
        parent::parse($obj);

        return $this;
    }

    /**
     * @param object $obj
     * @return ScheduledDeliveryResponse
     */
    public static function make($obj)
    {
        return (new self())->parse($obj);
    }
}
