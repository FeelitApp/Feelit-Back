# Feelit

Some people, for a variety of reasons, find it difficult to identify the feelings they are experiencing, and are unable to find the words to describe what is driving them at any given moment. In psychology, it is generally accepted that in order to feel fulfilled and more at peace with ourselves, it is beneficial to know ourselves. That's where Feelit comes in. 

We have designed Feelit as a tool to help you identify your emotions, inspired by the Wheel of Emotions developed by the American psychologist Robert Plutchik in 1980. In the form of a short questionnaire, designed as a 'funnel' - from the most general to the most specific - Feelit leads the user to identify the emotion that is running through him or her, and then to question the best way to deal with it, in particular by suggesting a correspondence with human needs. 

This repository is the backend part of Feelit app, developed with Symfony. It manages data and provides necessaries APIs for the frontend part of the app.

## Installation

Prerequisites:
- Docker
- Docker Compose

Clone the repository:
```bash
   git clone https://github.com/FeelitApp/Feelit-Back.git

```

Navigate to the project repository:
```bash
   cd Feelit-Back

```

Create and start Docker containers:
```bash
   docker-compose up --build

```

Configure the environment variables by duplicating .env.example and renaming it .env. Modify the values according to your needs.
    
## Usage

To run the server locally:

```bash
docker-compose up
```

## Screenshots

<img src="https://github.com/FeelitApp/Feelit-Front/assets/115532914/389ea11b-7f1a-4845-b25e-6feb88fbcc4b" alt="Homepage" width="400"/>
<img src="https://github.com/FeelitApp/Feelit-Front/assets/115532914/10ed4aa6-8b6d-4d77-afa6-ea4d32678eca" alt="Dashboard" width="400"/>
<img src="https://github.com/FeelitApp/Feelit-Front/assets/115532914/375c6a2f-801c-4cc8-9165-f7950f8fefae" alt="Sensations" width="400"/>
<img src="https://github.com/FeelitApp/Feelit-Front/assets/115532914/aee46678-15dc-48c7-a7c5-c62a9b742472" alt="Needs" width="400"/>


## Running Tests

Prerequisites :
- PHPUnit framework installed
To run tests, run the following command

```bash
  php bin/phpunit tests
```


## Authors

- [@Darondouche](https://github.com/Darondouche)
- [@justine-rgl](https://github.com/justine-rgl)
- [@TheoSeuge](https://github.com/TheoSeuge)


## Support

For support, email feelit.ada@gmail.com or use the contact form available on our website.


## Links

- [Feelit](https://feelit-app.com/)
- [Docker documentation](https://docs.docker.com/)
- [Symfony documentation](https://symfony.com/doc/current/index.html)
- [PHPUnit documentation](https://phpunit.de/documentation.html)



# Documentation API REST

## Get list of Emotion

`GET /api/emotion`

    curl -i -H 'Accept: application/json' http://localhost:8000/api/emotion

#### Response

    HTTP/1.1 200 OK
    Host: localhost:8000
    Connection: close
    X-Powered-By: PHP/8.2.15
    Cache-Control: no-cache, private
    Date: Mon, 01 Jul 2024 12:03:21 GMT
    Content-Type: application/json
    X-Robots-Tag: noindex

    []

##### Emotion object

    {
        "id": number,
        "content": string,
        "feeling": Feeling
    }

## Get list of Feeling

`GET /api/feeling`

    curl -i -H 'Accept: application/json' http://localhost:8000/api/feeling

#### Response

    HTTP/1.1 200 OK
    Host: localhost:8000
    Connection: close
    X-Powered-By: PHP/8.2.15
    Cache-Control: no-cache, private
    Date: Mon, 01 Jul 2024 12:03:21 GMT
    Content-Type: application/json
    X-Robots-Tag: noindex

    []

##### Feeling object

    {
        "id": number,
        "category": string,
        "emoji": string
    }

## Get list of Sensation

`GET /api/sensation`

    curl -i -H 'Accept: application/json' http://localhost:8000/api/sensation

#### Response

    HTTP/1.1 200 OK
    Host: localhost:8000
    Connection: close
    X-Powered-By: PHP/8.2.15
    Cache-Control: no-cache, private
    Date: Mon, 01 Jul 2024 12:03:21 GMT
    Content-Type: application/json
    X-Robots-Tag: noindex

    []

##### Sensation object

    {
        "id": number,
        "content": string,
        "feeling": Feeling
    }

## Get list of Need

`GET /api/need`

    curl -i -H 'Accept: application/json' http://localhost:8000/api/need

#### Response

    HTTP/1.1 200 OK
    Host: localhost:8000
    Connection: close
    X-Powered-By: PHP/8.2.15
    Cache-Control: no-cache, private
    Date: Mon, 01 Jul 2024 12:03:21 GMT
    Content-Type: application/json
    X-Robots-Tag: noindex

    []

##### Need object

    {
        "id": number,
        "content": string,
        "picture": string,
        "feeling": Feeling
    }

## Register User

`POST /register`

    curl -X POST http://localhost:8000/register \
         -H "Content-Type: multipart/form-data" \
         -F "email=user@example.com" \
         -F "username=username" \
         -F "password=yourpassword"

#### Request Body
- `email` (string): User's email address.
- `username` (string): User's chosen username.
- `password` (string): User's chosen password.

#### Response
- **HTTP 204 No Content**: Registration successful.
- **HTTP 400 Bad Request**: Registration failed. Response will include error details.

## Login User

`POST /login`

    curl -X POST http://localhost:8000/login \
         -H "Content-Type: application/json" \
         -d '{
               "email": "user@example.com",
               "password": "yourpassword"
             }'

#### Request Body
- `email` (string): User's email address.
- `password` (string): User's password.

#### Response
- **HTTP 200 OK**: Login successful, returns user data and sets a cookie with the token.
- **HTTP 400 Bad Request**: Login failed. Response will include error details.

## Logout User

`POST /logout`

    curl -X POST http://localhost:8000/logout \
         -H "Authorization: Bearer <user_token>"

#### Response
- **HTTP 204 No Content**: Logout successful. Clears the user token.

## Get Current User

`GET /me`

    curl -X GET http://localhost:8000/me \
         -H "Authorization: Bearer <user_token>"

#### Response
- **HTTP 200 OK**: Returns the current authenticated user's data.
- **HTTP 403 Forbidden**: User is not authenticated.

#### User Object

    {
        "id": number,
        "uuid": string,
        "roles": array,
        "email": string,
        "username": string,
        "token": string
    }
