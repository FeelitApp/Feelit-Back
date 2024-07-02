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
