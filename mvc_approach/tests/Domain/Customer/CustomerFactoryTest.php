<?php


namespace Bookstore\Tests\Domain\Customer;

use Bookstore\Domain\Customer\CustomerFactory;
use Bookstore\Domain\Customer\Basic;
use PHPUnit_Framework_TestCase;

class CustomerFactoryTest extends PHPUnit_Framework_TestCase {

    public function testFactoryBasic() {

        $customer = CustomerFactory::factory(
            'basic', 1, 'han', 'solo', 'han@solo.com'
        );

        $expectedBasicCustomer = new Basic(1, 'han', 'solo', 'han@solo.com');

        $this->assertEquals(
            $customer,
            $expectedBasicCustomer,
            'Customer object is not as expected.'
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Wrong type.
     */
    public function testCreatingWrongTypeOfCustomer() {
        $customer = CustomerFactory::factory(
            'deluxe', 1, 'han', 'solo', 'han@solo.com'
        );
    }

    public function providerFactoryValidCustomerTypes() {
        return [
            'Basic customer, lowercase' => [
                'type' => 'basic',
                'expectedType' => '\Bookstore\Domain\Customer\Basic'
            ],
            'Basic customer, uppercase' => [
                'type' => 'BASIC',
                'expectedType' => '\Bookstore\Domain\Customer\Basic'
            ],
            'Premium customer, lowercase' => [
                'type' => 'premium',
                'expectedType' => '\Bookstore\Domain\Customer\Premium'
            ],
            'Premium customer, uppercase' => [
                'type' => 'PREMIUM',
                'expectedType' => '\Bookstore\Domain\Customer\Premium'
            ]
        ];
    }

    /**
     * @dataProvider providerFactoryValidCustomerTypes
     * @param string $type
     * @param string $expectedType
     */
    public function testFactoryValidCustomerTypes(string $type, string $expectedType) {

        $customer = CustomerFactory::factory(
            $type, 1, 'han', 'solo', 'han@solo.com'
        );
        $this->assertInstanceOf(
            $expectedType,
            $customer,
            'Factory created the wrong type of customer.'
        );
    }

}