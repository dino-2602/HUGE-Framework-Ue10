# Huge Framework – Galerie

## Übersicht
Dieses Projekt erweitert das Huge Framework um eine benutzerspezifische Galerieanwendung. Es erfüllt die Vorgaben der Aufgabenstellung und bietet Funktionen zur Verwaltung, Anzeige und Sicherung von Bildern.

## Features

### 1. Einzel-Upload
- Ermöglicht das Hochladen eines einzelnen Bildes pro Vorgang.
- Bilder werden in privaten Verzeichnissen gespeichert:
  `Huge/userpictures/<UserID>/image.jpg`
- Direkter Zugriff auf Bilder im Ordner ist nicht möglich.

### 2. Benutzer-Spezifische Galerie
- Bilder sind nur für den jeweiligen Benutzer sichtbar.
- Bilder werden in einer Listenansicht als Thumbnails angezeigt.

### 3. Bilder Teilen
- Die Freigabe eines Bildes ist für alle User sichtbar.

### 4. Bildverwaltung
- Bilder können hochgeladen, heruntergeladen, freigegeben und gelöscht werden.
- Unterstützte Ansichten:
  - Thumbnail-Ansicht
  - Vollbildansicht (öffnet in einem neuen Tab)

### 5. Sicherheit
- Bilder werden in geschützten Verzeichnissen gespeichert, die nicht öffentlich zugänglich sind.
- Benutzerrechte und Zugriffe werden über die Datenbank verwaltet.

## Technologien
![PHP](https://img.shields.io/badge/PHP-8.1%2B-blue?logo=php&logoColor=white)
![Huge Framework](https://img.shields.io/badge/Huge_Framework-1.0-brightgreen)
![HTML](https://img.shields.io/badge/HTML-5-orange?logo=html5&logoColor=white)
![CSS](https://img.shields.io/badge/CSS-3-blue?logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6%2B-yellow?logo=javascript&logoColor=white)
![MySQL](https://img.shields.io/badge/Database-MySQL-lightblue?logo=mysql&logoColor=white)

⚠️**Hinweis:** In diesem Repository wurde ausschließlich der `application`-Ordner hochgeladen. Dies geschieht, um den Datenschutz zu gewährleisten und keine sensiblen Daten wie Serverkonfigurationen oder Zugangsdaten öffentlich bereitzustellen. Dateien wie `config.php` und andere Konfigurationsdateien, die möglicherweise sensible Informationen enthalten, wurden absichtlich nicht hochgeladen.

## Einrichtungsschritte

1. **Repository klonen:**
   ```bash
   git clone https://github.com/your_repository/Huge-Framework-Gallery.git
   ```

2. **Datenbank konfigurieren:**
   - Tabellen für Benutzer- und Bilddaten erstellen.
   - Stored Procedures und Datenbankrechte einrichten.

3. **Konfiguration:**
   - `config.php` mit den korrekten Pfaden und Datenbankinformationen anpassen.

4. **Deployment:**
   - Die Anwendung auf einem lokalen Server oder Webserver bereitstellen.

## Screenshots

### Datenbankkonfiguration
Zeigt die Struktur und Inhalte der Tabelle `gallery`, in der Bilder und deren Attribute gespeichert sind.
![Datenbank-Tabelle](link_zum_screenshot1)

### Benutzer- und Admin-Ansichten der Galerie
**Admin-Ansicht:** Darstellung der Galerie mit freigegebenen und privaten Bildern.
![Admin-Ansicht](link_zum_screenshot2)

### Öffentliche Galerieansicht
Zeigt, wie freigegebene Bilder in der öffentlichen Galerie angezeigt werden.
![Öffentliche Galerie](link_zum_screenshot3)

### Code-Referenzen
**Modell:** Beispiel für die Speicherung eines Bildes in der Datenbank.
![Code-Datenbankoperationen](link_zum_code_screenshot1)

**Controller:** Beispiel für die Anzeige eines Bildes aus dem Dateisystem.
![Code-Bildanzeige](link_zum_code_screenshot2)

**View:** Beispiel für die Darstellung der Galerie-Ansicht.
![Code-Galerieansicht](link_zum_code_screenshot3)

---

### Autor
**Dino Haskic**

### Klasse
3aAPC

### Schuljahr
2024/2025
