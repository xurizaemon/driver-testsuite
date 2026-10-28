<?php

namespace Behat\Mink\Tests\Driver\Basic;

use Behat\Mink\Tests\Driver\TestCase;

final class StatusCodeTest extends TestCase
{
    public function testStatuses(): void
    {
        $this->getSession()->visit($this->pathTo('/index.html'));

        $this->assertEquals(200, $this->getSession()->getStatusCode());
        $this->assertEquals($this->pathTo('/index.html'), $this->getSession()->getCurrentUrl());

        $this->getSession()->visit($this->pathTo('/404.php'));

        $this->assertEquals($this->pathTo('/404.php'), $this->getSession()->getCurrentUrl());
        $this->assertEquals(404, $this->getSession()->getStatusCode());
        $this->assertStringContainsString('Sorry, page not found', $this->getSession()->getPage()->getContent());

        // Returned status code should be the visited, not a later document response.
        $this->getSession()->visit($this->pathTo('/iframe_404.html'));
        $this->assertEquals(200, $this->getSession()->getStatusCode());
        $this->assertEquals($this->pathTo('/iframe_404.html'), $this->getSession()->getCurrentUrl());
    }

}
