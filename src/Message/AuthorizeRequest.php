<?php
namespace Omnipay\Braintree\Message;

use Braintree_Transaction;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Authorize Request
 *
 * @method Response send()
 */
class AuthorizeRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount', 'token');

        $data = [
            'amount' => $this->getAmount(),
            'billingAddressId' => $this->getBillingAddressId(),
            'channel' => $this->getChannel(),
            'customFields' => $this->getCustomFields(),
            'customerId' => $this->getCustomerId(),
            'descriptor' => $this->getDescriptor(),
            'deviceData' => $this->getDeviceData(),
            'deviceSessionId' => $this->getDeviceSessionId(),
            'merchantAccountId' => $this->getMerchantAccountId(),
            'options' => [
                'addBillingAddressToPaymentMethod' => $this->getAddBillingAddressToPaymentMethod(),
                'holdInEscrow' => $this->getHoldInEscrow(),
                'storeInVault' => $this->getStoreInVault(),
                'storeInVaultOnSuccess' => $this->getStoreInVaultOnSuccess(),
                'storeShippingAddressInVault' => $this->getStoreShippingAddressInVault(),
                'submitForSettlement' => false,
            ],
            'orderId' => $this->getTransactionId(),
            'paymentMethodNonce' => $this->getToken(),
            'purchaseOrderNumber' => $this->getPurchaseOrderNumber(),
            'recurring' => $this->getRecurring(),
            'shippingAddressId' => $this->getShippingAddressId(),
            'taxAmount' => $this->getTaxAmount(),
            'taxExempt' => $this->getTaxExempt(),
        ];

        $data += $this->getCardData();

        return $data;
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $response = Braintree_Transaction::sale($data);

        return $this->createResponse($response);
    }
}
