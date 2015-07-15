<?php

namespace Omnipay\Braintree\Message;

use Braintree_Configuration;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

/**
 * Abstract Request
 *
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    /**
     * Set the correct configuration sending
     *
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    public function send()
    {
        $this->configure();

        return parent::send();
    }

    public function configure()
    {
        // Reset to the initial state
        Braintree_Configuration::reset();

        // When in testMode, use the sandbox environment
        if ($this->getTestMode()) {
            Braintree_Configuration::environment('sandbox');
        } else {
            Braintree_Configuration::environment('production');
        }

        // Set the keys
        Braintree_Configuration::merchantId($this->getMerchantId());
        Braintree_Configuration::publicKey($this->getPublicKey());
        Braintree_Configuration::privateKey($this->getPrivateKey());
    }
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getPublicKey()
    {
        return $this->getParameter('publicKey');
    }

    public function setPublicKey($value)
    {
        return $this->setParameter('publicKey', $value);
    }

    public function getPrivateKey()
    {
        return $this->getParameter('privateKey');
    }

    public function setPrivateKey($value)
    {
        return $this->setParameter('privateKey', $value);
    }

    public function getBillingAddressId()
    {
        return $this->getParameter('billingAddressId');
    }

    public function setBillingAddressId($value)
    {
        return $this->setParameter('billingAddressId', $value);
    }

    public function getChannel()
    {
        return $this->getParameter('channel');
    }

    public function setChannel($value)
    {
        return $this->setParameter('channel', $value);
    }

    public function getCustomFields()
    {
        return $this->getParameter('customFields');
    }

    public function setCustomFields($value)
    {
        return $this->setParameter('customFields', $value);
    }

    public function getCustomerId()
    {
        return $this->getParameter('customerId');
    }

    public function setCustomerId($value)
    {
        return $this->setParameter('customerId', $value);
    }

    public function getDescriptor()
    {
        return $this->getParameter('descriptor');
    }

    public function setDescriptor($value)
    {
        return $this->setParameter('descriptor', $value);
    }

    public function getDeviceData()
    {
        return $this->getParameter('deviceData');
    }

    public function setDeviceData($value)
    {
        return $this->setParameter('deviceData', $value);
    }

    public function getDeviceSessionId()
    {
        return $this->getParameter('deviceSessionId');
    }

    public function setDeviceSessionId($value)
    {
        return $this->setParameter('deviceSessionId', $value);
    }

    public function getMerchantAccountId()
    {
        return $this->getParameter('merchantAccountId');
    }

    public function setMerchantAccountId($value)
    {
        return $this->setParameter('merchantAccountId', $value);
    }

    public function getRecurring()
    {
        return $this->getParameter('recurring');
    }

    public function setRecurring($value)
    {
        return $this->setParameter('recurring', (bool) $value);
    }

    public function getAddBillingAddressToPaymentMethod()
    {
        return $this->getParameter('addBillingAddressToPaymentMethod');
    }

    public function setAddBillingAddressToPaymentMethod($value)
    {
        return $this->setParameter('addBillingAddressToPaymentMethod', (bool) $value);
    }

    public function getHoldInEscrow()
    {
        return $this->getParameter('holdInEscrow');
    }

    public function setHoldInEscrow($value)
    {
        return $this->setParameter('holdInEscrow', (bool) $value);
    }

    public function getStoreInVault()
    {
        return $this->getParameter('storeInVault');
    }

    public function setStoreInVault($value)
    {
        return $this->setParameter('storeInVault', (bool) $value);
    }

    public function getStoreInVaultOnSuccess()
    {
        return $this->getParameter('storeInVaultOnSuccess');
    }

    public function setStoreInVaultOnSuccess($value)
    {
        return $this->setParameter('storeInVaultOnSuccess', (bool) $value);
    }

    public function getStoreShippingAddressInVault()
    {
        return $this->getParameter('storeShippingAddressInVault');
    }

    public function setStoreShippingAddressInVault($value)
    {
        return $this->setParameter('storeShippingAddressInVault', (bool) $value);
    }

    public function getShippingAddressId()
    {
        return $this->getParameter('shippingAddressId');
    }

    public function setShippingAddressId($value)
    {
        return $this->setParameter('shippingAddressId', $value);
    }

    public function getPurchaseOrderNumber()
    {
        return $this->getParameter('purchaseOrderNumber');
    }

    public function setPurchaseOrderNumber($value)
    {
        return $this->setParameter('purchaseOrderNumber', $value);
    }

    public function getTaxAmount()
    {
        return $this->getParameter('taxAmount');
    }

    public function setTaxAmount($value)
    {
        return $this->setParameter('taxAmount', $value);
    }

    public function getTaxExempt()
    {
        return $this->getParameter('taxExempt');
    }

    public function setTaxExempt($value)
    {
        return $this->setParameter('taxExempt', (bool) $value);
    }

    /**
     * @return array
     */
    protected function getCardData()
    {
        $card = $this->getCard();

        if (!$card) {
            return array();
        }

        return array(
            'billing' => array(
                'company' => $card->getBillingCompany(),
                'firstName' => $card->getBillingFirstName(),
                'lastName' => $card->getBillingLastName(),
                'streetAddress' => $card->getBillingAddress1(),
                'extendedAddress' =>  $card->getBillingAddress2(),
                'locality' => $card->getBillingCity(),
                'postalCode' => $card->getBillingPostcode(),
                'region' => $card->getBillingState(),
                'countryName' => $card->getBillingCountry(),
            ),
            'shipping' => array(
              'company' => $card->getShippingCompany(),
              'firstName' => $card->getShippingFirstName(),
              'lastName' => $card->getShippingLastName(),
              'streetAddress' => $card->getShippingAddress1(),
              'extendedAddress' =>  $card->getShippingAddress2(),
              'locality' => $card->getShippingCity(),
              'postalCode' => $card->getShippingPostcode(),
              'region' => $card->getShippingState(),
              'countryName' => $card->getShippingCountry(),
            )
        );
    }

    protected function createResponse($data)
    {
        return $this->response = new Response($this, $data);
    }
}
