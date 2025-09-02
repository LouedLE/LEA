LEA Web Creation — Starter ULTRA SIMPLE (PHP seul, sans BDD)
===========================================================

Objectif
- Zéro MySQL, zéro framework, zéro .htaccess
- Un seul fichier PHP (public/index.php) avec un mini routeur via ?page=...
- Données stockées en fichiers plats: JSON/CSV dans /data
- Parfait pour WAMP en local

Installation
1) Copiez le dossier où vous voulez (ex: C:\wamp64\www\leaweb-simple)
2) Ouvrez: http://localhost/leaweb-simple/public/index.php
3) Les formulaires écrivent dans /data (quotes.csv, reviews.json)

Pages
- Accueil: ?page=home
- Services: ?page=services (lecture data/services.json)
- Contact / Devis: ?page=contact (ajoute une ligne dans data/quotes.csv)
- Avis: ?page=reviews (lecture/écriture data/reviews.json)

Personnalisation
- Modifiez data/services.json pour changer les services
- Modifiez public/style.css pour le thème
- Si vous voulez une version MySQL/MVC plus tard, on pourra migrer progressivement.

Sécurité
- C’est volontairement minimal pour l’usage local et le prototypage.
- Ne pas exposer tel quel en production (pas de CSRF, pas d’auth).
