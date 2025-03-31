<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * CronExpression Validation Rule
 *
 * Ez a validációs szabály ellenőrzi, hogy a megadott érték érvényes cron kifejezés-e.
 * A cron kifejezés formátuma: * * * * *
 * Ahol: perc óra nap hónap hétnap
 */
class CronExpression implements Rule
{
    /**
     * Ellenőrzi, hogy a validációs szabály teljesül-e.
     *
     * @param string $attribute A validálandó mező neve
     * @param mixed $value A validálandó érték
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        // A cron kifejezés formátuma: * * * * *
        // Ahol: perc óra nap hónap hétnap

        // Először ellenőrizzük az alapvető formátumot
        if (! preg_match('/^(\*|[0-9\-\*\/,]+)\s+(\*|[0-9\-\*\/,]+)\s+(\*|[0-9\-\*\/,]+)\s+(\*|[0-9\-\*\/,]+)\s+(\*|[0-9\-\*\/,]+)$/', $value)) {
            return false;
        }

        // Szétbontjuk a kifejezést részekre
        $parts = explode(' ', $value);

        // Ellenőrizzük minden részt
        return $this->validatePart($parts[0], 0, 59) &&
        $this->validatePart($parts[1], 0, 23) &&
        $this->validatePart($parts[2], 1, 31) &&
        $this->validatePart($parts[3], 1, 12) &&
        $this->validatePart($parts[4], 0, 6);
    }

    /**
     * Visszaadja a validációs hibaüzenetet.
     *
     * @return string
     */
    public function message(): string
    {
        return 'A cron kifejezés formátuma nem megfelelő. Használja a következő formátumot: * * * * * (perc óra nap hónap hétnap)';
    }

    /**
     * Ellenőrzi a cron kifejezés egy részét.
     *
     * @param string $part A cron kifejezés része
     * @param int $min Az engedélyezett minimális érték
     * @param int $max Az engedélyezett maximális érték
     * @return bool
     */
    private function validatePart(string $part, int $min, int $max): bool
    {
        // Ha csillag, akkor minden érték megengedett
        if ($part === '*') {
            return true;
        }

        // Ha szám, ellenőrizzük a tartományt
        if (is_numeric($part)) {
            $value = (int) $part;
            return $value >= $min && $value <= $max;
        }

        // Ha tartomány (pl. 1-5)
        if (preg_match('/^(\d+)-(\d+)$/', $part, $matches)) {
            $start = (int) $matches[1];
            $end   = (int) $matches[2];
            return $start >= $min && $end <= $max && $start <= $end;
        }

        // Ha lépés (pl. */5)
        if (preg_match('/^\*\/(\d+)$/', $part, $matches)) {
            $step = (int) $matches[1];
            return $step >= 1 && $step <= $max;
        }

        // Ha felsorolás (pl. 1,3,5)
        if (str_contains($part, ',')) {
            $values = explode(',', $part);
            foreach ($values as $value) {
                if (! is_numeric($value) || (int) $value < $min || (int) $value > $max) {
                    return false;
                }
            }
            return true;
        }

        return false;
    }
}
