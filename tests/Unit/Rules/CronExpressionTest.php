<?php
namespace Tests\Unit\Rules;

use App\Rules\CronExpression;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CronExpressionTest extends TestCase
{
    private CronExpression $rule;

    protected function setUp(): void
    {
        parent::setUp();
        $this->rule = new CronExpression();
    }

    public static function validCronExpressionProvider(): array
    {
        return [
            'every minute'          => ['* * * * *'],
            'every 5 minutes'       => ['*/5 * * * *'],
            'every hour'            => ['0 * * * *'],
            'every day at midnight' => ['0 0 * * *'],
            'every monday'          => ['0 0 * * 1'],
            'every month first day' => ['0 0 1 * *'],
            'complex expression'    => ['15,45 */2 1-15 1,6,12 0-5'],
        ];
    }

    public static function invalidCronExpressionProvider(): array
    {
        return [
            'empty string'        => [''],
            'invalid parts count' => ['* * * *'],
            'invalid minute'      => ['60 * * * *'],
            'invalid hour'        => ['* 24 * * *'],
            'invalid day'         => ['* * 32 * *'],
            'invalid month'       => ['* * * 13 *'],
            'invalid weekday'     => ['* * * * 8'],
            'invalid characters'  => ['a b c d e'],
            'invalid step value'  => ['*/0 * * * *'],
        ];
    }

    #[Test]
    #[DataProvider('validCronExpressionProvider')]
    public function it_passes_for_valid_cron_expressions(string $expression)
    {
        $this->assertTrue($this->rule->passes('cron', $expression));
    }

    #[Test]
    #[DataProvider('invalidCronExpressionProvider')]
    public function it_fails_for_invalid_cron_expressions(string $expression)
    {
        $this->assertFalse($this->rule->passes('cron', $expression));
    }

    #[Test]
    public function it_has_error_message()
    {
        $this->assertIsString($this->rule->message());
        $this->assertNotEmpty($this->rule->message());
    }
}
