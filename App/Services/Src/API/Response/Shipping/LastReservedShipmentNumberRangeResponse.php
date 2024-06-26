<?php

namespace App\Services\Src\API\Response\Shipping;

use App\Services\Src\API\Response\Response;

/**
 * Returns the last range reserved.
 *
 * Class LastReservedShipmentNumberRangeResponse
 * @package App\Services\Src\API\Response
 */
class LastReservedShipmentNumberRangeResponse extends Response
{
    private $fromWayBill;
    private $toWayBill;

    /**
     * @return string
     */
    public function getFromWayBill(): string
    {
        return $this->fromWayBill;
    }

    /**
     * @param string $fromWayBill
     * @return LastReservedShipmentNumberRangeResponse
     */
    public function setFromWayBill(string $fromWayBill): LastReservedShipmentNumberRangeResponse
    {
        $this->fromWayBill = $fromWayBill;
        return $this;
    }

    /**
     * @return string
     */
    public function getToWayBill(): string
    {
        return $this->toWayBill;
    }

    /**
     * @param string $toWayBill
     * @return LastReservedShipmentNumberRangeResponse
     */
    public function setToWayBill($toWayBill): LastReservedShipmentNumberRangeResponse
    {
        $this->toWayBill = $toWayBill;
        return $this;
    }

    /**
     * @param object $obj
     * @return self
     */
    protected function parse($obj)
    {
        parent::parse($obj);

        $this->setFromWayBill($obj->FromWayBill);
        $this->setToWayBill($obj->ToWayBill);

        return $this;
    }

    /**
     * @param object $obj
     * @return LastReservedShipmentNumberRangeResponse
     */
    public static function make($obj)
    {
        return (new self())->parse($obj);
    }
}
