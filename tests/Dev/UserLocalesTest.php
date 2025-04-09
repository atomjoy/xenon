<?php

namespace Tests\Dev;

use Tests\TestCase;

class UserLocalesTest extends TestCase
{
    function test_change_locale_en()
    {
        $res = $this->getJson('/web/api/locale/en');
        $res->assertStatus(200)->assertJson([
            'message' => 'Locale has been changed.',
            'locale' => 'en',
        ]);

        $res = $this->getJson('/web/api/locale/error');
        $res->assertStatus(422)->assertJson([
            'message' => 'Locale has not been changed.'
        ]);
    }
}
