<?php

class ProductTest extends TestCase {
    public function testRequestWhenValidShouldIssueRequest() {
        CurlMock::register("https://api.tinify.com/", array("status" => 200));
        $client = new Tinify\Client("key");
        $client->request("get", "/");
        $this->assertSame("https://api.tinify.com/", CurlMock::last(CURLOPT_URL));
        $this->assertSame("api:key", CurlMock::last(CURLOPT_USERPWD));
    }
    public function testRequestWhenValidShouldIssueRequestWithoutBodyWhenOptionsAreEmpty() {
        CurlMock::register("https://api.tinify.com/", array("status" => 200));
        $client = new Tinify\Client("key");
        $client->request("get", "/", array());
        $this->assertFalse(CurlMock::last_has(CURLOPT_POSTFIELDS));
    }
    public function testRequestWhenValidShouldIssueRequestWithoutContentTypeWhenOptionsAreEmpty() {
        CurlMock::register("https://api.tinify.com/", array("status" => 200));
        $client = new Tinify\Client("key");
        $client->request("get", "/", array());
        $this->assertFalse(CurlMock::last_has(CURLOPT_HTTPHEADER));
    }

}