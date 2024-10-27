<?php

describe('store', function () {
    it('validates the name should not contain non-English characters', function () {
        $response = $this->postJson('/api/orders', [
            'name' => '圓山飯店',
        ]);

        $response->assertStatus(400);
        $response->assertExactJson(["Name contains non-English characters."]);
    });

    it('validates name must only contain English letters, with each word starting with an uppercase letter.', function () {
        $response = $this->postJson('/api/orders', [
            'name' => 'Melody Holiday lnn',
        ]);

        $response->assertStatus(400);
        $response->assertExactJson(['Name is not capitalized.']);
    });

    it('validates the price should be a decimal', function () {
        $response = $this->postJson('/api/orders', [
            'name' => 'Melody Holiday Lnn',
            'price' => '100.001',
        ]);

        $response->assertStatus(400);
        $response->assertExactJson(['Price is invalid.']);
    });

    it('validates the price should not more than 2000', function () {
        $response = $this->postJson('/api/orders', [
            'name' => 'Melody Holiday Lnn',
            'price' => '2001',
        ]);

        $response->assertStatus(400);
        $response->assertExactJson(['Price is over 2000.']);
    });

    it('validates the price should be a positive number', function () {
        $response = $this->postJson('/api/orders', [
            'name' => 'Melody Holiday Lnn',
            'price' => -1,
        ]);

        $response->assertStatus(400);
        $response->assertExactJson(['Price is less than 0.']);
    });

    it('validates the price should be more than 0', function () {
        $response = $this->postJson('/api/orders', [
            'name' => 'Melody Holiday Lnn',
            'price' => 0,
        ]);

        $response->assertStatus(400);
        $response->assertExactJson(['Price is less than 0.']);
    });


    it('validates the currency should be TWD or USD', function () {
        $response = $this->postJson('/api/orders', [
            'name' => 'Melody Holiday Lnn',
            'price' => 100,
            'currency' => 'JPY',
        ]);

        $response->assertStatus(400);
        $response->assertExactJson(['Currency format is wrong.']);
    });
});
