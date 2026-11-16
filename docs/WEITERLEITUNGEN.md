# Weiterleitungen

Stand: 16. November 2026. Das Theme richtet bewusst **keine** Weiterleitungen ein (`design/konzept.md`, Abschnitt 8). Weiterleitungen werden in Yoast SEO Premium, einem Redirect-Plugin oder auf dem Webserver gepflegt.

## Entfallene oder umbenannte Seiten

| Alte URL | Neues Ziel (301) | Grund | Theme-Verhalten |
|---|---|---|---|
| `/license-captain/im-paket/` | `/license-captain/preise/` | Die Seite stellte License Captain als Bestandteil von Captain Pro dar. License Captain ist ein eigenes Produkt aus Server und Client mit eigener Preisseite. | Der Seitenimport setzt eine unveränderte, vom Theme angelegte Kopie automatisch auf Entwurf (`content/retired.php`). Von Hand bearbeitete Kopien bleiben unangetastet und müssen redaktionell geprüft werden. |

Alle anderen bisher ausgelieferten Seiten-URLs sind unverändert (geprüft gegen alle Manifest-Stände in der Git-Historie).

## Beispiele für die Einrichtung

Apache (`.htaccess`, vor dem WordPress-Block):

```apache
Redirect 301 /license-captain/im-paket/ /license-captain/preise/
```

nginx:

```nginx
location = /license-captain/im-paket/ { return 301 /license-captain/preise/; }
```

## Pflege

Wird eine Seite aus `texte/homepage/` entfernt oder ihre `url:` geändert:

1. Eintrag in `theme/captain-plugins/content/retired.php` ergänzen (alte URL ohne Schrägstriche → neues Ziel).
2. Zeile in der Tabelle oben ergänzen und die Weiterleitung einrichten.
3. Nach dem Deployment mit `node tools/qa/site-check.cjs --base <URL>` auf tote interne Links prüfen.
