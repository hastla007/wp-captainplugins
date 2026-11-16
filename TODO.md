# TODO

## Mindestversionen: neueste PHP-, MySQL- und MariaDB-Version (Entscheidung der Inhaberin, 16.11.2026)

- [ ] **MINVER-1 — Auf die neuesten Versionen umstellen und testen.** Die Inhaberin hat am 16.11.2026 für alle Captain-Plugins entschieden: Mindestversionen sind die jeweils neuesten – **PHP 8.5** (PHP 8.6 erscheint am 19.11.2026 und kommt in die Test-Matrix), **MySQL 9.7 (LTS)** und **MariaDB 12.3 (LTS)**. Heute verlangt dieses Repository keine ausdrückliche PHP-Mindestversion im Plugin-Header.
  - *Zu tun:* Plugin-Header `Requires PHP`, Laufzeitprüfung, `readme.txt`, README, `composer.json`, PHPCS `testVersion`, PHPStan `phpVersion` und die CI-Zellen (Unit-Matrix ab 8.5, Integration auf MySQL 9.7 und MariaDB 12.3) einheitlich umstellen; eine Warnung (keine Sperre), wenn die Datenbank älter ist; Changelog-Eintrag.
  - *Test (Inhaberin):* auf einem echten Host mit PHP 8.5/8.6 und MySQL 9.7 bzw. MariaDB 12.3 installieren, aktualisieren und die Hauptabläufe durchspielen.
  - *Vorbild:* Affiliate Captain (`hastla007/wpaffiliatemaster`, Aufgaben PHP-1/PHP-2).

### Umsetzung in diesem Repository (wp-captainplugins)

Dieses Repository enthält kein Plugin, sondern Website-Texte und das Theme. Umgesetzt am 16.11.2026:

- [x] Theme-Header `Requires PHP: 8.5`; Admin-Hinweis (Warnung, keine Sperre) bei PHP unter 8.5 sowie MySQL unter 9.7 bzw. MariaDB unter 12.3 (`theme/captain-plugins/inc/requirements.php`).
- [x] Website-Texte: Kompatibilitätsmatrix mit Datenbankspalte und Hinweis, Produkt-, Pro-, Installations- und FAQ-Seiten auf PHP 8.5 und die Datenbank-Minima umgestellt; dokumentierte ältere Teststände sind als solche gekennzeichnet.
- [x] Theme-README und Designkonzept angepasst.
- [ ] Neutest des Themes auf einem Host mit PHP 8.5/8.6 und MySQL 9.7 bzw. MariaDB 12.3 (Inhaberin). Bisher getestet: PHP 8.3 mit SQLite.
