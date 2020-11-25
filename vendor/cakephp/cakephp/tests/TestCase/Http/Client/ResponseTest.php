<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         3.0.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\Test\TestCase\Http\Client;

use Cake\Http\Client\Response;
use Cake\Http\Cookie\CookieCollection;
use Cake\TestSuite\TestCase;

/**
 * HTTP response test.
 */
class ResponseTest extends TestCase
{
    /**
     * Test parsing headers and reading with PSR7 methods.
     *
     * @return void
     */
    public function testHeaderParsingPsr7()
    {
        $headers = [
            'HTTP/1.0 200 OK',
            'Content-Type : text/html;charset="UTF-8"',
            'date: Tue, 25 Dec 2012 04:43:47 GMT',
        ];
        $response = new Response($headers, 'winner!');

        $this->assertEquals('1.0', $response->getProtocolVersion());
        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals('OK', $response->getReasonPhrase());
        $this->assertEquals(
            'text/html;charset="UTF-8"',
            $response->getHeaderLine('content-type')
        );
        $this->assertEquals(
            'Tue, 25 Dec 2012 04:43:47 GMT',
            $response->getHeaderLine('Date')
        );
        $this->assertEquals('winner!', '' . $response->getBody());
    }

    /**
     * Test parsing headers and capturing content
     *
     * @return void
     */
    public function testHeaderParsing()
    {
        $headers = [
            'HTTP/1.0 200 OK',
            'Content-Type : text/html;charset="UTF-8"',
            'date: Tue, 25 Dec 2012 04:43:47 GMT',
        ];
        $response = new Response($headers, 'ok');

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals('1.0', $response->getProtocolVersion());
        $this->assertEquals(
            'text/html;charset="UTF-8"',
            $response->getHeaderLine('content-type')
        );
        $this->assertEquals(
            'Tue, 25 Dec 2012 04:43:47 GMT',
            $response->getHeaderLine('Date')
        );

        $this->assertEquals(
            'text/html;charset="UTF-8"',
            $response->getHeaderLine('Content-Type')
        );

        $headers = [
            'HTTP/1.0 200',
        ];
        $response = new Response($headers, 'ok');

        $this->assertEquals('1.0', $response->getProtocolVersion());
        $this->assertSame(200, $response->getStatusCode());
    }

    /**
     * Test body()
     *
     * @return void
     */
    public function testBody()
    {
        $this->deprecated(function () {
            $data = [
                'property' => 'value',
            ];
            $encoded = json_encode($data);

            $response = new Response([], $encoded);

            $this->assertEquals($encoded, $response->getBody()->getContents());
            $this->assertEquals($encoded, $response->body());

            $result = $response->body('json_decode');
            $this->assertEquals($data['property'], $result->property);
            $stream = $response->getBody();
            $stream->rewind();
            $this->assertEquals($encoded, $stream->getContents());
        });
    }

    /**
     * Test getStringBody()
     *
     * @return void
     */
    public function getStringBody()
    {
        $response = new Response([], 'string');

        $this->assertEquals('string', $response->getStringBody());
    }

    /**
     * Test accessor for json
     *
     * @return void
     */
    public function testBodyJson()
    {
        $data = [
            'property' => 'value',
        ];
        $encoded = json_encode($data);
        $response = new Response([], $encoded);
        $this->assertEquals($data['property'], $response->getJson()['property']);

        $data = '';
        $response = new Response([], $data);
        $this->assertNull($response->getJson());

        $data = json_encode([]);
        $response = new Response([], $data);
        $this->assertInternalType('array', $response->getJson());

        $data = json_encode(null);
        $response = new Response([], $data);
        $this->assertNull($response->getJson());

        $data = json_encode(false);
        $response = new Response([], $data);
        $this->assertFalse($response->getJson());

        $data = json_encode('');
        $response = new Response([], $data);
        $this->assertSame('', $response->getJson());
    }

    /**
     * Test accessor for json when set with PSR7 methods.
     *
     * @return void
     */
    public function testBodyJsonPsr7()
    {
        $data = [
            'property' => 'value',
        ];
        $encoded = json_encode($data);
        $response = new Response([], '');
        $response->getBody()->write($encoded);
        $this->assertEquals($data, $response->getJson());
    }

    /**
     * Test accessor for xml
     *
     * @return void
     */
    public function testBodyXml()
    {
        $data = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
	<test>Test</test>
</root>
XML;
        $response = new Response([], $data);
        $this->assertEquals('Test', (string)$response->getXml()->test);

        $data = '';
        $response = new Response([], $data);
        $this->assertNull($response->getXml());
    }

