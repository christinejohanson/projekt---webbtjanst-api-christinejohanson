# DT193G Projekt---webbtjanst-api-christinejohanson chjo2104 DEL 1

Projekt i kursen Fullstacks-utveckling med ramverk. Denna del består av en REST-webbtjänst med full CRUD-funktion skapad
med Laravel som backend-ramverk. 

## API ##

API´et finns ej publicerat, utan körs lokalt. 

RecordController

| Metod | Ändpunkt | Beskrivning |
| --- | --- | --- |
| GET | /api/record | hämtar alla record |
| GET | /api/record/1 | hämtar record med angivet ID |
| GET | /api/gettracks/1 | hämtar alla tracks som finns på record med angivet ID |
| POST | /api/record | lagrar ny record |
| PUT | /api/record/1 | uppdaterar record med angivet ID |
| DELETE | /api/record/1 | raderar record med angivet ID |

TrackController

| Metod | Ändpunkt | Beskrivning |
| --- | --- | --- |
| GET | /api/track | hämtar alla track |
| GET | /api/track/1 | hämtar track med angivet ID |
| POST | /api/track | lagrar ny track |
| PUT | /api/track/1 | uppdaterar track med angivet ID |
| DELETE | /api/track/1 | raderar track med angivet ID |

AuthController

| Metod | Ändpunkt | Beskrivning |
| --- | --- | --- |
| POST | /api/register | registrera ny användare |
| POST | /api/login | logga in |
| POST | /api/logout | logga ut |


Struktur för record-objekt, skickas samt returneras som JSON:

{
name: 'alla får påsar',
artist: 'magnus uggla',
record_type: 'cd',
release_year: '1998',
stock: '200'
}

Struktur för track-objekt, skickas samt returneras som JSON:

{
title: 'johnni balle',
length: '187',
track_no: '5',
record_id: '32'
}

