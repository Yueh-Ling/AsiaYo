<?php

describe('store', function () {
    it('it should return 200', function () {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road',
            ],
            'price' => 100,
            'currency' => 'USD',
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road',
            ],
            'price' => 3100,
            'currency' => 'TWD',
        ]);
    });

    it('validates the id is required', function () {
        $response = $this->postJson('/api/orders', [
            'name' => '圓山飯店',
        ]);
        $response->assertStatus(400);
        $response->assertExactJson(["The id is required."]);
    });

    it('validates the name is required', function () {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
        ]);
        $response->assertStatus(400);
        $response->assertExactJson(["The Name is required."]);
    });

    it('validates the address is required', function () {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn'
        ]);
        $response->assertStatus(400);
        $response->assertExactJson(["The address is required."]);
    });

    it('validates the address.city is required', function () {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'address' => [
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road',
            ]
        ]);
        $response->assertStatus(400);
        $response->assertExactJson(["The address.city is required."]);
    });

    it('validates the address.district is required', function () {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
            ]
        ]);
        $response->assertStatus(400);
        $response->assertExactJson(["The address.district is required."]);
    });

    it('validates the address.street is required', function () {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
            ]
        ]);
        $response->assertStatus(400);
        $response->assertExactJson(["The address.street is required."]);
    });

    it('validates the price is required', function () {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road',
            ]
        ]);
        $response->assertStatus(400);
        $response->assertExactJson(["The price is required."]);
    });

    it('validates the currency is required', function () {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road',
            ],
            'price' => 100,
        ]);
        $response->assertStatus(400);
        $response->assertExactJson(["The currency is required."]);
    });

    it('validates the name should not contain non-English characters', function () {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => '圓山飯店',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road',
            ],
            'price' => 100,
            'currency' => 'TWD',
        ]);

        $response->assertStatus(400);
        $response->assertExactJson(["Name contains non-English characters."]);
    });

    it('validates name must only contain English letters, with each word starting with an uppercase letter.', function () {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday inn',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road',
            ],
            'price' => 100,
            'currency' => 'TWD'
        ]);

        $response->assertStatus(400);
        $response->assertExactJson(['Name is not capitalized.']);
    });

    it('validates the price should be a decimal', function () {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'price' => '100.001',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road',
            ],
            'currency' => 'TWD',
        ]);

        $response->assertStatus(400);
        $response->assertExactJson(['Price is invalid.']);
    });

    it('validates the price should not more than 2000', function () {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'price' => '2001',
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road',
            ],
            'currency' => 'TWD',
        ]);

        $response->assertStatus(400);
        $response->assertExactJson(['Price is over 2000.']);
    });

    it('validates the price should be a positive number', function () {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'price' => -1,
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road',
            ],
            'currency' => 'TWD',
        ]);

        $response->assertStatus(400);
        $response->assertExactJson(['Price is less than 0.']);
    });

    it('validates the price should be more than 0', function () {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'price' => 0,
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road',
            ],
            'currency' => 'TWD',
        ]);

        $response->assertStatus(400);
        $response->assertExactJson(['Price is less than 0.']);
    });


    it('validates the currency should be TWD or USD', function () {
        $response = $this->postJson('/api/orders', [
            'id' => 'A0000001',
            'name' => 'Melody Holiday Inn',
            'price' => 100,
            'address' => [
                'city' => 'taipei-city',
                'district' => 'da-an-district',
                'street' => 'fuxing-south-road',
            ],
            'currency' => 'JPY',
        ]);

        $response->assertStatus(400);
        $response->assertExactJson(['Currency format is wrong.']);
    });
});
