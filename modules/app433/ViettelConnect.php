<?php

/**
 * Created by PhpStorm.
 * User: Hoàng
 * Date: 18/07/2016
 * Time: 5:26 CH
 */
class ViettelConnect
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    private function getRequestId()
    {
        return date('ymdHis');
    }

    private function getResponse($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["HTTP_X-Forwarded-For" => "27.67.43.123"]);
        $result = curl_exec($ch);
        curl_close($ch);
        var_dump($result);
    }

    public function onCheckisdn()
    {
        try {
            $subServiceId = $this->config['Sub']['Daily']['Live']['Code'];
            $requestId = $this->config['CpCode'] . $this->getRequestId();
            $session = session_id();
            $input = "SUB=" . $subServiceId . "&REQ=" . $requestId . "&SOURCE=WAP&SESS=" . $session;
            $AES_Key = EncryptManager::AESKeyGen();
            $value = "value=" . EncryptManager::encryptAES($input, $AES_Key) . "&key=" . $AES_Key;
            $privateKey = EncryptManager::getPrivateKey($this->config['Key']['privateCp']);
            $publicKey = EncryptManager::getPublicKey($this->config['Key']['publicVT']);
            $data = EncryptManager::encryptRSA($value, $publicKey);
            $sign = EncryptManager::createMsgSignature($data, $privateKey);
            $finalUrl = $this->config['Url']['Detect'] . '?PRO=' . $this->config['ProviderId'] . '&SER=' . $this->config['ServiceId'] . '&SUB=' . $subServiceId . "&DATA=" . urlencode($data) . "&SIG=" . urlencode($sign);
            header("Location: $finalUrl");
            die;
        } catch (ErrorException $e) {
            echo 'Đã có lỗi xảy ra. Chi tiết: ' . $e->getMessage();
        }
    }

    public function onCheckDangKy()
    {

    }

    public function test()
    {
        $data="DATA=APHFHR0vs7da/PgzvsyEMyK/LgkUB7vv5QBTjHLQOfN4XMfPnyB6ATJnTk7nDzC7QbVuU0hsZcv4CpMLmvfQU4kW5LbMhx5pMJYypu4odBdDSQNtzp46MissnhVK31OAS5/qu7Z/I6DmGiKW9Iz09S0kwK3DIHyKcUom3cVCMK+qQ1NuNe3w+xPwZWJA4MTD03+EK1OTTk1rLSeZURVhsGcctxLwFcrN9OR/ktc1lhvSpJOB0w/pVp+3TzK8VQaVrFz8I+771UtepNeG0T/B0Rm+ewJcE9HfI+5YL+dUOWHLxpEG0zJV1Jn21HH2CycV2ukZNk7ZWqzGQ3tyEY/80rdjwLz+qTh7eJgFh7Ed7ck35NxmfK71fOLxhyy3ILnDo0l91fOWwP2MjDksA4bADCFfE7H03AJxE559sVNIs53aAE6vU4qtoQ35dy9Qtm8jJZidhThze9R+Kcx88igg3ND1/5VOlZRA3V1/1eSfnNnHywLvpuQnj3dEOiKbDChybMEa8djnW/hCoV+7pwMnjJ06wl5cLce3i05ZTXptIvD+fXNTbT1i7SA3PdtC3Gxbw57H4ZlNkVr4A6gRRnE8G5PrrPflT5s4Vpx47cPerXCz17vpcAIjpDMcbDR8+MOgb7FKCnnmqtSXuuYtuSWsaT4PLTeCJ8xtueO0tfKhFJo=&SIG=eZaPl1uP3SU%2BBr5cTWZSHhpfCj5Wm7SkEYLwek%2F7USS%2F%2B15tyM1Sh6ESBhdXUHzOYHqE7aBlwkgqB0m7dLKKYSf26k7MlewBFhnBkjPu%2B%2FtcVSmwRfC0gtaqUGQ%2FTe%2FAQ%2BuKHS%2BVh3Fz0m4BCTrNKRd2n1nf7K3bMp9nZpZaSv9B%2FsguSzo6cU2APv07nCrB6g5U%2FMQEnaYfWnGJaqpM%2BtX3nZspkZQ4K8wHUlkgxv2mPNV55D0Gkkm2avjUFLKPvfBp%2F7B54j2Ty2tlPhKHY7%2B7xuQaucNTPrilxAzsgLYOLM5RHl2JXMSt8TJlCnSV3gIK1m1RZ6vSyLUax9d7NfHlmrHUVgrf2RXkcsCQXgYdUpgPQtIXJYEgnegGsOW8dE4FtnM5LcdJuSZ8UHBnfiFWv%2F0bM%2Fzqu9Vpsq7wpyFSbwBojI88fJNC%2BEERWX9YLvu4jhgR4Q%2BXdaVR2gzoLCStPGcD7yYAp%2FMy4BDIl73RAa6O2jIlZepq1ifF8Jm0ZADEnOqOuwA8B%2BKMsEeHAed2jna7qMc4TxZNxTcuB2qkytFq%2FUgjRzTeDTlcY3H9kNLWPC6vwjt%2BfydSvfAEb6thUN574cakDOBFfkTrTqobv1e7nRBrHzUIU0Dx1PeI%2FaJedjGAGo%2Bwan%2FFacjznxn1qy%2F9NqT0tNcHeOM7qsc%3D";
        $privateKey=EncryptManager::getPrivateKey($this->config['Key']['privateCp']);
        $VASResponse=new VASResponse($data,$privateKey);
        var_dump($VASResponse);
        var_dump($VASResponse->getREQ());
        var_dump($VASResponse->getRES());
        var_dump($VASResponse->getMOBILE());
        var_dump($VASResponse->getPRICE());
        var_dump($VASResponse->getCMD());
        var_dump($VASResponse->getSOURCE());
    }

}