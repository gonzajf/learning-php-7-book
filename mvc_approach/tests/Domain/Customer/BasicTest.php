<?php

namespace Bookstore\Tests\Domain\Customer;

use Bookstore\Domain\Customer\Basic;
use PHPUnit_Framework_TestCase;

class BasicTest extends PHPUnit_Framework_TestCase {

    private $customer;

    public function setUp() {
        $this->customer = new Basic(
            1, 'han', 'solo', 'han@solo.com'
        );
    }

    public function testAmountToBorrow() {

        $this->assertSame(
            3,
            $this->customer->getAmountToBorrow(),
            'Basic customer should borrow up to 3 books.'
        );
    }
}