    /**
     * Test isOk()
     *
     * @return void
     */
    public function testIsOk()
    {
        $headers = [
            'HTTP/1.1 200 OK',
            'Content-Type: text/html',
        ];
        $response = new Response($headers, 'ok');
        $this->assertTrue($response->isOk());

        $headers = [
            'HTTP/1.1 201 Created',
            'Content-Type: text/html',
        ];
        $response = new Response($headers, 'ok');
        $this->assertTrue($response->isOk());

        $headers = [
            'HTTP/1.1 202 Accepted',
            'Content-Type: text/html',
        ];
        $response = new Response($headers, 'ok');
        $this->assertTrue($response->isOk());

        $headers = [
            'HTTP/1.1 203 Non-Authoritative Information',
            'Content-Type: text/html',
        ];
        $response = new Response($headers, 'ok');
        $this->assertTrue($response->isOk());

        $headers = [
            'HTTP/1.1 204 No Content',
            'Content-Type: text/html',
        ];
        $response = new Response($headers, 'ok');
        $this->assertTrue($response->isOk());

        $headers = [
            'HTTP/1.1 301 Moved Permanently',
            'Content-Type: text/html',
        ];
        $response = new Response($headers, '');
        $this->assertFalse($response->isOk());

        $headers = [
            'HTTP/1.0 404 Not Found',
            'Content-Type: text/html',
        ];
        $response = new Response($headers, '');
        $this->assertFalse($response->isOk());
    }

    /**
     * Test isSuccess()
     *
     * @return void
     */
    public function testIsSuccess()
    {
        $headers = [
            'HTTP/1.1 200 OK',
            'Content-Type: text/html',
        ];
        $response = new Response($headers, 'ok');
        $this->assertTrue($response->isSuccess());

        $headers = [
            'HTTP/1.1 201 Created',
            'Content-Type: text/html',
        ];
        $response = new Response($headers, 'ok');
        $this->assertTrue($response->isSuccess());

        $headers = [
            'HTTP/1.1 202 Accepted',
            'Content-Type: text/html',
        ];
        $response = new Response($headers, 'ok');
        $this->assertTrue($response->isSuccess());

        $headers = [
            'HTTP/1.1 203 Non-Authoritative Information',
            'Content-Type: text/html',
        ];
        $response = new Response($headers, 'ok');
        $this->assertTrue($response->isSuccess());

        $headers = [
            'HTTP/1.1 204 No Content',
            'Content-Type: text/html',
        ];
        $response = new Response($headers);
        $this->assertTrue($response->isSuccess());

        $headers = [
            'HTTP/1.1 301 Moved Permanently',
            'Content-Type: text/html',
        ];
        $response = new Response($headers, '');
        $this->assertFalse($response->isSuccess());

        $headers = [
            'HTTP/1.1 404 Not Found',
            'Content-Type: text/html',
        ];
        $response = new Response($headers, '');
        $this->assertFalse($response->isSuccess());

        $headers = [
            'HTTP/1.1 500 Internal Server Error',
            'Content-Type: text/html',
        ];
        $response = new Response($headers, '');
        $this->assertFalse($response->isSuccess());
    }

    /**
     * Test isRedirect()
     *
     * @return void
     */
    public function testIsRedirect()
    {
        $headers = [
            'HTTP/1.1 200 OK',
            'Content-Type: text/html',
        ];
        $response = new Response($headers, 'ok');
        $this->assertFalse($response->isRedirect());

        $headers = [
            'HTTP/1.1 301 Moved Permanently',
            'Location: /',
            'Content-Type: text/html',
        ];
        $response = new Response($headers, '');
        $this->assertTrue($response->isRedirect());

        $headers = [
            'HTTP/1.0 404 Not Found',
            'Content-Type: text/html',
        ];
        $response = new Response($headers, '');
        $this->assertFalse($response->isRedirect());
    }

    /**
     * Test parsing / getting cookies.
     *
     * @group deprecated
     * @return void
     */
    public function testCookie()
    {
        $this->deprecated(function () {
            $headers = [
                'HTTP/1.0 200 Ok',
                'Set-Cookie: test=value',
                'Set-Cookie: session=123abc',
                'Set-Cookie: expiring=soon; Expires=Wed, 09-Jun-2021 10:18:14 GMT; Path=/; HttpOnly; Secure;',
            ];
            $response = new Response($headers, '');
            $this->assertEquals('value', $response->cookie('test'));
            $this->assertEquals('123abc', $response->cookie('session'));
            $this->assertEquals('soon', $response->cookie('expiring'));

            $result = $response->cookie('expiring', true);
            $this->assertTrue($result['httponly']);
            $this->assertTrue($result['secure']);
            $this->assertEquals(
                'Wed, 09-Jun-2021 10:18:14 GMT',
                $result['expires']
            );
            $this->assertEquals('/', $result['path']);

            $result = $response->header('set-cookie');
            $this->assertCount(3, $result, 'Should be an array.');

            $this->assertTrue(isset($response->cookies));
            $this->assertEquals(
                'soon',
                $response->cookies['expiring']['value']
            );
        });
    }

