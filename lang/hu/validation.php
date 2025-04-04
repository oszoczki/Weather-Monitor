<?php

return [
    'attributes'           => [
        'name'         => 'Név',
        'latitude'     => 'Szélesség',
        'longitude'    => 'Hosszúság',
        'cron'         => 'Cron kifejezés',
        'temperature'  => 'Hőmérséklet',
        'location_id'  => 'Helyszín',
        'country_code' => 'Ország',
        'city'         => 'Város',
        'show_on_home' => 'Megjelenítés a főoldalon',
    ],

    'accepted'             => 'A(z) :attribute el kell fogadni.',
    'accepted_if'          => 'A(z) :attribute el kell fogadni, ha a(z) :other :value.',
    'active_url'           => 'A(z) :attribute nem érvényes URL.',
    'after'                => 'A(z) :attribute :date utáni dátumnak kell lennie.',
    'after_or_equal'       => 'A(z) :attribute :date vagy az azutáni dátumnak kell lennie.',
    'alpha'                => 'A(z) :attribute csak betűket tartalmazhat.',
    'alpha_dash'           => 'A(z) :attribute csak betűket, számokat, kötőjeleket és alsóvonásokat tartalmazhat.',
    'alpha_num'            => 'A(z) :attribute csak betűket és számokat tartalmazhat.',
    'array'                => 'A(z) :attribute tömbnek kell lennie.',
    'before'               => 'A(z) :attribute :date előtti dátumnak kell lennie.',
    'before_or_equal'      => 'A(z) :attribute :date vagy az előtti dátumnak kell lennie.',
    'between'              => [
        'array'   => 'A(z) :attribute :min és :max elem között kell lennie.',
        'file'    => 'A(z) :attribute mérete :min és :max kilobájt között kell lennie.',
        'numeric' => 'A(z) :attribute :min és :max között kell lennie.',
        'string'  => 'A(z) :attribute hossza :min és :max karakter között kell lennie.',
    ],
    'boolean'              => 'A(z) :attribute mezőnek igaznak vagy hamisnak kell lennie.',
    'confirmed'            => 'A(z) :attribute megerősítése nem egyezik.',
    'current_password'     => 'A jelszó nem helyes.',
    'date'                 => 'A(z) :attribute nem érvényes dátum.',
    'date_equals'          => 'A(z) :attribute :date-nek kell lennie.',
    'date_format'          => 'A(z) :attribute nem egyezik a(z) :format formátummal.',
    'declined'             => 'A(z) :attribute el kell utasítani.',
    'declined_if'          => 'A(z) :attribute el kell utasítani, ha a(z) :other :value.',
    'different'            => 'A(z) :attribute és :other különbözőnek kell lennie.',
    'digits'               => 'A(z) :attribute :digits számjegynek kell lennie.',
    'digits_between'       => 'A(z) :attribute :min és :max számjegy között kell lennie.',
    'dimensions'           => 'A(z) :attribute kép méretei érvénytelenek.',
    'distinct'             => 'A(z) :attribute mező duplikált értéket tartalmaz.',
    'doesnt_end_with'      => 'A(z) :attribute nem végződhet a következőkkel: :values.',
    'doesnt_start_with'    => 'A(z) :attribute nem kezdődhet a következőkkel: :values.',
    'email'                => 'A(z) :attribute érvényes e-mail címnek kell lennie.',
    'ends_with'            => 'A(z) :attribute a következővel kell végződnie: :values.',
    'enum'                 => 'A kiválasztott :attribute érvénytelen.',
    'exists'               => 'A kiválasztott :attribute érvénytelen.',
    'file'                 => 'A(z) :attribute fájlnak kell lennie.',
    'filled'               => 'A(z) :attribute mezőnek értéket kell tartalmaznia.',
    'gt'                   => [
        'array'   => 'A(z) :attribute több mint :value elemet kell tartalmazzon.',
        'file'    => 'A(z) :attribute mérete nagyobbnak kell lennie, mint :value kilobájt.',
        'numeric' => 'A(z) :attribute nagyobbnak kell lennie, mint :value.',
        'string'  => 'A(z) :attribute hosszabbnak kell lennie, mint :value karakter.',
    ],
    'gte'                  => [
        'array'   => 'A(z) :attribute legalább :value elemet kell tartalmazzon.',
        'file'    => 'A(z) :attribute méretének legalább :value kilobájtnak kell lennie.',
        'numeric' => 'A(z) :attribute nagyobbnak vagy egyenlőnek kell lennie, mint :value.',
        'string'  => 'A(z) :attribute hosszabbnak vagy egyenlőnek kell lennie, mint :value karakter.',
    ],
    'image'                => 'A(z) :attribute képnek kell lennie.',
    'in'                   => 'A kiválasztott :attribute érvénytelen.',
    'in_array'             => 'A(z) :attribute mező nem létezik a(z) :other-ban.',
    'integer'              => 'A(z) :attribute egész számnak kell lennie.',
    'ip'                   => 'A(z) :attribute érvényes IP címnek kell lennie.',
    'ipv4'                 => 'A(z) :attribute érvényes IPv4 címnek kell lennie.',
    'ipv6'                 => 'A(z) :attribute érvényes IPv6 címnek kell lennie.',
    'json'                 => 'A(z) :attribute érvényes JSON stringnek kell lennie.',
    'lt'                   => [
        'array'   => 'A(z) :attribute kevesebb mint :value elemet kell tartalmazzon.',
        'file'    => 'A(z) :attribute mérete kisebbnek kell lennie, mint :value kilobájt.',
        'numeric' => 'A(z) :attribute kisebbnek kell lennie, mint :value.',
        'string'  => 'A(z) :attribute rövidebbnek kell lennie, mint :value karakter.',
    ],
    'lte'                  => [
        'array'   => 'A(z) :attribute nem lehet több, mint :value elem.',
        'file'    => 'A(z) :attribute mérete nem lehet nagyobb, mint :value kilobájt.',
        'numeric' => 'A(z) :attribute kisebbnek vagy egyenlőnek kell lennie, mint :value.',
        'string'  => 'A(z) :attribute rövidebbnek vagy egyenlőnek kell lennie, mint :value karakter.',
    ],
    'mac_address'          => 'A(z) :attribute érvényes MAC címnek kell lennie.',
    'max'                  => [
        'array'   => 'A(z) :attribute nem lehet több, mint :max elem.',
        'file'    => 'A(z) :attribute mérete nem lehet nagyobb, mint :max kilobájt.',
        'numeric' => 'A(z) :attribute nem lehet nagyobb, mint :max.',
        'string'  => 'A(z) :attribute nem lehet hosszabb, mint :max karakter.',
    ],
    'max_digits'           => 'A(z) :attribute nem lehet több, mint :max számjegy.',
    'mimes'                => 'A(z) :attribute típusa: :values kell lennie.',
    'mimetypes'            => 'A(z) :attribute típusa: :values kell lennie.',
    'min'                  => [
        'array'   => 'A(z) :attribute legalább :min elemet kell tartalmazzon.',
        'file'    => 'A(z) :attribute méretének legalább :min kilobájtnak kell lennie.',
        'numeric' => 'A(z) :attribute legalább :min kell lennie.',
        'string'  => 'A(z) :attribute hosszának legalább :min karakternek kell lennie.',
    ],
    'min_digits'           => 'A(z) :attribute legalább :min számjegynek kell lennie.',
    'multiple_of'          => 'A(z) :attribute többszöröse kell lennie a(z) :value-nak.',
    'not_in'               => 'A kiválasztott :attribute érvénytelen.',
    'not_regex'            => 'A(z) :attribute formátuma érvénytelen.',
    'numeric'              => 'A(z) :attribute számnak kell lennie.',
    'password'             => [
        'letters'       => 'A(z) :attribute legalább egy betűt kell tartalmazzon.',
        'lowercase'     => 'A(z) :attribute legalább egy kisbetűt kell tartalmazzon.',
        'mixed'         => 'A(z) :attribute legalább egy nagybetűt és egy kisbetűt kell tartalmazzon.',
        'numbers'       => 'A(z) :attribute legalább egy számot kell tartalmazzon.',
        'symbols'       => 'A(z) :attribute legalább egy szimbólumot kell tartalmazzon.',
        'uncompromised' => 'A megadott :attribute megjelent egy adatszivárgásban. Kérjük, válasszon egy másik :attribute.',
    ],
    'present'              => 'A(z) :attribute mezőnek jelen kell lennie.',
    'prohibited'           => 'A(z) :attribute mező tiltott.',
    'prohibited_if'        => 'A(z) :attribute mező tiltott, ha a(z) :other :value.',
    'prohibited_unless'    => 'A(z) :attribute mező tiltott, hacsak a(z) :other nem :values.',
    'prohibits'            => 'A(z) :attribute mező tiltja a(z) :other mező jelenlétét.',
    'regex'                => 'A(z) :attribute formátuma érvénytelen.',
    'required'             => 'A(z) :attribute mező megadása kötelező.',
    'required_array_keys'  => 'A(z) :attribute mezőnek tartalmaznia kell a következő elemeket: :values.',
    'required_if'          => 'A(z) :attribute mező megadása kötelező, ha a(z) :other :value.',
    'required_if_accepted' => 'A(z) :attribute mező megadása kötelező, ha a(z) :other elfogadásra került.',
    'required_unless'      => 'A(z) :attribute mező megadása kötelező, hacsak a(z) :other nem :values.',
    'required_with'        => 'A(z) :attribute mező megadása kötelező, ha a(z) :values jelen van.',
    'required_with_all'    => 'A(z) :attribute mező megadása kötelező, ha a(z) :values jelen vannak.',
    'required_without'     => 'A(z) :attribute mező megadása kötelező, ha a(z) :values nincs jelen.',
    'required_without_all' => 'A(z) :attribute mező megadása kötelező, ha egyik :values sem jelen.',
    'same'                 => 'A(z) :attribute és :other egyeznie kell.',
    'size'                 => [
        'array'   => 'A(z) :attribute :size elemet kell tartalmazzon.',
        'file'    => 'A(z) :attribute mérete :size kilobájtnak kell lennie.',
        'numeric' => 'A(z) :attribute :size kell lennie.',
        'string'  => 'A(z) :attribute hosszának :size karakternek kell lennie.',
    ],
    'starts_with'          => 'A(z) :attribute a következővel kell kezdődnie: :values.',
    'string'               => 'A(z) :attribute szövegnek kell lennie.',
    'timezone'             => 'A(z) :attribute érvényes időzónának kell lennie.',
    'unique'               => 'A(z) :attribute már használatban van.',
    'uploaded'             => 'A(z) :attribute feltöltése sikertelen.',
    'url'                  => 'A(z) :attribute formátuma érvénytelen.',
    'uuid'                 => 'A(z) :attribute érvényes UUID-nak kell lennie.',
    'cron'                 => 'A(z) :attribute nem érvényes cron kifejezés. Használja a következő formátumot: * * * * * (perc óra nap hónap hétnap)',
];
