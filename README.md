# Fotballdata SDK for PHP
[![codecov](https://codecov.io/gh/mentisy/fotballdata/branch/main/graph/badge.svg?token=fHDySEsedW)](https://codecov.io/gh/mentisy/fotballdata)
[![GitHub](https://img.shields.io/github/license/mentisy/fotballdata)](https://github.com/mentisy/fotballdata/blob/main/LICENSE)
[![PHP Version Require](http://poser.pugx.org/phpunit/phpunit/require/php)](https://packagist.org/packages/avolle/fotballdata)

A library for fetching data from [Norwegian Football API service Fotballdata](https://www.fotballdata.no/).

### Installation:
`composer install avolle/fotballdata`

### Gotchas
As `match` is a [protected control structure token](https://www.php.net/manual/en/control-structures.match.php) 
for PHP from version 8.0 and up, we need to alias the `Match` entity. Therefore all Match results use the `Game` entity.
Only the entity name is aliased. Requests and hasMany relationships continue to use `Matches`.

### Usage:
Anywhere in your code:

```php
<?php

require 'vendor/autoload.php';

use Avolle\Fotballdata\Request\MatchesRequests;

// Remember to define config keys. See Configuration below.
$config = [];

$matchesRequests = new MatchesRequests($config);
/** @var \Avolle\Fotballdata\Entity\Game $match */
$match = $matchesRequests->get(1);
```

### Configuration
Configuration keys. Only `clubId`, `cid` and `cwd` are required from you. These values are given by Fotballdata.

| Key    | Type      | Default Value   | Description                                            |
|--------|-----------|-----------------|--------------------------------------------------------|
| debug  | `boolean` | `false`         | Add configuration to HTTP requests to avoid SSL errors |
| clubId | `int`     | None. Required. | Your club id found in FIKS                             |
| cid    | `int`     | None. Required. | Authentication id for Fotballdata API                  |
| cwd    | `string`  | None. Required. | Authentication password for Fotballdata API            |

```php
<?php

use Avolle\Fotballdata\Request\ClubsRequests;

$config = [
    'clubId' => 69,
    'cid' => 666,
    'cwd' => 42,
];

$request = new ClubsRequests($config);
```

### Supports the following requests:
 #### Clubs
| Description                 | Method                              |
|-----------------------------|-------------------------------------|
| Get a club                  | `ClubsRequests::get($id)`           |
| Get a club's matches        | `ClubsRequests::matches($id)`       |
| Get a club's teams          | `ClubsRequests::teams($id)`         |
| Get a club's tournaments    | `ClubsRequests::tournaments($id)`   |

 #### Districts
| Description                  | Method                                |
|------------------------------|---------------------------------------|
| Get all districts            | `DistrictsRequests::all()`            |
| Get a district               | `DistrictsRequests::get($id)`         |
| Get a district's clubs       | `DistrictsRequests::clubs($id)`       |
| Get a district's teams       | `DistrictsRequests::teams($id)`       |
| Get a district's tournaments | `DistrictsRequests::tournaments($id)` |
| Get a district's stadiums    | `DistrictsRequests::stadiums($id)`    |

 #### Matches
| Description                                | Method                                  |
|--------------------------------------------|-----------------------------------------|
| Get a match                                | `MatchesRequests::get($id)`             |
| Get a match with related people            | `MatchesRequests::people($id)`          |
| Get a match with related people and events | `MatchesRequests::peopleAndEvents($id)` |

 #### Seasons
| Description                  | Method                      |
|------------------------------|-----------------------------|
| Get all seasons              | `SeasonsRequests::all()`    |
| Get a season                 | `SeasonsRequests::get($id)` |

 #### Stadiums
| Description                        | Method                                        |
|------------------------------------|-----------------------------------------------|
| Get a stadium                      | `StadiumsRequests::get($id)`                  |
| Get a stadium's matches            | `StadiumsRequests::matches($id)`              |
| Get a stadium's matches for a club | `StadiumsRequests::clubMatches($id, $clubId)` |
| Get a stadium's children stadiums  | `StadiumsRequests::children($id)`             |

 #### Teams
| Description              | Method                            |
|--------------------------|-----------------------------------|
| Get a team               | `TeamsRequests::get($id)`         |
| Get a team's matches     | `TeamsRequests::matches($id)`     |
| Get a team's tournaments | `TeamsRequests::tournaments($id)` |
| Get a team's tables      | `TeamsRequests::tables($id)`      |
| Get a team's players     | `TeamsRequests::players($id)`     |

 #### Tournaments
| Description                 | Method                               |
|-----------------------------|--------------------------------------|
| Get a tournament            | `TournamentsRequests::get($id)`      |
| Get a tournament's matches  | `TournamentsRequests::matches($id)`  |
| Get a tournament's tables   | `TournamentsRequests::tables($id)`   |
| Get a tournament's teams    | `TournamentsRequests::teams($id)`    |
