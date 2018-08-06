<?php namespace Signal;

use Signal\Enums\EndPoint;
use Signal\Enums\MessageType;

class TextMessageBase
{
    /**
     * @var string $username
     */
    private $username;
    /**
     * @var string $password
     */
    private $password;
    /**
     * @var string $fromNumber
     */
    private $fromNumber;
    /**
     * @var string $messageType
     */
    protected $messageType = MessageType::NORMAL;
    /**
     * @var \SoapClient $client
     */
    protected $client = null;

    /**
     * TextMessage constructor.
     * @param string $user
     * @param string $pass
     * @param string $from
     */
    public function __construct($user, $pass, $from)
    {
        $this->setUsername($user);
        $this->setPassword($pass);
        $this->setFromNumber($from);
        $this->setEndPoint();
    }

    /**
     * @param string $user
     */
    private function setUsername($user)
    {

        $this->username = strtolower($user);
    }

    /**
     * @param string $pass
     */
    private function setPassword($pass)
    {

        $this->password = md5($pass);
    }

    /**
     * @param string $from
     */
    private function setFromNumber($from)
    {

        $this->fromNumber = $from;
    }

    /**
     * @param integer $type
     */
    public function setMessageType($type)
    {
        $this->messageType = $type;
    }

    /**
     * @param string $endPoint
     */
    public function setEndPoint($endPoint = EndPoint::SOAP)
    {
        $this->client = new \SoapClient($endPoint, ['encoding' => 'UTF-8']);
    }


    /**
     * Send single message
     *
     * @param $text
     * @param $number
     * @return mixed
     */
    protected function sendSingle($text, $number)
    {
        $result = $this->client->SendSMS(
            $this->fromNumber,
            $number,
            $text,
            $this->messageType,
            $this->username,
            $this->password);

        return $result;
    }

    /**
     * @param array $texts
     * @param array $numbers
     * @return mixed
     */
    protected function sendMultiText($texts, $numbers)
    {
        $froms = $types = [];
        foreach ($numbers as $number) {
            $froms[] = $this->fromNumber;
            $types[] = $this->messageType;
        }
        $result = $this->client->SendMultiSMS(
            $froms,
            $numbers,
            $texts,
            $types,
            $this->username,
            $this->password);

        return $result;
    }

    /**
     * @param array $ids
     * @return mixed
     */
    protected function checkStatus($ids)
    {
        $result = $this->client->GetStatus(
            $this->username,
            $this->password,
            $ids);

        $return = [];
        if(count($result) == count($ids) && count($result)>1) {
            foreach ($ids as $index => $id) {
                $return[$id] = $result[$index];
            }
        } else {
            $return = $result;
        }

        return $return;
    }

    /**
     * @return mixed
     */
    protected function checkCredit()
    {
        $result = $this->client->GetCredit(
            $this->username,
            $this->password);

        return $result;
    }
}