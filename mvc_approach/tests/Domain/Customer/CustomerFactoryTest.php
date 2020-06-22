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

}