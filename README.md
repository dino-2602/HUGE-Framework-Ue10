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
- Generierung eines teilbaren Links zur öffentlichen Anzeige eines Bildes:
  `localhost/huge/image/showImage/<unique_hash>`
- Die Freigabe erfolgt über einen individuellen Hash-Code.

### 4. Bildverwaltung
- Bilder können hochgeladen, geteilt, heruntergeladen und gelöscht werden.
- Unterstützte Ansichten:
  - Thumbnail-Ansicht
  - Vollbildansicht (optimiert für verschiedene Auflösungen)

### 5. Sicherheit
- Bilder werden in geschützten Verzeichnissen gespeichert, die nicht öffentlich zugänglich sind.
- Die Integration der UberGallery-Bibliothek verhindert direkten Zugriff auf Dateien.
- Benutzerrechte und Zugriffe werden über die Datenbank verwaltet.

## Technologien
![PHP](https://img.shields.io/badge/PHP-8.1%2B-blue?logo=php&logoColor=white)
![Huge Framework](https://img.shields.io/badge/Huge_Framework-1.0-brightgreen)
![HTML](https://img.shields.io/badge/HTML-5-orange?logo=html5&logoColor=white)
![CSS](https://img.shields.io/badge/CSS-3-blue?logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6%2B-yellow?logo=javascript&logoColor=white)
![MySQL](https://img.shields.io/badge/Database-MySQL-lightblue?logo=mysql&logoColor=white)

⚠️ **Hinweis:** In diesem Repository wurden keine sensiblen Daten wie Konfigurationsdateien hochgeladen.

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

### **Benutzer-Galerieansicht**
![Galerie-Ansicht](https://github.com/dino-2602/Huge-Framework-Gallery/screenshots/galerie_ansicht.png)

### **Bild teilen**
![Bild teilen](https://github.com/dino-2602/Huge-Framework-Gallery/screenshots/bild_teilen.png)

### **Privates Verzeichnis**
![Privates Verzeichnis](https://github.com/dino-2602/Huge-Framework-Gallery/screenshots/privates_verzeichnis.png)

---

### Autor
**Dino Haskic**

### Klasse
3aAPC

### Schuljahr
2024/2025