    /**
     * Test accessing cookies through the PSR7-like methods
     *
     * @return void
     */
    public function testGetCookies()
    {
        $headers = [
            'HTTP/1.0 200 Ok',
            'Set-Cookie: test=value',
            'Set-Cookie: session=123abc',
            'Set-Cookie: expiring=soon; Expires=Wed, 09-Jun-2021 10:18:14 GMT; Path=/; HttpOnly; Secure;',
        ];
        $response = new Response($headers, '');

        $this->assertNull($response->getCookie('undef'));
        $this->assertEquals('value', $response->getCookie('test'));
        $this->assertEquals('soon', $response->getCookie('expiring'));

        $result = $response->getCookieData('expiring');
        $this->assertEquals('soon', $result['value']);
        $this->assertTrue($result['httponly']);
        $this->assertTrue($result['secure']);
        $this->assertEquals(
            'Wed, 09-Jun-2021 10:18:14 GMT',
            $result['expires']
        );
        $this->assertEquals('/', $result['path']);

        $result = $response->getCookies();
        $this->assertCount(3, $result);
        $this->assertArrayHasKey('test', $result);
        $this->assertArrayHasKey('session', $result);
        $this->assertArrayHasKey('expiring', $result);
    }

    /**
     * Test accessing cookie collection
     *
     * @return void
     */
    public function testGetCookieCollection()
    {
        $headers = [
            'HTTP/1.0 200 Ok',
            'Set-Cookie: test=value',
            'Set-Cookie: session=123abc',
            'Set-Cookie: expiring=soon; Expires=Wed, 09-Jun-2021 10:18:14 GMT; Path=/; HttpOnly; Secure;',
        ];
        $response = new Response($headers, '');

        $cookies = $response->getCookieCollection();
        $this->assertInstanceOf(CookieCollection::class, $cookies);
        $this->assertTrue($cookies->has('test'));
        $this->assertTrue($cookies->has('session'));
        $this->assertTrue($cookies->has('expiring'));
        $this->assertSame('123abc', $cookies->get('session')->getValue());
    }

    /**
     * Test statusCode()
     *
     * @return void
     */
    public function testGetStatusCode()
    {
        $headers = [
            'HTTP/1.0 404 Not Found',
            'Content-Type: text/html',
        ];
        $response = new Response($headers, '');
        $this->assertSame(404, $response->getStatusCode());

        $this->deprecated(function () use ($response) {
            $this->assertSame(404, $response->code);
            $this->assertTrue(isset($response->code));
        });
    }

    /**
     * Test statusCode()
     *
     * @group deprecated
     * @return void
     */
    public function testStatusCode()
    {
        $this->deprecated(function () {
            $headers = [
                'HTTP/1.0 404 Not Found',
                'Content-Type: text/html',
            ];
            $response = new Response($headers, '');
            $this->assertSame(404, $response->statusCode());
            $this->assertSame(404, $response->code);
            $this->assertTrue(isset($response->code));
        });
    }

    /**
     * Test reading the encoding out.
     *
     * @return void
     */
    public function testGetEncoding()
    {
        $headers = [
            'HTTP/1.0 200 Ok',
        ];
        $response = new Response($headers, '');
        $this->assertNull($response->getEncoding());

        $headers = [
            'HTTP/1.0 200 Ok',
            'Content-Type: text/html',
        ];
        $response = new Response($headers, '');
        $this->assertNull($response->getEncoding());

        $headers = [
            'HTTP/1.0 200 Ok',
            'Content-Type: text/html; charset="UTF-8"',
        ];
        $response = new Response($headers, '');
        $this->assertEquals('UTF-8', $response->getEncoding());

        $headers = [
            'HTTP/1.0 200 Ok',
            "Content-Type: text/html; charset='ISO-8859-1'",
        ];
        $response = new Response($headers, '');
        $this->assertEquals('ISO-8859-1', $response->getEncoding());
    }

    /**
     * Test reading the encoding out.
     *
     * @group deprecated
     * @return void
     */
    public function testEncoding()
    {
        $this->deprecated(function () {
            $headers = [
                'HTTP/1.0 200 Ok',
            ];
            $response = new Response($headers, '');
            $this->assertNull($response->encoding());

            $headers = [
                'HTTP/1.0 200 Ok',
                'Content-Type: text/html',
            ];
            $response = new Response($headers, '');
            $this->assertNull($response->encoding());

            $headers = [
                'HTTP/1.0 200 Ok',
                'Content-Type: text/html; charset="UTF-8"',
            ];
            $response = new Response($headers, '');
            $this->assertEquals('UTF-8', $response->encoding());

            $headers = [
                'HTTP/1.0 200 Ok',
                "Content-Type: text/html; charset='ISO-8859-1'",
            ];
            $response = new Response($headers, '');
            $this->assertEquals('ISO-8859-1', $response->encoding());
        });
    }

    /**
     * Test that gzip responses are automatically decompressed.
     *
     * @return void
     */
    public function testAutoDecodeGzipBody()
    {
        $headers = [
            'HTTP/1.0 200 OK',
            'Content-Encoding: gzip',
            'Content-Length: 32',
            'Content-Type: text/html; charset=UTF-8',
        ];
        $body = base64_decode('H4sIAAAAAAAAA/NIzcnJVyjPL8pJUQQAlRmFGwwAAAA=');
        $response = new Response($headers, $body);
        $this->assertEquals('Hello world!', $response->getBody()->getContents());
    }
}
