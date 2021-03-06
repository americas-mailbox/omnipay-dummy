<?php
namespace Omnipay\Dummy\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Dummy Authorize/Purchase Request
 *
 * This is the request that will be called for any transaction which submits a card reference for purchase,
 * including `authorize` and `purchase`
 */
class PurchaseCardRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount', 'cardReference');

        return array('amount' => $this->getAmount(), 'cardReference' => $this->getCardReference());
    }

    public function sendData($data)
    {
        $data['reference'] = uniqid();
        $data['success'] = $this->getCardReference()?true:false;
        $data['message'] = $data['success'] ? 'Success' : 'Failure';

        return $this->response = new Response($this, $data);
    }
}
