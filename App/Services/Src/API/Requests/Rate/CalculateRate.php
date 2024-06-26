<?php

namespace App\Services\Src\API\Requests\Rate;

use Exception;
use App\Services\Src\API\Classes\Address;
use App\Services\Src\API\Classes\ShipmentDetails;
use App\Services\Src\API\Interfaces\Normalize;
use App\Services\Src\API\Requests\API;
use App\Services\Src\API\Response\Rate\RateCalculatorResponse;

class CalculateRate extends API implements Normalize
{
    private $originalAddress;
    private $destinationAddress;
    private $shipmentDetails;
    private $preferredCurrencyCode;

    protected $live_wsdl;
    protected $test_wsdl;

    public function __construct()
    {
        $this->live_wsdl = config('aramex.live.rateURL');
        $this->test_wsdl = config('aramex.test.rateURL');
        parent::__construct();
    }

    /**
     * @return RateCalculatorResponse
     * @throws Exception
     */
    public function run()
    {
        $this->validate();

        return RateCalculatorResponse::make($this->soapClient->CalculateRate($this->normalize()));
    }

    protected function validate()
    {
        Parent::validate();

        if (!$this->originalAddress) {
            throw new Exception('Origin Address not provided');
        }

        if (!$this->destinationAddress) {
            throw new Exception('Destination Address not provided');
        }

        if (!$this->shipmentDetails) {
            throw new Exception('Shipment Details not provided');
        }
    }

    /**
     * @return Address
     */
    public function getOriginalAddress(): Address
    {
        return $this->originalAddress;
    }

    /**
     * To identify the desired physical shipment origin location details
     * and validates them to be a factor in rate calculation.
     *
     * @param Address $originalAddress
     * @return $this
     */
    public function setOriginalAddress(Address $originalAddress): CalculateRate
    {
        $this->originalAddress = $originalAddress;
        return $this;
    }

    /**
     * @return Address
     */
    public function getDestinationAddress(): Address
    {
        return $this->destinationAddress;
    }

    /**
     * To identify the desired shipment Destination location details
     * and validates them to be a factor in rate calculation.
     *
     * @param Address $destinationAddress
     * @return $this
     */
    public function setDestinationAddress(Address $destinationAddress): CalculateRate
    {
        $this->destinationAddress = $destinationAddress;
        return $this;
    }

    /**
     * @return ShipmentDetails
     */
    public function getShipmentDetails(): ShipmentDetails
    {
        return $this->shipmentDetails;
    }

    /**
     * Several aspects about the shipment some required to be filled,
     * other aspects are optional if the customer wished to include extra features.
     *
     * @param ShipmentDetails $shipmentDetails
     * @return $this
     */
    public function setShipmentDetails(ShipmentDetails $shipmentDetails): CalculateRate
    {
        $this->shipmentDetails = $shipmentDetails;
        return $this;
    }

    /**
     * @return string
     */
    public function getPreferredCurrencyCode(): ?string
    {
        return $this->preferredCurrencyCode;
    }

    /**
     * @param string $preferredCurrencyCode
     * @return $this
     */
    public function setPreferredCurrencyCode(string $preferredCurrencyCode): CalculateRate
    {
        $this->preferredCurrencyCode = $preferredCurrencyCode;
        return $this;
    }

    public function normalize(): array
    {
        return array_merge([
            'OriginAddress' => $this->getOriginalAddress()->normalize(),
            'DestinationAddress' => $this->getDestinationAddress()->normalize(),
            'ShipmentDetails' => $this->getShipmentDetails()->normalize(),
            'PreferredCurrencyCode' => $this->getPreferredCurrencyCode(),
        ], parent::normalize());
    }

}
