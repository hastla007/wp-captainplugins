---
url: /review-captain/integrationen/
seo_title: Review Captain Integrationen – Plattformen und Connectoren
meta_description: Verbinden Sie Review Captain mit Bewertungsplattformen, Captain-Plugins und lokalen Projekt-Connectoren – mit klaren Ereignis- und Datenregeln.
focus_keyphrase: Review Captain Integrationen
---

# Review Captain Integrationen

Review Captain verbindet Bewertungsquellen und bestätigte Kundenerlebnisse in WordPress. Jede Integration ist optional, transparent und auf dokumentierte, erlaubte Datenwege ausgelegt.

## Bewertungsplattformen

Review Captain Pro unterstützt Verbindungen zu Google Business Profile, Trustpilot, Trusted Shops/eTrusted, Apple App Store und Google Play. Die API-Funktionen hängen von Kontotyp, Profil- oder App-Eigentümerschaft, Freigabe und Tarifrecht ab. Für Google Business Profile nutzen Sie ein eigenes Google-Cloud-Projekt. Wenn ein API-Zugang nicht verfügbar ist, können Sie einen Profil-Link, manuell ausgewählte Reviews oder – für Trustpilot und Trusted Shops/eTrusted – ein offizielles Anbieter-Widget verwenden, das erst nach Klick oder Einwilligung lädt.

## WooCommerce

Mit Review Captain Pro lösen Sie Bewertungsanfragen über einen von Ihnen festgelegten Bestellstatus aus (Standard: abgeschlossen) und ordnen Bewertungen Produkten zu; mehrere Produkte einer Bestellung landen in einer Anfrage. Wählen Sie einen Status, der im konkreten Ablauf tatsächlich eine erbrachte Leistung bestätigt. Versendet wird erst, wenn Sie eine Versandgrundlage ausdrücklich gewählt haben; Erstattung und Storno stoppen offene Anfragen. HPOS und Block-Checkout werden unterstützt. Review Captain dedupliziert Anfragen auf ein Erlebnis und einen Empfänger, berücksichtigt Ausschlüsse und Opt-out und protokolliert den Versand.

## Captain Suite (Pro)

- **Voucher Captain:** Anfrage nach einer tatsächlichen Gutscheinverwendung, sofern das Ereignis vom Quellplugin bereitgestellt wird.
- **Pass Captain:** Anfrage nach bestätigtem Check-in bzw. bestätigter Teilnahme, sofern das Ereignis vom Quellplugin bereitgestellt wird; Absage, Erstattung und Nichtteilnahme können offene Anfragen ausschließen.
- **Affiliate Captain:** Qualitätsauswertungen zu Partnerempfehlungen, ohne Reviews automatisch in Provisionen oder Partnerfreigaben umzuwandeln.
- **Form Captain:** lokale Review-Einreichung über ein Formular; neue Einträge bleiben bis zur Moderation pending und unverified.
- **Workflow Captain:** Empfang der Review-Ereignisse, siehe unten.

Für Kursabschlüsse ist kein eigener Suite-Adapter vorgesehen; Kurs- und Buchungssysteme lassen sich über einen kundenspezifischen Connector anbinden.

Review Captain Pro wird separat lizenziert. Details zur Aktivierung und Verlängerung erhalten Käufer nach dem Kauf im Lizenzbereich.

## Kundenspezifische WordPress-Connectoren

Neben den gepflegten Suite-Adaptern unterstützt Review Captain Pro Connectoren für lokale Buchungs-, Kurs-, CRM- und Branchensysteme. Der Connector wird als separates WordPress-Plugin installiert und deklariert seine Fähigkeiten über einen versionierten Vertrag. Review Captain bleibt Eigentümer von Anfragen, Reviews, Moderation und Widgets; Connectoren greifen nicht direkt auf fremde Plugin-Datenbanken zu.

Der Connector-Manager zeigt Kompatibilität, verfügbare Aktionen, Konfiguration, Testläufe, offene Jobs und Fehler. Betreiber aktivieren jede Erweiterung einzeln und geben nur die für den Ablauf nötigen Daten frei. Eine kundenspezifische Erweiterung bringt ihre eigene Funktions- und Supportgrenze mit.

## Faire Anfrage-Automation

Pro Erlebnis und Empfänger gilt dieselbe Anfragegrenze über alle verbundenen Auslöser. Kampagnenziel und neutrale Formulierung gelten für alle geeigneten Empfänger gleich; Zufriedenheit oder Sterne verändern weder Ziel noch Versand. Eine spätere Erinnerung ist optional, standardmäßig aus und bleibt derselben Erlebnis-/Empfängergrenze unterworfen.

## Workflow Captain

Workflow Captain verarbeitet nach der gemeinsamen Suite-Spezifikation die Ereignisse „Review erstellt“, „Status geändert“ und „Review entfernt“ – ohne Namen, E-Mail-Adressen, Reviewtexte und IP-Adressen. Befehle an Review Captain, etwa zum Planen von Anfragen, gehören nicht zu dieser Anbindung. Review Captain bleibt für Versandberechtigung, Einladungsgrenze, Opt-out, Plattformziel und Moderation verantwortlich; Workflow Captain kann diese Regeln nicht umgehen.

## Klare Grenzen der Verbindungen

Review Captain verwendet keine Scrapes und umgeht keine Anbieterzugänge. Es versendet keine Anfrage ohne geeigneten Auslöser und Einwilligungs-/Rechtsgrundlage, lenkt unzufriedene Kunden nicht von öffentlichen Plattformen weg und veröffentlicht Antworten nicht ohne erforderliche Berechtigungen und Freigaben.

[Kompatibilitätsübersicht](/review-captain/kompatibilitaet/) · [Review Captain Pro](/review-captain/pro/) · [Alle Integrationen](/integrationen/)

[Screenshot-Platzhalter: Integrationsansicht mit getrennten Bereichen für offizielle Plattformen, Captain-Suite-Adapter, Workflow Captain und kundenspezifische Connectoren zeigen. Connector-Karte mit Fähigkeiten, Vertragsstatus, Testlauf, Queue und bereinigtem Fehler darstellen. Synthetische Daten verwenden; keine Zugangsdaten anzeigen.]
