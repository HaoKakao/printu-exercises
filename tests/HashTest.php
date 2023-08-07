<?php
declare(strict_types=1);
ini_set('memory_limit', '1024M');

require_once __DIR__ . '/../vendor/autoload.php';

use Printu\Exercises\Hash;
use PHPUnit\Framework\TestCase;

class HashTest extends TestCase
{
    /**
     * @test
     */
    public function testSameOrderNumber(): void
    {
        $orderNumber = 1234456;
        $orderHashed1 = Hash::hashOrder($orderNumber);
        $orderHashed2 = Hash::hashOrder($orderNumber);

        $this->assertSame($orderHashed1, $orderHashed2, "Hashes for the same order number are not the same.");
    }

    /**
     * @test
     */
    public function testHashOrderLoop(): void
    {
        $unique = [];

        echo "Starting test ...." . PHP_EOL;
        $start = microtime(true);

        for ($i = 1; $i <= 9999999; $i++) {
            $result = Hash::hashOrder($i);

            if (!preg_match("/^[0-9]{7}$/", $result)) {
                throw new InvalidArgumentException("Result {$result} does not match regex");
            }

            if (!empty($unique[$result])) {
                throw new InvalidArgumentException("Colision detected for key {$i}:{$unique[$result]} and result {$result}");
            }

            $unique[$result] = $i;
        }

        $time_elapsed_secs = microtime(true) - $start;

        if ($time_elapsed_secs > 60) {
            throw new InvalidArgumentException("Could not finish test in 60 seconds");
        }

        echo "Finished in {$time_elapsed_secs}";
    }
}
