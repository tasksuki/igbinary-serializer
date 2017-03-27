<?php

namespace Tasksuki\Component\PhpSerializer\Test;

use Tasksuki\Component\IgbinarySerializer\IgbinarySerializer;
use Tasksuki\Component\Message\Message;
use PHPUnit\Framework\TestCase;

/**
 * Class IgbinarySerializerTest
 *
 * @package Tasksuki\Component\PhpSerializer\Test
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 *
 * @requires extension igbinary
 */
class IgbinarySerializerTest extends TestCase
{
    public function testSerialize()
    {
        $message = new Message();
        $message
            ->setData(['foo' => 'bar'])
            ->setName('foo_bar');

        $serializer = new IgbinarySerializer();

        $this->assertEquals($serializer->serialize($message), igbinary_serialize($message));
    }

    public function testUnserialize()
    {
        $expected = new Message();
        $expected
            ->setData(['foo' => 'bar'])
            ->setName('foo_bar');

        $given = igbinary_serialize($expected);

        $serializer = new IgbinarySerializer();

        $this->assertEquals($expected, $serializer->unserialize($given));
    }

    /**
     * @expectedException Tasksuki\Component\Serializer\Exception\NotValidInputException
     */
    public function testUnserializeFail()
    {
        $input = '$$';

        $serializer = new IgbinarySerializer();

        $this->setExpectedExceptionFromAnnotation();

        $serializer->unserialize($input);
    }
}
