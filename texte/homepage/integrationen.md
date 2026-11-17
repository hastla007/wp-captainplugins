---
url: /integrationen/
seo_title: Captain Plugins: Integrationen und APIs
meta_description: Erfahren Sie, wie Captain Plugins mit WooCommerce, Bewertungsplattformen, Workflow Captain und individuellen WordPress-Connectoren zusammenarbeiten.
focus_keyphrase: WooCommerce Plugin Integrationen
---

# Ihre Abläufe verbunden

Die Captain-Plugins lassen sich einzeln einsetzen und über dokumentierte Schnittstellen in bestehende WordPress- und WooCommerce-Prozesse einbinden.

## Integrationen nach Produkt

| Produkt | Zentrale Anbindungen |
|---|---|
| Voucher Captain | WooCommerce-Produkte, Bestellungen, HPOS und Blocks-Checkout; WooCommerce Subscriptions; Mehrsprachigkeit mit WPML/WCML und Polylang; Mehrwährung über unterstützte Erweiterungen; Gutscheinzahlung, Ticketgutscheine und gemeinsamer Scanner mit Pass Captain; Affiliate Captain |
| Pass Captain | Direkte Zahlungen mit Stripe, PayPal oder Mollie; optional WooCommerce Classic- oder Blocks-Checkout; Voucher Captain; Affiliate Captain; Twilio oder generischer HTTP-Anbieter für SMS; iCal-Feeds, signierte Webhooks, Veranstalter- und Mobile-API |
| Affiliate Captain | Eigenständiges Partnerprogramm; WooCommerce optional; versionierter Integrationsvertrag für Verkaufsquellen wie Pass Captain und Voucher Captain sowie weitere kompatible Connectors; Partnerbewerbungen über Form Captain |
| Form Captain | Eigenständige Formulare und Entries; WooCommerce nur für Käuferfragebögen in Pro; versionierte Verbindungen zu Pass, Voucher, Affiliate, Review und Course Captain sowie separaten Projekt-Connectoren; Workflow-Ereignisse mit Workflow Captain Pro und Form Captain Pro |
| Review Captain | Google, Trustpilot, Trusted Shops/eTrusted, Apple App Store und Google Play über offizielle APIs, Widgets, Profil-Links oder manuelle Kuration; faire Anfragen nach bestätigtem Erlebnis; Workflow Captain und Pro-Manager für lokale Projekt-Connectoren |
| Course Captain | Eigenständiges LMS ohne Pflicht-Plugins; in Pro WooCommerce-Kurszugänge nach bestätigter Zahlung, Kursgutscheine über Voucher Captain, Kurszugänge aus Pass-Tickets (ein Check-in ist kein Abschluss), Formulare und Provisionen über die jeweiligen Captain-Plugins |
| Workflow Captain | WordPress Core und WooCommerce im kostenlosen Kern; in Pro Provider für Voucher, Pass, Affiliate, Form und Review Captain, signierte Webhooks und n8n, eigene Connectoren und netzwerkweite Multisite-Workflows |
| License Captain | WooCommerce als Lizenzshop; signierte REST-API für Produkt-Plugins; Entitlements, Lizenzprüfung und Updatebereitstellung; offizielles WooCommerce-Stripe-Gateway für automatische Verlängerungen |

## Was Sie für eine Integration benötigen

Zahlungsanbieter benötigen ein eigenes Händlerkonto und korrekt konfigurierte Zugangsdaten. Für den WooCommerce-Checkout können je nach Plugin HPOS, klassische Bestellspeicherung und Blocks-Checkout genutzt werden. License Captain nutzt WooCommerce für Lizenzprodukte; WooCommerce-Subscriptions sind nicht als Lizenzprodukt vorgesehen.

Die konkreten Mindestversionen und geprüften Plattformen finden Sie in der [Kompatibilitätsmatrix](/kompatibilitaet/). Eine Schritt-für-Schritt-Einrichtung steht in der [Dokumentation](/dokumentation/installation/).

## Form- und Review-Abläufe

Form Captain speichert eine Einsendung zuerst als Eintrag in WordPress. Suite- oder Projektaktionen erfolgen danach über dokumentierte Verträge; ein Formular löst weder automatisch eine Buchung noch eine Zahlung oder Provisionsfreigabe aus. Review Captain plant höchstens eine Anfrage pro bestätigtem Erlebnis und Empfänger. Externe Plattformdaten werden nicht gescrapt und lokale Review-Einträge bleiben bis zur Moderation unveröffentlicht.

[Form Captain Integrationen](/form-captain/integrationen/) · [Review Captain Integrationen](/review-captain/integrationen/)

## Automationen mit Workflow Captain

Workflow Captain bündelt WordPress- und WooCommerce-Abläufe im Kern-Plugin. Pro ergänzt versionierte Captain-Provider und sichere Webhooks. Jede Suite-Verbindung setzt das jeweilige Plugin und einen kompatiblen öffentlichen Providervertrag voraus; fachliche Daten und Zuständigkeiten bleiben beim Quellplugin.

[Workflow Captain Integrationen](/workflow-captain/integrationen/) · [Voraussetzungen](/workflow-captain/kompatibilitaet/)

**[Passendes Plugin finden](/produkte/)** · **[Support](/support/)**
