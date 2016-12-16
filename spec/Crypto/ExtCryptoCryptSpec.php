<?php

namespace spec\Cmnty\Push\Crypto;

use Cmnty\Push\Crypto\Cipher;
use Cmnty\Push\Crypto\ContentEncryptionKey;
use Cmnty\Push\Crypto\Crypt;
use Cmnty\Push\Crypto\Exception\UnsupportedEncryptionMethod;
use Cmnty\Push\Crypto\ExtCryptoCrypt;
use Cmnty\Push\Crypto\Nonce;
use Cmnty\Push\Crypto\PublicKey;
use Cmnty\Push\Crypto\Salt;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExtCryptoCryptSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ExtCryptoCrypt::class);
    }

    function it_should_implement_crypt()
    {
        $this->shouldImplement(Crypt::class);
    }

    function it_should_encrypt_a_string(ContentEncryptionKey $contentEncryptionKey, Nonce $nonce, Salt $salt, PublicKey $publicKey)
    {
        if (PHP_VERSION_ID >= 70100 && version_compare(phpversion('crypto'), '0.3.0', '<')) {
            $this->shouldThrow(UnsupportedEncryptionMethod::class)->duringInstantiation();

            return;
        }

        $contentEncryptionKey->getRawKeyMaterial()->willReturn(base64_decode('1478s12rIuzznquRpokhdw'));
        $nonce->getRawBytes()->willReturn(base64_decode('QN6zugACy0bYogh8'));
        $salt->getRawBytes()->willReturn(base64_decode('Cv0fRYvjK3xSDOxPkRXtlg'));
        $publicKey->getRawKeyMaterial()->willReturn(base64_decode('BP4SlAJQhcxGYerW3gZusOx5osiRvkn0Q79CTiXbOPP9QH6l//17D3MkAdhx6GEytbLVQRtVO6xeb8XuaP7qzeA'));

        $this->encrypt(
            Argument::type('string'),
            $contentEncryptionKey,
            $nonce,
            $salt,
            $publicKey
        )->shouldReturnAnInstanceOf(Cipher::class);
    }
}
