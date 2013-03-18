<?php
/**
 * SecurityMultiTool
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://github.com/padraic/SecurityMultiTool/blob/master/LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to padraic@php.net so we can send you a copy immediately.
 *
 * @category   SecurityMultiTool
 * @package    SecurityMultiTool
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2013 Pádraic Brady (http://blog.astrumfutura.com)
 * @license    http://github.com/padraic/SecurityMultiTool/blob/master/LICENSE New BSD License
 */

use SecurityMultiTool\Http\HttpsDetector;

class HttpsDetectorTest extends \PHPUnit_Framework_TestCase
{

    public function setup()
    {
        $this->server = $_SERVER;
    }

    public function teardown()
    {
        $_SERVER = $this->server;
    }

    public function testDetectorWorksWithHttpsSetTo1()
    {
        $_SERVER['HTTPS'] = 1;
        $this->assertTrue(HttpsDetector::isHttps());
    }

    public function testDetectorWorksWithHttpsSetToOn()
    {
        $_SERVER['HTTPS'] = 'on';
        $this->assertTrue(HttpsDetector::isHttps());
        $_SERVER['HTTPS'] = 'ON';
        $this->assertTrue(HttpsDetector::isHttps());
    }

    public function testDetectorWorksHttpXForwardedProtoSetToHttps()
    {
        $_SERVER['HTTP_X_FORWARDED_PROTO'] = 'https';
        $this->assertTrue(HttpsDetector::isHttps());
        $_SERVER['HTTP_X_FORWARDED_PROTO'] = 'HTTPS';
        $this->assertTrue(HttpsDetector::isHttps());
    }

    public function testDetectorWorksWithServerPortSetTo443()
    {
        $_SERVER['SERVER_PORT'] = 443;
        $this->assertTrue(HttpsDetector::isHttps());
    }

}