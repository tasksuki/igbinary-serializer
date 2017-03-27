<?php

namespace Tasksuki\Component\IgbinarySerializer;

use RuntimeException;
use Tasksuki\Component\Message\Message;
use Tasksuki\Component\Serializer\SerializerInterface;
use Tasksuki\Component\Serializer\Exception\NotValidInputException;

/**
 * Class IgbinarySerializer
 *
 * @package Tasksuki\Component\IgbinarySerializer
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class IgbinarySerializer implements SerializerInterface
{
    /**
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        if (false === extension_loaded('igbinary')) {
            throw new RuntimeException('Extension `igbinary` is missing');
        }
    }

    /**
     * @param Message $message
     *
     * @return string
     */
    public function serialize(Message $message): string
    {
        return igbinary_serialize($message);
    }

    /**
     * @param string $data
     *
     * @return Message
     * @throws NotValidInputException
     */
    public function unserialize(string $data): Message
    {
        $message = @igbinary_unserialize($data);

        if (false === ($message instanceof Message)) {
            throw new NotValidInputException();
        }

        return $message;
    }

}